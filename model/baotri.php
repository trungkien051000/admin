<?php

class BaoTri{
    private $conn;

    //baotri properties
    public $MaBaoTri;
    public $MaNhanVien;
    public $MaKhachHang;
    public $MaBinhLuan;
    public $TieuDe;
    public $MoTa;
    public $CreationDate;
    public $updationDate;

    //connect db
    public function __construct($db){
        $this->conn = $db;
    }

    //read data
    public function read(){
        $query="SELECT * from baotri ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
   
?>