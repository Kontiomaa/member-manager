<?php
	if(isset($_POST["delete"])){
		$id=$_POST["id"];
		require_once "athletePDO.php";
		$database=new athletePDO();
		$database->deleteAthlete($id);

		header("location:deleteAthlete.php");
		exit;
	}	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Delete athlete</title>
		<meta name="author" content="Samuel Kontiomaa">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<h1>Delete athlete</h1>
		</header>
		<main>
			<nav id="navigation">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="index.php">Front page</a></li>
					<li><a href="newAthlete.php">Enroll</a></li>
					<li><a href="athleteList.php">Browse</a></li>
					<li><a href="searchAthletes.php">Search</a></li>
					<li class="active"><a href="#">Remove</a></li>
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
							print("<form action='' method='post'>\n");
							print("<b>");
							print($row->getId().".");
							print(" ".$row->getFirstname());
							print(" ".$row->getLastname());
							print("</b>");
							print("<input type='hidden' name='id' value='$id'>\n");
							print("<input class='btn btn-default' type='submit' name='delete' value='Delete'></p>\n");
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
