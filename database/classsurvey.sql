-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 12, 2019 lúc 04:52 PM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `classsurvey`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`username`, `password`, `remember_token`, `id`) VALUES
('admin', '$2y$10$ZS89x/.6bqmbwrcdN4HVf.w2upaxCJOxgkeoknWw/Ryzs3jNbsPTm', 'iGSxUatz1zVfuUL5WWiH6X4i4gP1OZCRMvPUNsMTud0FGojunhpjbz48qpov', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_khao_sat`
--

CREATE TABLE `category_khao_sat` (
  `ma_category` int(10) NOT NULL,
  `ten_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category_khao_sat`
--

INSERT INTO `category_khao_sat` (`ma_category`, `ten_category`) VALUES
(3, 'Cơ sở vật chất'),
(4, 'Môn học');

--
-- Bẫy `category_khao_sat`
--
DELIMITER $$
CREATE TRIGGER `delete_category` BEFORE DELETE ON `category_khao_sat` FOR EACH ROW BEGIN
    DELETE  FROM `diem_ks` WHERE ma_phieu IN (SELECT ma_phieu FROM `phieu_khao_sat` WHERE ma_category = OLD.ma_category);
    DELETE  FROM `phieu_khao_sat` WHERE ma_category = OLD.ma_category;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `class`
-- (See below for the actual view)
--
CREATE TABLE `class` (
`ten_mh` varchar(250)
,`gv` varchar(100)
,`ma_mh` varchar(50)
,`sv` varchar(100)
,`da_danh_gia` int(1)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diem_ks`
--

CREATE TABLE `diem_ks` (
  `id_sv` int(11) NOT NULL,
  `ma_phieu` int(10) NOT NULL,
  `ma_mh` varchar(50) NOT NULL,
  `diem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `diem_ks`
--

INSERT INTO `diem_ks` (`id_sv`, `ma_phieu`, `ma_mh`, `diem`) VALUES
(1, 5, 'INT3304 1', 10),
(1, 6, 'INT3304 1', 10),
(1, 7, 'INT3304 1', 10),
(1, 8, 'INT3304 1', 10),
(1, 9, 'INT3304 1', 10),
(1, 10, 'INT3304 1', 10),
(1, 11, 'INT3304 1', 10),
(2, 5, 'INT3304 1', 10),
(2, 6, 'INT3304 1', 10),
(2, 7, 'INT3304 1', 10),
(2, 8, 'INT3304 1', 10),
(2, 9, 'INT3304 1', 10),
(2, 10, 'INT3304 1', 10),
(2, 11, 'INT3304 1', 10);

--
-- Bẫy `diem_ks`
--
DELIMITER $$
CREATE TRIGGER `update_da_danh_gia` AFTER INSERT ON `diem_ks` FOR EACH ROW BEGIN
    UPDATE lop_mon_hoc 
    SET da_danh_gia = 1 
    WHERE id_sv = NEW.id_sv AND ma_mh = NEW.ma_mh;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giang_vien`
--

CREATE TABLE `giang_vien` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `giang_vien`
--

INSERT INTO `giang_vien` (`username`, `password`, `ho_ten`, `email`, `remember_token`, `id`) VALUES
('thanhld', '$2y$10$FcSqdAZBNinwvnQUPmcDnOO/rfO8B2WwgMuolObDNp1P7YsK0A5zW', 'Lê Đình Thanh', 'thanhld@vnu.edu.vn', '06tUtI7STRVoZ3HNZFNvaA00DUr7KkyhoQ38OxG19ocWsHBP6mH4TVU2iOKJ', 1),
('tunghx', '$2y$10$cPEK25KwBcZIW6MrUWY9Y.3HgEO9o8acSA5tKJQY4y6IWFwh.AJFW', ' Hoàng Xuân Tùng', 'tunghx@vnu.edu.vn', NULL, 2),
('sonnh', '$2y$10$3tsrfFShP99SH0qHUITnOOJKbh5mSRweWY4wjvY4w6W1iTebX/rK2', 'Nguyễn Hoài Sơn', 'sonnh@vnu.edu.vn', NULL, 3),
('thudm', '$2y$10$s73bPWYB3YincrmQ7koJZe4a4R88L2PS1bzoqRcZYyQNx1c8GKVq.', 'Đào Minh Thư', 'thudm@vnu.edu.vn', NULL, 4),
('maitt', '$2y$10$xMQchIWvYsKXVIMWNasUPuspa1pP2.nZ8NOYjjQp8jp0TbhXYjPvy', 'Trần Trúc Mai', 'maitt@vnu.edu.vn', NULL, 5);

--
-- Bẫy `giang_vien`
--
DELIMITER $$
CREATE TRIGGER `delete_gv_mon_hoc` BEFORE DELETE ON `giang_vien` FOR EACH ROW BEGIN
    DELETE FROM diem_ks WHERE ma_mh IN (SELECT ma_mh FROM mon_hoc WHERE gv_id = OLD.id);
    DELETE FROM `mon_hoc` WHERE gv_id = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop_mon_hoc`
--

CREATE TABLE `lop_mon_hoc` (
  `ma_mh` varchar(50) NOT NULL,
  `id_sv` int(11) NOT NULL,
  `da_danh_gia` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lop_mon_hoc`
--

INSERT INTO `lop_mon_hoc` (`ma_mh`, `id_sv`, `da_danh_gia`) VALUES
('INT3304 1', 1, 1),
('INT3304 1', 2, 1),
('INT3306 1', 1, 0),
('INT3306 1', 2, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon_hoc`
--

CREATE TABLE `mon_hoc` (
  `ma_mh` varchar(50) NOT NULL,
  `ten_mh` varchar(250) NOT NULL,
  `gv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `mon_hoc`
--

INSERT INTO `mon_hoc` (`ma_mh`, `ten_mh`, `gv_id`) VALUES
('INT3304 1', 'Cơ sở dữ liệu', 1),
('INT3306 1', 'Phát triển ứng dụng Web', 1);

--
-- Bẫy `mon_hoc`
--
DELIMITER $$
CREATE TRIGGER `delete_lop_mon_hoc` BEFORE DELETE ON `mon_hoc` FOR EACH ROW BEGIN
    DELETE  FROM `lop_mon_hoc` WHERE ma_mh = OLD.ma_mh;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_khao_sat`
--

CREATE TABLE `phieu_khao_sat` (
  `ma_category` int(10) DEFAULT NULL,
  `ma_phieu` int(10) NOT NULL,
  `ndung_phieu_ks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phieu_khao_sat`
--

INSERT INTO `phieu_khao_sat` (`ma_category`, `ma_phieu`, `ndung_phieu_ks`) VALUES
(3, 5, 'Giảng đường đáp ứng yêu cầu môn học'),
(3, 6, 'Các trang thiết bị tại giảng đường đáp ứng yêu cầu giảng dạy và học tập'),
(4, 7, 'Bạn được hỗ trợ kịp thời trong quá trình học môn này'),
(4, 8, 'Mục tiêu của môn học nêu rõ kiến thức và kỹ năng người học cần đạt được'),
(4, 9, 'Thời lượng môn học được phân bổ hợp lý cho các hình thức học tập'),
(4, 10, 'Các tài liệu phục vụ môn học được cập nhật'),
(4, 11, 'Môn học góp phần trang bị kiến thức kỹ năng nghề nghiệp cho bạn');

--
-- Bẫy `phieu_khao_sat`
--
DELIMITER $$
CREATE TRIGGER `delete_phieu_khao_sat_diem` BEFORE DELETE ON `phieu_khao_sat` FOR EACH ROW BEGIN
    DELETE  FROM `diem_ks` WHERE ma_phieu = OLD.ma_phieu;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinh_vien`
--

CREATE TABLE `sinh_vien` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `lop_khoa_hoc` varchar(50) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sinh_vien`
--

INSERT INTO `sinh_vien` (`username`, `password`, `ho_ten`, `email`, `lop_khoa_hoc`, `remember_token`, `id`) VALUES
('15020881', '$2y$10$g/N2wNyJyT6zl5HAWrCmwO3iOZ/ECZrVphvRA3Myoxk93C.y3ywlC', ' Triệu Hoàng An', ' 15020881@vnu.edu.vn', 'QH-2015-I/CQ-CLC', 'nqVUC3NO3VSTdmdJ0m7gk3lETGOmREAEksVdtmWImkwCcdnPcBOkYE0ZiEpX', 1),
('15021394', '$2y$10$ZGHElUb9b7CLAOhF7calMufLacKJDm6SPTPUK9ktQLpnQYBWxr4t2', ' Bùi Châu Anh', ' 15021394@vnu.edu.vn', 'QH-2015-I/CQ-CLC', 'ZttfVj6W8Q07a11kbftSGftnvhXxh0qSf7TSUuIFg9NBE1OoK13TLZXHuLad', 2),
('15021606', '$2y$10$IyGx/Ynz5mQrCeT1E3LgHOeb1XL2gr93KY8o8HSPT0YdhKeYisdCi', ' Lưu Việt Anh', ' 15021606@vnu.edu.vn', 'QH-2015-I/CQ-CLC', NULL, 3),
('15021976', '$2y$10$fF6WRrF3x2JX3qGdYls1iel5douWPssLxqp/fUsuJDfx6Xn9I.s7m', ' Nguyễn Đức Anh', ' 15021976@vnu.edu.vn', 'QH-2015-I/CQ-CLC', NULL, 4),
('15021483', '$2y$10$.kNhTOasSCJlj9tDMqkNe.3jLWbYIuaZEdCjz5l/rW.HrC3zh3HjS', ' Nguyễn Quang Anh', '15021483@vnu.edu.vn', 'QH-2015-I/CQ-CLC', NULL, 5),
('15022841', '$2y$10$E31lYhFTMHlb2gPTEdU4z.rj0XN5ASAEjadHWnNmB1DQIM9RWY9t2', ' Nguyễn Thị Phương Anh', ' 15022841@vnu.edu.vn', 'QH-2015-I/CQ-CLC', NULL, 6),
('15021332', '$2y$10$RPTvys2d8htAU3.9aqok2ug6usrlOc0/.6/xPZhz1yqRdg/WR5PCW', ' Nguyễn Thị Vân Anh', ' 15021332@vnu.edu.vn', 'QH-2015-I/CQ-CLC', NULL, 7),
('15021849', '$2y$10$xXdsjfxCOhd2K1Yg0.fUK.PLgOEgTOz6ICJ4Yml0GYKc3nYgTAc1.', ' Nguyễn Tuấn Anh', ' 15021849@vnu.edu.vn', 'QH-2015-I/CQ-CLC', NULL, 8),
('15021469', '$2y$10$fpu7c1vQ0BMp2NueBvE1ze6X.7pWYSwsQkKrwjQ2fiw0TqUxhsEoq', ' Nguyễn Chu Chiến', ' 15021469@vnu.edu.vn', 'QH-2015-I/CQ-CLC', NULL, 9),
('15021359', '$2y$10$Bh0tfRwyC6jgEouDlfAEYOV5DYUCGJBMgPbjeMGRc7sHupDL36gs6', ' Trần Minh Chiến', ' 15021359@vnu.edu.vn', 'QH-2015-I/CQ-CLC', NULL, 10);

--
-- Bẫy `sinh_vien`
--
DELIMITER $$
CREATE TRIGGER `delete_sv_lop_hoc` BEFORE DELETE ON `sinh_vien` FOR EACH ROW BEGIN
    DELETE  FROM `lop_mon_hoc` WHERE id_sv = OLD.id;
    DELETE  FROM `diem_ks` WHERE id_sv = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `class`
--
DROP TABLE IF EXISTS `class`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `class`  AS  select `mh`.`ten_mh` AS `ten_mh`,`gv`.`ho_ten` AS `gv`,`lmh`.`ma_mh` AS `ma_mh`,`sv`.`ho_ten` AS `sv`,`lmh`.`da_danh_gia` AS `da_danh_gia` from (((`lop_mon_hoc` `lmh` join `mon_hoc` `mh` on((`lmh`.`ma_mh` = `mh`.`ma_mh`))) join `giang_vien` `gv` on((`mh`.`gv_id` = `gv`.`id`))) join `sinh_vien` `sv` on((`lmh`.`id_sv` = `sv`.`id`))) ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_khao_sat`
--
ALTER TABLE `category_khao_sat`
  ADD PRIMARY KEY (`ma_category`);

--
-- Chỉ mục cho bảng `diem_ks`
--
ALTER TABLE `diem_ks`
  ADD KEY `fk_diem_ma_phieu` (`ma_phieu`),
  ADD KEY `fk_diem_id_sv` (`id_sv`),
  ADD KEY `fk_diem_ma_mh` (`ma_mh`);

--
-- Chỉ mục cho bảng `giang_vien`
--
ALTER TABLE `giang_vien`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `giang_vien` ADD FULLTEXT KEY `fulltext_index` (`username`,`ho_ten`,`email`);
ALTER TABLE `giang_vien` ADD FULLTEXT KEY `ho_ten` (`ho_ten`);

--
-- Chỉ mục cho bảng `lop_mon_hoc`
--
ALTER TABLE `lop_mon_hoc`
  ADD KEY `fk_id_sv` (`id_sv`),
  ADD KEY `fk_ma_mh` (`ma_mh`);

--
-- Chỉ mục cho bảng `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD PRIMARY KEY (`ma_mh`),
  ADD KEY `fk_id_gv` (`gv_id`);
ALTER TABLE `mon_hoc` ADD FULLTEXT KEY `ma_mh` (`ma_mh`,`ten_mh`);
ALTER TABLE `mon_hoc` ADD FULLTEXT KEY `ten_mh` (`ten_mh`);
ALTER TABLE `mon_hoc` ADD FULLTEXT KEY `ma_mh_2` (`ma_mh`);

--
-- Chỉ mục cho bảng `phieu_khao_sat`
--
ALTER TABLE `phieu_khao_sat`
  ADD PRIMARY KEY (`ma_phieu`),
  ADD KEY `ma_category` (`ma_category`);

--
-- Chỉ mục cho bảng `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `sinh_vien` ADD FULLTEXT KEY `fulltext_index` (`username`,`lop_khoa_hoc`,`ho_ten`,`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `category_khao_sat`
--
ALTER TABLE `category_khao_sat`
  MODIFY `ma_category` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `giang_vien`
--
ALTER TABLE `giang_vien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `phieu_khao_sat`
--
ALTER TABLE `phieu_khao_sat`
  MODIFY `ma_phieu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `sinh_vien`
--
ALTER TABLE `sinh_vien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `diem_ks`
--
ALTER TABLE `diem_ks`
  ADD CONSTRAINT `fk_diem_id_sv` FOREIGN KEY (`id_sv`) REFERENCES `sinh_vien` (`id`),
  ADD CONSTRAINT `fk_diem_ma_mh` FOREIGN KEY (`ma_mh`) REFERENCES `mon_hoc` (`ma_mh`),
  ADD CONSTRAINT `fk_diem_ma_phieu` FOREIGN KEY (`ma_phieu`) REFERENCES `phieu_khao_sat` (`ma_phieu`);

--
-- Các ràng buộc cho bảng `lop_mon_hoc`
--
ALTER TABLE `lop_mon_hoc`
  ADD CONSTRAINT `fk_id_sv` FOREIGN KEY (`id_sv`) REFERENCES `sinh_vien` (`id`),
  ADD CONSTRAINT `fk_ma_mh` FOREIGN KEY (`ma_mh`) REFERENCES `mon_hoc` (`ma_mh`);

--
-- Các ràng buộc cho bảng `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD CONSTRAINT `fk_id_gv` FOREIGN KEY (`gv_id`) REFERENCES `giang_vien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `phieu_khao_sat`
--
ALTER TABLE `phieu_khao_sat`
  ADD CONSTRAINT `phieu_khao_sat_ibfk_1` FOREIGN KEY (`ma_category`) REFERENCES `category_khao_sat` (`ma_category`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
