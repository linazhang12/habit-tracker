<?php 
	include_once 'header.php';
	

	if(isset($_SESSION['user_id'])){
?>
	<div class = "container-fluid padding">
		<div class="row">
		<div class="col-xs-12 col-lg-3">
			<div class="row" >
			
			<!-- form to insert into database  -->
			
				<form class = "form" action="includes/habitadd.inc.php" method="POST" style="padding-left: 10px;">
					<div class="form-group">
					<input type="text" name="habit1" placeholder="Enter Habit Here">
					</div>
					<div class="form-group">
					<input type="text" name="habit2" placeholder="Example: workout">
					</div>
					<div class="form-group">
					<input type="text" name="habit3" placeholder="Example: drink water">
					</div>
					<div class="form-group">
					<input type="text" name="habit4" placeholder="Example: get 7 hours of sleep">
					</div>
					<div class="form-group">
					<input type="text" name="habit5" placeholder="Example: meditate">
					</div>
					<button type="submit" name="submit">Add</button>
				</form>
			</div>

		</div>
		<!-- barchart and pie chart div-->
		<div class="col-xs-12 col-lg-9">
			<div class = "row data">
			<p id="empty"></p>	
				<div class="col-xs-12 col-lg-6">
					<div id="barchart_div"></div>
				</div>
				<div class="col-xs-12 col-lg-6">
					<div id="piechart_div"></div>
				</div>
			</div>

		</div>
		<!-- table div-->
		</div>
		<div class = "row scrolltable">
			<div class = "databasetable">
				<table class="table table-hover">
				    <thead>
				    	<tr>
				    		<th scope="col">HABIT</th>
				        	<th scope="col"># TIMES</th>
				   		</tr>
				    </thead>
				    <tbody>

						<?php
							$user_id = $_SESSION['user_id'];

							$sql = "SELECT * FROM user_profile WHERE user_id=?";
							$query = $conn->prepare($sql);
							$query->bindParam('1', $user_id);
							$query->execute(); 

							while($row = $query->fetch()){

							  // echo each row into a table

							echo '<tr>';
							echo '<td>'.$row['habit'].'</td><td>'.$row['counter'].'</td>';
							echo '</tr>';
							}
						?>
			
					</tbody>
				</table>
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