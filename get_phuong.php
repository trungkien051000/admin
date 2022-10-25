<?php
include('includes/config.php');
if(!empty($_POST["maquan"])) 
{
 $cid=intval($_POST['maquan']);
 if(!is_numeric($cid)){
 
 	echo htmlentities("Sai cú pháp");exit;
 }
 else{
 $stmt = $dbh->prepare("SELECT TenPhuong,MaPhuong FROM phuong WHERE MaQuan= :id order by MaPhuong");
 $stmt->execute(array(':id' => $cid));
 ?><option value="">Chọn phường </option><?php
 echo $cid;
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
  <option value="<?php echo htmlentities($row['MaPhuong']); ?>"><?php echo htmlentities($row['TenPhuong']); ?></option>
  <?php
 }
}

}
?>


