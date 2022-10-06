<?php 
	// database connection and session functions
	require_once './partial/database_connection.php';
	if(isset($_SESSION['is_logged_in'])){
		header("Location: ./landing.php");
	}

	$error_msg = 'User Name or Password Might Be Incorrect';

	if (isset($_POST['login_submit'])){
		$email = $_POST['email'] ?? null;
		$login_password = $_POST['login_password'] ?? null;

		$user_data = get_user_login($email, $login_password, $pdo);

		if ($user_data['row_count'] == 1){
			//session_start();
			$_SESSION['user_info'] = $user_data[0];
			$_SESSION['is_logged_in'] = true;

			header("Location: ./landing.php");
		}
		else{
			header("Location: ./login.php?error");
		}
	}
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log-In</title>
	<link href="./style/global_style.css" rel="stylesheet" type="text/css">
	<link href="./style/login_css.css" rel="stylesheet" type="text/css">
  
	<?php
		require_once './style/bootstrap.html';
		require_once './style/ubuntu_regular_font.html';
	?>
</head>
<body class="teal">
	<div class="text-center mb-3">
		<h1 class="text-white p-4">Log-In</h1>

		<!-- Error Message -->
		<?php if (isset($_GET['error'])): ?>
			<div class="col-6 mx-auto alert alert-danger pt-3 pb-3" role="alert">
				<strong>Attention!</strong>
				<p><?php echo $error_msg; ?></p>
			</div>
		<?php endif; ?>
		<!-- Error Message -->
	</div>


	<div class="bg-light login_area rounded-3 p-3">
		<form class="m-2" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<!-- Email Input -->
			<div class="form-floating mb-3">
				<input type="text" name="email" id="email" class="form-control" placeholder=" ">
				<label>Email:</label>
			</div>
			<!-- Email Input -->

			<!-- Password Input -->
			<div class="form-floating mb-1">
				<input type="password" id="login_password" name="login_password" class="form-control" placeholder=" ">
				<label>Password:</label>
			</div>
			<!-- Password Input -->

			<!-- Show or Hide Password Checkbox -->
			<div class="mb-4">
				<input type="checkbox" name="show_password" onclick="showOrHidePassword()">
				<label>Show Password</label>
				<script src="./partial/show_hide_password.js"></script>
			</div>
			<!-- Show or Hide Password Checkbox -->

			<center>
				<!-- Login Button -->
				<button name="login_submit" type="submit" class="btn btn-success rounded-pill mb-3">
					Log-In   
				</button>
				<!-- Login Button -->
				
				<p>or</p>
				<!-- Create Account or Register Button -->
				<a href="registration.php" class="btn btn-outline-success rounded-pill" >
					Create Account
				</a>
				<!-- Create Account or Register Button -->
			</center>
		</form>
	</div>

	<!-- Footer -->
	<?php require_once './partial/footer.php'; ?>
	<!-- Footer -->
</body>
</html>
