-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 12, 2017 lúc 05:41 SA
-- Phiên bản máy phục vụ: 10.1.21-MariaDB
-- Phiên bản PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `khenthuong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `award`
--

CREATE TABLE `award` (
  `id` int(11) NOT NULL,
  `awardName` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `award`
--

INSERT INTO `award` (`id`, `awardName`) VALUES
(1, 'Danh hiệu thi đua'),
(2, 'Bằng khen - Giấy khen'),
(8, 'Huân chương'),
(9, 'Đề tài'),
(11, 'Sáng kiến');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `commend`
--

CREATE TABLE `commend` (
  `idCmd` int(11) NOT NULL,
  `idS` int(11) NOT NULL,
  `idSubAward` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `commend`
--

INSERT INTO `commend` (`idCmd`, `idS`, `idSubAward`, `year`) VALUES
(1, 13, 10, 2001),
(2, 13, 17, 2001),
(3, 13, 8, 2001),
(4, 13, 16, 2002),
(5, 13, 8, 2002),
(6, 13, 16, 2002),
(7, 13, 16, 2003),
(8, 13, 8, 2003),
(9, 13, 16, 2004),
(10, 13, 4, 2004),
(11, 13, 16, 2005),
(12, 13, 8, 2006),
(13, 13, 9, 2007),
(14, 13, 32, 2007),
(15, 13, 8, 2008),
(16, 13, 16, 2008),
(17, 13, 8, 2009),
(18, 13, 16, 2010),
(19, 13, 8, 2010),
(20, 13, 9, 2010),
(21, 13, 10, 2011),
(22, 13, 8, 2011),
(23, 13, 17, 2012),
(24, 13, 8, 2012),
(25, 13, 16, 2013),
(26, 13, 31, 2013),
(27, 13, 8, 2013),
(28, 13, 8, 2014),
(29, 13, 8, 2015),
(30, 13, 16, 2015),
(31, 13, 8, 2016),
(32, 13, 10, 2016),
(33, 15, 2, 2013),
(34, 15, 2, 2014),
(35, 15, 12, 2014),
(36, 15, 13, 2015),
(37, 15, 5, 2015),
(38, 15, 2, 2015),
(39, 15, 12, 2015),
(40, 15, 13, 2016),
(41, 15, 5, 2016),
(42, 15, 2, 2016),
(43, 15, 12, 2016),
(45, 16, 2, 2013),
(46, 16, 12, 2013),
(47, 16, 12, 2013),
(48, 16, 2, 2014),
(49, 16, 12, 2014),
(50, 16, 2, 2015),
(51, 16, 12, 2015),
(52, 16, 2, 2016),
(53, 16, 12, 2016),
(58, 16, 5, 2013),
(59, 17, 2, 2013),
(60, 17, 2, 2014),
(61, 15, 2, 2015),
(62, 17, 12, 2015),
(63, 17, 2, 2015),
(64, 15, 2, 2016),
(65, 17, 2, 2016),
(66, 47, 2, 2013),
(67, 15, 2, 2014),
(68, 47, 2, 2015),
(69, 47, 2, 2016),
(70, 19, 2, 2013),
(71, 19, 2, 2014),
(72, 19, 2, 2016),
(73, 19, 2, 2015),
(74, 20, 2, 2013),
(75, 20, 2, 2014),
(76, 20, 2, 2015),
(77, 20, 2, 2016),
(78, 20, 12, 2016),
(79, 21, 6, 2013),
(80, 21, 5, 2013),
(81, 21, 2, 2013),
(82, 21, 12, 2013),
(83, 21, 13, 2014),
(84, 21, 5, 2014),
(85, 21, 2, 2014),
(86, 21, 12, 2014),
(87, 21, 5, 2015),
(88, 21, 2, 2015),
(89, 21, 12, 2015),
(90, 21, 13, 2016),
(91, 21, 5, 2016),
(92, 21, 2, 2016),
(93, 21, 12, 2016),
(94, 22, 2, 2013),
(95, 22, 12, 2013),
(96, 22, 2, 2014),
(97, 22, 2, 2015),
(98, 22, 2, 2016),
(99, 23, 2, 2015),
(100, 23, 2, 2016),
(101, 23, 12, 2016),
(102, 24, 6, 2013),
(103, 24, 5, 2013),
(104, 24, 2, 2013),
(105, 24, 12, 2013),
(106, 24, 20, 2014),
(107, 24, 13, 2014),
(108, 24, 5, 2014),
(109, 24, 2, 2014),
(110, 24, 12, 2014),
(111, 24, 2, 2015),
(112, 24, 12, 2015),
(113, 24, 13, 2016),
(114, 24, 2, 2016),
(115, 24, 12, 2016),
(116, 25, 6, 2013),
(117, 25, 5, 2013),
(118, 25, 2, 2013),
(119, 25, 12, 2013),
(120, 25, 2, 2014),
(121, 25, 12, 2014),
(122, 25, 13, 2015),
(123, 25, 5, 2015),
(124, 25, 2, 2015),
(125, 25, 12, 2015),
(126, 25, 5, 2016),
(127, 25, 2, 2016),
(128, 25, 12, 2016),
(129, 26, 5, 2013),
(130, 26, 2, 2013),
(131, 26, 12, 2013),
(132, 26, 20, 2014),
(133, 26, 2, 2014),
(134, 26, 2, 2015),
(135, 26, 12, 2015),
(136, 26, 2, 2016),
(137, 26, 12, 2016),
(138, 27, 5, 2013),
(139, 27, 2, 2013),
(140, 27, 12, 2013),
(141, 27, 2, 2014),
(142, 27, 12, 2014),
(143, 27, 13, 2015),
(144, 27, 2, 2015),
(145, 27, 12, 2015),
(146, 27, 2, 2016),
(147, 28, 5, 1013),
(148, 28, 2, 2013),
(149, 28, 12, 2013),
(150, 28, 2, 2014),
(151, 28, 2, 2015),
(152, 28, 2, 2016),
(153, 29, 5, 2013),
(154, 29, 2, 2013),
(155, 29, 12, 2013),
(156, 29, 2, 2014),
(157, 29, 12, 2014),
(158, 29, 2, 2015),
(159, 29, 2, 2016),
(160, 30, 5, 2013),
(161, 30, 2, 2013),
(162, 30, 12, 2013),
(163, 30, 2, 2014),
(164, 30, 2, 2015),
(165, 30, 12, 2015),
(166, 30, 13, 2016),
(167, 30, 2, 2016),
(168, 30, 12, 2016),
(169, 31, 5, 2013),
(170, 31, 2, 2013),
(171, 31, 12, 2013),
(172, 31, 2, 2014),
(173, 31, 12, 2014),
(174, 31, 2, 2015),
(175, 31, 2, 2016),
(176, 31, 12, 2016),
(177, 33, 2, 2013),
(178, 33, 2, 2015),
(179, 33, 12, 2015),
(180, 33, 2, 2016),
(181, 33, 12, 2016),
(182, 34, 2, 2013),
(183, 34, 5, 2014),
(184, 34, 2, 2014),
(185, 34, 12, 2014),
(186, 34, 2, 2015),
(187, 34, 12, 2015),
(188, 34, 2, 2016),
(189, 34, 12, 2016),
(190, 35, 2, 2013),
(191, 35, 2, 2014),
(192, 35, 12, 2014),
(193, 35, 13, 2015),
(194, 35, 2, 2015),
(195, 35, 12, 2015),
(196, 35, 2, 2016),
(197, 36, 2, 2013),
(198, 36, 12, 2013),
(199, 36, 2, 2014),
(200, 36, 12, 2014),
(201, 36, 2, 2015),
(202, 36, 12, 2015),
(203, 36, 2, 2016),
(204, 36, 12, 2016),
(205, 37, 5, 2013),
(206, 37, 2, 2013),
(207, 37, 12, 2013),
(208, 37, 2, 2014),
(209, 37, 2, 2015),
(210, 38, 2, 2013),
(211, 38, 2, 2014),
(212, 38, 12, 2014),
(213, 38, 13, 2015),
(214, 38, 5, 2015),
(215, 38, 2, 2015),
(216, 38, 12, 2015),
(217, 38, 5, 2016),
(218, 38, 2, 2016),
(219, 38, 12, 2016),
(220, 39, 5, 2013),
(221, 39, 2, 2013),
(222, 39, 12, 2013),
(223, 39, 2, 2014),
(224, 39, 12, 2014),
(225, 39, 2, 2015),
(226, 39, 12, 2015),
(227, 39, 2, 2016),
(228, 39, 12, 2016),
(229, 40, 2, 2013),
(230, 40, 2, 2014),
(231, 40, 2, 2015),
(232, 40, 2, 2016),
(233, 41, 2, 2013),
(234, 41, 2, 2014),
(235, 41, 2, 2015),
(236, 41, 12, 2015),
(237, 41, 2, 2016),
(238, 41, 12, 2016),
(239, 44, 2, 2013),
(240, 44, 2, 2014),
(241, 44, 5, 2015),
(242, 44, 2, 2015),
(243, 44, 12, 2015),
(244, 44, 13, 2016),
(245, 44, 5, 2016),
(246, 44, 2, 2016),
(247, 44, 12, 2016),
(248, 45, 2, 2013),
(249, 45, 12, 2013),
(250, 45, 2, 2014),
(251, 45, 2, 2015),
(252, 45, 12, 2015),
(253, 45, 2, 2016),
(254, 46, 2, 2013),
(255, 46, 12, 2013),
(256, 46, 2, 2014),
(257, 46, 2, 2015),
(258, 46, 2, 2016),
(259, 46, 12, 2016);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subaward`
--

CREATE TABLE `subaward` (
  `id` int(11) NOT NULL,
  `subAwardName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `awardId` int(11) NOT NULL,
  `institute` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subaward`
--

INSERT INTO `subaward` (`id`, `subAwardName`, `awardId`, `institute`) VALUES
(2, 'Lao động tiên tiến', 1, 1),
(3, 'Anh hùng lao động', 1, 1),
(4, 'Tập thể lao động tiên tiến', 1, 2),
(5, 'Chiến sỹ thi đua cơ sở', 1, 1),
(6, 'Chiến sỹ thi đua Bộ TTTT', 1, 1),
(7, 'Chiến sĩ thi đua toàn quốc', 1, 1),
(8, 'Tập thể lao động xuất sắc', 1, 2),
(9, 'Cờ thi đua của Bộ TTTT', 1, 2),
(10, 'Cờ thi đua của Chính phủ', 1, 2),
(11, 'Anh hùng lao động', 1, 2),
(12, 'Giấy khen của Cục trưởng', 2, 1),
(13, 'Bằng khen của Bộ trưởng Bộ TTTT', 2, 1),
(14, 'Bằng khen của Thủ tướng Chính phủ', 2, 1),
(15, 'Giấy khen của Cục trưởng', 2, 2),
(16, 'Bằng khen của Bộ trưởng Bộ TTTT', 2, 2),
(17, 'Bằng khen của Thủ tướng Chính phủ', 2, 2),
(18, 'Huân chương lao động hạng nhất', 8, 1),
(19, 'Huân chương lao động hạng nhì', 8, 1),
(20, 'Huân chương lao động hạng ba', 8, 1),
(21, 'Huân chương sao vàng', 8, 1),
(22, 'Huân chương Hồ Chí Minh', 8, 1),
(23, 'Huân chương độc lập', 8, 1),
(24, 'Chủ trì đề tài', 9, 1),
(25, 'Tham gia đề tài', 9, 1),
(28, 'Sáng kiến cấp Cục', 11, 1),
(29, 'Sáng kiến cấp Trung tâm', 11, 1),
(30, 'Huân chương lao động hạng nhất', 8, 2),
(31, 'Huân chương lao động hạng nhì', 8, 2),
(32, 'Huân chương lao động hạng ba', 8, 2),
(33, 'Huân chương sao vàng', 8, 2),
(34, 'Huân chương Hồ Chí Minh', 8, 2),
(35, 'Huân chương độc lập', 8, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subject`
--

CREATE TABLE `subject` (
  `idS` int(11) NOT NULL,
  `nameF` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nameS` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `typeS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subject`
--

INSERT INTO `subject` (`idS`, `nameF`, `nameS`, `email`, `typeS`) VALUES
(13, '', 'Trung tâm 1', '', 2),
(15, 'Nguyễn Phương ', 'Đông', 'npdong@gmail.com', 1),
(16, 'Lê Văn ', 'Tuyên', 'lvtuyen@gmail.com', 1),
(17, 'Nguyễn Xuân ', 'Minh', 'nxminh@gmail.com', 1),
(19, 'Lê Văn ', 'Việt', 'lvviet@gmail.com', 1),
(20, 'Nguyễn Đức ', 'Hải', 'ndhai@gmail.com', 1),
(21, 'Nguyễn Anh ', 'Sơn', 'nason@gmail.com', 1),
(22, 'Tô Thị ', 'Hường', 'tthuong@gmail.com', 1),
(23, 'Dương Nguyễn Hồng  ', 'Anh', 'ndhanh@gmail.com', 1),
(24, 'Trịnh Sơn ', 'Tùng', 'tstung@gmail.com', 1),
(25, 'Đoàn Minh ', 'Trang', 'dmtrang@gmail.com', 1),
(26, 'Hoàng ', 'Việt', 'hviet@gmail.com', 1),
(27, 'Nguyễn Ngọc ', 'Anh', 'nnanh@gmail.com', 1),
(28, 'Phạm Tuyết ', 'Lan', 'ptlan@gmail.com', 1),
(29, 'Trần Anh ', 'Tuấn', 'tatuan@gmail.com', 1),
(30, 'Vũ Sơn ', 'Tùng', 'vstung@gmail.com', 1),
(31, 'Đào Lan ', 'Hương', 'dlhuong@gmail.com', 1),
(32, 'Nguyễn Văn ', 'Mong', 'nvmong@gmail.com', 1),
(33, 'Nguyễn Mạnh ', 'Hải', 'nmhai@gmail.com', 1),
(34, 'Nguyễn Đức ', 'Huấn', 'ndhuan@gmail.com', 1),
(35, 'Nguyễn Lê ', 'Cường', 'nlcuong@gmail.com', 1),
(36, 'Ngô Nhất ', 'Sơn', 'nnson@gmail.com', 1),
(37, 'Đặng Tiến ', 'Nguyên', 'dtnguyen@gmail.com', 1),
(38, 'Nguyễn Duy ', 'Hiếu', 'ndhieu@gmail.com', 1),
(39, 'Phạm Hoàng ', 'Lê', 'phle@gmail.com', 1),
(40, 'Nguyễn Trường ', 'Minh', 'ntminh@gmail.com', 1),
(41, 'Nguyễn Việt ', 'Hùng', 'nvhung@gmail.com', 1),
(42, 'Nguyễn Tuấn ', 'Anh', 'ntanh@gmail.com', 1),
(43, 'Nguyễn Ngọc ', 'Nam', 'nnnam@gmail.com', 1),
(44, 'Đặng Thị Phong ', 'Thủy', 'dpthuy@gmail.com', 1),
(45, 'Hoàng ', 'Long', 'hlong@gmail.com', 1),
(46, 'Vũ Thanh ', 'Hòa', 'vthoa@gmail.com', 1),
(47, 'Vũ Thị Hoàng ', 'Yến', 'vthyen@gmail.com', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `acc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `acc`, `name`, `pass`) VALUES
(22, 'admin', 'Admin', '12345');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `award`
--
ALTER TABLE `award`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `commend`
--
ALTER TABLE `commend`
  ADD PRIMARY KEY (`idCmd`),
  ADD KEY `fk_foreign_idS` (`idS`),
  ADD KEY `fk_foreign_idSub` (`idSubAward`);

--
-- Chỉ mục cho bảng `subaward`
--
ALTER TABLE `subaward`
  ADD PRIMARY KEY (`id`),
  ADD KEY `awardId` (`awardId`);

--
-- Chỉ mục cho bảng `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`idS`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acc` (`acc`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `award`
--
ALTER TABLE `award`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT cho bảng `commend`
--
ALTER TABLE `commend`
  MODIFY `idCmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;
--
-- AUTO_INCREMENT cho bảng `subaward`
--
ALTER TABLE `subaward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT cho bảng `subject`
--
ALTER TABLE `subject`
  MODIFY `idS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `commend`
--
ALTER TABLE `commend`
  ADD CONSTRAINT `fk_foreign_idS` FOREIGN KEY (`idS`) REFERENCES `subject` (`idS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_foreign_idSub` FOREIGN KEY (`idSubAward`) REFERENCES `subaward` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `subaward`
--
ALTER TABLE `subaward`
  ADD CONSTRAINT `awardId` FOREIGN KEY (`awardId`) REFERENCES `award` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
