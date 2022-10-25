<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['submit']))
{
$tieude=$_POST['tieude'];
$mota=$_POST['mota']; 
$thietbi=$_POST['thietbi'];
$khachhang=$_POST['khachhang'];
$nhanvien=$_POST['nhanvien'];
$sql="INSERT INTO  baotri(MaNhanVien,MaKhachHang,TieuDe,MoTa) 
VALUES(:nhanvien,:khachhang,:tieude,:mota)

";
$query = $dbh->prepare($sql);
$query->bindParam(':nhanvien',$nhanvien,PDO::PARAM_STR);
$query->bindParam(':khachhang',$khachhang,PDO::PARAM_STR);
$query->bindParam(':tieude',$tieude,PDO::PARAM_STR);
$query->bindParam(':mota',$mota,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Tạo lịch bảo trì thành công";
}
else 
{
$error="Có lỗi xảy ra, vui lòng thử lại";
}
}

$sql= "SELECT MaBaoTri  FROM baotri" ;
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$max = 0;
if($query -> rowCount()>0){
    foreach($results as $result)
    {   
        if($result->MaBaoTri > $max)
        {
            $max = $result->MaBaoTri;
        }      
    }
}

$sql="INSERT INTO  chitietbaotri(MaBaoTri,MaThietBi) 
VALUES(:mabaotri,:thietbi)

";
$query = $dbh->prepare($sql);
$query->bindParam(':mabaotri',$max,PDO::PARAM_STR);
$query->bindParam(':thietbi',$thietbi,PDO::PARAM_STR);
$query->execute();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tạo lịch bảo trì</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
         <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('includes/topbar.php');?>   
          <!-----End Top bar>
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

<!-- ========== LEFT SIDEBAR ========== -->
<?php include('includes/leftbar.php');?>                   
 <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Tạo lịch bảo trì</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Trang chủ</a></li>
            							<li><a href="quanly-baotri.php">Lịch bảo trì</a></li>
            							<li class="active">Tạo lịch bảo trì</li>
            						</ul>
                                </div>
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Tạo lịch bảo trì</h5>
                                                </div>
                                            </div>
           <?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Hoàn tất!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Thất bại!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
  
                                            <div class="panel-body">

                                                <form method="post">

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Tiêu đề</label>
                                                		<div class="">
                                                			<input type="text" name="tieude" class="form-control" required="required" id="success">
                                                            <span class="help-block">Ví dụ - Bảo trì máy cà phê</span>
                                                		</div>

                                                	</div>
                                                       <div class="form-group has-success">
                                                        <label for="success" class="control-label">Mô tả</label>
                                                        <div class="">
                                                            <input type="text" name="mota" required="required" class="form-control" id="success">
                                                            <span class="help-block">Ví dụ: Bị hỏng máy đánh sửa</span>
                                                        </div>
                                                    </div>

                                                     <div class="form-group has-success">
                                                        <label for="success" class="control-label">Thiết bị</label>
                                                        <div class="">
                                                        <select name="thietbi" class="form-control" id="default" required="required">
                                                            <?php 
                                                            $sql = "SELECT *  from thietbi";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($results as $result)
                                                            {   
                                                            
                                                                ?>
                                                                <option value="<?php echo htmlentities($result->MaThietBi)?>" ><?php echo htmlentities($result->TenThietBi) ?></option>
                                                            
                                                                
                                                            <?php }} ?>
                                                        </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Khách hàng</label>
                                                        <div class="">
                                                        <select name="khachhang" class="form-control" id="default" required="required">
                                                            <?php 
                                                            $sql = "SELECT *,diachi.DiaChi,phuong.TenPhuong,quan.TenQuan,thanhpho.TenTP
                                                            from khachhang left join diachi on diachi.MaDiaChi = khachhang.MaDiaChi 
                                                            left join phuong on phuong.MaPhuong = diachi.MaPhuong 
                                                            left join quan on quan.MaQuan = phuong.MaQuan 
                                                            left join thanhpho on thanhpho.MaTP = quan.MaTP";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($results as $result)
                                                            {  
                                                                ?>
                                                                <option value="<?php echo htmlentities($result->MaKhachHang)?>" ><?php echo htmlentities($result->HoTen) ?>. Địa chỉ: <?php echo htmlentities($result->DiaChi) ?>, <?php echo htmlentities($result->TenPhuong) ?>, <?php echo htmlentities($result->TenQuan) ?>, <?php echo htmlentities($result->TenTP) ?></option>    
                                                            <?php }} ?>
                                                        </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Nhân viên</label>
                                                        <div class="">
                                                        <select name="nhanvien" class="form-control" id="default" required="required">
                                                            <?php 
                                                            $sql = "SELECT * from nhanvien";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($results as $result)
                                                            {  
                                                                ?>
                                                                <option value="<?php echo htmlentities($result->MaNhanVien)?>" ><?php echo htmlentities($result->MaNhanVien) ?> - <?php echo htmlentities($result->HoTen) ?></option>    
                                                            <?php }} ?>
                                                        </select>
                                                        </div>
                                                    </div>
  <div class="form-group has-success">

                                                        <div class="">
                                                           <button type="submit" name="submit" class="btn btn-success btn-labeled">Tạo<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                    </div>


                                                    
                                                </form>

                                              
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-8 col-md-offset-2 -->
                                </div>
                                <!-- /.row -->

                               
                               

                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>



        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
<?php  } ?>
