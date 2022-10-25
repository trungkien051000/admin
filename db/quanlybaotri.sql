

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlybaotri`
--

-- --------------------------------------------------------

--
-- Table structure for table `ThanhPho`
--

CREATE TABLE `thanhpho` (
  `MaTP` int(10) NOT NULL PRIMARY KEY,
  `TenTat` varchar(50)  NOT NULL,
  `TenTP` varchar(100) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ThanhPho`
--

INSERT INTO `thanhpho` (`MaTP`,`TenTat`, `TenTP`,`CreationDate`,`updationDate`) VALUES
(1,'DN', N'Đà Nẵng', '2022-04-19 09:37:14', '0000-00-00 00:00:00'),
(2,'HN', N'Hà Nội', '2022-04-19 09:37:34', '0000-00-00 00:00:00'),
(3,'HCM', N'Hồ Chí Minh', '2022-04-19 09:37:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Quan`
--

CREATE TABLE `quan` (
  `MaQuan` int(10) NOT NULL PRIMARY KEY,
  `MaTP` int(10)  NOT NULL,
  `TenQuan` varchar(100) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
   KEY `thanhpho`(`MaTP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Quan`
--

INSERT INTO `quan` (`MaQuan`, `MaTP`,`TenQuan`,`CreationDate`,`updationDate`) VALUES
(1, 1,N'Hải Châu', '2022-04-19 09:45:10', '0000-00-00 00:00:00'),
(2, 1,N'Sơn Trà', '2022-04-19 09:45:21', '0000-00-00 00:00:00'),
(3, 1,N'Ngũ Hành Sơn', '2022-04-19 09:45:33', '0000-00-00 00:00:00'),
(4, 2, N'Hoàn Kiếm', '2022-04-19 09:45:47', '0000-00-00 00:00:00'),
(5, 2, N'Cầu Giấy', '2022-04-19 09:45:55', '0000-00-00 00:00:00'),
(6, 3, N'Gò Vấp', '2022-04-19 09:46:05', '0000-00-00 00:00:00'),
(7, 3, N'Phú Nhuận', '2022-04-19 09:46:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Phuong`
--

CREATE TABLE `phuong` (
  `MaPhuong` int(10) NOT NULL PRIMARY KEY,
  `MaQuan` int(10)  NOT NULL,
  `TenPhuong` varchar(100) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
   KEY `quan`(`MaQuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Phuong`
--

INSERT INTO `phuong` (`MaPhuong`, `MaQuan`,`TenPhuong`,`CreationDate`,`updationDate`) VALUES
(1, 1,N'Thanh Bình', '2022-04-19 10:07:00', '0000-00-00 00:00:00'),
(2, 2,N'An Hải Bắc', '2022-04-19 10:07:08', '0000-00-00 00:00:00'),
(3, 3,N'Mỹ An', '2022-04-19 10:07:11', '0000-00-00 00:00:00'),
(4, 4, N'Chương Dương', '2022-04-19 10:07:13', '0000-00-00 00:00:00'),
(5, 5, N'Mai Dịch', '2022-04-19 10:07:17', '0000-00-00 00:00:00'),
(6, 6, N'Phường 15', '2022-04-19 10:07:20', '0000-00-00 00:00:00'),
(7, 7, N'Phường 04', '2022-04-19 10:07:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Dia Chi`
--

CREATE TABLE `diachi` (
  `MaDiaChi` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `MaPhuong` int(10)  NOT NULL,
  `DiaChi` varchar(100) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
   KEY `phuong`(`MaPhuong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Dia Chi`
--

INSERT INTO `diachi` (`MaDiaChi`, `MaPhuong`,`DiaChi`,`CreationDate`,`updationDate`) VALUES
(1, 1,N'12 Ông Ích Khiêm', '2022-04-19 10:32:03', '0000-00-00 00:00:00'),
(2, 2,N'129 Nguyễn Trung Trực', '2022-04-19 10:32:04', '0000-00-00 00:00:00'),
(3, 3,N'368 Ngũ Hành Sơn', '2022-04-19 10:32:05', '0000-00-00 00:00:00'),
(4, 4,N'68 Bạch Đằng', '2022-04-19 10:32:11', '0000-00-00 00:00:00'),
(5, 5,N'64 Trần Vỹ', '2022-04-19 10:32:12', '0000-00-00 00:00:00'),
(6, 6,N'862 Lê Đức Thọ', '2022-04-19 10:32:14', '0000-00-00 00:00:00'),
(7, 7,N'706 Nguyễn Kiệm', '2022-04-19 10:32:17', '0000-00-00 00:00:00'),
(8, 1,N'255 Nguyễn Tất Thành', '2022-04-19 10:32:20', '0000-00-00 00:00:00'),
(9, 1,N'43 Hải Hồ', '2022-04-19 10:32:22', '0000-00-00 00:00:00'),
(10, 1,N'4 Thanh Thủy', '2022-04-19 10:32:23', '0000-00-00 00:00:00'),
(11, 2,N'26 Nguyễn Thế Lộc', '2022-04-19 10:32:34', '0000-00-00 00:00:00'),
(12, 1,N'K21/20 Ông Ích Khiêm', '2022-04-19 10:32:37', '0000-00-00 00:00:00'),
(13, 2,N'267 Trần Hưng Đạo', '2022-04-19 10:32:40', '0000-00-00 00:00:00'),
(14, 3,N'48 Phan Tứ', '2022-04-19 10:32:44', '0000-00-00 00:00:00'),
(15, 1,N'138 Ông Ích Khiêm', '2022-04-19 10:32:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Nhan Vien`
--

CREATE TABLE `nhanvien` (
  `MaNhanVien` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `HoTen` varchar(100)  NOT NULL,
  `NgaySinh` date NOT NULL,
  `GioiTinh` varchar(10) DEFAULT 'Nam' NOT NULL,
  `Email` varchar(100) NOT NULL,
  `DienThoai` varchar(15) NOT NULL,
  `MaDiaChi` int(10) NOT NULL,
  `TaiKhoan` varchar(100) NOT NULL,
  `MatKhau` varchar(100) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
   KEY `diachi`(`MaDiaChi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Nhan Vien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `HoTen`,`NgaySinh`,`GioiTinh`, `Email`,`DienThoai`,`MaDiaChi`, `TaiKhoan`,`MatKhau`,`CreationDate`,`updationDate`) VALUES
(1, N'Bạch Trung Kiên','2000-10-05','Nam','1811505310121@sv.ute.udn.vn','0123456789',1,'admin','admin', '2022-04-19 10:55:01', '0000-00-00 00:00:00'),
(2, N'Lê Trương Bảo','20-11-05','Nam','letruongbao@gmail.com','0231456789',2,'letruongbao','demo', '2022-04-19 10:55:04', '0000-00-00 00:00:00'),
(3, N'Lê Nguyễn Hoàng Bin','2000-02-04','Nam','binLNH@gmail.com','0312456789',3,'bin','demo', '2022-04-19 10:55:13', '0000-00-00 00:00:00'),
(4, N'Hoàng Hồng Nhung','2002-02-02',N'Nữ','nhungHH@gmail.com','0321456789',4,'nhung','demo', '2022-04-19 10:55:24', '0000-00-00 00:00:00'),
(5, N'Nguyễn Văn An','2001-12-07','Nam','andeptrai@gmail.com','0456123789',5,'nguyenvanan','demo', '2022-04-19 10:55:35', '0000-00-00 00:00:00'),
(6, N'Thị Nở','1936-04-24',N'Nữ','thinocute@gmail.com','0654123789',6,'thino','demo', '2022-04-19 10:55:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Quyen`
--

CREATE TABLE `quyen` (
  `MaQuyen` int(2) NOT NULL PRIMARY KEY,
  `TenQuyen` varchar(100) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Quyen`
--

INSERT INTO `quyen` (`MaQuyen`, `TenQuyen`,`CreationDate`,`updationDate`) VALUES
(1, 'Admin', '2022-04-19 09:25:22', '0000-00-00 00:00:00'),
(2, N'Nhân viên', '2022-04-19 09:25:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `NV_Quyen`
--

CREATE TABLE `nv_quyen` (
  `MaNhanVien` int(10) NOT NULL PRIMARY KEY,
  `MaQuyen` int(2) NOT NULL ,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  KEY `quyen` (`MaQuyen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `NV_Quyen`
--

INSERT INTO `nv_quyen` (`MaNhanVien`, `MaQuyen`,`CreationDate`,`updationDate`) VALUES
(1, 1, '2022-04-19 09:29:30', '0000-00-00 00:00:00'),
(2, 2, '2022-04-19 09:29:55', '0000-00-00 00:00:00'),
(3, 2, '2022-04-19 09:30:05', '0000-00-00 00:00:00'),
(4, 2, '2022-04-19 09:30:49', '0000-00-00 00:00:00'),
(5, 2, '2022-04-19 09:31:15', '0000-00-00 00:00:00'),
(6, 2, '2022-04-19 09:31:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Nha San Xuat`
--

CREATE TABLE `nhasanxuat` (
  `MaNSX` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `MaDiaChi` int(10)  NOT NULL,
  `TenNSX` varchar(100) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
   KEY `diachi`(`MaDiaChi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Nha San Xuat`
--

INSERT INTO `nhasanxuat` (`MaNSX`, `MaDiaChi`,`TenNSX`,`CreationDate`,`updationDate`) VALUES
(1, 7,'Nuova Simonelli', '2022-04-19 10:32:03', '0000-00-00 00:00:00'),
(2, 8,'Nescafe', '2022-04-19 10:32:04', '0000-00-00 00:00:00'),
(3, 9,'Saeco', '2022-04-19 10:32:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Nha Cung Cap`
--

CREATE TABLE `nhacungcap` (
  `MaNCC` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `MaNSX` int(10)  NOT NULL,
  `MaDiaChi` int(10)  NOT NULL,
  `TenNCC` varchar(100) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
   KEY `diachi`(`MaDiaChi`),
   KEY `nhasanxuat`(`MaNSX`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Nha Cung Cap`
--

INSERT INTO `nhacungcap` (`MaNCC`, `MaNSX`,`MaDiaChi`,`TenNCC`,`CreationDate`,`updationDate`) VALUES
(1, 1,10,N'Mộc Nguyên Coffee', '2022-04-19 10:32:03', '0000-00-00 00:00:00'),
(2, 2,11,N'VinaFin-Máy pha cà phê 100% từ Italia', '2022-04-19 10:32:04', '0000-00-00 00:00:00'),
(3, 3,12,N'UY VIET GROUP', '2022-04-19 10:32:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Loai Thiet Bi`
--

CREATE TABLE `loaithietbi` (
  `MaLoaiTB` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `TenLoaiTB` varchar(100) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Loai Thiet Bi`
--

INSERT INTO `loaithietbi` (`MaLoaiTB`, `TenLoaiTB`,`CreationDate`,`updationDate`) VALUES
(1,'Jura', '2022-04-19 11:53:11', '0000-00-00 00:00:00'),
(2,'Melitta ', '2022-04-19 11:53:17', '0000-00-00 00:00:00'),
(3,'Ascaso', '2022-04-19 11:53:35', '0000-00-00 00:00:00'),
(4,'Faema', '2022-04-19 11:53:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Thiet Bi`
--

CREATE TABLE `thietbi` (
  `MaThietBi` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `MaLoaiTB` int(10) NOT NULL ,
  `MaNCC` int(10) NOT NULL ,
  `TenThietBi` varchar(100) NOT NULL,
  `CongSuat` varchar(100) NOT NULL,
  `DienAp` varchar(100) NOT NULL,
  `CanNang` varchar(100) NOT NULL,
  `XuatSu` varchar(100) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  KEY `loaithietbi`(`MaLoaiTB`),
  KEY `nhacungcap`(`MaNCC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Thiet Bi`
--

INSERT INTO `thietbi` (`MaThietBi`, `MaLoaiTB`,`MaNCC`,`TenThietBi`,`CongSuat`, `DienAp`,`CanNang`, `XuatSu`,`CreationDate`,`updationDate`) VALUES
(1,1,1,N'Máy Jura Impressa A5','1450W','220V – 240V','9kg – 10kg',N'Thụy Sĩ', '2022-04-19 15:01:01', '0000-00-00 00:00:00'),
(2,1,1,N'Máy Jura Impressa A8','1450W','220V – 240V','9kg – 10kg',N'Thụy Sĩ', '2022-04-19 15:01:02', '0000-00-00 00:00:00'),
(3,1,2,N'Máy Jura Impressa S9','1450W','220V – 240V','9kg – 10kg',N'Thụy Sĩ', '2022-04-19 15:01:03', '0000-00-00 00:00:00'),
(4,2,1,N'Máy Melitta Caffeo Passione','1450W – 1500W','220V – 240V','9kg – 11kg',N'Đức', '2022-04-19 15:01:04', '0000-00-00 00:00:00'),
(5,2,2,N'Máy Melitta CI Touch','1450W – 1500W','220V – 240V','9kg – 11kg',N'Đức', '2022-04-19 15:01:05', '0000-00-00 00:00:00'),
(6,2,3,N'Máy Melitta Caffeo Solo','1450W – 1500W','220V – 240V','9kg – 11kg',N'Đức', '2022-04-19 15:01:06', '0000-00-00 00:00:00'),
(7,3,1,N'Máy Ascaso Dream 14','1000W – 1100W','230V','7kg – 12kg',N'Tây Ban Nha', '2022-04-19 15:01:07', '0000-00-00 00:00:00'),
(8,3,2,N'Máy Ascaso Basic 11','1000W – 1100W','230V','7kg – 12kg',N'Tây Ban Nha', '2022-04-19 15:01:08', '0000-00-00 00:00:00'),
(9,3,2,N'Máy Ascaso Uno 12','1450W','220V – 240V','9kg – 10kg',N'Thụy Sĩ', '2022-04-19 15:01:09', '0000-00-00 00:00:00'),
(10,4,1,N'Máy Faema E71','4300W –7400W','220V','66kg – 67kg',N'Ý', '2022-04-19 15:01:10', '0000-00-00 00:00:00'),
(11,4,2,N'Máy Faema E98 RE A','4300W –7400W','220V','66kg – 67kg',N'Ý', '2022-04-19 15:01:11', '0000-00-00 00:00:00'),
(12,4,3,N'Máy Faema E61 Jubile DT2','4300W –7400W','220V','66kg – 67kg',N'Ý', '2022-04-19 15:01:12', '0000-00-00 00:00:00'),
(13,4,3,N'Máy Faema Enova A2','4300W –7400W','220V','66kg – 67kg',N'Ý', '2022-04-19 15:01:13', '0000-00-00 00:00:00');


-- --------------------------------------------------------

--
-- Table structure for table `Khach Hang`
--

CREATE TABLE `khachhang` (
  `MaKhachHang` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `MaDiaChi` int(10) NOT NULL ,
  `HoTen` varchar(100) NOT NULL,
  `DoanhNghiep` varchar(100) NOT NULL,
  `DienThoai` varchar(100) NOT NULL,
  `TaiKhoan` varchar(100) NOT NULL,
  `MatKhau` varchar(100) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  KEY `diachi`(`MaDiaChi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Khach Hang`
--

INSERT INTO `khachhang` (`MaKhachHang`, `MaDiaChi`,`HoTen`,`DoanhNghiep`,`DienThoai`, `TaiKhoan`,`MatKhau`,`CreationDate`,`updationDate`) VALUES
(1,13,N'Kiều Nguyệt Nga',N'Lầu Ngưng Bích','00232145698','kieunguyetnga','kieunguyetnga', '2022-04-19 15:11:01', '0000-00-00 00:00:00'),
(2,14,N'Ngô Minh Hiếu',N'Hiếu PC','0334455661','hieupc','hieupc', '2022-04-19 15:11:02', '0000-00-00 00:00:00'),
(3,15,'John Cena','You cant see me','0011445599','johncena','johncena', '2022-04-19 15:11:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Thiet Bi Khach Hang`
--
CREATE TABLE `thietbiKH` (
  `MaKhachHang` int(10) NOT NULL,
  `MaThietBi` int(10) NOT NULL ,
  KEY `khachhang`(`MaKhachHang`),
  KEY `thietbi`(`MaThietBi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Thiet Bi khach Hang`
--

INSERT INTO `thietbiKH` (`MaKhachHang`,`MaThietBi`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13);

-- --------------------------------------------------------

--
-- Table structure for table `Binh luan`
--

CREATE TABLE `binhluan` (
  `MaBinhLuan` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `NoiDung` varchar(256) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Binh luan`
--

INSERT INTO `binhluan` (`MaBinhLuan`, `NoiDung`,`CreationDate`,`updationDate`) VALUES
(1,N'Làm tốt', '2022-04-19 15:16:01', '0000-00-00 00:00:00'),
(2,N'Làm nhanh, gọn gàng, sạch sẽ', '2022-04-19 15:16:02', '0000-00-00 00:00:00'),
(3,N'Làm chưa tốt, thái độ thiếu chuyên nghiệp', '2022-04-19 15:16:03', '0000-00-00 00:00:00'),
(4,N'Làm ẩu thả, cần phải cải thiện lại thái độ làm việc', '2022-04-19 15:16:04', '0000-00-00 00:00:00'),
(5,N'Tác phong nhanh nhẹn', '2022-04-19 15:16:05', '0000-00-00 00:00:00'),
(6,N'Làm tốt', '2022-04-19 15:16:07', '0000-00-00 00:00:00');


-- --------------------------------------------------------

--
-- Table structure for table `DuyetBaoTri`
--


CREATE TABLE `duyetbaotri` (
  `MaDuyetBT` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `TrangThaiDuyet` varchar(255) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Duyet Bao Tri`
--

INSERT INTO `duyetbaotri` (`MaDuyetBT`, `TrangThaiDuyet`, `CreationDate`, `updationDate`) VALUES
(1, 'Đang chờ duyệt', '2022-04-19 12:16:04', '0000-00-00 00:00:00'),
(2, 'Không duyệt', '2022-04-19 13:16:04', '0000-00-00 00:00:00'),
(3, 'Đã duyệt', '2022-04-19 14:16:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Bao Tri`
--

CREATE TABLE `baotri` (
  `MaBaoTri` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `MaNhanVien` int(10) ,
  `MaKhachHang` int(10) NOT NULL,
  `MaBinhLuan` int(10) ,
  `TieuDe` varchar(100) NOT NULL,
  `MoTa` varchar(250) NULL,
  `MaDuyetBT` int(10) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  KEY `nhanvien`(`MaNhanVien`),
  KEY `khachhang`(`MaKhachHang`),
  KEY `binhluan`(`MaBinhLuan`),
  KEY `duyetbaotri`(`MaDuyetBT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Bao Tri`
--

INSERT INTO `baotri` (`MaBaoTri`, `MaNhanVien`,`MaKhachHang`,`MaBinhLuan`, `TieuDe`,`MoTa`,`MaDuyetBT`,`CreationDate`,`updationDate`) VALUES
(1,2,1,1,N'Bảo trì vòi đánh sữa',N'Vòi đánh sữa không hoạt động',3,'2022-04-19 16:28:01', '0000-00-00 00:00:00'),
(2,3,2,2,N'Sửa chữa máy cà phê',N'Cà phê chảy ra ít',3,'2022-04-19 16:28:02', '0000-00-00 00:00:00'),
(3,6,3,3, N'Máy cà phê không hoạt động',NULL,3,'2022-04-19 16:28:04', '0000-00-00 00:00:00'),
(4,2,2,4,N'Bảo trì máy pha cà phê',NULL,3, '2022-04-19 16:28:05', '0000-00-00 00:00:00'),
(5,4,2,5, N'Sửa chữa máy cà phê',N'Cà phê chảy ra quá nhiều, dẫn đến bị lỏng, uống không còn đậm đà',3,'2022-04-19 16:27:06', '0000-00-00 00:00:00'),
(6,3,1,6, N'Bảo trì máy pha cà phê',NULL,3,'2022-04-19 16:28:07', '0000-00-00 00:00:00'),
(7,4,2,5, N'Sửa chữa máy cà phê',N'Cà phê chảy ra quá nhiều, dẫn đến bị lỏng, uống không còn đậm đà',3,'2022-04-19 16:26:06', '0000-00-00 00:00:00'),
(8,4,2,5, N'Ống nước bị tắc',N'Không có nước',1,'2022-04-19 16:25:06', '0000-00-00 00:00:00'),
(9,null,2,null, N'Máy cà phê bị hỏng',N'Không mở nguồn được máy pha cà phê',2,'2022-04-19 16:24:06', '0000-00-00 00:00:00'),
(10,2,2,5, N'Lưới lọc cà phê',N'Lưới lọc máy pha bị gỉ',3,'2022-04-19 16:23:06', '0000-00-00 00:00:00'),
(11,4,2,5, N'Không có nước',N'Cà phê không chảy ra khi bấm nút pha',1,'2022-04-19 16:22:06', '0000-00-00 00:00:00'),
(12,4,2,5, N'Đồng hồ nhiệt độ và áp suất',N'Bảng đồng hồ bị hư, không thấy hoạt động',3,'2022-04-19 16:21:06', '0000-00-00 00:00:00'),
(13,4,2,5, N'Công tắc điều chỉnh áp suất',N'Công tắc bị hỏng, không điều chỉnh được áp suất',1,'2022-04-19 16:28:36', '0000-00-00 00:00:00');


-- --------------------------------------------------------

--
-- Table structure for table `Trang Thai Bao Tri`
--

CREATE TABLE `trangthai` (
  `MaTrangThai` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `TrangThai` varchar(256) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Trang Thai Bao Tri`
--

INSERT INTO `trangthai` (`MaTrangThai`, `TrangThai`,`CreationDate`,`updationDate`) VALUES
(1,N'Mới', '2022-04-19 15:16:01', '0000-00-00 00:00:00'),
(2,N'Đang tiến hành', '2022-04-19 15:16:02', '0000-00-00 00:00:00'),
(3,N'Hoàn thành', '2022-04-19 15:16:03', '0000-00-00 00:00:00'),
(4,N'Phản hồi', '2022-04-19 15:16:04', '0000-00-00 00:00:00'),
(5,N'Đóng', '2022-04-19 15:16:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Chi Tiet Bao Tri`
--

CREATE TABLE `chitietbaotri` (
  `MaBaoTri` int(10) NOT NULL ,
  `MaThietBi` int(10) NOT NULL,
  `NgayBatDau` date DEFAULT CURRENT_TIMESTAMP,
  `NgayKetThuc` date,
  `NgayHoanThanh` date  ,
  `TienDo` varchar(100) DEFAULT '0%' ,
  `MaTrangThai` int(10)  DEFAULT 1,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  KEY `baotri`(`MaBaoTri`),
  KEY `thietbi`(`MaThietBi`),
  KEY `trangthai`(`MaTrangThai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Chi Tiet Bao Tri`
--

INSERT INTO `chitietbaotri` (`MaBaoTri`, `MaThietBi`,`NgayBatDau`,`NgayKetThuc`, `NgayHoanThanh`,`TienDo`,`MaTrangThai`,`CreationDate`,`updationDate`) VALUES
(1,1,'2022-04-19','2022-04-19','2022-04-19','100%',3 ,'2022-04-19 16:41:01', '0000-00-00 00:00:00'),
(2,2,'2022-04-20','2022-04-21',NULL,'50%',2 ,'2022-04-19 16:41:02', '0000-00-00 00:00:00'),
(3,3,'2022-04-21','2022-04-23',NULL,'0%',4 ,'2022-04-19 16:41:04', '0000-00-00 00:00:00'),
(4,4,'2022-04-22','2022-04-22','2022-04-22','100%',5 ,'2022-04-19 16:41:12', '0000-00-00 00:00:00'),
(5,5,'2022-04-23','2022-04-25',NULL,'80%',1, '2022-04-19 16:41:21', '0000-00-00 00:00:00'),
(6,4,'2022-04-23','2022-04-25',NULL,'70%',1, '2022-04-19 16:41:21', '0000-00-00 00:00:00'),
(7,3,'2022-04-23','2022-04-25',NULL,'60%',1, '2022-04-19 16:41:21', '0000-00-00 00:00:00'),
(8,2,'2022-04-23','2022-04-25',NULL,'0%',1, '2022-04-19 16:41:21', '0000-00-00 00:00:00'),
(9,1,'2022-04-23','2022-04-25',NULL,'0%',5, '2022-04-19 16:41:21', '0000-00-00 00:00:00'),
(10,2,'2022-04-23','2022-04-25',NULL,'30%',4, '2022-04-19 16:41:21', '0000-00-00 00:00:00'),
(11,3,'2022-04-23','2022-04-25',NULL,'0%',1, '2022-04-19 16:41:21', '0000-00-00 00:00:00'),
(12,4,'2022-04-23','2022-04-25',NULL,'10%',5, '2022-04-19 16:41:21', '0000-00-00 00:00:00'),
(13,5,'2022-04-23','2022-04-25',NULL,'0%',1, '2022-04-19 16:41:21', '0000-00-00 00:00:00');


-- --------------------------------------------------------

--
-- Table structure for table `Danh gia`
--

CREATE TABLE `danhgia` (
  `MaDanhGia` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `MaNhanVien` int(10) NOT NULL,
  `DanhGia` int(2) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  KEY `baotri`(`MaNhanVien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Danh gia`
--

INSERT INTO `danhgia` (`MaDanhGia`, `MaNhanVien`,`DanhGia`,`CreationDate`,`updationDate`) VALUES
(1,2,5, '2022-04-19 15:21:01', '0000-00-00 00:00:00'),
(2,3,8, '2022-04-19 15:21:02', '0000-00-00 00:00:00'),
(3,6,4, '2022-04-19 15:21:04', '0000-00-00 00:00:00'),
(4,2,3, '2022-04-19 15:21:05', '0000-00-00 00:00:00'),
(5,4,9, '2022-04-19 15:21:06', '0000-00-00 00:00:00'),
(6,3,10, '2022-04-19 15:21:07', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
