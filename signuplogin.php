<?php 
	include_once 'header.php';
?>
		<div class = "container-fluid padding">
			<div class="row">		
				<div class="col-xs-12 col-md-4">				
				</div>

				<!-- singup/login form -->
				<div class="formborder col-xs-12 col-md-4">
					<h class="enter"> SIGNUP </h> 
						<form class = "form" action="includes/signup.inc.php" method="POST">
							<div class="form-group">
							<input type="email" name="email" placeholder="E-mail">
							</div>
							<div class="form-group">
							<input type="text" name="uid" placeholder="Username">
							</div>
							<div class="form-group">
							<input type="password" name="pwd" placeholder="Password">
							</div>
							<button type="submit" name="submit">SIGNUP</button>
						</form>
					
					<h class="enter">LOGIN</h>
						<form class = "form" action="includes/login.inc.php" method="POST">
							<div class="form-group">
							<input type="text" name="uid" placeholder="Username">
							</div>
							<div class="form-group">
							<input type="password" name="pwd" placeholder="Password">
							</div>
							<button type="submit" name="submit">LOGIN</button>
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
				<div class="col-xs-12 col-md-4">				
				</div>
			</div>
		</div>


		

<?php 

	include_once 'footer.php';
?>