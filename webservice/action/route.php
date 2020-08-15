<?php
header("Content-type: application/json");
$object = json_decode(file_get_contents("php://input"));
include "../object/route.php";
$route = new Route();

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["status"]) && $_GET["status"]="all"){
    $route->getAll();


}
else{
    $route->apiStatus(404,null,0);
}
