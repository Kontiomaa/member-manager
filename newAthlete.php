<?php
	require_once "newAthleteCheck.php";
	session_start();

	if (isset($_POST["send"])){
		$check=new NewAthleteCheck($_POST["firstname"], $_POST["lastname"], $_POST["birth"], $_POST["address"], $_POST["zip"], $_POST["city"], $_POST["phoneNo"], $_POST["email"], $_POST["joinDate"], $_POST["notes"]);

		$_SESSION["check"]=$check;
		session_write_close();

		$firstnameError=$check->checkFirstname();
		$lastnameError=$check->checkLastname();
		$birthDateError=$check->checkDayOfBirth();
		$addressError=$check->checkAddress();
		$zipError=$check->checkZip();
		$cityError=$check->checkCity();
		$phoneNoError=$check->checkPhoneNo();
		$emailError=$check->checkEmail();
		$joinDateError=$check->checkJoindate();
		$notesError=$check->checkNotes();

		if($firstnameError==0&&$lastnameError==0&&$birthDateError==0&&$addressError==0&&$zipError==0&&$cityError==0&&$phoneNoError==0&&$emailError==0&&$joinDateError==0&&$notesError==0)
		{
			header("location:saveNewAthlete.php");
			exit;
		}
	}
	elseif (isset($_POST["cancel"])) {
		unset($_SESSION["check"]);
		session_write_close();
		header("location: index.php");
		exit;
	}
	else {
		if(isset($_SESSION["check"])){
			$check=$_SESSION["check"];
		}
		else{
			$check=new NewAthleteCheck();
		}
		$firstnameError=0;
		$lastnameError=0;
		$birthDateError=0;
		$addressError=0;
		$zipError=0;
		$cityError=0;
		$phoneNoError=0;
		$emailError=0;
		$joinDateError=0;
		$notesError=0;
	}
	//print_r($check);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>New Athlete</title>
		<meta name="author" content="Samuel Kontiomaa">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<h1>New Athlete</h1>
		</header>
		<main>
			<nav id="navigation">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="index.php">Front page</a></li>
					<li class="active"><a href="#">Enroll</a></li>
					<li><a href="athleteList.php">Browse</a></li>
					<li><a href="searchAthletes.php">Search</a></li>
					<li><a href="deleteAthlete.php">Remove</a></li>
					<li><a href="settings.php">Settings</a></li>
				</ul>
			</nav>
			<section>
				<article>
					<form class="padding" action="" method="post">
						<fieldset>
							<legend>Personal information</legend>
							<p>
								<label>Firstname: <span>*</span></label>
								<input type="text" name="firstname" value="<?php print(htmlentities($check->getFirstname(), ENT_QUOTES, 'UTF-8')); ?>">
								<?php
									print("<span class='error'>".$check->getError($firstnameError)."</span>");
								?>
							</p>
							<p>
								<label>Lastname: <span>*</span></label>
								<input type="text" name="lastname" value="<?php print(htmlentities($check->getLastname(), ENT_QUOTES, 'UTF-8')); ?>">
								<?php
									print("<span class='error'>".$check->getError($lastnameError)."</span>");
								?>
							</p>
							<p>
								<label>Date of birth: <span>*</span></label>
								<input type="date" name="birth" value="<?php print(htmlentities($check->getDayOfBirth(), ENT_QUOTES, 'UTF-8')); ?>">
								<?php
									print("<span class='error'>".$check->getError($birthDateError)."</span>");
								?>
							</p>
						</fieldset>
						<fieldset>
							<legend>Contact information</legend>
								<p>
								<label>Address: <span>*</span></label>
								<input type="text" name="address" value="<?php print(htmlentities($check->getAddress(), ENT_QUOTES, 'UTF-8')); ?>">
								<?php
									print("<span class='error'>".$check->getError($addressError)."</span>");
								?>
							</p>
							<p>
								<label>Zip code: <span>*</span></label>
								<input type="text" name="zip" value="<?php print(htmlentities($check->getZip(), ENT_QUOTES, 'UTF-8')); ?>">
								<?php
									print("<span class='error'>".$check->getError($zipError)."</span>");
								?>
							</p>
							<p>
								<label>City: <span>*</span></label>
								<input type="text" name="city" value="<?php print(htmlentities($check->getCity(), ENT_QUOTES, 'UTF-8')); ?>">
								<?php
									print("<span class='error'>".$check->getError($cityError)."</span>");
								?>
							</p>
							<p>
								<label>Telephone number: <span>*</span></label>
								<input type="tel" name="phoneNo" value="<?php print(htmlentities($check->getPhoneNo(), ENT_QUOTES, 'UTF-8')); ?>">
								<?php
									print("<span class='error'>".$check->getError($phoneNoError)."</span>");
								?>
							</p>
							<p>
								<label>Email: <span>*</span></label>
								<input type="text" name="email" value="<?php print(htmlentities($check->getEmail(), ENT_QUOTES, 'UTF-8')); ?>">
								<?php
									print("<span class='error'>".$check->getError($emailError)."</span>");
								?>
							</p>
						</fieldset>
						<fieldset>
							<legend>Additional information</legend>
							<p>
								<label>Join date: <span>*</span></label>
								<input type="date" name="joinDate" value="<?php print(htmlentities($check->getJoinDate(), ENT_QUOTES, 'UTF-8')); ?>">
								<?php
									print("<span class='error'>".$check->getError($joinDateError)."</span>");
								?>
							</p>
							<p>
								<label>Notes:</label><br>
								<textarea rows="5" name="notes"><?php print(htmlentities($check->getNotes(), ENT_QUOTES, 'UTF-8')); ?></textarea>
								<?php
									print("<span class='error' style='vertical-align:top;'>".$check->getError($notesError)."</span>");
								?>
							</p>
						</fieldset>
						<p class="buttons">
							<input class="btn btn-success" type="submit" name="send" value="Send">
							<input class="btn btn-danger" type="submit" name="cancel" value="Cancel">
						</p>
					</form>
				</article>
			</section>
		</main>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
