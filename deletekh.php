<?php 
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])=="")
        {   
        header("Location: index.php"); 
        }
        else{
            $makh=intval($_GET['idkh']);
            $sql = "DELETE FROM diachi where MaDiaChi = (SELECT MaDiaChi From khachhang where MaKhachHang = :makh);
            DELETE FROM khachhang where MaKhachHang = :makh ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':makh',$makh,PDO::PARAM_STR);
            $query->execute();
            header("Location: quanly-khachhang.php"); 
        }
?>