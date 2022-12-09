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
	$row_limit = $statement->rowCount();
	// $row_limit = 2;
	$post = $statement->fetchAll(PDO::FETCH_ASSOC);
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
			if(isset($_SESSION['is_logged_in'])){
				for($index = 0 ; $index < $row_limit ; $index++){

					// when upvote and downvote is null in the database
					if($post[$index]['UPVOTE'] == NULL)
						$post[$index]['UPVOTE'] = 0;
					if($post[$index]['DOWNVOTE'] == NULL)
						$post[$index]['DOWNVOTE'] = 0;

					// Make use don't convert spaces to tabs or the opposite, or it will parse error
					// Heredoc strings are whitespace sensitive
					if ($index == 0){
						// for debugging purposes
						var_dump($post[$index]);

						echo <<< FUNNIEST_MEME
							<div class="row rounded-2 border shadow mb-3 pt-3 pb-3 ps-2 pe-2">
								<h1 class="text-center mb-4">Funniest Meme of the Day</h1>

								<h3 class="text-center">{$post[$index]['TITLE']}</h3>

								<div class="text-center border rounded-2 p-2">
									<img class="img-fluid" src="./uploaded_files/memes_posted/{$post[$index]['POST_IMAGE']}">
								</div>

								<div class="row g-0 pt-3">
									<div class="col d-inline-flex justify-content-end me-2">
										<button class="btn btn-outline-primary" type="button">
											<div class="row g-0">
												<img class="col me-1" src="./assets/icons/caret-up.svg">
												<label class="col">{$post[$index]['UPVOTE']}</label>
											</div>
										</button>
									</div>
									<div class="col ms-2">
										<button class="btn btn-outline-danger" type="button">
											<div class="row g-0">
												<img class="col me-1" src="./assets/icons/caret-down.svg">
												<label class="col">{$post[$index]['DOWNVOTE']}</label>
											</div>
										</button>
									</div>
								</div>

								<p></p>
							</div>
						FUNNIEST_MEME;
					}
					else{
						// for debugging purposes
						var_dump($post[$index]);

						echo <<< SUB_MEMES
							<div class="row rounded-2 border shadow-lg mb-2 pt-3 pb-3 ps-2 pe-2">

								<h3 class="text-center mb-4">Meh Meme of the Day</h3>

								<h3 class="text-center">{$post[$index]['TITLE']}</h3>

								<div class="text-center border p-2">
									<img class="img-fluid" src="./uploaded_files/memes_posted/{$post[$index]['POST_IMAGE']}">
								</div>

								<div class="row g-0 pt-3">
									<div class="col d-inline-flex justify-content-end me-2">
										<button class="btn btn-outline-primary" type="button">
											<div class="row g-0">
												<img class="col me-1" src="./assets/icons/caret-up.svg">
												<label class="col">{$post[$index]['UPVOTE']}</label>
											</div>
										</button>
									</div>
									<div class="col ms-2">
										<button class="btn btn-outline-danger" type="button">
											<div class="row g-0">
												<img class="col me-1" src="./assets/icons/caret-down.svg">
												<label class="col">{$post[$index]['DOWNVOTE']}</label>
											</div>
										</button>
									</div>
								</div>

								<p></p>

							</div>
						SUB_MEMES;
					}
				}
			}
			else{
				for($index = 0 ; $index < $row_limit ; $index++){

					// Make use don't convert spaces to tabs or the opposite, or it will parse error
					// Heredoc strings are whitespace sensitive
					if ($index == 0){
						echo <<< FUNNIEST_MEME
							<div class="row rounded-2 border shadow mb-3 pt-3 pb-3 ps-2 pe-2">
								<h1 class="text-center mb-4">Funniest Meme of the Day</h1>

								<h3 class="text-center">{$post[$index]['TITLE']}</h3>

								<div class="text-center border rounded-2 p-2">
									<img class="img-fluid" src="./uploaded_files/memes_posted/{$post[$index]['POST_IMAGE']}">
								</div>

								<p></p>

							</div>
						FUNNIEST_MEME;
					}
					else{
						echo <<< SUB_MEMES
							<div class="row rounded-2 border shadow-lg mb-2 pt-3 pb-3 ps-2 pe-2">
								<h3 class="text-center mb-4">Meh Meme of the Day</h3>

								<h3 class="text-center">{$post[$index]['TITLE']}</h3>

								<div class="text-center border rounded-2 p-2">
									<img class="img-fluid" src="./uploaded_files/memes_posted/{$post[$index]['POST_IMAGE']}">
								</div>

								<p></p>

							</div>
						SUB_MEMES;
					}
				}
			}
		?>
	</div>

	<!-- Footer -->
	<?php require_once './partial/footer.php'; ?>
	<!-- Footer -->
</body>
</html>

