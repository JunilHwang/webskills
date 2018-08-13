-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 17-09-27 17:35
-- 서버 버전: 10.1.25-MariaDB
-- PHP 버전: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `0927`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `client`
--

CREATE TABLE `client` (
  `idx` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `client`
--

INSERT INTO `client` (`idx`, `name`, `tel`, `address`, `date`) VALUES
(4, '이름', '전화번호', '주소', '2017-09-27 19:52:03'),
(5, 'test', '1234', '1234', '2017-09-27 21:00:42'),
(6, 'adfa', 'adfa', 'adsfas', '2017-09-27 21:00:48');

-- --------------------------------------------------------

--
-- 테이블 구조 `in_pro`
--

CREATE TABLE `in_pro` (
  `idx` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `cnt` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `in_pro`
--

INSERT INTO `in_pro` (`idx`, `product`, `cnt`, `price`, `date`) VALUES
(1, 2, 10, 10, '2017-09-01 00:00:00'),
(2, 2, 20, 20, '2017-09-27 00:00:00'),
(3, 3, 20, 20, '2017-09-27 00:00:00'),
(4, 1, 50, 50, '2017-09-27 00:00:00');

-- --------------------------------------------------------

--
-- 테이블 구조 `out_pro`
--

CREATE TABLE `out_pro` (
  `idx` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `in_pro` int(11) NOT NULL,
  `cnt` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `product`
--

CREATE TABLE `product` (
  `idx` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `product`
--

INSERT INTO `product` (`idx`, `name`, `price`, `description`) VALUES
(1, '제품명', 10000, '0'),
(2, '제품명2', 10000, '비고'),
(3, '제품명3', 20000, '1'),
(4, '제품명4', 50000, '');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `in_pro`
--
ALTER TABLE `in_pro`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `client`
--
ALTER TABLE `client`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 테이블의 AUTO_INCREMENT `in_pro`
--
ALTER TABLE `in_pro`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 테이블의 AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
