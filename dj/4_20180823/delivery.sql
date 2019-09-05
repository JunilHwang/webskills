-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 18-08-22 10:23
-- 서버 버전: 10.1.21-MariaDB
-- PHP 버전: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `delivery`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `deliveryorder`
--

CREATE TABLE `deliveryorder` (
  `idx` int(11) NOT NULL,
  `midx` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `fidx` int(11) NOT NULL,
  `date` date NOT NULL,
  `price` varchar(255) NOT NULL,
  `total_price` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL DEFAULT 'shipping'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `deliveryorder`
--

INSERT INTO `deliveryorder` (`idx`, `midx`, `menu`, `fidx`, `date`, `price`, `total_price`, `quantity`, `state`) VALUES
(1, 1, '고르곤졸라 피자/ 콤비네이션 피자/ 토테이토 피자', 1, '2018-08-21', '11000/ 18000/ 33000', 62000, '1/ 2/ 3', 'completed'),
(2, 4, '콤비네이션 피자/ 불고기 피자', 1, '2018-08-22', '18000/ 39000', 57000, '2/ 3', 'shipping');

-- --------------------------------------------------------

--
-- 테이블 구조 `franchisee`
--

CREATE TABLE `franchisee` (
  `idx` int(11) NOT NULL,
  `midx` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `distance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `franchisee`
--

INSERT INTO `franchisee` (`idx`, `midx`, `type`, `logo`, `name`, `distance`) VALUES
(1, 3, 'pz', '1534500755_27066.png', '피자알볼로', 285.41373477813),
(2, 5, 'ck', '1534919066_9194.png', '웰덤치킨', 285.41373477813);

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `idx` int(11) NOT NULL,
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `x_location` int(11) NOT NULL,
  `y_location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`idx`, `id`, `name`, `pw`, `level`, `tel`, `x_location`, `y_location`) VALUES
(1, 'sslmyo', '회원1', 'lss8360', 'N', '0101-1234-1232', 230, 169),
(2, 'master', '관리자', '1234', 'AD', '', 0, 0),
(3, 'oymlss', '피자에땅', 'lss8360', 'AF', '0101-1234-1234', 160, 201),
(4, 'test', '이름', 'qaz1234', 'N', '0101-1234-1234', 563, 142),
(5, 'bbqbbq', '비비큐', 'lss8360', 'AF', '0101-1234-1234', 42, 81);

-- --------------------------------------------------------

--
-- 테이블 구조 `menu`
--

CREATE TABLE `menu` (
  `idx` int(11) NOT NULL,
  `midx` int(11) NOT NULL,
  `fidx` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `menu`
--

INSERT INTO `menu` (`idx`, `midx`, `fidx`, `name`, `price`, `quantity`, `date`) VALUES
(3, 3, 1, '콤비네이션 피자', 9000, 2, '2018-08-17'),
(4, 3, 1, '토테이토 피자', 11000, 3, '2018-08-17'),
(6, 5, 2, '양념치킨', 9000, 0, '2018-08-22'),
(7, 5, 2, '후라이드', 9000, 0, '2018-08-22'),
(8, 5, 2, '간장치킨', 10000, 0, '2018-08-22');

-- --------------------------------------------------------

--
-- 테이블 구조 `review`
--

CREATE TABLE `review` (
  `idx` int(11) NOT NULL,
  `midx` int(11) NOT NULL,
  `fidx` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `review`
--

INSERT INTO `review` (`idx`, `midx`, `fidx`, `grade`, `content`, `date`) VALUES
(2, 1, 1, 2, 'ㅁㅁㅁㅁㅁㅁㅁㅁㅁㅁㄹㄹㄹㄹㄹㄹㄹㄹㄹㄹㄹㄻㄴㅇㄻㄴㅇㄹ', '2018-08-22');

-- --------------------------------------------------------

--
-- Stand-in structure for view `reviewcnt`
-- (See below for the actual view)
--
CREATE TABLE `reviewcnt` (
`cnt` bigint(21)
,`fidx` int(11)
);

-- --------------------------------------------------------

--
-- 뷰 구조 `reviewcnt`
--
DROP TABLE IF EXISTS `reviewcnt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reviewcnt`  AS  select count(0) AS `cnt`,`review`.`fidx` AS `fidx` from `review` group by `review`.`fidx` ;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `deliveryorder`
--
ALTER TABLE `deliveryorder`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `franchisee`
--
ALTER TABLE `franchisee`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `deliveryorder`
--
ALTER TABLE `deliveryorder`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 테이블의 AUTO_INCREMENT `franchisee`
--
ALTER TABLE `franchisee`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 테이블의 AUTO_INCREMENT `menu`
--
ALTER TABLE `menu`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 테이블의 AUTO_INCREMENT `review`
--
ALTER TABLE `review`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
