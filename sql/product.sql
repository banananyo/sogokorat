-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2018 at 08:17 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sogokorat`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `detail_short` text,
  `detail` text,
  `price` double NOT NULL,
  `category` int(11) NOT NULL,
  `src_thumb` text,
  `active` int(11) NOT NULL,
  `size` text,
  `school_logo` text,
  `student_info` text,
  `star` text,
  `waist` text,
  `waist_long` text,
  `color` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `detail_short`, `detail`, `price`, `category`, `src_thumb`, `active`, `size`, `school_logo`, `student_info`, `star`, `waist`, `waist_long`, `color`) VALUES
(10, 'ชุดลูกเสือ-เนตรนารี-ยุวกาชาติ', '<p>เสื้อลูกเสือ เสือเนตรนารี เสือยุวะกาชาติ ตราโซโก้ ผ้าเนื้อดี มีความคงทน ตรงตามมาตรฐานอุตสหกรรม</p>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n', '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>ขนาด</td>\r\n			<td style=\"text-align:center\">32</td>\r\n			<td style=\"text-align:center\">34</td>\r\n			<td style=\"text-align:center\">36</td>\r\n			<td style=\"text-align:center\">38</td>\r\n			<td style=\"text-align:center\">40</td>\r\n			<td style=\"text-align:center\">42</td>\r\n			<td style=\"text-align:center\">44</td>\r\n		</tr>\r\n		<tr>\r\n			<td>ราคา</td>\r\n			<td style=\"text-align:center\">&nbsp;<span style=\"color:#e74c3c\">280</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">290</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">300</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">310</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">320</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">335</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">345</span></td>\r\n		</tr>\r\n		<tr>\r\n			<td>ขนาด</td>\r\n			<td style=\"text-align:center\">46</td>\r\n			<td style=\"text-align:center\">48</td>\r\n			<td style=\"text-align:center\">50</td>\r\n			<td style=\"text-align:center\">52</td>\r\n			<td style=\"text-align:center\">54</td>\r\n			<td style=\"text-align:center\">56</td>\r\n			<td style=\"text-align:center\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>ราคา</td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">360</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">385</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">400</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">425</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">435</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">490</span></td>\r\n			<td style=\"text-align:center\">&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n', 280, 6, '../images/upload/product/pro1.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'เสื้อพละโรงเรียน', '<p>เสือพละโรงเรียนต่างๆ เสื้อโปโล ผ้าโทเรอย่างดีทนทาน สีสดไม่ซีดง่าย&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n', '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\">ขนาด</td>\r\n			<td>\r\n			<p style=\"text-align:center\">S-XL</p>\r\n			</td>\r\n			<td style=\"text-align:center\">3L-4L</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">ราคา</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">200 บาท</span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#e74c3c\">250 บาท</span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n', 200, 4, '../images/upload/product/196K0003.JPG', 0, NULL, NULL, NULL, NULL, 'เอว 32,\r\nเอว 38,\r\nเอว 40,', NULL, NULL),
(12, 'กระเป๋านักเรียน', '<p>กระเป๋านักเรียน โรงเรียนต่างๆ</p>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n', '<p>กระเป๋านักเรียน โรงเรียนต่างๆ ผ้าไนลอนเนื้อหนา เเข็งแรง ทนทาน</p>\r\n\r\n<div class=\"grammarly-disable-indicator\">&nbsp;</div>\r\n', 250, 5, '../images/upload/product/196K0012.JPG', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'เสื้อนักเรียนอนุบาล', '<p>เสื้อนักเรียนระดับชั้นอนุบาล</p>\r\n', '<p style=\"text-align:center\">เสื้อนักเรียนระดับชั้นอนุบาล พร้อมปักโลโก้ ผ้าดี สีขาวสะอาด ทนทาน ไม่ยืดไม่ย้วย</p>\r\n\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\">ขนาด</td>\r\n			<td style=\"text-align:center\">S</td>\r\n			<td style=\"text-align:center\">M</td>\r\n			<td style=\"text-align:center\">L</td>\r\n			<td style=\"text-align:center\">XL</td>\r\n			<td style=\"text-align:center\">XXL</td>\r\n			<td style=\"text-align:center\">3L</td>\r\n			<td style=\"text-align:center\">4L</td>\r\n			<td style=\"text-align:center\">5L</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\">ราคา</td>\r\n			<td style=\"text-align:center\">155</td>\r\n			<td style=\"text-align:center\">165</td>\r\n			<td style=\"text-align:center\">175</td>\r\n			<td style=\"text-align:center\">185</td>\r\n			<td style=\"text-align:center\">200</td>\r\n			<td style=\"text-align:center\">210</td>\r\n			<td style=\"text-align:center\">230</td>\r\n			<td style=\"text-align:center\">250</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<div class=\"grammarly-disable-indicator\" style=\"text-align:center\">&nbsp;</div>\r\n', 155, 1, '../images/upload/product/196K0096.JPG', 0, NULL, 'SUT,\r\nORM + ฿30', NULL, NULL, NULL, NULL, NULL),
(14, 'เสือพละโรงเรียนอัชสัมชัน ', '<p>เสื้อพละโรงเรียนอัชสัมชัน ผ้ายืด&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '<div>\r\n<p style=\"text-align:center\"><strong>เสื้อพละโรงเรียนอัชสัมชัน ผ้ายืด&nbsp;</strong></p>\r\n</div>\r\n\r\n<div style=\"display:flex; justify-content:center; width:100%\">\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\"><strong>ขนาด</strong></td>\r\n			<td style=\"text-align:center\"><strong>ราคา</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\">SS-XL</td>\r\n			<td style=\"text-align:center\">200 บาท</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\">3L ขึ้นไป</td>\r\n			<td style=\"text-align:center\">250 บาท</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n', 200, 4, '../images/upload/product/196K0060.JPG', 0, 'S,\r\nM + ฿20.00,\r\nL + ฿50,\r\nXL + ฿30.75', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
