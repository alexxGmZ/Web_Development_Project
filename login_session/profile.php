<?php 

	require '../partial/database_connection.php';

	if (!isset($_SESSION['is_logged_in'])){
		header("Location: ../login.php");
	}

	echo '<p class=""><a href="./logout.php">Sign Out</a></p>';
	echo '<pre>';var_dump( $_SESSION['user_info'] );echo '</pre>'; 
?>