<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lịch bảo trì</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen"> <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css" />
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
    </head>

    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('includes/topbar.php'); ?>
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
                    <?php include('includes/leftbar.php'); ?>

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Lịch bảo trì</h2>

                                </div>

                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Trang chủ</a></li>
                                        <li> <a href="quanly-baotri.php">Lịch bảo trì</a></li>
                                        <li class="active">Danh sách lịch bảo trì</li>
                                    </ul>
                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">



                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Xem thông tin lịch bảo trì</h5>
                                                </div>
                                            </div>
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                    <strong>Hoàn tất!</strong><?php echo htmlentities($msg); ?>
                                                </div><?php } else if ($error) { ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                    <strong>Thất bại!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                            <div class="panel-body p-20">

                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tiêu đề</th>
                                                            <th>Mô tả</th>
                                                            <th>Thiết bị</th>
                                                            <th>Nhân viên</th>
                                                            <th>Khách hàng</th>
                                                            <th>Tiến độ</th>
                                                            <th>Trạng thái</th>
                                                            <th>Trạng thái duyệt</th>
                                                            <th>Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tiêu đề</th>
                                                            <th>Mô tả</th>
                                                            <th>Thiết bị</th>
                                                            <th>Nhân viên</th>
                                                            <th>Khách hàng</th>
                                                            <th>Tiến độ</th>
                                                            <th>Trạng thái</th>
                                                            <th>Trạng thái duyệt</th>
                                                            <th>Thao tác</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        <?php $sql = "SELECT baotri.MaBaoTri,nhanvien.HoTen as htnv,khachhang.HoTen as htkh,baotri.TieuDe,baotri.MoTa,thietbi.TenThietBi,chitietbaotri.TienDo,trangthai.TrangThai, duyetbaotri.TrangThaiDuyet
from baotri 
left join duyetbaotri on duyetbaotri.MaDuyetBT = baotri.MaDuyetBT left join nhanvien on nhanvien.MaNhanVien = baotri.MaNhanVien 
left join khachhang on khachhang.MaKhachHang =baotri.MaKhachHang 
left join chitietbaotri on chitietbaotri.MaBaoTri = baotri.MaBaoTri left join diachi on diachi.MaDiaChi = khachhang.MaDiaChi 
left join binhluan on binhluan.MaBinhLuan = baotri.MaBinhLuan left join thietbi on thietbi.MaThietBi = chitietbaotri.MaThietBi
left join phuong on diachi.MaPhuong = phuong.MaPhuong left join quan on phuong.MaQuan = quan.MaQuan left join thanhpho on quan.MaTP = thanhpho.MaTP
left join trangthai on chitietbaotri.MaTrangThai = trangthai.MaTrangThai
ORDER BY baotri.MaBaoTri ASC
";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {
                                                                if ($result->TrangThai === 'Đóng') {
                                                        ?>
                                                                    <tr style="background-color:red">
                                                                    <?php
                                                                } else if ($result->TrangThai === 'Đang tiến hành') {
                                                                    ?>
                                                                    <tr style="background-color:green">
                                                                    <?php
                                                                }
                                                                    ?>
                                                                    <td <?php if($result->TrangThai === 'Đóng' || $result->TrangThai === 'Đang tiến hành') {?> style="color:white"<?php } ?>><?php echo htmlentities($cnt); ?></td>
                                                                    <td <?php if($result->TrangThai === 'Đóng' || $result->TrangThai === 'Đang tiến hành') {?> style="color:white"<?php } ?>><?php echo htmlentities($result->TieuDe); ?></td>
                                                                    <td <?php if($result->TrangThai === 'Đóng' || $result->TrangThai === 'Đang tiến hành') {?> style="color:white"<?php } ?>><?php echo htmlentities($result->MoTa); ?></td>
                                                                    <td <?php if($result->TrangThai === 'Đóng' || $result->TrangThai === 'Đang tiến hành') {?> style="color:white"<?php } ?>><?php echo htmlentities($result->TenThietBi); ?></td>
                                                                    <td <?php if($result->TrangThai === 'Đóng' || $result->TrangThai === 'Đang tiến hành') {?> style="color:white"<?php } ?>><?php echo htmlentities($result->htnv); ?></td>
                                                                    <td <?php if($result->TrangThai === 'Đóng' || $result->TrangThai === 'Đang tiến hành') {?> style="color:white"<?php } ?>><?php echo htmlentities($result->htkh); ?></td>
                                                                    <td <?php if($result->TrangThai === 'Đóng' || $result->TrangThai === 'Đang tiến hành') {?> style="color:white"<?php } ?>><?php echo htmlentities($result->TienDo); ?></td>
                                                                    <td <?php if($result->TrangThai === 'Đóng' || $result->TrangThai === 'Đang tiến hành') {?> style="color:white"<?php } ?>><?php echo htmlentities($result->TrangThai); ?></td>

                                                                    <?php if ($result->TrangThaiDuyet === 'Đã duyệt') {
                                                                        echo "<td style='background-color: green;color: white';>" ?>
                                                                        <?php echo htmlentities($result->TrangThaiDuyet); ?><?php "</td>";
                                                                                                                        } ?>
                                                                        <?php if ($result->TrangThaiDuyet === 'Không duyệt') {
                                                                            echo "<td style='background-color: red;color: white';>" ?>
                                                                            <?php echo htmlentities($result->TrangThaiDuyet); ?><?php "</td>";
                                                                                                                            } ?>
                                                                            <?php if ($result->TrangThaiDuyet === 'Đang chờ duyệt') {
                                                                                echo "<td style='background-color: orange;color: white';>" ?>
                                                                                <?php echo htmlentities($result->TrangThaiDuyet); ?><?php "</td>";
                                                                                                                                } ?>
                                                                                <td>
                                                                                    <a href="sua-baotri.php?idbt=<?php echo htmlentities($result->MaBaoTri); ?>"><i  <?php if($result->TrangThai === 'Đóng' || $result->TrangThai === 'Đang tiến hành') {?> style="color:white"<?php } ?>class="fa fa-edit" title="Chỉnh sửa"></i> </a>
                                                                                    <a href="deletebaotri.php?idbt=<?php echo htmlentities($result->MaBaoTri); ?>" onclick="return confirm('Bạn có muốn xóa ?');"><i  <?php if($result->TrangThai === 'Đóng' || $result->TrangThai === 'Đang tiến hành') {?> style="color:white"<?php } ?> class="fa fa-trash-o" title="Xóa"></i> </a>
                                                                                </td>
                                                                    </tr>
                                                            <?php $cnt = $cnt + 1;
                                                            }
                                                        } ?>


                                                    </tbody>
                                                </table>


                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->


                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-md-6 -->

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
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable({
                    "scrollY": "300px",
                    "scrollCollapse": true,
                    "paging": false
                });

                $('#example3').DataTable();
            });
        </script>
    </body>

    </html>
<?php } ?>