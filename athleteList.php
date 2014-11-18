<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Browse</title>
		<meta name="author" content="Samuel Kontiomaa">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<h1>Browse</h1>
		</header>
		<main>
			<nav>
				<ul>
					<li><a href="index.php">Front page</a></li>
					<li><a href="newAthlete.php">Enroll</a></li>
					<li class="active"><a href="#">Browse</a></li>
					<li><a href="searchAthletes.php">Search</a></li>
					<li><a href="deleteAthlete.php">Remove</a></li>
					<li><a href="settings.php">Settings</a></li>
				</ul>
			</nav>
			<section>
				<?php
					try
					{
						require_once "athletePDO.php";
						$database=new athletePDO();
						$result=$database->athleteList();
						foreach($result as $row){
							$id=$row->getId();
							print("<form action='profile.php' method='post'>\n");
							print("<b>");
							print($row->getId().".");
							print(" ".$row->getFirstname());
							print(" ".$row->getLastname());
							print("</b>");
							print("<input type='hidden' name='id' value='$id'>\n");
							print("<input class='btn btn-default' type='submit' name='profile' value='Profile'></p>\n");
							print("</form>\n");
						}
					} catch (Exception $error) {
    					print($error->getMessage());
						header("location: error.php?error=".$error->getMessage());
						exit;
					}
				?>
			</section>
		</main>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
