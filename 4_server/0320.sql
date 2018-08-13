-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- 생성 시간: 18-03-21 18:34
-- 서버 버전: 10.1.30-MariaDB
-- PHP 버전: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `0320`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `files`
--

CREATE TABLE `files` (
  `idx` int(11) NOT NULL,
  `parent` int(11) UNSIGNED NOT NULL,
  `midx` int(11) NOT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  `change_name` varchar(255) NOT NULL DEFAULT '',
  `com_name` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `change_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `infile_list`
--

CREATE TABLE `infile_list` (
  `idx` int(11) NOT NULL,
  `fidx` int(11) NOT NULL DEFAULT '0',
  `midx` int(11) NOT NULL DEFAULT '0',
  `regdate` datetime NOT NULL,
  `cnt` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `idx` int(11) NOT NULL,
  `id` varchar(50) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`idx`, `id`, `pw`, `name`, `level`) VALUES
(1, 'admin', 'dbe9787aaf4002c6662e490b3f1f7512807459b6dee2e1c2e56738e1cbbd993c', '관리자', 10),
(2, 'user1', '2fc577149080578c983f969a6ce84146fb79b5e17c0447d4e0718e039d62da19', '유저1', 1),
(3, 'user2', '7a9f58a002c9682fceda675a74759336805785d34c0f10ce1cee6e8315a17711', '유저2', 1),
(4, 'user3', 'd9f593bb452232b6a85b46816ee33292a4776a22c09973cbc138e4e91242c96c', '유저3', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `outfile_list`
--

CREATE TABLE `outfile_list` (
  `idx` int(11) NOT NULL,
  `fidx` int(11) NOT NULL,
  `midx` int(11) NOT NULL,
  `regdate` datetime NOT NULL,
  `cnt` int(11) NOT NULL DEFAULT '0',
  `ukey` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `infile_list`
--
ALTER TABLE `infile_list`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `outfile_list`
--
ALTER TABLE `outfile_list`
  ADD PRIMARY KEY (`idx`),
  ADD UNIQUE KEY `url` (`ukey`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `files`
--
ALTER TABLE `files`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `infile_list`
--
ALTER TABLE `infile_list`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 테이블의 AUTO_INCREMENT `outfile_list`
--
ALTER TABLE `outfile_list`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
