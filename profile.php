<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Profile</title>
		<meta name="author" content="Samuel Kontiomaa">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<h1>Profile</h1>
		</header>
		<main>
			<nav id="navigation">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="index.php">Front page</a></li>
					<li><a href="newAthlete.php">Enroll</a></li>
					<li><a href="athleteList.php">Browse</a></li>
					<li><a href="searchAthletes.php">Search</a></li>
					<li><a href="deleteAthlete.php">Remove</a></li>
					<li><a href="settings.php">Settings</a></li>
				</ul>
			</nav>
			<section class="padding">
				<?php
					if(isset($_POST["profile"])){
						try
						{
							$id=$_POST["id"];
							require_once "athletePDO.php";
							$database=new athletePDO();
							$result=$database->getAthleteProfile($id);
							foreach($result as $row){
								print("<h4>");
								print("Name: ".$row->getFirstname());
								print(" ".$row->getLastname());
								print("</h4><br>");
								print("<p>Born: ".$row->getDayOfBirth()."</p>");
								print("<p>Tel: ".$row->getPhoneNo()."</p>");
								print("<p>Email: ".$row->getEmail()."</p><br>");							
								print("<p>Address: ".$row->getAddress()."</p>");
								print("<p>Zip: ".$row->getZip()."</p>");
								print("<p>City: ".$row->getCity()."</p>");
								print("<p>Join date: ".$row->getJoinDate()."</p><br>");
								print("<p>Notes: ".$row->getNotes()."</p><br>");							
							}
						} catch (Exception $error) {
							print($error->getMessage());
							header("location: error.php?error=".$error->getMessage());
							exit;
						}
					}
				?>
			</section>
		</main>
	</body>
</html>
