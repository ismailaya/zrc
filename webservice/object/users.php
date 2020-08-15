<?php
include "../config/database.php";
class User extends Database{
    public $username;
    public $password;


    public function __construct()
    {
        $this->pdo = $this->connect();
    }

    public function login(){
        $data = array();
        $code = 202;
        $sql = "SELECT * FROM users WHERE username = :username AND password =:pass AND status = 1";
        $query = $this->pdo->prepare($sql);
        $query->execute(array("username"=>$this->username, "pass"=>md5($this->password)));
        $rows = $query->fetchAll();
        foreach($rows as $row){
            array_push($data,$row);
            $code = 200;
        }
        $this->apiStatus($code,$data,$query->rowCount());
    }


}