<?php
	// database connection
	require_once './partial/database_connection.php';

	// old database (article_site)
	// $statement = $pdo->prepare('
	// 	SELECT * FROM `Written_Article`
	// 	ORDER BY `Written_Article`.`PUBLISH_DATE` DESC
	// 	LIMIT 10
	// ');

	// new database (memesite)
	$statement = $pdo->prepare('
		SELECT * FROM `Written_Posts`
		ORDER BY `Written_Posts`.`DATE_POSTED` DESC
		LIMIT 10
	');

	$statement->execute();
	// $row_limit = $statement->rowCount();
	$row_limit = 2;
	$articles = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Landing Page</title>
	<link href="./style/global_style.css" rel="stylesheet" type="text/css">
	<link href="./style/landing_page.css" rel="stylesheet" type="text/css">

	<?php
		require_once './style/bootstrap.html';
		require_once './style/ubuntu_regular_font.html';
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

	<div class="m-5">
		<?php
			for($index = 0 ; $index < $row_limit ; $index++){
				// Make use don't convert spaces to tabs or the opposite, or it will parse error
				// Heredoc strings are whitespace sensitive
				if ($index == 0){
					echo <<< FUNNIEST_MEME
						<div class="row rounded-2 border shadow mb-3 pt-3 pb-3">

							<h1 class="text-center mb-4">Funniest Meme of the Day</h1>
							<p></p>
							<p></p>
							<p></p>
							<p></p>
							<p></p>

						</div>
					FUNNIEST_MEME;
				}
				else{
					echo <<< SUB_MEMES
						<div class="row rounded-2 border shadow-lg mb-2 pt-3 pb-3">

							<h3 class="text-center mb-4">Meh Meme of the Day</h3>
							<p></p>
							<p></p>
							<p></p>
							<p></p>
							<p></p>

						</div>
					SUB_MEMES;
				}
			}
		?>
	</div>

	<!-- Footer -->
	<?php require_once './partial/footer.php'; ?>
	<!-- Footer -->
</body>
</html>

