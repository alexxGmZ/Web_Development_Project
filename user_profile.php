<?php
	require './partial/database_connection.php';

	if (!isset($_SESSION['is_logged_in'])){
		header("Location: ./login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link href="./style/user_profile.css" rel="stylesheet" type="text/css">

	<?php
		// global requirements: favicon, global_style.css, Bootstrap, and Global Font
		require_once './partial/global_requirements.html';
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
	?>
	<?php
		//Access the Specific Data from the Array
		//Assign the 'user_info' to variable $User to easily access its data individually
		// if ($_SESSION['visit_other_profile'] == true)
		// 	$User = $_SESSION['other_user_info'][$_SESSION['visited_id']];
		// else
			$User = $_SESSION['user_info'];

		// echo "<pre>";
		// var_dump($User);
		// echo "</pre>";

		$profile_pic = $User["PROFILE_PIC"];
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
					<?php echo $User["FIRST_NAME"]." ".$User["LAST_NAME"]; ?>
					<span class="username">
						<?php echo "@".$User["USER_NAME"]; ?>
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

		<!-- Start for Tabs in User-profile -->
		<div class="profile-tabs">
			<!-- Start for Timeline-Tab -->
			<input type="radio" name="profile-tabs" id="timeline-tab" checked="checked">
			<label for="timeline-tab">Timeline</label>
			<div class="tab-container">
				<center>
					<h4>Your timeline</h4>
				</center>
				
				<!-- Timeline Posts -->
				<?php
					$posts = get_personal_posts($pdo, $User['USER_ID']);
					//for each loop to access every post made by the user
					foreach ($posts as $post){
						// echo "<pre>";
						// var_dump($post);
						// echo "</pre>";
				?>	

				<div class="post-container">
					<div class="poster-info">
						<div class="poster-photo">
							<!-- poster picture -->
							<a class="profile-picture" href="./uploaded_files/profile_pics/<?php echo $profile_pic; ?>" target="_self">
								<img class="profile-picture border border-2" src="./uploaded_files/profile_pics/<?php echo $profile_pic; ?>" alt="User_image">
							</a>
						</div>
						<!-- username of the poster -->
						<div class="user-name"><b><?php echo $User["USER_NAME"]; ?></b></div>
					</div>

					<!-- title of post -->
					<div class="post-title">
						<center>
							<b><?php echo $post["TITLE"]; ?></b>
						</center>
					</div>

					<div class="posted-photo">
						<div class="photo-container">
							<!-- the posted meme photo -->
							<a href="./uploaded_files/memes_posted/<?php echo $post["POST_IMAGE"]; ?>" target="_self">
								<img src="./uploaded_files/memes_posted/<?php echo $post["POST_IMAGE"]; ?>" alt="posted-photo">
							</a>
						</div>
						
						<div>
							<div class="row pt-3">	
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
							</div>
						</div>

					</div>
				</div>

				<?php	
					}
				?>
				<!-- Timeline Posts -->
				
			</div>
			<!-- End of Timeline-Tab -->

			<!-- Start for About-Tab -->
			<input type="radio" name="profile-tabs" id="about-tab">
			<label for="about-tab">About</label>
			<div class="tab-container">
				<center>
					<h4>About</h4>
				</center>

				<div class="about-container">

					<!-- User Gender -->
					<div class="about-info">
						<div class="info"><span><?php echo $User["GENDER"]; ?></span></div>
						<div>Gender</div>
					</div>
					<!-- End User Gender -->

					<!-- User Contact -->
					<div class="about-info">
						<div class="info"><span><?php echo $User["EMAIL"]; ?></span></div>
						<div>Contact</div>
					</div>
					<!-- End User Contact -->

					<!-- User Birthday -->
					<div class="about-info">
						<div class="info"><span><?php echo $User["BIRTHDAY"]; ?></span></div>
						<div>Birthday</div>
					</div>
					<!-- End User Birthday -->
				</div>
			</div>
			<!-- End of About-Tab -->
		</div>
	<!-- End for Tabs in User-profile -->
	</div>

	<!-- Footer -->
	<?php require_once './partial/footer.php'; ?>
	<!-- Footer -->
</body>
</html>
