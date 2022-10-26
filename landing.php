<?php
	// database connection
	require_once './partial/database_connection.php';

	// Only 10 Articles can be outputted in the landing page
	$statement = $pdo->prepare('
		SELECT * FROM `Written_Article` 
		ORDER BY `Written_Article`.`PUBLISH_DATE` DESC 
		LIMIT 10
	');
	$statement->execute();
	$row_limit = $statement->rowCount();
	$articles = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link href="./style/global_style.css" rel="stylesheet" type="text/css">
	<link href="./style/landing_page.css" rel="stylesheet" type="text/css">

	<?php
		require_once './style/bootstrap.html';
		require_once './style/ubuntu_regular_font.html';	
	?>
</head>

<body class="teal">
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
					echo <<< HOTTEST_ARTICLE
					<div class="row rounded-2 bg-light mb-2 pt-3 pb-3">
						<h1 class="text-center mb-4">Hottest Topic</h1>

						<img class="mb-3" src="./uploaded_files/article_thumbnails/{$articles[$index]["THUMBNAIL"]}">

						<h2 class="text-center">
							{$articles[$index]["HEADLINE"]}
						</h2>

						<h4 class="text-center">
							By: {$articles[$index]["AUTHOR"]}
						</h4>

						<strong class="text-center">
							{$articles[$index]["PUBLISH_DATE"]}
						</strong>

						<p class="ps-4 pe-4">
							{$articles[$index]["CONTENT"]}
						</p>
					</div>
					HOTTEST_ARTICLE;
				}
				else{
					echo <<< SUB_ARTICLES
					<div class="row rounded-2 bg-light mb-2 pt-3 pb-3">
						<img class="mb-3" src="./uploaded_files/article_thumbnails/{$articles[$index]["THUMBNAIL"]}">

						<h2 class="text-center">
							{$articles[$index]["HEADLINE"]}
						</h2>

						<h4 class="text-center">
							By: {$articles[$index]["AUTHOR"]}
						</h4>

						<strong class="text-center">
							{$articles[$index]["PUBLISH_DATE"]}
						</strong>

						<p class="ps-4 pe-4">
							{$articles[$index]["CONTENT"]}
						</p>
					</div>
					SUB_ARTICLES;
				}
			}
		?>
	</div>

	<!-- Footer -->
	<?php require_once './partial/footer.php'; ?>
	<!-- Footer -->
	<!-- Exp -->
</body>
</html>

