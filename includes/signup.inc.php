<?php
session_start();
if(isset($_POST['submit'])){
    
	include_once 'dbh.inc.php';
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $email = $_POST['email'];
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    if(empty($uid)||empty($pwd)||empty($email)){\
        //check if empty
        header("Location: ../signuplogin.php?signup=empty");
        exit();

    }else{    
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            //check email validity
            header("Location: ../signuplogin.php?signup=email");
            exit();
        } else{

            //check if username taken
            $sql = "SELECT * FROM users WHERE user_uname=?";
            $q = $conn->prepare($sql);
            $q->bindParam('1', $uid, PDO::PARAM_STR); 
            $q->execute();
            $count = $q->rowCount();
            

            if($count == 1){
                header("Location: ../signuplogin.php?signup=usertaken");
                exit();               
            } else{

                //finally insert

                $query = "INSERT into users(user_email,user_uname,user_pwd) VALUES (?, ?, ?)";
                $query = $conn->prepare($query);
                $query->bindParam('1', $email, PDO::PARAM_STR);
                $query->bindParam('2', $uid, PDO::PARAM_STR);
                $query->bindParam('3', $hashedPwd, PDO::PARAM_STR);
                $query->execute();

                $sql = "SELECT * FROM users WHERE user_uname=?";
                $q = $conn->prepare($sql);
                $q->bindParam('1', $uid, PDO::PARAM_STR); 
                $q->execute();
                $row   = $q->fetch();
                
                if($query->rowCount() == 1) {
                $_SESSION['user_id']= $row['user_id'];
                header("Location: ../index.php");
                exit();
                }
            }
        }
    }

} else{
	//returns to index if user didn't sign up through button click
	header("Location: ../signuplogin.php");
	exit();
}