<?php
class Database{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "zrc";  
    private $port = "3306";
    public $pdo = null;


    public function connect(){
        try {
            $this->pdo = new PDO("mysql:host=".$this->host.";port=".$this->port.";dbname=".$this->dbname, $this->user,$this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $th) {
            // $this->pdo["message"] = $th->getMessage();
        }

        return $this->pdo;
    }

    public function apiStatus($code,$result,$total){
        $data = array();
        $data["status"] = $code;
        $data["message"] = $this->statusMessage($code);
        $data["total"] = $total;
        $data["data"] = $result;

        echo json_encode($data);
    }

    private function statusMessage($sms){
        switch($sms){
            case 200:
                return "Success";
            case 201:
                return "Created";
            case 202:
                return "No Content Found !!!";
            case 206:
                return "Partial Content !!!";
            case 400:
                return "Fail";
            default:
                return "Bad Request";
        }
    }    
    
}