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
		require_once './partial/favicon.html';
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
	<?php
	//Access the Specific Data from the Array
		//Assign the 'user_info' to variable $User to easily access its data individually
		$User = $_SESSION['user_info'];

		$profile_pic = $User["PROFILE_PIC"];
		// echo $User["USER_ID"];
		// echo $User["FIRST_NAME"];
		// echo $User["LAST_NAME"];
		// echo $User["USER_NAME"];
		// echo $User["EMAIL"];
		// echo $User["PASSWORD"];
		// echo $User["GENDER"];
		// echo $User["BIRTHDAY"];
		// echo $User["BIO"];
	?>

	<div class="profile_area border shadow-lg rounded-3 p-3">
		<!-- Upper Area Profile Picture, Profile Name, Username, and Bio -->
		<center>
			<!-- profile picture -->
			<div class="picture-container">
				<a class="profile-picture" href="./uploaded_files/profile_pics/<?php echo $profile_pic; ?>" target="_self">
					<img class="profile-picture border border-2" src="./uploaded_files/profile_pics/<?php echo $profile_pic; ?>" alt="User_image">
				</a>
			</div>

			<!-- name and user-name -->
			<div class="name-container">
				<p class="name">
						<?php
							echo $User["FIRST_NAME"]." ".$User["LAST_NAME"];
						?>
					<span class="username">
						<?php
							echo "( ".$User["USER_NAME"]." )";
						?>
					</span>
				</p>
			</div>

			<!-- user's bio -->
			<div class="bio-container">
				<p class="bio">
					<?php
						echo $User["BIO"];
					?>
				</p>
			</div>

		</center>
		<!-- End of Upper Area Profile Picture, Profile Name, Username, and Bio -->

		<!-- Collapsible Area -->
		<div class="accordion accordion-flush" id="Container">

			<!-- Buttons for collapsible area -->
			<div class="button-container">
				<center>
					<button class="btn posts-button" type="button" data-bs-toggle="collapse" data-bs-target="#Posts">
						<b>Posts</b>
					</button>
					<button class="btn about-button" type="button" data-bs-toggle="collapse" data-bs-target="#About">
						<b>About</b>
					</button>
				</center>
			</div>
			<!-- Buttons for collapsible area -->

			<!-- About -->
			<div id="About" class="collapse" data-bs-parent="#Container">
				<div class="accordion-body">
					<h2 class="About">About</h2>
						<div class="about-container">

							<!-- User Gender -->
							<div class="about-info">
									<div><span><?php echo $User["GENDER"]; ?></span></div>
									<div>Gender</div>
								</div>
							<!-- End User Gender -->

							<!-- User Contact -->
							<div class="about-info">
									<div><span><?php echo $User["EMAIL"]; ?></span></div>
									<div>Contact</div>
								</div>
							<!-- End User Contact -->

							<!-- User Birthday -->
								<div class="about-info">
									<div><span><?php echo $User["BIRTHDAY"]; ?></span></div>
									<div>Birthday</div>
								</div>
							<!-- End User Birthday -->

						</div>
				</div>
			</div>
			<!-- End of About -->

			<!-- Posts -->
			<div id="Posts" class="collapse" data-bs-parent="#Container">
				<div class="accordion-body">
					Posts Here...
				</div>
			</div>
			<!-- End of Posts -->

		</div>
		<!-- End of Collapsible Area -->

	<?php
		// echo '<pre>';
		// $User = $_SESSION['user_info'];
		// var_dump($User);
		// echo '</pre>';
	?>
	</div>

	<!-- Footer -->
	<?php require_once './partial/footer.php'; ?>
	<!-- Footer -->
</body>
</html>
