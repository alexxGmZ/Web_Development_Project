<?php
	/*
		Database Name: article_site
		Table Name: Written_Article
	*/
	// comment out of needed or for debugging purposes
	require_once './partial/database_connection.php';
	if (!isset($_SESSION['is_logged_in']))
		header("Location: ./landing.php");

	$headline = $_POST['headline'] ?? null;
	$content = $_POST['content'] ?? null;
	$category = $_POST['category'] ?? null;
	$publish_date = $_POST['publish_date'] ?? null;

	$thumbnail = $_POST['thumbnail'] ?? null;
	$upload_ok = 1;

	$author_name = $_POST['author_name'] ?? null;

	$has_error = 0;
	$error_msg = 'Please fill out the required fields.';


	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(!isset($headline) || strlen(trim($headline)) == 0) $has_error = 1;
		if(!isset($content) || strlen(trim($content)) == 0) $has_error = 1;
		// if(!isset($thumbnail) || strlen(trim($thumbnail)) == 0) $has_error = 1;
		if(!isset($author_name) || strlen(trim($author_name)) == 0) $has_error = 1;
		if(!isset($category) || strlen(trim($category)) == 0) $has_error = 1;
		if(!isset($publish_date) || strlen(trim($publish_date)) == 0) $has_error = 1;

//
//    Thumbnail Upload Validation
//
		$target_directory = './uploaded_files/article_thumbnails/';
		$image_file_type = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));

		$time_stamp = time();
		$file_destination = $target_directory."thumbnail_{$time_stamp}.{$image_file_type}";
		$thumbnail = "thumbnail_{$time_stamp}.{$image_file_type}";
		$upload_file_size = 10000000;

		// checks if form is submitted
		if (isset($_POST['submit'])){
			// gets file size
			$image_file_size = filesize($_FILES['thumbnail']['tmp_name']);
			if ($image_file_size === false){
				$has_error = 1;
				$upload_ok = 0;
			}
		}

		// checks file if more than 10MB, if not file goes upload
		if ($_FILES['thumbnail']['size'] > $upload_file_size){
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
			$result = move_uploaded_file($_FILES['thumbnail']['tmp_name'], $file_destination);
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
	<link href="./style/global_style.css" rel="stylesheet" type="text/css">
	<link href="./style/new_article_css.css" rel="stylesheet" type="text/css">
	<!-- CSS -->

	<?php
		require_once './style/bootstrap.html';
		require_once './style/ubuntu_regular_font.html';
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
		<h1 class="text-dark fw-bold p-3">Create Article</h1>
		<!-- Error Message -->
		<?php if($has_error == 1): ?>
			<div class="col-6 mx-auto alert alert-danger pt-3 pb-3" role="alert">
				<strong>Attention!</strong><br>
				<span><?php echo $error_msg; ?></span>
			</div>
		<?php endif; ?>
		<!-- Error Message -->
	</div>

	<div class="new_article_area border shadow-lg mt-3 mb-4 p-3 rounded-3">
		<form class="m-2" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
		  <!-- Headline -->
			<div class="mb-3
				<?php
					echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($headline) || strlen(trim($headline)) == 0) ? 'has_error' : '' );
				?>">
				<label for="headline" class="form-label">Headline</label>
				<textarea class="form-control text-center fs-3 fw-bold" type="text" id="headline" name="headline"><?php echo $headline; ?></textarea>
			</div>
			<!-- Headline -->

			<!-- Content -->
			<div class="mb-3
				<?php
					echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($content) || strlen(trim($content)) == 0) ? 'has_error' : '' );
				?>">
				<label for="content" class="form-label">Content</label>
				<textarea class="form-control content_textarea_height"  id="content" name="content"><?php echo $content; ?></textarea>
			</div>
			<!-- Content -->

			<div class="row mb-3">
				<!-- Author Name -->
				<div class="col
					<?php
						echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($author_name) || strlen(trim($author_name)) == 0) ? 'has_error' : '' );
					?>">
					<label for="author_name" class="form-label">Author</label>
					<input type="text" class="form-control" id="author_name" name="author_name" value="<?php echo $author_name; ?>">
				</div>
				<!-- Author Name -->

				<!-- Article Thumbnail Upload and Validation -->
				<div class="col ">
					<label for="thumbnail" class="form-label">Article Thumbnail</label>
					<div class="row ms-2 mb-1
						<?php
							echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($thumbnail) || strlen(trim($thumbnail)) == 0) ? 'has_error' : '' );
						?>" style="margin-right: 2px;">

						<input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
					</div>

					<div class="row">
						<?php if (isset($_POST['submit']) && $upload_ok == 0): ?>
							<div class="mx-auto alert alert-danger pt-3 text-center" role="alert">
								<strong>Image Upload Failed</strong><br>
								<?php if ($_FILES['thumbnail']['size'] > $upload_file_size): ?>
									<span>Exceeded 10MB File Size</span>
								<?php endif; ?>

								<?php if ($image_file_type != 'jpg' && $image_file_type != 'jpeg' && $image_file_type != 'png' && $image_file_type != 'gif'): ?>
									<span>File Format Not Supported</span>
								<?php endif; ?>
							</div>

						<?php elseif (isset($_POST['submit']) && $upload_ok == 1): ?>
							<div class="mx-auto alert alert-success pt-3 text-center" role="alert">
								<strong>Image Successfully Uploaded</strong><br>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<!-- Article Thumbnail Upload and Validation -->
			</div>

			<div class="row mb-3">
				<!-- Category -->
				<div class="col
					<?php
						echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($category) || strlen(trim($category)) == 0) ? 'has_error' : '' );
					?>">
					<label for="category" class="form-label">Category</label>
					<select class="form-select" id="category" name="category">
						<option selected><?php echo $category; ?></option>
						<option>Science</option>
						<option>Technology</option>
						<option>Sports</option>
						<option>Medicine</option>
						<option>Real Estate</option>
						<option>Stock Market</option>
						<option>Gaming</option>
						<option>Military</option>
						<option>Economy</option>
					</select>
				</div>
				<!-- Category -->

				<!-- Publishing Date -->
				<div class="col
					<?php
						echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($publish_date) || strlen(trim($publish_date)) == 0) ? 'has_error' : '' );
					?>">
					<label for="publish_date" class="form-label">Publish Date</label>
					<input type="date" class="form-control" id="publish_date" name="publish_date" value="<?php echo $publish_date; ?>">
				</div>
				<!-- Publishing Date -->
			</div>

			<!-- Publish Button -->
			<div class="text-center mb-1">
				<button name="submit" type="submit" class="btn btn-success rounded-pill">Publish Article</button>
				<?php
					if(isset($_POST['submit']) && $has_error == 0){
						insert_new_article($pdo, $headline, $content, $category, $publish_date, $thumbnail, $author_name);
						//header("Location: ./landing.php");
						echo ' <script type="text/javascript">window.location.href = "./landing.php";</script>';
					}
				?>
			</div>
			<!-- Publish Button -->
		</form>
	</div>

	<!-- Footer -->
	<?php require_once './partial/footer.php'; ?>
	<!-- Footer -->

</body>
</html>
