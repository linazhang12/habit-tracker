<?php 
	include_once 'header.php';
	include_once 'includes/dbh.inc.php';

	if(isset($_SESSION['user_id'])){
?>
	<div class = "container-fluid padding">
		<div class="row" >
			<div class="col-xs-12 col-lg-3">

			<!-- form to insert into database  -->
			
				<form class = "form" action="includes/habitadd.inc.php" method="POST">
					<input type="text" name="habit1" placeholder="Enter Habit Here">
					<input type="text" name="habit2" placeholder="Example: workout">
					<input type="text" name="habit3" placeholder="Example: drink water">
					<input type="text" name="habit4" placeholder="Example: get 7 hours of sleep">
					<input type="text" name="habit5" placeholder="Example: meditate">
					<button type="submit" name="submit">Add</button>
				</form>
			</div>
			<div class="col-xs-12 col-lg-9">

				<!-- fetch database results for user and display in a list -->

				<div class="habits">
					<h style="font-size: 25px;">It takes twenty-one days to form a habit. Let's check on your habits...</h>
					<ul>
						<?php
							$user_id = $_SESSION['user_id'];

							$sql = "SELECT * FROM user_profile WHERE user_id=?";
							$query = $conn->prepare($sql);
							$query->bindParam('1', $user_id);
							$query->execute(); 

							while($row = $query->fetch()){

							  // echo each row as a list item

							 echo '<li style="font-size: 20px;">'.$row['habit']." ".$row['counter']." time(s) ".'</li>';
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
		
	
<?php
	}
	else{

		//if session is not set, direct user to signup/login page

        header("Location: signuplogin.php");
        exit();
	}
	include_once 'footer.php';
?>