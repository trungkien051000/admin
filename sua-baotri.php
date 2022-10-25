<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['duyet'])) {
        $mabt = intval($_GET['idbt']);
        $sqlduyet = " UPDATE baotri set MaDuyetBT =3 where baotri.MaBaoTri =:mabt ";
        $query = $dbh->prepare($sqlduyet);
        $query->bindParam(':mabt', $mabt, PDO::PARAM_STR);
        $query->execute();
        $msg = " Lịch bảo trì đã được duyệt thành công !";
    } else if(isset($_POST['khongduyet'])) {
        $mabt = intval($_GET['idbt']);
        $sqlkhongduyet = " UPDATE baotri set MaDuyetBT =2 where baotri.MaBaoTri =:mabt ";
        $query = $dbh->prepare($sqlkhongduyet);
        $query->bindParam(':mabt', $mabt, PDO::PARAM_STR);
        $query->execute();
        $msg = " Lịch bảo trì không được duyệt !";
    }
    if (isset($_POST['Update'])) {
        $mabt = intval($_GET['idbt']);
        $tieude = $_POST['tieude'];
        $mota = $_POST['mota'];
        $thietbi = $_POST['thietbi'];
        $nhanvien = $_POST['nhanvien'];
        $khachhang = $_POST['khachhang'];
        $ngaybatdau = $_POST['ngaybd'];
        $sql = "UPDATE baotri, chitietbaotri set 
    baotri.MaNhanVien=:nhanvien,
    baotri.MaKhachHang=:khachhang,
    baotri.TieuDe=:tieude,
    baotri.MoTa=:mota,
    chitietbaotri.MaThietBi=:thietbi,
    chitietbaotri.NgayBatDau=:ngaybatdau
WHERE 
    baotri.MaBaoTri =:mabt AND
    baotri.MaBaoTri = chitietbaotri.MaBaoTri ;";
        $query = $dbh->prepare($sql);
        $query->bindParam(':mabt', $mabt, PDO::PARAM_STR);
        $query->bindParam(':nhanvien', $nhanvien, PDO::PARAM_STR);
        $query->bindParam(':khachhang', $khachhang, PDO::PARAM_STR);
        $query->bindParam(':tieude', $tieude, PDO::PARAM_STR);
        $query->bindParam(':mota', $mota, PDO::PARAM_STR);
        $query->bindParam(':thietbi', $thietbi, PDO::PARAM_STR);
        $query->bindParam(':ngaybatdau', $ngaybatdau, PDO::PARAM_STR);
        $query->execute();

        $msg = " Lịch bảo trì đã được cập nhật thành công !";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin | Cập nhật lịch bảo trì </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <link rel="stylesheet" href="css/select2/select2.min.css">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>

    </head>

    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('includes/topbar.php'); ?>
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                    <?php include('includes/leftbar.php'); ?>
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Cập nhật lịch bảo trì</h2>

                                </div>

                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Trang chủ</a></li>
                                        <li> <a href="quanly-baotri.php">Lịch bảo trì</a></li>
                                        <li class="active">Cập nhật lịch bảo trì</li>
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
                                            <div class="panel-title" style="">
                                                <h5>Thông tin chi tiết lịch bảo trì</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                    <strong>Hoàn tất!</strong><?php echo htmlentities($msg); ?>
                                                </div><?php } else if ($error) { ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                    <strong>Thất bại!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                            <form class="form-horizontal" method="post">

                                                <?php
                                                $mabt = intval($_GET['idbt']);
                                                $sql = "SELECT nhanvien.MaNhanVien, khachhang.MaKhachHang, thietbi.MaThietBi, baotri.MaBaoTri,nhanvien.HoTen as htnv,khachhang.HoTen as htkh,binhluan.NoiDung,baotri.TieuDe,baotri.MoTa,thietbi.TenThietBi,chitietbaotri.NgayBatDau,chitietbaotri.NgayKetThuc,chitietbaotri.NgayHoanThanh,chitietbaotri.TienDo,trangthai.TrangThai,diachi.DiaChi,phuong.TenPhuong,quan.TenQuan,thanhpho.TenTP,baotri.MaDuyetBT 
from baotri left join nhanvien on nhanvien.MaNhanVien = baotri.MaNhanVien left join khachhang on khachhang.MaKhachHang =baotri.MaKhachHang 
left join chitietbaotri on chitietbaotri.MaBaoTri = baotri.MaBaoTri left join diachi on diachi.MaDiaChi = khachhang.MaDiaChi 
left join binhluan on binhluan.MaBinhLuan = baotri.MaBinhLuan left join thietbi on thietbi.MaThietBi = chitietbaotri.MaThietBi
left join phuong on diachi.MaPhuong = phuong.MaPhuong left join quan on phuong.MaQuan = quan.MaQuan left join thanhpho on quan.MaTP = thanhpho.MaTP
left join trangthai on chitietbaotri.MaTrangThai = trangthai.MaTrangThai
where baotri.MaBaoTri=:mabt";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':mabt', $mabt, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {
                                                        $idnhanvien = $result->MaNhanVien;
                                                        $idkhachhang = $result->MaKhachHang;
                                                        $idthietbi = $result->MaThietBi;
                                                        $diachi = $result->DiaChi;
                                                        $phuong = $result->TenPhuong;
                                                        $quan = $result->TenQuan;
                                                        $tp = $result->TenTP;
                                                        $maduyetbt = $result->MaDuyetBT;
                                                ?>
                                                        <?php
                                                        if ($result->MaDuyetBT === '1') {
                                                            echo "
                                                                <div style='margin-left:203px; margin-bottom: 10px'>
                                                           <button type='submit' name='duyet' class='btn btn-success btn-labeled'>Duyệt<span class='btn-label btn-label-right'><i class='fa fa-check'></i></span></button>
                                                           <button type='submit' name='khongduyet' class='btn btn-danger btn-labeled'>Không duyệt<span class='btn-label btn-label-right'><i class='fa fa-close'></i></span></button>
                                                        </div>";
                                                        }
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Mã bảo trì</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" value="<?php echo htmlentities($result->MaBaoTri) ?>" required="required" readonly autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Tiêu đề</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="tieude" class="form-control" id="tieude" value="<?php echo htmlentities($result->TieuDe) ?>" required="required" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Mô tả</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="mota" class="form-control" id="mota" value="<?php echo htmlentities($result->MoTa) ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Thiết bị</label>
                                                            <div class="col-sm-10">
                                                                <select name="thietbi" class="form-control" id="default" required="required">
                                                                    <?php
                                                                    $sql = "SELECT *  from thietbi";
                                                                    $query = $dbh->prepare($sql);
                                                                    $query->execute();
                                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                    if ($query->rowCount() > 0) {
                                                                        foreach ($results as $result) {
                                                                            if ($result->MaThietBi == $idthietbi) {
                                                                    ?>
                                                                                <option value="<?php echo htmlentities($result->MaThietBi) ?>" selected><?php echo htmlentities($result->TenThietBi) ?></option>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <option value="<?php echo htmlentities($result->MaThietBi) ?>"><?php echo htmlentities($result->TenThietBi) ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Nhân viên bảo trì</label>
                                                            <div class="col-sm-10">
                                                                <select name="nhanvien" class="form-control" id="default" required="required">
                                                                    <?php
                                                                    $sql = "SELECT *  from nhanvien";
                                                                    $query = $dbh->prepare($sql);
                                                                    $query->execute();
                                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                    if ($query->rowCount() > 0) {
                                                                        foreach ($results as $result) {
                                                                            if ($result->MaNhanVien == $idnhanvien) {
                                                                    ?>
                                                                                <option value="<?php echo htmlentities($result->MaNhanVien) ?>" selected><?php echo htmlentities($result->MaNhanVien) ?> - <?php echo htmlentities($result->HoTen) ?></option>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <option value="<?php echo htmlentities($result->MaNhanVien) ?>"><?php echo htmlentities($result->MaNhanVien) ?> - <?php echo htmlentities($result->HoTen) ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Khách hàng</label>
                                                            <div class="col-sm-10">
                                                                <select name="khachhang" class="form-control" id="default" required="required">
                                                                    <?php
                                                                    $sql = "SELECT *,diachi.DiaChi,phuong.TenPhuong,quan.TenQuan,thanhpho.TenTP
                       from khachhang left join diachi on diachi.MaDiaChi = khachhang.MaDiaChi 
                       left join phuong on phuong.MaPhuong = diachi.MaPhuong 
                       left join quan on quan.MaQuan = phuong.MaQuan 
                       left join thanhpho on thanhpho.MaTP = quan.MaTP";
                                                                    $query = $dbh->prepare($sql);
                                                                    $query->execute();
                                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                    if ($query->rowCount() > 0) {
                                                                        foreach ($results as $result) {
                                                                            if ($result->MaKhachHang == $idkhachhang) {
                                                                    ?>
                                                                                <option value="<?php echo htmlentities($result->MaKhachHang) ?>" selected><?php echo htmlentities($result->HoTen) ?>. Địa chỉ: <?php echo $diachi ?>, <?php echo $phuong ?>, <?php echo $quan ?>, <?php echo $tp ?></option>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <option value="<?php echo htmlentities($result->MaKhachHang) ?>"><?php echo htmlentities($result->HoTen) ?>. Địa chỉ: <?php echo htmlentities($result->DiaChi) ?>, <?php echo htmlentities($result->TenPhuong) ?>, <?php echo htmlentities($result->TenQuan) ?>, <?php echo htmlentities($result->TenTP) ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                <?php }
                                                } ?>

                                                <?php
                                                $mabt = intval($_GET['idbt']);
                                                $sql = "SELECT baotri.MaBaoTri,nhanvien.HoTen as htnv,khachhang.HoTen as htkh,binhluan.NoiDung,baotri.TieuDe,baotri.MoTa,thietbi.TenThietBi,chitietbaotri.NgayBatDau,chitietbaotri.NgayKetThuc,chitietbaotri.NgayHoanThanh,chitietbaotri.TienDo,trangthai.TrangThai,diachi.DiaChi,phuong.TenPhuong,quan.TenQuan,thanhpho.TenTP 
from baotri left join nhanvien on nhanvien.MaNhanVien = baotri.MaNhanVien left join khachhang on khachhang.MaKhachHang =baotri.MaKhachHang 
left join chitietbaotri on chitietbaotri.MaBaoTri = baotri.MaBaoTri left join diachi on diachi.MaDiaChi = khachhang.MaDiaChi 
left join binhluan on binhluan.MaBinhLuan = baotri.MaBinhLuan left join thietbi on thietbi.MaThietBi = chitietbaotri.MaThietBi
left join phuong on diachi.MaPhuong = phuong.MaPhuong left join quan on phuong.MaQuan = quan.MaQuan left join thanhpho on quan.MaTP = thanhpho.MaTP
left join trangthai on chitietbaotri.MaTrangThai = trangthai.MaTrangThai
where baotri.MaBaoTri=:mabt";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':mabt', $mabt, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {
                                                ?>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Ngày bắt đầu</label>
                                                            <div class="col-sm-10">
                                                                <input type="date"  name="ngaybd" class="form-control" id="ngaybd" value="<?php echo htmlentities($result->NgayBatDau) ?>" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Ngày kết thúc</label>
                                                            <div class="col-sm-10">
                                                                <input type="date" readonly  class="form-control" id="ngaykt" value="<?php echo htmlentities($result->NgayKetThuc) ?>" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Ngày hoàn thành</label>
                                                            <div class="col-sm-10">
                                                                <input type="date" readonly class="form-control" id="ngayht" value="<?php echo htmlentities($result->NgayHoanThanh) ?>" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Tiến độ</label>
                                                            <div class="col-sm-10">
                                                                <?php
                                                                $tiendo = $result->TienDo;
                                                                if ($tiendo == "0%") {
                                                                ?>
                                                                    <select  disabled={true} class="form control">
                                                                        <option value="0%" selected>0%</option>
                                                                        <option value="10%">10%</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%">30%</option>
                                                                        <option value="40%">40%</option>
                                                                        <option value="50%">50%</option>
                                                                        <option value="60%">60%</option>
                                                                        <option value="70%">70%</option>
                                                                        <option value="80%">80%</option>
                                                                        <option value="90%">90%</option>
                                                                        <option value="100%">100%</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($tiendo == "10%") {
                                                                ?>
                                                                    <select  disabled={true} class="form control">
                                                                        <option value="0%">0%</option>
                                                                        <option value="10%" selected>10%</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%">30%</option>
                                                                        <option value="40%">40%</option>
                                                                        <option value="50%">50%</option>
                                                                        <option value="60%">60%</option>
                                                                        <option value="70%">70%</option>
                                                                        <option value="80%">80%</option>
                                                                        <option value="90%">90%</option>
                                                                        <option value="100%">100%</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($tiendo == "20%") {
                                                                ?>
                                                                    <select  disabled={true} class="form control">
                                                                        <option value="0%">0%</option>
                                                                        <option value="10%" selected>10%</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%">30%</option>
                                                                        <option value="40%">40%</option>
                                                                        <option value="50%">50%</option>
                                                                        <option value="60%">60%</option>
                                                                        <option value="70%">70%</option>
                                                                        <option value="80%">80%</option>
                                                                        <option value="90%">90%</option>
                                                                        <option value="100%">100%</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($tiendo == "30%") {
                                                                ?>
                                                                    <select  disabled={true} class="form control">
                                                                        <option value="0%">0%</option>
                                                                        <option value="10%">10%</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%" selected>30%</option>
                                                                        <option value="40%">40%</option>
                                                                        <option value="50%">50%</option>
                                                                        <option value="60%">60%</option>
                                                                        <option value="70%">70%</option>
                                                                        <option value="80%">80%</option>
                                                                        <option value="90%">90%</option>
                                                                        <option value="100%">100%</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($tiendo == "40%") {
                                                                ?>
                                                                    <select  disabled={true} class="form control">
                                                                        <option value="0%">0%</option>
                                                                        <option value="10%">10%</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%">30%</option>
                                                                        <option value="40%" selected>40%</option>
                                                                        <option value="50%">50%</option>
                                                                        <option value="60%">60%</option>
                                                                        <option value="70%">70%</option>
                                                                        <option value="80%">80%</option>
                                                                        <option value="90%">90%</option>
                                                                        <option value="100%">100%</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($tiendo == "50%") {
                                                                ?>
                                                                    <select  disabled={true} class="form control">
                                                                        <option value="0%">0%</option>
                                                                        <option value="10%">10%</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%">30%</option>
                                                                        <option value="40%">40%</option>
                                                                        <option value="50%" selected>50%</option>
                                                                        <option value="60%">60%</option>
                                                                        <option value="70%">70%</option>
                                                                        <option value="80%">80%</option>
                                                                        <option value="90%">90%</option>
                                                                        <option value="100%">100%</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($tiendo == "60%") {
                                                                ?>
                                                                    <select  disabled={true} class="form control">
                                                                        <option value="0%">0%</option>
                                                                        <option value="10%">10%</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%">30%</option>
                                                                        <option value="40%">40%</option>
                                                                        <option value="50%">50%</option>
                                                                        <option value="60%" selected>60%</option>
                                                                        <option value="70%">70%</option>
                                                                        <option value="80%">80%</option>
                                                                        <option value="90%">90%</option>
                                                                        <option value="100%">100%</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($tiendo == "70%") {
                                                                ?>
                                                                    <select  disabled={true} class="form control">
                                                                        <option value="0%">0%</option>
                                                                        <option value="10%">10%</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%">30%</option>
                                                                        <option value="40%">40%</option>
                                                                        <option value="50%">50%</option>
                                                                        <option value="60%">60%</option>
                                                                        <option value="70%" selected>70%</option>
                                                                        <option value="80%">80%</option>
                                                                        <option value="90%">90%</option>
                                                                        <option value="100%">100%</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($tiendo == "80%") {
                                                                ?>
                                                                    <select  disabled={true} class="form control">
                                                                        <option value="0%">0%</option>
                                                                        <option value="10%">10%</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%">30%</option>
                                                                        <option value="40%">40%</option>
                                                                        <option value="50%">50%</option>
                                                                        <option value="60%">60%</option>
                                                                        <option value="70%">70%</option>
                                                                        <option value="80%" selected>80%</option>
                                                                        <option value="90%">90%</option>
                                                                        <option value="100%">100%</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($tiendo == "90%") {
                                                                ?>
                                                                    <select  disabled={true} class="form control">
                                                                        <option value="0%">0%</option>
                                                                        <option value="10%">10%</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%">30%</option>
                                                                        <option value="40%">40%</option>
                                                                        <option value="50%">50%</option>
                                                                        <option value="60%">60%</option>
                                                                        <option value="70%">70%</option>
                                                                        <option value="80%">80%</option>
                                                                        <option value="90%" selected>90%</option>
                                                                        <option value="100%">100%</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($tiendo == "100%") {
                                                                ?>
                                                                    <select  disabled={true} class="form control">
                                                                        <option value="0%">0%</option>
                                                                        <option value="10%">10%</option>
                                                                        <option value="20%">20%</option>
                                                                        <option value="30%">30%</option>
                                                                        <option value="40%">40%</option>
                                                                        <option value="50%">50%</option>
                                                                        <option value="60%">60%</option>
                                                                        <option value="70%">70%</option>
                                                                        <option value="80%">80%</option>
                                                                        <option value="90%">90%</option>
                                                                        <option value="100%" selected>100%</option>
                                                                    </select>
                                                                <?php } ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Trạng thái</label>
                                                            <div class="col-sm-10">
                                                                <?php
                                                                $trangthai = $result->TrangThai;
                                                                if ($trangthai == "Mới") {
                                                                ?>
                                                                    <select  disabled={true} disabled={true} class="form-control">
                                                                        <option value="1" selected>Mới</option>
                                                                        <option value="2">Đang tiến hành</option>
                                                                        <option value="3">Hoàn thành</option>
                                                                        <option value="4">Phản hồi</option>
                                                                        <option value="5">Đóng</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($trangthai == "Đang tiến hành") {
                                                                ?>
                                                                    <select  disabled={true} class="form-control">
                                                                        <option value="1">Mới</option>
                                                                        <option value="2" selected>Đang tiến hành</option>
                                                                        <option value="3">Hoàn thành</option>
                                                                        <option value="4">Phản hồi</option>
                                                                        <option value="5">Đóng</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($trangthai == "Hoàn thành") {
                                                                ?>
                                                                    <select  disabled={true} class="form-control">
                                                                        <option value="1">Mới</option>
                                                                        <option value="2">Đang tiến hành</option>
                                                                        <option value="3" selected>Hoàn thành</option>
                                                                        <option value="4">Phản hồi</option>
                                                                        <option value="5">Đóng</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($trangthai == "Phản hồi") {
                                                                ?>
                                                                    <select  disabled={true} class="form-control">
                                                                        <option value="1">Mới</option>
                                                                        <option value="2">Đang tiến hành</option>
                                                                        <option value="3">Hoàn thành</option>
                                                                        <option value="4" selected>Phản hồi</option>
                                                                        <option value="5">Đóng</option>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php
                                                                if ($trangthai == "Đóng") {
                                                                ?>
                                                                    <select  disabled={true} class="form-control">
                                                                        <option value="1">Mới</option>
                                                                        <option value="2">Đang tiến hành</option>
                                                                        <option value="3">Hoàn thành</option>
                                                                        <option value="4">Phản hồi</option>
                                                                        <option value="5" selected>Đóng</option>
                                                                    </select>
                                                                <?php } ?>

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Bình luận</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" value="<?php echo htmlentities($result->NoiDung) ?>" readonly autocomplete="off">
                                                            </div>
                                                        </div>

                                                <?php }
                                                } ?>


                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" name="Update" class="btn btn-primary">Cập nhật</button>
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