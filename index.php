<?php
	$username="";

	if(isset($_COOKIE['username'])){
		$username=$_COOKIE['username'].',';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Front page</title>
		<meta name="author" content="Samuel Kontiomaa">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<h1>Front page</h1>
			<?php
				if(isset($_COOKIE["saved"])){
					print("<h3>New athlete saved!</h3>");
				}
			?>
		</header>
		<main>
			<nav>
				<ul>
					<li class="active"><a href="#">Front page</a></li>
					<li><a href="newAthlete.php">Enroll</a></li>
					<li><a href="athleteList.php">Browse</a></li>
					<li><a href="searchAthletes.php">Search</a></li>
					<li><a href="deleteAthlete.php">Remove</a></li>
					<li><a href="settings.php">Settings</a></li>
				</ul>
			</nav>
			<section>
				<p>Hello <?php echo $username; ?> welcome!</p>
				<p>This is still a work in progress.</p>
			</section>
		</main>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
