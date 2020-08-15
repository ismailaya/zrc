<?php
session_start();
include("webservice/config/database.php");
if(!isset($_SESSION["ifFailusername"])){
    $_SESSION["ifFailusername"] = "";
    $_SESSION["ifFailpassword"] = "";
}

$db = new Database();
$pdo=$db->connect();
if(isset($_POST["allowed"])){
    
    if(isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])){
        $username = htmlentities($_POST["username"]);
        $pass = htmlentities($_POST["password"]);

        $sql = "SELECT * FROM users WHERE username = :username AND password =:pass AND status = 1";
        $query = $pdo->prepare($sql);
        $query->execute(array("username"=>$username, "pass"=>md5($pass)));
        $rows = $query->fetch();
        if($query->rowCount() == 1){
            $_SESSION["userId"] = $rows["user_id"];
            $_SESSION["username"] = $rows["username"];
            $_SESSION["role"] = $rows["role"];
            header("location:./home/");
        }
        else{
            echo "<script>alert('Fail To Login');</script>";
        }


        
    }
    else{
        header("location:./");
    }

    
}