<?php
	/*
		Database Name: article_site
		Table Name: Registered_Users
	*/
	// Database connection and functions
	require_once './partial/database_connection.php';
	if(isset($_SESSION['is_logged_in'])){
		header("Location: ./landing.php");
	}

	$firstname = $_POST['firstname'] ?? null;
	$lastname = $_POST['lastname'] ?? null;
	$username = $_POST['username'] ?? null;
	$email = $_POST['email'] ?? null;
	$password = $_POST['password'] ?? null;
	$gender = $_POST['gender'] ?? null;
	$birthday = $_POST['birthday'] ?? null;
	$home_add = $_POST['home_add'] ?? null;

	// Ignore the Profile Pic Yet
	$profile_pic = $_POST['profile_pic'] ?? null;
	$upload_ok = 1;

	$short_bio = $_POST['short_bio'] ?? null;
	$agree_terms1 = $_POST['agree_terms1'] ?? null;
	$agree_terms2 = $_POST['agree_terms2'] ?? null;

	$has_error = 0;
	$error_msg = 'Information Needed';

	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		// Required Fields
		if (!isset($firstname) || strlen(trim($firstname)) == 0) $has_error = 1;
		if (!isset($lastname) || strlen(trim($lastname)) == 0) $has_error = 1;
		if (!isset($username) || strlen(trim($username)) == 0) $has_error = 1;
		if (!isset($email) || strlen(trim($email)) == 0) $has_error = 1;
		if (!isset($password) || strlen(trim($password)) == 0) $has_error = 1;
		if (!isset($birthday) || strlen(trim($birthday)) == 0) $has_error = 1;
		if (!isset($agree_terms1) || strlen(trim($agree_terms1)) == 0) $has_error = 1;
		if (!isset($agree_terms2) || strlen(trim($agree_terms2)) == 0) $has_error = 1;

//
//    Profile Pic Upload Validation
//
		$target_directory = './uploaded_files/profile_pics/';
		$image_file_type = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));

		$time_stamp = time();
		$target_file = $target_directory."user_{$time_stamp}.{$image_file_type}";
		$profile_pic = "user_{$time_stamp}.{$image_file_type}";
		$upload_file_size = 5000000;

		// checks if form is submitted
		if (isset($_POST['submit'])){
			// gets file size
			$image_file_size = filesize($_FILES['profile_pic']['tmp_name']);

			if ($image_file_size === false){
				$has_error = 1;
				$upload_ok = 0;
			}
		}

		// checks file if more than 5MB, if not file goes upload
		if ($_FILES['profile_pic']['size'] > $upload_file_size){
			$has_error = 1;
			$upload_ok = 0;
		}

		// Allow certain file formats
		if ($image_file_type != 'jpg' && $image_file_type != 'jpeg' && $image_file_type != 'png' && $image_file_type != 'gif'){
			$has_error = 1;
			$upload_ok = 0;
		}

		if ($upload_ok == 1 && $has_error == 0){
			$result = move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file);
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link href="./style/global_style.css" rel="stylesheet" type="text/css">
	<link href="./style/registration_css.css" rel="stylesheet" type="text/css">

	<!-- Bootstrap core CSS and JS -->
	<?php
		require_once './style/bootstrap.html';
		require_once './style/ubuntu_regular_font.html';
	?>
</head>

<body class="teal">

	<!-- Navbar -->
	<?php require_once './partial/navbar.php'; ?>
	<!-- Navbar -->

	<div class="text-center">
		<h1 class="text-white p-3">Registration Form</h1>

		<!-- Error Message -->
		<?php if($has_error == 1): ?>
			<div class="col-6 mx-auto alert alert-danger pt-3 pb-3" role="alert">
				<strong class="">Attention!</strong>
				<p><?php echo $error_msg; ?></p>
			</div>
		<?php endif; ?>
		<!-- Error Message -->
	</div>

	<div class="bg-light registration_area rounded-3 p-3">
		<form class="ms-2 me-2 mb-2 mt-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
			<!-- Name -->
			<div class="form-floating mb-3 
				<?php echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($firstname) || strlen(trim($firstname)) == 0) ? 'has_error' : '' ); ?>">
				<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" value="<?php echo $firstname; ?>">
				<label>First Name:</label>
			</div>

			<div class="form-floating mb-3 
				<?php echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($lastname) || strlen(trim($lastname)) == 0) ? 'has_error' : '' ); ?>">
				<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" value="<?php echo $lastname; ?>">
				<label>Last Name: </label>
			</div>
			<!-- Name -->

			<!--- Username --->
			<div class="form-floating mb-3 
				<?php echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && (!isset($username) || strlen(trim($username)) == 0) ? 'has_error' : '' ); ?>">
				<input type="text" class="form-control" placeholder="floatinginput" id="username" name="username" value="<?php echo $username; ?>">
				<label>Username: </label>
			</div>
			<!--- Username --->

			<!--- Email --->
			<div class="form-floating mb-3 
				<?php echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($email) || strlen(trim($email)) == 0) ? 'has_error' : '' ); ?>">
				<input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $email; ?>">
				<label>Email: </label>
			</div> 
			<!--- Email --->

			<!--- Password --->
			<div class="form-floating mb-1 
				<?php echo ( $_SERVER['REQUEST_METHOD'] === 'POST' &&( !isset($password) || strlen(trim($password)) == 0) ? 'has_error' : '' ); ?>">
				<input type="password" class="form-control" id="login_password" name="password" placeholder=" ">
				<label>Password: </label>
			</div>

			<div class="mb-3">
				<input type="checkbox" name="show_password" onclick="showOrHidePassword()">
				<label class="fw-light">Show Password</label>
				<script src="./partial/show_hide_password.js"></script>
			</div>
			<!--- Password --->

			<!--- Gender --->
			<div class="form-floating mb-3">
				<select class="form-select" id="gender" name="gender">
					<option selected><?php echo $gender; ?></option>
					<option>Male</option>
					<option>Female</option>
				</select>
				<label>Gender: </label>
			</div>
			<!--- Gender --->

			<!--- Birthday --->
			<div class="form-floating mb-3
				<?php echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($birthday) || strlen(trim($birthday)) == 0) ? 'has_error' : '' ); ?>">
				<input type="date" name="birthday" class="form-control" placeholder="Birthday" value="<?php echo $birthday; ?>">
				<label>Birthday:</label>
			</div>
			<!--- Birthday --->

			<!--- Address --->
			<div class="form-floating mb-3">
			<input type="text" class="form-control" name="home_add" placeholder=" " value="<?php echo $home_add; ?>">
				<label>Address:</label>
			</div>
			<!--- Address --->

			<!-- Upload Profile Picture -->
			<div class="mb-2">
				<label for="profile_pic" class="form-label mt-2">Profile Picture</label>
				<input class="form-control mb-1" type="file"  id="profile_pic" name="profile_pic" accept="image/*">
			</div>
			<!-- Upload Profile Picture -->

			<!-- Upload Profile Picture Status Feedback -->
			<?php if (isset($_POST['submit']) && $upload_ok == 0): ?>
				<div class="mx-auto alert alert-danger pt-3 text-center" role="alert">
					<strong>Image Upload Failed</strong><br>
					<?php if ($_FILES['profile_pic']['size'] > $upload_file_size): ?>
						<span>Exceeded 5MB File Size</span>
					<?php endif; ?>

					<?php if ($image_file_type != 'jpg' && $image_file_type != 'jpeg' && $image_file_type != 'png' && $image_file_type != 'gif'): ?>
						<span>File Format Not Supported</span>
					<?php endif; ?>
				</div>
			<?php elseif (isset($_POST['submit']) && $upload_ok == 1): ?>
				<div class="mx-auto alert alert-success pt-3 text-center" role="alert">
					<strong>Image Successfully Uploaded</strong>
					<br>
				</div>
			<?php endif; ?>
			<!-- Upload Profile Picture Status Feedback -->

			<!--- Bio --->
			<div>
				<label for="bio" class="form-label">Short Bio</label>
				<textarea class="form-control bio_textarea_height" id="short_bio" name="short_bio"></textarea>
			</div>
			<!--- Bio --->

			<!-- Terms Agreement -->
			<div class="text-center mb-2">
				<div class="form-check form-check-inline mt-4 
					<?php echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($agree_terms1) || strlen(trim($agree_terms1)) == 0) ? 'has_error' : '' ); ?>">
					<input class="form-check-input" type="checkbox" value="1" id="agree_terms1" name="agree_terms1">
					<label class="form-check-label" for="flexCheckChecked">
						* I agree with the <a class="text-decoration-none" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">Terms of Service</a>
					</label>
				</div>

				<div class="form-check form-check-inline 
					<?php echo ( $_SERVER['REQUEST_METHOD'] === 'POST' && ( !isset($agree_terms2) || strlen(trim($agree_terms2)) == 0) ? 'has_error' : '' ); ?>">
					<input class="form-check-input" type="checkbox" value="1" id="agree_terms2" name="agree_terms2">
					<label class="form-check-label" for="flexCheckChecked">
						* I agree with the <a class="text-decoration-none" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">Terms & Conditions</a>
					</label>
				</div>
			</div>
			<!-- Terms Agreement -->

			<!-- Submit Button -->
			<div class="text-center mb-2">
				<button name="submit" type="submit" class="btn btn-success rounded-pill">Create Account</button>
				<?php
					// Inert New User to Database
					if(isset($_POST['submit']) && $has_error == 0){
						registration_insert_user($pdo, $firstname, $lastname, $username, $email, $password, $gender, $birthday, $home_add, $profile_pic, $short_bio);
						//header("Location: ./login.php");
						echo '<script type="text/javascript">window.location.href = "login.php";</script>';
					}
				?>
			</div>
			<!-- Submit Button -->

			<p class="text-center"> Already a member? 
				<a class="text-decoration-none" href="./login.php">Login Here</a>
			</p>
		</form>
	</div>

	<!-- Footer -->
	<?php require './partial/footer.php'; ?>
	<!-- Footer -->

</body>
</html>
