<?php
	session_start();
	//echo '<pre>';
	//var_dump($_SESSION);
	//echo '</pre>';

	// database connection
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=article_site', 'root', '');
	// set error
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	function registration_insert_user($pdo, $firstname, $lastname, $username, $email, $password, $gender, $birthday, $home_add, $profile_pic, $short_bio){
		$statement = $pdo->prepare('
			INSERT INTO `Registered_Users`
				(`FIRST_NAME`, `LAST_NAME`, `USER_NAME`, `EMAIL`, `PASSWORD`, `GENDER`, `BIRTHDAY`, `ADDRESS`, `PROFILE_PIC`, `BIO`)
			VALUES
				(:FIRST_NAME, :LAST_NAME, :USER_NAME, :EMAIL, :PASSWORD, :GENDER, :BIRTHDAY, :ADDRESS, :PROFILE_PIC, :BIO)
		');

		$statement->bindValue(':FIRST_NAME', $firstname);
		$statement->bindValue(':LAST_NAME', $lastname);
		$statement->bindValue(':USER_NAME', $username);
		$statement->bindValue(':EMAIL', $email);
		$statement->bindValue(':PASSWORD', $password);
		$statement->bindValue(':GENDER', $gender);
		$statement->bindValue(':BIRTHDAY', $birthday);
		$statement->bindValue(':ADDRESS', $home_add);
		$statement->bindValue(':PROFILE_PIC', $profile_pic);
		$statement->bindValue(':BIO', $short_bio);
		$statement->execute();
	}

	function insert_new_article($pdo, $headline, $content, $category, $publish_date, $thumbnail, $author_name){
		$statement = $pdo->prepare('
			INSERT INTO `Written_Article`
				(`HEADLINE`, `CONTENT`, `AUTHOR`, `THUMBNAIL`, `CATEGORY`, `PUBLISH_DATE`)
			VALUES
				(:HEADLINE, :CONTENT, :AUTHOR, :THUMBNAIL, :CATEGORY, :PUBLISH_DATE)
		');

		$statement->bindValue(':HEADLINE', $headline);
		$statement->bindValue(':CONTENT', $content);
		$statement->bindValue(':AUTHOR', $author_name);
		$statement->bindValue(':THUMBNAIL', $thumbnail);
		$statement->bindValue(':CATEGORY', $category);
		$statement->bindValue(':PUBLISH_DATE', $publish_date);
		$statement->execute();
	}

	function get_user_login($email,$password,$pdo){

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

?>
