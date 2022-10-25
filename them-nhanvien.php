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
    $hoten=$_POST['hoten']; 
    $diachi=$_POST['diachi']; 
    $maphuong=$_POST['maphuong']; 
    $ngaysinh=$_POST['ngaysinh']; 
    $dienthoai=$_POST['dienthoai']; 
    $taikhoan=$_POST['taikhoan']; 
    $matkhau=md5($_POST['matkhau']); 
    $gioitinh=$_POST['gioitinh']; 
    $email=$_POST['email'];  
    $sql="INSERT INTO diachi(MaPhuong,DiaChi)
            VALUES (:maphuong,:diachi);
    
        INSERT INTO  nhanvien(HoTen,NgaySinh,GioiTinh,Email,DienThoai,MaDiaChi,TaiKhoan,MatKhau)
        SELECT :hoten,:ngaysinh,:gioitinh,:email,:dienthoai,MaDiaChi,:taikhoan,:matkhau
        FROM diachi
        WHERE diachi.MaDiaChi=(SELECT MAX(MaDiaChi)
                                FROM diachi)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':hoten',$hoten,PDO::PARAM_STR);
    $query->bindParam(':diachi',$diachi,PDO::PARAM_STR);
    $query->bindParam(':maphuong',$maphuong,PDO::PARAM_STR);
    $query->bindParam(':ngaysinh',$ngaysinh,PDO::PARAM_STR);
    $query->bindParam(':gioitinh',$gioitinh,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':dienthoai',$dienthoai,PDO::PARAM_STR);
    $query->bindParam(':taikhoan',$taikhoan,PDO::PARAM_STR);
    $query->bindParam(':matkhau',$matkhau,PDO::PARAM_STR);
    $query->execute();


    // $error="Có lỗi xảy ra ! Vui lòng thử lại !";


    $msg="Thêm nhân viên thành công";


}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin | Nhân viên </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
        <script>
function getQuan(val) {
    $.ajax({
    type: "POST",
    url: "get_quan.php",
    data:'matp='+val,
    success: function(data){
        $("#maquan").html(data);
        
    }
    });
}
    </script>
<script>

function getPhuong(val) {
    $.ajax({
    type: "POST",
    url: "get_phuong.php",
    data:'maquan='+val,
    success: function(data){
        $("#maphuong").html(data);
        
    }
    });
}
    </script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
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
                                    <h2 class="title">Nhân viên</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Trang chủ</a></li>
                                        <li><a href="quanly-nhanvien.php"> Nhân viên </a></li>
                                        <li class="active">Thêm nhân viên</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Xem thông tin nhân viên</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Hoàn tất!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Thất bại!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">
                                                    <div class="form-group">
<?php $sql= "SELECT MaNhanVien  FROM nhanvien" ;
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$max = 0;
if($query -> rowCount()>0){
    foreach($results as $result)
    {   
        if($result->MaNhanVien > $max)
        {
            $max = $result->MaNhanVien;
        }      
    }
}
?>

<label for="default" class="col-sm-2 control-label">Mã nhân viên</label>
<div class="col-sm-10">
<input type="text"class="form-control" name="manhanvien" value="<?php echo $max +1?>" required="required" readonly autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Họ tên</label>
<div class="col-sm-10">
<input type="text" name="hoten" class="form-control" id="hoten"  required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="date" class="col-sm-2 control-label">Ngày sinh</label>
<div class="col-sm-10">
<input type="date" name="ngaysinh" class="form-control" id="ngaysinh"  required="required" autocomplete="off" placeholder="01-01-2022">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Giới tính</label>
<div class="col-sm-10">
<input type="radio" name="gioitinh" value="Nam" required="required" checked="">   Nam <input type="radio" name="gioitinh" value="Nữ" required="required">   Nữ <input type="radio" name="gioitinh" value="Khác" required="required">   Khác
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Email</label>
<div class="col-sm-10">
<input type="email" name="email" class="form-control" id="email"  required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Số điện thoại</label>
<div class="col-sm-10">
<input type="text" name="dienthoai" class="form-control" id="dienthoai"  required="required" placeholder="0123456789" title="Vui lòng nhập đúng định dạng số điện thoại !" pattern="0[0-9\s.-]{9,13}" autocomplete="off">    
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Tài khoản</label>
<div class="col-sm-10">
<input type="text"  name="taikhoan" class="form-control"required="required" autocomplete="off">    
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Mật khẩu</label>
<div class="col-sm-10">
<input type="password" name="matkhau" class="form-control" id="matkhau"  required="required"  autocomplete="off">    
</div>
</div>

<!-- TEST OPTION ĐỊA CHỈ -->

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Địa chỉ</label>
<div class="col-sm-10">
<input type="text" name="diachi" class="form-control" id="madiachi"  required="required" autocomplete="off">    
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Thành phố</label>
 <div class="col-sm-10">
 <select name="matp" class="form-control clid" id="matp" onChange="getQuan(this.value);" required="required">
<option value="">Chọn thành phố</option>
<?php $sql = "SELECT * from thanhpho";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->MaTP); ?>"><?php echo htmlentities($result->TenTat); ?>&nbsp; - <?php echo htmlentities($result->TenTP); ?></option>
<?php }} ?>
 </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Quận</label>
                                                        <div class="col-sm-10">
                                                    <select name="maquan" class="form-control stid" id="maquan" required="required" onChange="getPhuong(this.value);">
                                                    </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Phường</label>
                                                        <div class="col-sm-10">
                                                    <select name="maphuong" class="form-control stid" id="maphuong" required="required" >
                                                    </select>
                                                        </div>
                                                    </div>                                          
                                                    

<!-- TEST OPTION ĐỊA CHỈ -->              
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
