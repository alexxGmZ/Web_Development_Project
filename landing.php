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
	function posted_meme_layout($post, $index, $pdo){
		// debugging purposes
		// echo "<pre>";
		// var_dump($post);
		// echo "</pre>";

		$id = $post["USER_ID"];
		$poster = get_poster_user_name($pdo, $id);
		// echo "<pre>";
		// var_dump($poster);
		// echo "</pre>";

		$poster_profile_pic = get_poster_profile_pic($pdo, $id);
		// echo "<pre>";
		// var_dump($poster_profile_pic);
		// echo "</pre>";
?>
		<div class="row rounded-2 border shadow mb-4 pt-3 pb-3 ps-2 pe-2">
			<?php if ($index == 0): ?>
				<h1 class="text-center mb-4">Funniest Meme of the Day</h1>
			<?php endif ?>

			<div class="row">
				<!-- when not logged in, clicking will redirect to login page -->
				<a class="text-decoration-none text-dark" href="<?php echo (isset($_SESSION['is_logged_in']) ? "" : "./login.php") ?>">
					<div class="row">
						<div class="col-auto me-2 profile-pic-container">
							<img class="poster-profile-pic" src="<?php echo $poster_profile_pic; ?>">
						</div>
						<b class="col align-self-center"><?php echo $poster; ?></b>
					</div>
				</a>
			</div>

			<h3 class="text-center"><?php echo $post["TITLE"];?></h3>

			<div class="text-center border rounded-2 p-2">
				<img class="img-fluid rounded mx-auto d-block" src="./uploaded_files/memes_posted/<?php echo $post['POST_IMAGE'];?>">
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
								<label class="col"><?php echo $post["DOWNVOTE"];?></label>
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
								<label class="col"><?php echo $post["DOWNVOTE"];?></label>
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

<body>
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

	<!-- Menu -->
	<div id="mySidenav" class="sidenav pt-8">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="<?php echo (isset($_SESSION['is_logged_in']) ? './landing.php' : './login.php') ?>">Pinoy Memes</a>
		<a href="<?php echo (isset($_SESSION['is_logged_in']) ? './landing.php' : './login.php') ?>">Anime</a>
		<a href="<?php echo (isset($_SESSION['is_logged_in']) ? './landing.php' : './login.php') ?>">Animals</a>
		<a href="<?php echo (isset($_SESSION['is_logged_in']) ? './landing.php' : './login.php') ?>">Funniest Meme</a>
	</div>

	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>

	<script>
		function openNav() {
		  document.getElementById("mySidenav").style.width = "250px";
		}

		function closeNav() {
		  document.getElementById("mySidenav").style.width = "0";
		}
	</script>


	<div class="post-body">
		<?php
			for($index = 0 ; $index < $row_limit ; $index++){
				// when upvote and downvote is null in the database
				if ($post[$index]['UPVOTE'] == NULL || $post[$index]['UPVOTE'] < 0)
					$post[$index]['UPVOTE'] = 0;
				if ($post[$index]['DOWNVOTE'] == NULL || $post[$index]['DOWNVOTE'] < 0)
					$post[$index]['DOWNVOTE'] = 0;

				posted_meme_layout($post[$index], $index, $pdo);
			}
		?>
	</div>

	<!-- Footer -->
	<?php require_once './partial/footer.php'; ?>
	<!-- Footer -->
</body>
</html>

