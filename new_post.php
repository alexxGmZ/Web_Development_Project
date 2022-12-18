<?php
	/*
		Database Name: article_site
		Table Name: Written_Article
	*/
	// comment out of needed or for debugging purposes
	require_once './partial/database_connection.php';
	if (!isset($_SESSION['is_logged_in']))
		header("Location: ./landing.php");

	$title = $_POST['title'] ?? null;
	$user_id = $_SESSION['user_info']['USER_ID'];
	// $content = $_POST['content'] ?? null;
	// $category = $_POST['category'] ?? null;
	// $publish_date = $_POST['publish_date'] ?? null;

	$image = $_POST['image'] ?? null;
	$upload_ok = 1;

	// $author_name = $_POST['author_name'] ?? null;

	$has_error = 0;
	$error_msg = 'Please fill out the required fields.';


	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(!isset($title) || strlen(trim($title)) == 0) $has_error = 1;
		// if(!isset($content) || strlen(trim($content)) == 0) $has_error = 1;
		// // if(!isset($thumbnail) || strlen(trim($thumbnail)) == 0) $has_error = 1;
		// if(!isset($author_name) || strlen(trim($author_name)) == 0) $has_error = 1;
		// if(!isset($category) || strlen(trim($category)) == 0) $has_error = 1;
		// if(!isset($publish_date) || strlen(trim($publish_date)) == 0) $has_error = 1;

		//
		//    Post Image Upload Validation
		//
		$target_directory = './uploaded_files/memes_posted/';
		$image_file_type = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

		$time_stamp = time();
		$file_destination = $target_directory."post_{$time_stamp}.{$image_file_type}";
		$image = "post_{$time_stamp}.{$image_file_type}";
		$upload_file_size = 10000000;

		// checks if form is submitted
		if (isset($_POST['submit'])){
			// gets file size
			$image_file_size = filesize($_FILES['image']['tmp_name']);
			if ($image_file_size === false){
				$has_error = 1;
				$upload_ok = 0;
			}
		}

		// checks file if more than 10MB, if not file goes upload
		if ($_FILES['image']['size'] > $upload_file_size){
			$has_error = 1;
			$upload_ok = 0;
		}

		// Allow certain file formats
		if ($image_file_type != 'jpg' && $image_file_type != 'jpeg' && $image_file_type != 'png' && $image_file_type != 'gif'){
			$has_error = 1;
			$upload_ok = 0;
		}

		// Upload File if has no error
		if ($upload_ok == 1 && $has_error == 0){
			$result = move_uploaded_file($_FILES['image']['tmp_name'], $file_destination);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create Article</title>

	<!-- CSS -->
	<link href="./style/new_post.css" rel="stylesheet" type="text/css">
	<!-- CSS -->

	<?php
		// global requirements: favicon, global_style.css, Bootstrap, and Global Font
		require_once './partial/global_requirements.html';
	?>
</head>

<body class="">
	<!-- Navbar -->
	<?php
		// require_once './partial/navbar.php';
		// require_once './partial/logged_in_navbar.php';

		// use if session is implemented
		if (isset($_SESSION['is_logged_in']))
			require_once './partial/logged_in_navbar.php';
		else
			require_once './partial/navbar.php';
	?>
	<!-- Navbar -->

	<div class="text-center">
		<h1 class="text-dark fw-bold p-3">Post a Meme</h1>
		<!-- Error Message -->
		<?php if($has_error == 1): ?>
			<div class="col-6 mx-auto alert alert-danger pt-3 pb-3" role="alert">
				<strong>Attention!</strong><br>
				<span><?php echo $error_msg; ?></span>
			</div>
		<?php endif; ?>
		<!-- Error Message -->
	</div>

	<div class="new_post_area border shadow-lg mt-3 p-3 rounded-3">
		<form class="m-2" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
		  <!-- Title -->
			<div class="mb-3
				<?php
					echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($title) || strlen(trim($title)) == 0) ? 'has_error' : '' );
				?>">
				<label for="title" class="form-label">Title</label>
				<textarea class="form-control text-center fs-3 fw-bold" type="text" id="title" name="title"><?php echo $title; ?></textarea>
			</div>
			<!-- Title -->

			<!-- Image Upload -->
			<div class="mb-4">
				<label for="image" class="form-label mt-2">Upload Post Image</label>
				<input class="form-control mb-3" type="file" name="image" accept="image/*" onchange="readURL(this);">

				<!-- Image Preview -->
				<script src="./partial/image_upload_preview.js"></script>
				<div class="border p-2 text-center">
					<p>Image Preview</p>
					<img class="img-fluid" id="image" alt="" src="http://placehold.it/180"">
				</div>
				<!-- Image Preview -->
			</div>
			<!-- Image Upload -->

			<!-- Upload Picture Status Feedback -->
			<?php if (isset($_POST['submit']) && $upload_ok == 0): ?>
				<div class="mx-auto alert alert-danger pt-3 text-center" role="alert">
					<strong>Image Upload Failed</strong><br>
					<?php if ($_FILES['image']['size'] > $upload_file_size): ?>
						<span>Exceeded 5MB File Size</span>
					<?php endif; ?>

					<?php if ($image_file_type != 'jpg' && $image_file_type != 'jpeg' && $image_file_type != 'png' && $image_file_type != 'gif'): ?>
						<span>File Format Not Supported</span>
					<?php endif; ?>
				</div>
			<?php elseif (isset($_POST['submit']) && $upload_ok == 1 && $has_error == 0): ?>
				<div class="mx-auto alert alert-success pt-3 text-center" role="alert">
					<strong>Image Successfully Uploaded</strong>
					<br>
				</div>
			<?php endif; ?>
			<!-- Upload Picture Status Feedback -->

			<!-- Post Button -->
			<div class="text-center mb-1">
				<button name="submit" type="submit" class="btn btn-success rounded-pill">Post Meme</button>
				<?php
					if(isset($_POST['submit']) && $has_error == 0){
						// function body is in database_connection.php
						insert_new_post($pdo, $user_id, $title, $image, $upvote, $downvote);
						echo ' <script type="text/javascript">window.location.href = "./landing.php";</script>';
					}
				?>
			</div>
			<!-- Post Button -->
		</form>
	</div>

	<!-- Footer -->
	<?php require_once './partial/footer.php'; ?>
	<!-- Footer -->
</body>
</html>
