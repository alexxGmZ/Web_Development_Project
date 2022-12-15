<?php
	// database connection
	require_once './partial/database_connection.php';

	// new database (memesite)
	$statement = $pdo->prepare('
		SELECT * FROM `Written_Posts`
		ORDER BY `Written_Posts`.`DATE_POSTED` DESC
	');

	$statement->execute();
	$row_limit = $statement->rowCount();
	$post = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
	// funniest meme layout design function
	function top_meme_layout($post){
		// debugging purposes
		// var_dump($post);
?>
		<div class="row rounded-2 border shadow mb-4 pt-3 pb-3 ps-2 pe-2">
			<h1 class="text-center mb-4">Funniest Meme of the Day</h1>

			<h3 class="text-center"><?php echo $post["TITLE"];?></h3>

			<div class="text-center border rounded-2 p-2">
				<img class="img-fluid" src="./uploaded_files/memes_posted/<?php echo $post['POST_IMAGE'];?>">
			</div>

			<div class="row pt-3">
				<!-- when not logged in, redirect buttons to login page -->
				<?php if (!isset($_SESSION['is_logged_in'])): ?>
					<div class="col justify-content-end d-inline-flex">
						<a class="btn btn-outline-primary" type="button" href="./login.php">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/caret-up.svg">
								<label class="col"><?php echo $post["UPVOTE"];?></label>
							</div>
						</a>
					</div>
					<div class="col-auto p-0 text-center">
						<a class="btn btn-outline-danger" type="button" href="./login.php">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/caret-down.svg">
								<label class="col"><?php echo $post["UPVOTE"];?></label>
							</div>
						</a>
					</div>
					<div class="col">
						<a class="btn btn-outline-success rounded-pill" type="button" href="./login.php">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/chat-left.svg">
								<label class="col">0</label>
							</div>
						</a>
					</div>

				<?php else: ?>
					<div class="col justify-content-end d-inline-flex">
						<button class="btn btn-outline-primary" type="button">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/caret-up.svg">
								<label class="col"><?php echo $post["UPVOTE"];?></label>
							</div>
						</button>
					</div>
					<div class="col-auto p-0 text-center">
						<button class="btn btn-outline-danger" type="button">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/caret-down.svg">
								<label class="col"><?php echo $post["UPVOTE"];?></label>
							</div>
						</button>
					</div>
					<div class="col">
						<button class="btn btn-outline-success rounded-pill" type="button">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/chat-left.svg">
								<label class="col">0</label>
							</div>
						</button>
					</div>
				<?php endif ?>
			</div>
		</div>
<?php
	}
?>

<?php
	// ordynary meme layout design function
	function ordinary_meme_layout($post){
		// debugging purposes
		// var_dump($post);
?>
		<div class="row rounded-2 border shadow-lg mb-4 pt-3 pb-3 ps-2 pe-2">
			<h3 class="text-center"><?php echo $post["TITLE"];?></h3>

			<div class="text-center border p-2">
				<img class="img-fluid" src="./uploaded_files/memes_posted/<?php echo $post["POST_IMAGE"];?>">
			</div>

			<div class="row pt-3">
				<!-- when not logged in, redirect buttons to login page -->
				<?php if (!isset($_SESSION['is_logged_in'])): ?>
					<div class="col justify-content-end d-inline-flex">
						<a class="btn btn-outline-primary" type="button" href="./login.php">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/caret-up.svg">
								<label class="col"><?php echo $post["UPVOTE"];?></label>
							</div>
						</a>
					</div>
					<div class="col-auto p-0 text-center">
						<a class="btn btn-outline-danger" type="button" href="./login.php">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/caret-down.svg">
								<label class="col"><?php echo $post["UPVOTE"];?></label>
							</div>
						</a>
					</div>
					<div class="col">
						<a class="btn btn-outline-success rounded-pill" type="button" href="./login.php">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/chat-left.svg">
								<label class="col">0</label>
							</div>
						</a>
					</div>

				<?php else: ?>
					<div class="col justify-content-end d-inline-flex">
						<button class="btn btn-outline-primary" type="button">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/caret-up.svg">
								<label class="col"><?php echo $post["UPVOTE"];?></label>
							</div>
						</button>
					</div>
					<div class="col-auto p-0 text-center">
						<button class="btn btn-outline-danger" type="button">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/caret-down.svg">
								<label class="col"><?php echo $post["UPVOTE"];?></label>
							</div>
						</button>
					</div>
					<div class="col">
						<button class="btn btn-outline-success rounded-pill" type="button">
							<div class="row g-0">
								<img class="col me-1" src="./assets/icons/chat-left.svg">
								<label class="col">0</label>
							</div>
						</button>
					</div>
				<?php endif ?>
			</div>
		</div>
<?php
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Landing Page</title>
	<link href="./style/landing_page.css" rel="stylesheet" type="text/css">

	<?php
		// global requirements: favicon, global_style.css, Bootstrap, and Global Font
		require_once './partial/global_requirements.html';
	?>
</head>

<body class="">
	<!-- Navigation Bar -->
	<?php
		//require_once './partial/navbar.php';
		//require './partial/logged_in_navbar.php';

		// use if session is already implemented
		if(isset($_SESSION['is_logged_in']))
			require './partial/logged_in_navbar.php';
		else
			require './partial/navbar.php';
	?>
	<!-- End of Navigation Bar -->

	<div class="post-body">
		<?php
			for($index = 0 ; $index < $row_limit ; $index++){
				// when upvote and downvote is null in the database
				if($post[$index]['UPVOTE'] == NULL)
					$post[$index]['UPVOTE'] = 0;
				if($post[$index]['DOWNVOTE'] == NULL)
					$post[$index]['DOWNVOTE'] = 0;

				if ($index == 0){
					top_meme_layout($post[$index]);
				}
				else{
					ordinary_meme_layout($post[$index]);
				}
			}
		?>
	</div>

	<!-- Footer -->
	<?php require_once './partial/footer.php'; ?>
	<!-- Footer -->
</body>
</html>

