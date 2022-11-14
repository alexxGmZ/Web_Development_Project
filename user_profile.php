<?php
	require './partial/database_connection.php';

	if (!isset($_SESSION['is_logged_in'])){
		header("Location: ./login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link href="./style/global_style.css" rel="stylesheet" type="text/css">
	<link href="./style/user_profile.css" rel="stylesheet" type="text/css">

	<?php
		require_once './style/bootstrap.html';
		require_once './style/ubuntu_regular_font.html';
	?>
</head>

<body class="">
	<?php
		//require_once './partial/navbar.php';
		//require './partial/logged_in_navbar.php';

		// use if session is already implemented
		if(isset($_SESSION['is_logged_in']))
			require './partial/logged_in_navbar.php';
		else
			require './partial/navbar.php';

		// echo '<pre>';
		// var_dump($_SESSION['user_info']);
		// echo '</pre>';
	?>
	<div class="text-center">
		<h1 class="text-dark fw-bold p-3">Your Profile</h1>
	</div>
	<div class="profile_area border shadow-lg rounded-3 p-3">
		<?php
			echo '<pre>';
			var_dump($_SESSION['user_info']);
			echo '</pre>';
		?>
	</div>
</body>
</html>
