<?php
     $servername ="localhost";
     $username ="id18857676_kien";
     $password =">_[V!|)mb2^hGDAg";
     $dbname ="id18857676_quanly";
    
    $conn =  new mysqli($servername,$username,$password,$dbname);
    if($conn -> connect_error){
        die("Connection failed:" . $conn->connect_error);
    }

    $sql ="SELECT * from baotri";
    $result = $conn->query($sql);

    if($result->num_rows >0){
        while($row = $result->fetch_assoc()){
            echo "MaBaoTri: " .$row["MaBaoTri"] . " - MaNhanVien: " .$row["MaNhanVien"] . " - MaKhachHang: " .$row["MaKhachHang"] . " - MaBinhLuan: " .$row["MaBinhLuan"] ." - TieuDe: " .$row["TieuDe"] . " - MoTa" . $row["MoTa"] . "<br>";

        } 
    } else{
        echo "0 results";
    }

    $conn ->close();

?>