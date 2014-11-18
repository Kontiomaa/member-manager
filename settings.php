<?php
	if(isset($_POST['username'])){	
		setcookie('username',$_POST['username'],time()+60*60*24*7);
		header("location:index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Settings</title>
		<meta name="author" content="Samuel Kontiomaa">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<h1>Settings</h1>
		</header>
		<main>
			<nav>
				<ul>
					<li><a href="index.php">Front page</a></li>
					<li><a href="newAthlete.php">Enroll</a></li>
					<li><a href="athleteList.php">Browse</a></li>
					<li><a href="searchAthletes.php">Search</a></li>
					<li><a href="deleteAthlete.php">Remove</a></li>
					<li class="active"><a href="#">Settings</a></li>
				</ul>
			</nav>
			<section>
			<form action="" method="post">
				<label>Your name: </label>
				<input type="text" name="username" value="<?php if(isset($_COOKIE['username']))print($_COOKIE['username']); ?>">
				<input class="btn btn-default" type="submit" name="changeUsername" value="Change username">
			</form>
			</section>
		</main>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
