-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2019 at 04:45 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manager_recruitment`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id_blog` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id_blog`, `title`, `link`, `id_user`) VALUES
(1, '10 Framework PHP chất cho Developer', 'https://itviec.com/blog/framework-php/', 5),
(2, '20+ Tài liệu JavaScript cơ bản đến nâng cao hay nhất (update 2019)', 'https://itviec.com/blog/tai-lieu-javascript/', 5),
(3, 'Lời khuyên cho các bạn thiết kế web', 'https://topdev.vn/blog/loi-khuyen-cho-cac-ban-thiet-ke-web/', 5);

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id_cv` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `name_cv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`id_cv`, `id_post`, `name_cv`) VALUES
(1, 2, 'usecasedes-Template.docx'),
(2, 2, 'new.doc'),
(3, 1, 'new.doc');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `name_company` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salary` int(11) NOT NULL,
  `quatity` int(11) NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `confirm` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `countview` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `name_company`, `title`, `description`, `salary`, `quatity`, `image`, `status`, `confirm`, `location`, `id_user`, `countview`) VALUES
(1, 'Fpt Software', 'Tuyển lập trình Back-end', 'Có 1 năm kinh nghiệm với ReactJS, Redux', 12000000, 6, 'fpt.png', 'T', 'T', 'HCM', 7, 2),
(2, 'DXC', 'Tuyển lập trình Front-end', 'Biết HTML, CSS, JavaScript', 10000000, 10, 'dxc.jpg', 'T', 'T', 'HN', 10, 2),
(6, 'DXC', 'Tuyển lập trình Back-end', 'Java, .Net', 10000000, 12, 'dxc.jpg', 'T', 'T', 'HCM', 10, 1),
(7, 'KFC', 'Tuyển Lập Trình Mobile', 'Có ít nhất 2 năm kinh nghiệm với React Native', 15000000, 2, 'kfc.png', 'T', 'T', 'HCM', 9, 2),
(8, 'Tiki', 'Tuyển Senior Java', 'có nhiều hơn 3 năm kinh nghiệm', 20000000, 3, 'tiki.jpg', 'T', 'T', 'HCM', 12, 0),
(9, 'Shopee', 'Tuyển Project Manager', 'Cứ apply tiền xài không hết', 90000000, 2, 'shopee.jpg', 'T', 'T', 'HN', 12, 1),
(10, 'Viettel', 'Tuyển Full Stack ', 'hiểu sâu OOP\r\ncó kinh nghiệm làm việc với MongoDB, Angular, Nodejs', 23000000, 10, 'viettel.png', 'T', 'T', 'HN', 14, 0),
(11, 'Vietcombank', 'Tuyển lập trình Back-end', 'chuyên sâu Java, MySql', 30000000, 5, 'vietcombank.jpg', 'T', 'T', 'HCM', 15, 12),
(12, 'KFC', 'Tuyển BA', 'Có kinh nghiệm trên 3 năm', 18000000, 2, 'kfc.png', 'T', 'F', 'HN', 9, 0),
(13, 'Viva Coffee', 'Tuyển lập trình Back-end', 'có kinh nghiệm với C#', 10000000, 2, 'viva.png', 'T', 'T', 'HN', 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `fullname`, `email`, `role`) VALUES
(5, 'admin', '$2y$10$nYd.Jx5ilgvUjf4NveqHDOhGFOxhLQsLFW8hgBpnTQkXQNX0rWb1y', 'Cao Lê Hữu Đẳng', 'caolehuudangga@gmail.com', 'ADMIN'),
(7, 'admin1', '$2y$10$ke2OcmsZU6eHPaXpGi84Q.aS1g6MimguwTtlK3lSwWv/mY5HROAM6', 'Lê Thanh Đức', 'caolehuudangga@gmail.com', 'USER'),
(9, 'tutu', '$2y$10$tOOpQvUZsWu3L1.GcO2BG.SQdxSt.gRriz7tzAKATNzenBS1N2l5i', 'Tú Nguyễn', 'caolehuudangga@gmail.com', 'USER'),
(10, 'thanhduc', '$2y$10$CS4D6AnuSclRnK3tlWI7zOzPotRiOEPmj7oM2kkMKRY.hnOq7r6FK', 'Đức Lê', 'caolehuudangga@gmail.com', 'USER'),
(11, '51503114', '$2y$10$IC5DIXl24gOmF.sOxIvLhOBoaBpK9I7svJZaw82oddCId4njRCT.W', '51503114', 'caolehuudangga@gmail.com', 'ADMIN'),
(12, '51503075', '$2y$10$sVEqgI8khsisFt.KbIT7ne4ZdNoKkbv.f5AJZRtcDeVngM9aim2wa', '51503075', 'caolehuudangga@gmail.com', 'USER'),
(13, '51503011', '$2y$10$vfu0RDIhph3tCi297i0nJu8Yh19kZDnaZQYp/o8Xn/.zLbzKgV076', '51503011', 'caolehuudangga@gmail.com', 'ADMIN'),
(14, 'mssv', '$2y$10$9QBQNv4dnD98Maxidr5olukQTy1Gp1kUGOuMuItTf1VKydRCXJurC', 'mssv', 'caolehuudangga@gmail.com', 'USER'),
(15, 'mssv1', '$2y$10$eQ/zWdkgc09ZagTkIlIHL.sa6jI.KuKdeXW8ZoygDVDb6b05oYh2.', 'mssv1', 'caolehuudangga@gmail.com', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_blog`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id_cv`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id_cv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `cv_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
