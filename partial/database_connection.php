<?php
	session_start();
	//echo '<pre>';
	//var_dump($_SESSION);
	//echo '</pre>';

	// database connection (old database connection)
	// $pdo = new PDO('mysql:host=localhost;port=3306;dbname=article_site', 'root', '');

	// new database connection for memesite
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=memesite', 'root', '');

	// set error
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// for memesite database
	function registration_insert_user($pdo, $firstname, $lastname, $username, $email, $password, $gender, $birthday, $profile_pic, $bio){
		$statement = $pdo->prepare('
			INSERT INTO `Registered_Users`
				(`FIRST_NAME`, `LAST_NAME`, `USER_NAME`, `EMAIL`, `PASSWORD`, `GENDER`, `BIRTHDAY`, `PROFILE_PIC`, `BIO`)
			VALUES
				(:FIRST_NAME, :LAST_NAME, :USER_NAME, :EMAIL, :PASSWORD, :GENDER, :BIRTHDAY, :PROFILE_PIC, :BIO)
		');

		$statement->bindValue(':FIRST_NAME', $firstname);
		$statement->bindValue(':LAST_NAME', $lastname);
		$statement->bindValue(':USER_NAME', $username);
		$statement->bindValue(':EMAIL', $email);
		$statement->bindValue(':PASSWORD', $password);
		$statement->bindValue(':GENDER', $gender);
		$statement->bindValue(':BIRTHDAY', $birthday);
		$statement->bindValue(':PROFILE_PIC', $profile_pic);
		$statement->bindValue(':BIO', $bio);
		$statement->execute();
	}

	// for memesite database
	function insert_new_post($pdo, $user_id, $title, $post_image, $upvote, $downvote){
		$statement = $pdo->prepare('
			INSERT INTO `Written_Posts`
				(`USER_ID`, `TITLE`, `POST_IMAGE`, `UPVOTE`, `DOWNVOTE`)
			VALUES
				(:USER_ID, :TITLE, :POST_IMAGE, :UPVOTE, :DOWNVOTE)
		');
		$statement->bindValue(':USER_ID', $user_id);
		$statement->bindValue(':TITLE', $title);
		$statement->bindValue(':POST_IMAGE', $post_image);
		$statement->bindValue(':UPVOTE', $upvote);
		$statement->bindValue(':DOWNVOTE', $downvote);
		$statement->execute();
	}

	function get_user_login($email, $password, $pdo){

		//$password = md5($password);
		$statement = $pdo->prepare('
			SELECT * FROM `Registered_Users`
			WHERE `EMAIL` = :EMAIL AND `PASSWORD` = :PASSWORD
		');

		$statement->bindValue(':EMAIL', $email);
		$statement->bindValue(':PASSWORD', $password);

		$statement->execute();

		$users = $statement->fetchAll(PDO::FETCH_ASSOC); // returns associative 2 dimensional array
		$users['row_count'] = $statement->rowCount(); // returns 1 if successsful else 0 on failure

		return $users;
	}

	// fetch USER_NAME from Registered_Users database based on the USER_ID inside the Written_Posts database
	function get_poster_user_name($pdo, $user_id){
		$statement = $pdo->prepare('
			SELECT USER_NAME FROM Registered_Users WHERE USER_ID=? LIMIT 1
		');
		$statement->execute([$user_id]);
		$poster = $statement->fetch();
		return $poster[0];
	}

	// fetch PROFILE_PIC from Registered_Users database based on the USER_ID inside the Written_Posts database
	function get_poster_profile_pic($pdo, $user_id){
		$statement = $pdo->prepare('
			SELECT PROFILE_PIC FROM Registered_Users WHERE USER_ID=? LIMIT 1
		');
		$statement->execute([$user_id]);
		$profile_pic = $statement->fetch();
		return $profile_pic[0];
	}

?>
