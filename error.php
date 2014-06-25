<?php
	session_start();
	unset($_SESSION["check"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Error page</title>
		<meta name="author" content="Sirpa Marttila, Samuel Kontiomaa">
		<link href="style.css" rel="stylesheet">
		<style type="text/css">
			label {display:block; float: left; width:8em;}
		</style>
	</head>
	<body>
		<div>
			<header>Error page</header>
			<article>
				<?php
					if (isset($_GET["error"])) {
						$error = $_GET["error"];
					}
					else {
						$error = "Unknown error";
					}
					print("<p style='margin-top:1cm'>$error <br><br>Back to front page in 8 seconds...</p>");
				?>
			</article>
		</div>
	</body>
</html>
<?php
	header("refresh:8; url=index.php");
	exit;
?>
