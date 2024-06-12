-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 12, 2024 lúc 01:47 AM
-- Phiên bản máy phục vụ: 10.5.20-MariaDB
-- Phiên bản PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `id21952697_quanlydiemsinhvien`
--
CREATE DATABASE IF NOT EXISTS `id21952697_quanlydiemsinhvien` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id21952697_quanlydiemsinhvien`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhsachlophocphan`
--

CREATE TABLE `danhsachlophocphan` (
  `id_lhp` varchar(12) NOT NULL,
  `ma_sv` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhsachlophocphan`
--

INSERT INTO `danhsachlophocphan` (`id_lhp`, `ma_sv`) VALUES
('010100174215', '2001211000'),
('010100174215', '2001211007'),
('010100174215', '2001211008'),
('010100174215', '2001211009'),
('010100228927', '2001211000'),
('010100228927', '2001211009'),
('010100228927', '2001211010'),
('010100259905', '2001211000'),
('010100259905', '2001211001'),
('010100259905', '2001211011'),
('010100347206', '2001211000'),
('010100347206', '2001211001'),
('010100347206', '2001211002'),
('010100347206', '2001211006'),
('010100347317', '2001211000'),
('010100347317', '2001211005'),
('010100347317', '2001211006'),
('010100347317', '2001211008'),
('010100517702', '2001211000'),
('010100517702', '2001211004'),
('010100517702', '2001211005'),
('010100755764', '2001211000'),
('010100755764', '2001211003'),
('010100755764', '2001211004'),
('010100755764', '2001211007'),
('010110098540', '2001211000'),
('010110098540', '2001211002'),
('010110098540', '2001211003');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diem`
--

CREATE TABLE `diem` (
  `id_sinh_vien` varchar(10) NOT NULL,
  `id_lhp` varchar(12) NOT NULL,
  `diemTL` float DEFAULT NULL,
  `diemCK` float DEFAULT NULL,
  `diemTK` float DEFAULT NULL,
  `thangDiem4` float DEFAULT NULL,
  `diemChu` char(2) DEFAULT NULL,
  `xepLoai` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `diem`
--

INSERT INTO `diem` (`id_sinh_vien`, `id_lhp`, `diemTL`, `diemCK`, `diemTK`, `thangDiem4`, `diemChu`, `xepLoai`) VALUES
('2001211000', '010100174215', 7, 6.5, 6.7, 2.5, 'C+', 'Trung bình'),
('2001211000', '010100228927', 9.5, 5.8, 7.5, 3, 'B', 'Khá'),
('2001211000', '010100259905', 9, 8.5, 8.7, 4, 'A', 'Giỏi'),
('2001211000', '010100347206', 9.5, 10, 9.9, 4, 'A', 'Giỏi'),
('2001211000', '010100347317', NULL, 9, 9, 4, 'A', 'Giỏi'),
('2001211000', '010100517702', NULL, 8.5, 8.5, 4, 'A', 'Giỏi'),
('2001211000', '010100755764', 9.7, 9, 9.2, 4, 'A', 'Giỏi'),
('2001211000', '010110098540', NULL, 8, 8, 3.5, 'B+', 'Khá'),
('2001211001', '010100259905', NULL, NULL, NULL, NULL, NULL, NULL),
('2001211001', '010100347206', NULL, NULL, NULL, NULL, NULL, NULL),
('2001211002', '010100347206', NULL, NULL, NULL, NULL, NULL, NULL),
('2001211005', '010100347317', NULL, NULL, NULL, NULL, NULL, NULL),
('2001211006', '010100347206', NULL, NULL, NULL, NULL, NULL, NULL),
('2001211006', '010100347317', NULL, NULL, NULL, NULL, NULL, NULL),
('2001211007', '010100174215', 8, 6, 6.6, NULL, NULL, NULL),
('2001211008', '010100174215', 6, 8, 7.4, NULL, NULL, NULL),
('2001211008', '010100347317', NULL, NULL, NULL, NULL, NULL, NULL),
('2001211009', '010100174215', 7, 9, 8.4, NULL, NULL, NULL),
('2001211009', '010100228927', NULL, NULL, NULL, NULL, NULL, NULL),
('2001211010', '010100228927', NULL, NULL, NULL, NULL, NULL, NULL),
('2001211011', '010100259905', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocky`
--

CREATE TABLE `hocky` (
  `id_hk` int(11) NOT NULL,
  `ten_hk` varchar(100) NOT NULL,
  `Nam_hoc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hocky`
--

INSERT INTO `hocky` (`id_hk`, `ten_hk`, `Nam_hoc`) VALUES
(1, 'Học kỳ 1', 2021),
(2, 'Học kỳ 2', 2021);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lophoc`
--

CREATE TABLE `lophoc` (
  `id_lh` int(11) NOT NULL,
  `tenLop` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lophoc`
--

INSERT INTO `lophoc` (`id_lh`, `tenLop`) VALUES
(1, '12DHTH02'),
(2, '12DHTH03'),
(3, '12DHTH05'),
(4, '12DHTH06'),
(5, '12DHTH18'),
(6, '12DHTH21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lophocphan`
--

CREATE TABLE `lophocphan` (
  `id_lhp` varchar(12) NOT NULL,
  `id_lh` int(11) DEFAULT NULL,
  `id_mh` varchar(10) DEFAULT NULL,
  `id_gv` varchar(10) DEFAULT NULL,
  `id_hk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lophocphan`
--

INSERT INTO `lophocphan` (`id_lhp`, `id_lh`, `id_mh`, `id_gv`, `id_hk`) VALUES
('010100174215', 4, '001742', 'teacher1', 2),
('010100228927', 5, '002289', 'teacher1', 2),
('010100259905', 3, '002599', 'teacher1', 2),
('010100347206', 2, '003472', 'teacher1', 1),
('010100347317', 2, '003473', 'teacher1', 1),
('010100517702', 1, '005177', 'teacher1', 2),
('010100755764', 2, '007557', 'teacher1', 1),
('010110098540', 6, '100985', 'teacher1', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

CREATE TABLE `monhoc` (
  `id_mh` varchar(10) NOT NULL,
  `ten` varchar(100) DEFAULT NULL,
  `so_tin_chi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`id_mh`, `ten`, `so_tin_chi`) VALUES
('001742', 'Hệ điều hành', 3),
('002289', 'Kiến trúc máy tính', 3),
('002599', 'Kỹ thuật lập trình', 2),
('003472', 'Nhập môn lập trình', 3),
('003473', 'Thực hành nhập môn lập trình', 2),
('005177', 'Thực hành kỹ thuật lập trình', 1),
('007557', 'Kỹ năng ứng dụng Công nghệ Thông tin', 3),
('100985', 'Thực hành Hệ điều hành', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbao`
--

CREATE TABLE `thongbao` (
  `id_thongbao` int(11) NOT NULL,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` text DEFAULT NULL,
  `ngay_dang` date DEFAULT NULL,
  `khoa` varchar(50) DEFAULT NULL,
  `id_gv` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongbao`
--

INSERT INTO `thongbao` (`id_thongbao`, `tieu_de`, `noi_dung`, `ngay_dang`, `khoa`, `id_gv`) VALUES
(1, 'Thông báo học kỳ mới', 'Học kỳ mới sẽ bắt đầu vào ngày 10/01/2023.', '2023-01-05', 'Khoa Công nghệ thông tin', 'teacher1'),
(2, 'Thông báo về lịch thi', 'Lịch thi sẽ được công bố vào ngày 01/05/2023.', '2023-04-25', 'Khoa Công nghệ thông tin', 'teacher1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id_user` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL CHECK (`role` in ('admin','teacher','student')),
  `ten` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gioi_tinh` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `dia_chi` text DEFAULT NULL,
  `hinh_the` varchar(200) DEFAULT 'undraw_profile.svg',
  `ma_lop` int(11) DEFAULT NULL,
  `khoa` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `otp_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id_user`, `password`, `role`, `ten`, `email`, `gioi_tinh`, `ngay_sinh`, `dia_chi`, `hinh_the`, `ma_lop`, `khoa`, `otp`, `otp_verified`) VALUES
('2001211000', '$2a$12$4pHuVIXjDglog86GUm/Z6epgt7LuRYhRRKu4Io09sMhBRsvqNQ0fy', 'student', 'Trương Ca Ca', 'caca10@gmail.com', 'Nữ', '2003-09-10', 'Hà Nội', 'ca_ca.jpg', 2, 'Khoa Công nghệ thông tin', '638860', 0),
('2001211001', '$2a$12$zU2QpVgk.Rc1dGj7s7SqZO0LFCq9L/0ZJB0LOk25DHbyY2BYija5S', 'student', 'Nguyễn Văn A', 'vana1@gmail.com', 'Nam', '2002-01-01', 'An Giang', 'undraw_profile.svg', 1, 'Công nghệ thông tin', NULL, 0),
('2001211002', '$2a$12$exvTYTS/5fbbLnB5CluS8eEARh3BpZ/8jbtdSC8PS4R8zdK4vSQ2.', 'student', 'Trần Thị B', 'trantib2@gmail.com', 'Nữ', '2002-02-02', 'Bà Rịa - Vũng Tàu', 'undraw_profile.svg', 3, 'Công nghệ thông tin', NULL, 0),
('2001211003', '$2a$12$dFtvwlNoI5nM4twOd5c0V.iDWBc2RhVB5hHa5pCwNYU5r00KV.1/e', 'student', 'Lê Văn C', 'levanc3@gmail.com', 'Nam', '2003-03-03', 'Bắc Giang', 'undraw_profile.svg', 4, 'Công nghệ thông tin', NULL, 0),
('2001211004', '$2a$12$WNmo3Fk0KnAM7h7/f9mRaeX6usNbdFukcPCRmzf/fZRW0dAZ/EIpq', 'student', 'Đặng Thị D', 'dangthid4@gmail.com', 'Nữ', '2004-04-04', 'Bắc Kạn', 'undraw_profile.svg', 5, 'Công nghệ thông tin', NULL, 0),
('2001211005', '$2a$12$Dj133t4G/FwOzINPawiH.eCr3P.VYWMdsj6iDHjyzlJCvmn3L9/2.', 'student', 'Phạm Văn E', 'phamve5@gmail.com', 'Nam', '2002-05-05', 'Bạc Liêu', 'undraw_profile.svg', 6, 'Công nghệ thông tin', NULL, 0),
('2001211006', '$2a$12$QofraummW5xeQ6grUdha0eS7LGBK//UVMT1BmQF4eztS/t7AR6IZi', 'student', 'Võ Thị F', 'vothif6@gmail.com', 'Nữ', '2003-06-06', 'Bến Tre', 'undraw_profile.svg', 1, 'Công nghệ thông tin', NULL, 0),
('2001211007', '$2y$10$IVr3R3hsSQlwxQA6yM5K/eu9A6Z9IvW4ceGntODkR50xgLX48V45G', 'student', 'Huỳnh Văn G', 'huynhvang7@gmail.com', 'Nam', '2003-07-07', 'Bình Định', 'undraw_profile.svg', 2, 'Công nghệ thông tin', NULL, 0),
('2001211008', '$2a$12$Bo9CXLtn7Q8AfXSMJyIQPeu2w6Ne6XzrtoTE2vLVoAWmZ9/FnVbdm', 'student', 'Đỗ Thị H', 'dothi8@gmail.com', 'Nữ', '2004-08-08', 'Bình Dương', 'undraw_profile.svg', 3, 'Công nghệ thông tin', NULL, 0),
('2001211009', '$2a$12$waSTO3VSoshNLz41nFLpHeDJypWzpAGmDHWBGBvW1.IZXEK6fDfVm', 'student', 'Nguyễn Thị I', 'nguyenthi9@gmail.com', 'Nữ', '2004-09-09', 'Bình Phước', 'undraw_profile.svg', 4, 'Công nghệ thông tin', NULL, 0),
('2001211010', '$2a$12$pVTjZavQdpNYjQ1j5xEJq.Ee7lftyySZ3xWx3n7MktDmj86cDdAkq', 'student', 'Lê Văn J', 'levanj10@gmail.com', 'Nam', '2003-10-10', 'Bình Thuận', 'undraw_profile.svg', 5, 'Công nghệ thông tin', NULL, 0),
('2001211011', '$2a$12$MNslXc5FLm.sCm1gM6JedORLAUTPYsnfRqch3nn1oW3ID.lMxFc9C', 'student', 'Trần Thị K', 'trantik11@gmail.com', 'Nữ', '2002-11-11', 'Cà Mau', 'undraw_profile.svg', 6, 'Công nghệ thông tin', NULL, 0),
('admin', '$2a$12$anYxh3IAbGgyWyJwN09R3uipRIy1KiQRn9b/ctkAao03hDk.w0.Sm', 'admin', 'Admin User', 'trieuthanh08042003@gmail.com', NULL, '1980-01-01', '123 Admin Street', 'undraw_profile.svg', NULL, NULL, NULL, 0),
('student1', '$2a$12$q0ztqwFHShOXMPxNStGtCOhmRsHbYZlkt2NdxSmSkai8UAKXg7Lu2', 'student', 'Student One', 'trieuuii@gmail.com', 'Nam', '2003-03-03', '789 Student Street', 'undraw_profile.svg', 1, 'Khoa Công nghệ thông tin', NULL, 0),
('teacher1', '$2a$12$0ybq5mEFLuB2bR0XaUW98.BQuL7uOjdwC2UioAPhvnP0gC9i3FByy', 'teacher', 'Teacher One', 'huynhthanhtrieu00@gmail.com', 'Nam', '2000-02-02', '456 Teacher Street', 'undraw_profile.svg', 1, 'Khoa Công nghệ thông tin', NULL, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhsachlophocphan`
--
ALTER TABLE `danhsachlophocphan`
  ADD PRIMARY KEY (`id_lhp`,`ma_sv`),
  ADD KEY `fk_dslhp_sv` (`ma_sv`);

--
-- Chỉ mục cho bảng `diem`
--
ALTER TABLE `diem`
  ADD PRIMARY KEY (`id_sinh_vien`,`id_lhp`),
  ADD KEY `fk_diem_lhp` (`id_lhp`);

--
-- Chỉ mục cho bảng `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`id_hk`);

--
-- Chỉ mục cho bảng `lophoc`
--
ALTER TABLE `lophoc`
  ADD PRIMARY KEY (`id_lh`);

--
-- Chỉ mục cho bảng `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD PRIMARY KEY (`id_lhp`),
  ADD KEY `fk_lhp_lh` (`id_lh`),
  ADD KEY `fk_lhp_mh` (`id_mh`),
  ADD KEY `fk_lhp_hk` (`id_hk`),
  ADD KEY `fk_lhp_gv` (`id_gv`);

--
-- Chỉ mục cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`id_mh`);

--
-- Chỉ mục cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`id_thongbao`),
  ADD KEY `id_gv` (`id_gv`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_users_lop` (`ma_lop`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `danhsachlophocphan`
--
ALTER TABLE `danhsachlophocphan`
  ADD CONSTRAINT `fk_dslhp_lhp` FOREIGN KEY (`id_lhp`) REFERENCES `lophocphan` (`id_lhp`),
  ADD CONSTRAINT `fk_dslhp_sv` FOREIGN KEY (`ma_sv`) REFERENCES `users` (`id_user`);

--
-- Các ràng buộc cho bảng `diem`
--
ALTER TABLE `diem`
  ADD CONSTRAINT `fk_diem_lhp` FOREIGN KEY (`id_lhp`) REFERENCES `lophocphan` (`id_lhp`),
  ADD CONSTRAINT `fk_diem_user` FOREIGN KEY (`id_sinh_vien`) REFERENCES `users` (`id_user`);

--
-- Các ràng buộc cho bảng `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD CONSTRAINT `fk_lhp_gv` FOREIGN KEY (`id_gv`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `fk_lhp_hk` FOREIGN KEY (`id_hk`) REFERENCES `hocky` (`id_hk`),
  ADD CONSTRAINT `fk_lhp_lh` FOREIGN KEY (`id_lh`) REFERENCES `lophoc` (`id_lh`),
  ADD CONSTRAINT `fk_lhp_mh` FOREIGN KEY (`id_mh`) REFERENCES `monhoc` (`id_mh`);

--
-- Các ràng buộc cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD CONSTRAINT `thongbao_ibfk_1` FOREIGN KEY (`id_gv`) REFERENCES `users` (`id_user`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_lop` FOREIGN KEY (`ma_lop`) REFERENCES `lophoc` (`id_lh`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
