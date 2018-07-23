<?php 
	include_once 'header.php';
?>
		<div class = "container-fluid padding">
			<div class="row">		
				<div class="col-xs-12 col-md-9">				
					<p>Monitor <br>Your<br> Habits</p>
				</div>

				<div class="col-xs-12 col-md-3">
					<h class="enter"> Sign-up </h> 
						<form class = "form" action="includes/signup.inc.php" method="POST">
							<input type="email" name="email" placeholder="E-mail">
							<input type="text" name="uid" placeholder="Username">
							<input type="password" name="pwd" placeholder="Password">
							<button type="submit" name="submit">Signup</button>
						</form>
					
					<h class="enter">Login</h>
						<form class = "form" action="includes/login.inc.php" method="POST">
							<input type="text" name="uid" placeholder="Username">
							<input type="password" name="pwd" placeholder="Password">
							<button type="submit" name="submit">Login</button>
						</form>
					<?php
						//displays error message to tell user of incorrect signup/login

						if(!isset($_GET['signup']) && !isset($_GET['login'])){
							exit();
						} elseif (isset($_GET['signup'])){
							$signupCheck = $_GET['signup'];
							if( $signupCheck == "empty"){
								echo "Please fill in all fields!";
								exit();
							} elseif ($signupCheck == "email"){
								echo "Please enter a valid email";
								exit();
							} elseif ($signupCheck == "usertaken"){
								echo "That username is already taken!";
								exit();
							}
						} else{
							$loginCheck = $_GET['login'];
							if( $loginCheck == "empty"){
								echo "Please fill in all fields!";
								exit();
							} elseif ($loginCheck == "error"){
								echo "The username or password was incorrect";
								exit();
							}
						}
					?>
				</div>
			</div>
		</div>

<?php 

	include_once 'footer.php';
?>