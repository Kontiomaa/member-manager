<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Search</title>
		<meta name="author" content="Samuel Kontiomaa">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<h1>Search</h1>
		</header>
		<main>
			<nav>
				<ul>
					<li><a href="index.php">Front page</a></li>
					<li><a href="newAthlete.php">Enroll</a></li>
					<li><a href="athleteList.php">Browse</a></li>
					<li class="active"><a href="#">Search</a></li>
					<li><a href="deleteAthlete.php">Remove</a></li>
					<li><a href="settings.php">Settings</a></li>
				</ul>
			</nav>
			<section>
				<div id="search">
				<b class="fl">Search by last name:</b>
				<form class="fr" action="" method="post">
					<input type="text" name="name" placeholder="Last name" value="">
					<input class="btn btn-default" type="submit" name="search" value="Search">
				</form>
				</div>
				<div id="results">
					<hr>
					<?php
						if (isset ($_POST["search"]) && $_POST["name"] !=NULL)
						{
							try
							{
								require_once "athletePDO.php";
								$database=new athletePDO();
								$result=$database->searchAthletes($_POST["name"]);
								if($result!=NULL)
								{
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
								}
								else
								{
									print("<h4 class='error'>0 results</h4>");
								}
							} catch (Exception $error) {
								print($error->getMessage());
								//header("location: error.php?error=".$error->getMessage());
								//exit;
							}
						}
					?>
				</div>
			</section>
		</main>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
