<?php
	require_once "newAthleteCheck.php";
	$check;
	session_start();

	if(isset($_POST["makeChanges"])){
		header("location:newAthlete.php");
		exit;
	}

	elseif(isset($_POST["cancelData"])){
		unset($_SESSION["check"]);
		session_write_close();
		header("location:index.php");
		exit;
	}

	elseif(isset($_POST["saveData"])){
		require_once "athletePDO.php";
		$check=$_SESSION["check"];
		$database=new athletePDO();
		$database->addNewAthlete($check);
		unset($_SESSION["check"]);
		session_write_close();
		setcookie("saved",1,time()+5);
		header("location:index.php");
		exit;
	}

	elseif(isset($_SESSION["check"])){
		$check=$_SESSION["check"];
	}
	else
	{
		header("location:index.php");
		exit;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Confirm</title>
		<meta name="author" content="Samuel Kontiomaa">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<h1>Confirm new athlete</h1>
		</header>
		<main>
			<nav id="navigation">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="index.php">Front page</a></li>
					<li class="active"><a href="newAthlete.php">Enroll</a></li>
					<li><a href="athleteList.php">Browse</a></li>
					<li><a href="searchAthletes.php">Search</a></li>
					<li><a href="deleteAthlete.php">Remove</a></li>
					<li><a href="settings.php">Settings</a></li>
				</ul>
			</nav>
			<section>
				<h3>Confirm data:</h3><!-- !! -->
				<form action="" method="post">
				<?php
					print("<p>First name: ".$check->getFirstname()."</p>");
					print("<p>Last name: ".$check->getLastname()."</p>");
					print("<p>Born: ".$check->getDayOfBirth()."</p><br>");
					print("<p>Address: ".$check->getAddress()."</p>");
					print("<p>Zip: ".$check->getZip()."</p>");
					print("<p>City: ".$check->getCity()."</p>");
					print("<p>Tel: ".$check->getPhoneNo()."</p>");
					print("<p>Email: ".$check->getEmail()."</p><br>");
					print("<p>Join date: ".$check->getJoinDate()."</p>");
					print("<p>Notes: ".$check->getNotes()."</p><br>");
				?>
				<p class="buttons">
					<input class="btn btn-warning" type="submit" name="makeChanges" value="Edit">
					<input class="btn btn-success" type="submit" name="saveData" value="Save">
					<input class="btn btn-danger" type="submit" name="cancelData" value="Cancel">
				</p>
				</form>
			</section>
		</main>
	</body>
</html>
