<?php
session_start();
if(isset($_POST['submit'])){
	include 'dbh.inc.php';
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    if(empty($uid)||empty($pwd)){
        //if empty
        header("Location: ../signuplogin.php?login=empty");
        exit();
    } else{
        $sql = "SELECT * FROM users WHERE user_uname=? LIMIT 1 ";
        $query = $conn->prepare($sql);
        $query->bindParam('1', $uid, PDO::PARAM_STR); 
        $query->execute();
        $count = $query->rowCount();
        $row   = $query->fetch(); 

        //check database to see if user exists

        if($count==1){
            $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
            if($hashedPwdCheck == false){
                header("Location: ../signuplogin.php?login=error");
                exit();                 
            } elseif($hashedPwdCheck == true){
                $_SESSION['user_id']= $row['user_id'];
                header("Location: ../index.php");
                exit();
            }
        } else{
            header("Location: ../signuplogin.php?login=error");
            exit(); 
        }
    }

} else{
	//returns to index if user didn't login through button click
	header("Location: ../signuplogin.php");
	exit();
}