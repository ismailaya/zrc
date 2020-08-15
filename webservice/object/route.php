<?php
include "../config/database.php";
class Route extends Database{
    public $name;
    public $address;
    public $phone;
    public $username;
    public $userId;

    public function __construct()
    {
        $this->pdo = $this->connect();
    }

    public function getAll(){
        $data = array();
        $code = 202;
        $sql = "SELECT * FROM route WHERE status = 1";
        $query = $this->pdo->prepare($sql);
        $res = $query->execute();
        $rows = $query->fetchAll();
        foreach ($rows as$value) {
          array_push($data,array("content"=>$value));
          $code = 200;
        }
        $this->apiStatus($code,$data,$query->rowCount());
    }


}
