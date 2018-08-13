-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 18-07-19 10:46
-- 서버 버전: 10.1.34-MariaDB
-- PHP 버전: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `20180514`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE `board` (
  `idx` int(11) NOT NULL,
  `memberidx` int(11) NOT NULL,
  `bds_idx` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `datetime` datetime NOT NULL,
  `hit` int(11) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `board_set`
--

CREATE TABLE `board_set` (
  `idx` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `line_cnt` int(11) NOT NULL,
  `page_cnt` int(11) NOT NULL,
  `upload_cnt` int(11) NOT NULL,
  `upload_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `board_set`
--

INSERT INTO `board_set` (`idx`, `name`, `type`, `line_cnt`, `page_cnt`, `upload_cnt`, `upload_size`) VALUES
(7, '공지사항', 1, 1, 10, 3, 2),
(8, '갤러리', 3, 1, 8, 3, 2),
(20, '커뮤니티', 1, 1, 10, 3, 2),
(23, '게시판111321', 1, 1, 10, 5, 2),
(24, '게시판 설정', 1, 4, 1, 3, 2),
(25, '게시판 추가', 1, 4, 1, 3, 2),
(26, '메뉴별 컨텐츠 제작 영상', 1, 4, 1, 3, 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `image_ani`
--

CREATE TABLE `image_ani` (
  `idx` int(11) NOT NULL,
  `second` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `image_ani`
--

INSERT INTO `image_ani` (`idx`, `second`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- 테이블 구조 `main_image`
--

CREATE TABLE `main_image` (
  `idx` int(11) NOT NULL,
  `l_back` text NOT NULL,
  `m_img` text NOT NULL,
  `r_back` text NOT NULL,
  `l_order` int(11) NOT NULL,
  `m_type` varchar(255) NOT NULL,
  `l_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `main_image`
--

INSERT INTO `main_image` (`idx`, `l_back`, `m_img`, `r_back`, `l_order`, `m_type`, `l_url`) VALUES
(1, '0f0', 'gallery_4.jpg', 'fdf222', 0, '', ''),
(2, '0f0', 'gallery_2.jpg', 'fdf222', 1, '', ''),
(3, '0f0', 'slide_5.jpg', 'fdf222', 2, '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `main_page`
--

CREATE TABLE `main_page` (
  `idx` int(11) NOT NULL,
  `l_order` int(11) NOT NULL,
  `t_line` varchar(255) NOT NULL,
  `b_color` varchar(255) NOT NULL,
  `b_line` varchar(255) NOT NULL,
  `c_type` int(11) NOT NULL,
  `b_idx` int(11) NOT NULL,
  `def_img` text NOT NULL,
  `over_img` text NOT NULL,
  `l_url` varchar(255) NOT NULL,
  `m_type` varchar(255) NOT NULL,
  `parent_idx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `main_page`
--

INSERT INTO `main_page` (`idx`, `l_order`, `t_line`, `b_color`, `b_line`, `c_type`, `b_idx`, `def_img`, `over_img`, `l_url`, `m_type`, `parent_idx`) VALUES
(25, 0, '', '', '', 1, 8, '2.jpg', '', '', '1', 9),
(26, 0, '', '', '', 1, 8, '2.jpg', '', '', '1', 8),
(33, 4, '', '', '', 2, 8, '2.jpg', '', '', '_SELF', 7),
(36, 7, '', '', '', 1, 19, 'republic-of-korea-2382430_1920 (1).jpg', '', '', '_SELF', 7),
(37, 8, '', '', '', 1, 8, '2.jpg', '', '', '1', 7),
(43, 5, '', '', '', 1, 7, '', '', '', '', 7),
(44, 6, '', '', '', 1, 19, '', '', '', '', 7),
(53, 0, '', '', '', 1, 19, '', '', '', '', 52),
(54, 1, '', '', '', 1, 6, '', '', '', '', 52),
(55, 2, '', '', '', 1, 7, '', '', '', '', 52),
(56, 3, '', '', '', 1, 8, '', '', '', '', 52),
(57, 0, 'rgb(255, 0, 255)', 'rgb(255, 225, 132)', 'rgb(255, 0, 255)', 0, 0, '', '', '', '', 0),
(60, 0, '', '', '', 2, 7, 'img093.jpg', 'img096.jpg', '#', '_blank', 57),
(61, 2, '', '', '', 1, 8, '', '', '', '', 57),
(64, 1, '', '', '', 1, 7, 'img101.jpg', 'img097.jpg', '', '_SELF', 57);

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `idx` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `lv` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`idx`, `userid`, `username`, `pw`, `lv`, `nickname`, `email`) VALUES
(1, 'root', '관리자', 'root', 1, 'admin', 'admin@admin.com');

-- --------------------------------------------------------

--
-- 테이블 구조 `menu_set`
--

CREATE TABLE `menu_set` (
  `idx` int(11) NOT NULL,
  `s_ok` int(11) NOT NULL,
  `l_order` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `m_active` int(11) NOT NULL,
  `m_dan` int(11) NOT NULL,
  `parent_idx` int(11) NOT NULL,
  `c_type` int(11) NOT NULL,
  `c_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `menu_set`
--

INSERT INTO `menu_set` (`idx`, `s_ok`, `l_order`, `name`, `m_active`, `m_dan`, `parent_idx`, `c_type`, `c_text`) VALUES
(9, 1, 2, '관광명소', 1, 1, 0, 3, '19'),
(83, 1, 0, '커뮤니티', 1, 1, 0, 2, '<h1>오동도</h1>\r\n\r\n<IMG src=\"/images/13_1.jpg\" style=\"width:350px;\"> \r\n\r\n<p>오동도는 전라남도 여수시 앞바다 남동쪽 1km 지점에 있는 면적 0.3km² 정도의 섬으로, 한려해상 국립공원에 속해 있으며 동백꽃과 대나무가 우거져 있어 여수시민의 휴식처이다. 현재는 육지와의 사이에 폭 5ｍ 정도의 방파제를 쌓아서 육계도화하였으므로 사람은 물론 자동차도 다닐 수 있게 되었다. 멀리서 보면 지형의 생김새가 오동잎처럼 보이며, 옛날에는 오동나무가 빽빽이 들어서 있었기 때문에 오동도라 불렸다.</p>'),
(84, 1, 1, '음식', 1, 1, 0, 3, '24'),
(87, 1, 2, '여수엑스포', 1, 2, 9, 3, '26'),
(88, 1, 3, '진남관', 1, 2, 9, 3, '25'),
(89, 1, 1, '김치찌개', 1, 2, 84, 2, '<h1>오동도</h1>\r\n<IMG src=\"/images/13_1.jpg\" style=\"width:350px;\"> \r\n<p>오동도는 전라남도 여수시 앞바다 남동쪽 1km 지점에 있는 면적 0.3km² 정도의 섬으로, 한려해상 국립공원에 속해 있으며 동백꽃과 대나무가 우거져 있어 여수시민의 휴식처이다. 현재는 육지와의 사이에 폭 5ｍ 정도의 방파제를 쌓아서 육계도화하였으므로 사람은 물론 자동차도 다닐 수 있게 되었다. 멀리서 보면 지형의 생김새가 오동잎처럼 보이며, 옛날에는 오동나무가 빽빽이 들어서 있었기 때문에 오동도라 불렸다.</p>'),
(90, 1, 0, '콩물국수', 1, 2, 84, 2, '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n\r\n<h1>콩물국수</h1>\r\n\r\n<img src=\"/images/img1.jpg\" >\r\n\r\n<p>콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.콩국수는 차갑게 식힌 콩국물에 국수를 넣어 먹는 한국 음식이다.</p>\r\n\r\n</body>\r\n</html>\r\n');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `board_set`
--
ALTER TABLE `board_set`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `image_ani`
--
ALTER TABLE `image_ani`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `main_image`
--
ALTER TABLE `main_image`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `main_page`
--
ALTER TABLE `main_page`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `menu_set`
--
ALTER TABLE `menu_set`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `board_set`
--
ALTER TABLE `board_set`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 테이블의 AUTO_INCREMENT `image_ani`
--
ALTER TABLE `image_ani`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `main_image`
--
ALTER TABLE `main_image`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `main_page`
--
ALTER TABLE `main_page`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `menu_set`
--
ALTER TABLE `menu_set`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
