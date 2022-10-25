<?php 
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])=="")
        {   
        header("Location: index.php"); 
        }
        else{
            $mabt=intval($_GET['idbt']);
            $sql = "DELETE FROM baotri WHERE MaBaoTri =:mabt;
            DELETE FROM chitietbaotri WHERE MaBaoTri =:mabt;
            DELETE FROM binhluan  WHERE MaBinhLuan=:mabt
            ;";
            $query = $dbh->prepare($sql);
            $query->bindParam(':mabt',$mabt,PDO::PARAM_STR);
            $query->execute();
            header("Location: quanly-baotri.php"); 
        }
?>