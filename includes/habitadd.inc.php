<?php
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])){
    include 'dbh.inc.php';
    $h1 = $_POST['habit1'];
    $h2 = $_POST['habit2'];
    $h3 = $_POST['habit3'];
    $h4 = $_POST['habit4'];
    $h5 = $_POST['habit5'];
    $habits = array($h1, $h2, $h3, $h4, $h5);

    foreach ($habits as $h) {

        //if form was left blank, it will not be included

        if(!empty($h)){

            //check to see if habit is already present in database

            $sql = "SELECT * FROM user_profile WHERE user_id=? and habit=? LIMIT 1 ";
            $query = $conn->prepare($sql);
            $query->bindParam('1', $user_id);
            $query->bindParam('2', $h, PDO::PARAM_STR); 
            $query->execute();
            $count = $query->rowCount();
            $row   = $query->fetch(); 

            if($count==1){

                //if already present, add one to the counter

                $sql = "UPDATE user_profile SET counter=? WHERE user_id=? AND habit=?";
                $query = $conn->prepare($sql);
                $update=$row['counter']+1;
                $query->bindParam('1', $update);
                $query->bindParam('2', $user_id);
                $query->bindParam('3', $h, PDO::PARAM_STR);
                $query->execute();
            } else{

                //if not present, then add into database

                $query = "INSERT INTO user_profile (user_id, habit, counter) VALUES (?,?,1)";
                $query = $conn->prepare($query);
                $query->bindParam('1', $user_id);
                $query->bindParam('2', $h, PDO::PARAM_STR);
                $query->execute(); 
            }
        }
    }
    header("Location: ../index.php");
    exit();

} else{
	//returns to index if user didn't sign up through button click
	header("Location: ../index.php");
	exit();
}