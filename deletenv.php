<?php 
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])=="")
        {   
        header("Location: index.php"); 
        }
        else{
            $manv=intval($_GET['idnv']);
            $sql = "DELETE FROM nhanvien where MaNhanVien =:manv ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':manv',$manv,PDO::PARAM_STR);
            $query->execute();
            header("Location: quanly-nhanvien.php"); 
        }
?>