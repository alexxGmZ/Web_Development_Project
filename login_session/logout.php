<?php 
	require_once '../partial/database_connection.php';

	session_unset();
	session_destroy();
	header("Location: ../landing.php");
?>

