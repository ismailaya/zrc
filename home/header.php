<?php
include("../webservice/config/database.php");
$db = new Database();
$pdo=$db->connect();
?>

<?php
session_start();
if(!isset($_SESSION["username"])){
    header("location:../?loginAgain=Please Login Again");
}
$username = $_SESSION["username"];

?>





<!doctype html>

<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../bootstrap/font-awesome.min.css" />
    <link rel="stylesheet" href="../custom_style.css" />
  </head>
  <body>

<header>
  <div class="row container-fluid">

    <div class="col-lg-12 text-center bg-primary" style="margin: 0px;padding: 0px;height: 100px;line-height: 100px;">
      <b>ZANZIBAR ROUTE COST</b>
    </div>
    <br/><br/><br/>
  </div>
</header>
