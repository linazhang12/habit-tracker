<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>habit tracker</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Eczar" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
</head>
<body>
	<header>
		<nav>
			<h class = "logo"> Habit Tracker </h>
			<?php
			
				//logout button

				if(isset($_SESSION['user_id'])){
					echo '<a href="includes/logout.inc.php">Logout</a>';
				}
			?>
		</nav>
	</header>