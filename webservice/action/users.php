<?php
header("Content-type: application/json");
$object = json_decode(file_get_contents("php://input"));
var_dump($object);
include "../object/users.php";
$user = new User();

// if($_SERVER["REQUEST_METHOD"] == "POST" && isset($object->allowed)){
    $user->username = $object->username;
    $user->password = $object->password;
    $user->login();
// }
// else{
//     $user->apiStatus(404,null,0);
// }
