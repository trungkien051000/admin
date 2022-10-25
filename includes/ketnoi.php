<?php
    $connect= mysqli_connect("127.0.0.1:3307","root","");
    mysqli_select_db($connect, "quanlybaotri");
    mysqli_query($connect, "SET names 'utf8'");
    if(!$connect){
      echo "Không thể kết nối đến Database!".mysqli_connect_error($connect);
    }
?>