<?php
include_once 'includes/dbh.inc.php';
session_start();

if(isset($_SESSION['user_id'])){
  //get data from table 
	$user_id = $_SESSION['user_id'];

	$sql = "SELECT * FROM user_profile WHERE user_id=?";
	$query = $conn->prepare($sql);
	$query->bindParam('1', $user_id);
	$query->execute();      

    $rows = array();
    $table = array();
    $table['cols'] = array(
        array('label' => 'Habit', 'type' => 'string'),
        array('label' => '# Times', 'type' => 'number')
    );

    foreach($query as $q) {
        $temp = array();
        $temp[] = array('v' => (string) $q['habit']); 
        $temp[] = array('v' => (int) $q['counter']); 
        $rows[] = array('c' => $temp);
    }

    //json format
    $table['rows'] = $rows;
    $jsonTable = json_encode($table);
}
?>
<!DOCTYPE html>
<html>
<head>

    <title>habit tracker</title>
	
<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

    //barchart and pie chart
    google.load('visualization', '1', {'packages':['corechart']});
    google.setOnLoadCallback(createChart);

    function createChart() {
        var data = new google.visualization.DataTable(<?=$jsonTable?>);

        var pieoptions = {
            is3D: 'false',
           'backgroundColor': 'transparent',
    		   'chartArea': {left:0,top:0, right:0, bottom:0},		 
            height: $(window).height()*0.5
        };

        var baroptions = {
            'backgroundColor': 'transparent',
            'chartArea': {left:10,top:0, right:0, bottom:0},
            height: $(window).height()*0.5,
        };

        var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
        var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
        piechart.draw(data, pieoptions);
        barchart.draw(data, baroptions);
    }
    </script>
</head>
<body>
	<header>
		<nav class = "navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#uh" aria-expanded="false">
       				<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
      				<span class="icon-bar"></span>                        
      			</button>
      			<h class = "navbar-brand"> HABIT TRACKER </h>
			</div>

			<div class="collapse navbar-collapse" id="uh">
				<ul class="nav navbar-nav">
				<?php

				//logout

					if(isset($_SESSION['user_id'])){
						echo '<li><a href="includes/logout.inc.php" >Logout</a></li>';
					}
				?>
				</ul>
			</div>
		</div>
		</nav>
	</header>