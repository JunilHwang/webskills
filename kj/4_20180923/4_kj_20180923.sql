-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 18-09-25 12:14
-- 서버 버전: 10.1.35-MariaDB
-- PHP 버전: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `4_kj_20180923`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE `board` (
  `idx` int(11) NOT NULL,
  `writer` varchar(255) NOT NULL,
  `memberidx` int(11) NOT NULL,
  `bds_idx` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `datetime` datetime NOT NULL,
  `hit` int(11) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `board`
--

INSERT INTO `board` (`idx`, `writer`, `memberidx`, `bds_idx`, `title`, `text`, `datetime`, `hit`, `file`) VALUES
(5, '전라남도', 1, 7, '홈페이지 메뉴얼', '홈페이지 리뉴얼 되었습니다 많은 관심 부탁 드립니다.', '2018-06-08 15:54:33', 13, ''),
(7, '관리자', 1, 6, '전남관광명소에 오신것을 환영합니다.', '전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.', '2018-06-17 15:14:21', 14, ''),
(10, '전라남도', 1, 7, '2018 전라남도 관광사진 공모전', '천혜의 자연환경과 전남만의 독특한 문화 등 차별성 있는 관광자원을 발굴하고 홍보하고자 「2018 전라남도 관광사진 공모전」을 공고합니다..\r\n\r\n파일 다운로드 : 2018 전라남도 관광사진 공모전 공고문 1부.hwp', '2018-06-17 15:28:56', 1, ''),
(11, '전라남도', 1, 7, '2018 『남도여행 으뜸상품』 공모 공고 ', '우리 도에서는 전남 관광자원의 매력을 잘 드러낼 2018년 남도여행 으뜸상품을 다음과 같이 공모하오니 전국 여행업체의 많은 관심과 참여를 바랍니다.\r\n\r\n\r\n파일 다운로드 : 2018 『남도여행 으뜸상품』하반기 공모 공고.hwp', '2018-06-17 15:30:18', 0, ''),
(12, '전라남도', 1, 7, '전라남도 관광마케팅사업 위탁 운영자 모집공고', '전라남도 관광마케팅사업 위탁 운영자 모집공고\r\n\r\n전라남도 사무의 민간위탁 조례 제5조 및 전라남도 관광진흥에 관한 \r\n조례 제10조, 제11조의 규정에 따라 전라남도 관광업무 위탁 운영자를 다음과 같이 공개모집합니다.\r\n\r\n파일 다운로드 : 전라남도 관광마케팅사업 위탁 운영자 모집공고.hwp', '2018-06-17 15:30:48', 0, ''),
(13, '전라남도', 1, 7, '2017 전라남도 관광사진 공모전 공고', '천혜의 자연환경과 전남만의 독특한 문화 등 차별성 있는 관광자원을 발굴하고 홍보하고자 \r\n\r\n「2017 전라남도 관광사진 공모전」을 개최하오니 많은 참여 바랍니다.\r\n\r\n\r\n\r\n\r\n파일 다운로드 : 2017_전라남도_관광사진_공모전_공고.hwp', '2018-06-17 15:32:31', 1, ''),
(14, '전라남도', 1, 7, '2017 전라남도 관광사진 공모전 공고 ', '천혜의 자연환경과 전남만의 독특한 문화 등 차별성 있는 관광자원을 발굴하고 홍보하고자 \r\n\r\n「2017 전라남도 관광사진 공모전」을 개최하오니 많은 참여 바랍니다.', '2018-06-17 15:32:55', 1, ''),
(16, '관리자', 1, 8, '톱머리 해변', '', '2018-06-17 15:36:49', 0, ''),
(17, '관리자', 1, 8, '돌머리해수욕장', '', '2018-06-17 15:36:58', 0, ''),
(18, '관리자', 1, 8, '하트해변', '', '2018-06-17 15:37:18', 0, ''),
(20, '관리자', 1, 8, '우전해변', '', '2018-06-17 15:37:56', 0, ''),
(21, '관리자', 1, 6, '미황횟집', '', '2018-06-17 15:39:29', 0, ''),
(22, '관리자', 1, 6, '독천식당', '', '2018-06-17 15:39:43', 0, ''),
(23, '관리자', 1, 6, '해빔목포비빔밥', '', '2018-06-17 15:39:57', 0, ''),
(24, '관리자', 1, 6, '광장미가', '40년 식당 운영의 내공을 자랑하는 엄마의 손맛을 그대로 이어 받은 여수 토박이 주인장이 투철한 프로정신으로 운영하며, 막걸리 식초로 만든 서대회와 싱싱한 바다 장어를 이용하여 담백하고 시원한 국물 맛이 일품인 장어탕이 주메뉴다.\r\n최고의 재료를 이용 최선의 서비스로 최대의 만족을 느끼게 하고 싶은 주인장의 신념이 빛을 발하며, 관광객의 발길이 끊이지 않는 곳이다. 산지에서 직송되어온 지역 특산물과 국산 양념류 고집으로 안심 먹거리를 제공하며, 담백한 보양식으로 많이 찾는 장어탕은 전국 어디서나 택배 주문이 가능하다. \r\n좌수영 음식 문화거리에 위치하고 있으며, 연중무휴로 운영되고 150여 명 수용이 가능한 1~2층의 넓은 공간을 자랑한다.', '2018-06-17 15:40:56', 6, ''),
(25, '내용ㅁㄹㄴㅁㅇㄹㅁㄹㅁ', 0, 6, '제목ㅁㅇㄴㄹ', 'ㅁㅇㄹㅁㄹㅁㄹㅁㄹㅁㄹㅇㄴㅁㅁㄹㅇㄴㅁ\r\nㄹㄴㅁㅇㄹ\r\nㄴㅁㅇㄹ\r\nㅇㅁㄹ\r\nㅁㄹ\r\nㅇㅁㄹ\r\nㅁㄹㅁㄴㅁㅇ\r\nㅁㄴㅇ\r\nㄴㅁㄹ\r\nㅁㅇㄴ\r\nㄹㅁ\r\nㅁ\r\nㄹㅁ\r\nㄹㅁ\r\n\r\n', '2018-09-25 19:01:48', 36, '[\"1537869708_1425786353.jpg\"]'),
(26, 'dsafa', 0, 9, 'adsfa', 'vvvdsfaf\r\nasdf\r\ndsf\r\na', '2018-09-25 19:12:42', 0, '[\"1537870362_1445535307.jpg\"]');

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
  `list_set` varchar(255) NOT NULL,
  `view_set` varchar(255) NOT NULL,
  `upload_cnt` int(11) NOT NULL,
  `upload_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `board_set`
--

INSERT INTO `board_set` (`idx`, `name`, `type`, `line_cnt`, `page_cnt`, `list_set`, `view_set`, `upload_cnt`, `upload_size`) VALUES
(6, '자유게시판', 2, 1, 5, '1>3>4', '', 3, 2),
(7, '공지사항', 1, 1, 10, '1>3>4', '1>5>9', 3, 2),
(8, '갤러리', 3, 1, 8, '', '', 3, 2),
(9, 'testtest', 3, 4, 1, '', '', 5, 5);

-- --------------------------------------------------------

--
-- 테이블 구조 `main_content`
--

CREATE TABLE `main_content` (
  `idx` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `od` int(11) NOT NULL,
  `bidx` int(11) NOT NULL,
  `default_image` varchar(255) NOT NULL,
  `over_image` varchar(255) NOT NULL,
  `link_url` varchar(255) NOT NULL,
  `link_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `main_content`
--

INSERT INTO `main_content` (`idx`, `parent`, `od`, `bidx`, `default_image`, `over_image`, `link_url`, `link_type`) VALUES
(5, 3, 0, 8, '', '', '', 0),
(6, 2, 0, 7, '', '', '', 0),
(7, 4, 1, 6, '', '', '', 0),
(8, 4, 2, 0, '1537795051_1017796121.jpg', '1537795051_2026085638.jpg', 'http://naver.com', 1),
(9, 4, 3, 0, '1537795064_145004284.jpg', '1537795064_1658475021.jpg', 'http://daum.net', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `main_content_meta`
--

CREATE TABLE `main_content_meta` (
  `idx` int(11) NOT NULL,
  `od` int(11) NOT NULL,
  `top_color` varchar(255) NOT NULL,
  `btm_color` varchar(255) NOT NULL,
  `bg_color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `main_content_meta`
--

INSERT INTO `main_content_meta` (`idx`, `od`, `top_color`, `btm_color`, `bg_color`) VALUES
(2, 1, '', '', ''),
(3, 2, '', '', ''),
(4, 0, '339900', '33CCFF', '9900FF');

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
-- 테이블 구조 `site_menu`
--

CREATE TABLE `site_menu` (
  `idx` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `od` int(11) NOT NULL,
  `hide` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `bidx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `site_menu`
--

INSERT INTO `site_menu` (`idx`, `parent`, `od`, `hide`, `title`, `type`, `content`, `bidx`) VALUES
(1, 0, 0, 1, '동부권 관광명소', '게시판', '', 6),
(2, 0, 1, 1, '남부권 관광명소', '게시판', '', 9),
(3, 0, 2, 1, '서부권 관광명소', 'HTML', 'adf\r\nasdf\r\ndsf\r\nadsf\r\na', 0),
(5, 1, 0, 1, '지리산 10경', '게시판', '', 7),
(6, 1, 1, 1, '내장산 국립공원', 'HTML', 'adf\r\nadsf\r\nasdf\r\nwer\r\naw\r\nrfa\r\nfasd\r\nasd]asdada\r\nasd\r\nasd', 0),
(7, 1, 2, 1, '담양 메타세쿼이아길', 'HTML', 'qeqweasdadad\r\nad\r\nad\r\nadas\r\nda', 0),
(8, 2, 0, 1, '순천만 국가정원', '게시판', '', 9),
(9, 2, 1, 1, '보길도', '게시판', '', 7),
(10, 2, 2, 1, '보성 녹차밭 대한 다원', '게시판', '', 8),
(11, 3, 0, 1, '홍도', 'HTML', 'qweqw\r\newq\r\neq\r\nwe\r\nqwe\r\nqwe\r\nqd\r\n', 0),
(12, 3, 1, 1, '흑산도', 'HTML', '가나다라마바사\r\n아자차카타파하', 0),
(13, 3, 2, 1, '삼학도', 'HTML', 'ㅇㅁㄹㅁ', 0),
(19, 0, 3, 1, '공지사항', 'HTML', 'ㄷ1ㄷㅈㅂㅇㄴㅁ\r\nㄷ\r\nㅂ\r\nㄷㅂㅈ\r\nㅂㅈㅇㅁㄴㄴㄴㄴㄴㄴ', 0),
(21, 19, 0, 1, '공지사항', 'HTML', '<ul>\r\n  <li>안녕하세요</li>\r\n  <li>감사해요</li>\r\n  <li>잘있어요</li>\r\n  <li>다시만나요</li>\r\n</ul>', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `site_meta`
--

CREATE TABLE `site_meta` (
  `idx` int(11) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `site_meta`
--

INSERT INTO `site_meta` (`idx`, `meta_key`, `meta_value`) VALUES
(1, 'animation', '{\"left_back\":\"666\",\"m_img\":[{\"saved_name\":\"1537858066_2021540521.jpg\",\"origin_name\":\"slide_1.jpg\"},{\"saved_name\":\"1537858066_2036803485.jpg\",\"origin_name\":\"slide_2.jpg\"},{\"saved_name\":\"1537858233_1986418674.jpg\",\"origin_name\":\"slide_3.jpg\"}],\"right_back\":\"666\",\"second\":\"3\"}');

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
-- 테이블의 인덱스 `main_content`
--
ALTER TABLE `main_content`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `main_content_meta`
--
ALTER TABLE `main_content_meta`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `site_menu`
--
ALTER TABLE `site_menu`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `site_meta`
--
ALTER TABLE `site_meta`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 테이블의 AUTO_INCREMENT `board_set`
--
ALTER TABLE `board_set`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `main_content`
--
ALTER TABLE `main_content`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `main_content_meta`
--
ALTER TABLE `main_content_meta`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `site_menu`
--
ALTER TABLE `site_menu`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 테이블의 AUTO_INCREMENT `site_meta`
--
ALTER TABLE `site_meta`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
