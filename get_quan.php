<?php
include('includes/config.php');
if(!empty($_POST["matp"])) 
{
 $cid=intval($_POST['matp']);
 if(!is_numeric($cid)){
 
 	echo htmlentities("Sai cú pháp");exit;
 }
 else{
 $stmt = $dbh->prepare("SELECT TenQuan,MaQuan FROM quan WHERE MaTP= :id order by MaQuan");
 $stmt->execute(array(':id' => $cid));
 ?><option value="">Chọn quận </option><?php
 echo $cid;
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
  <option value="<?php echo htmlentities($row['MaQuan']); ?>"><?php echo htmlentities($row['TenQuan']); ?></option>
  <?php
 }
}

}

?>


