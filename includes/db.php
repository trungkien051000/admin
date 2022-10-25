<?php
class db{
    private $servername ="127.0.0.1:3307";
    private $username ="root";
    private $password ="";
    private $db ="quanlybaotri";
    private $conn;

    public function connect(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->db."",$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e){
            echo "Failed" . $e -> getMessage();
        }
        return $this->conn;
    }
}
?>