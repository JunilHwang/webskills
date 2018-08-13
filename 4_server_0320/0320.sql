-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.2.13-MariaDB - mariadb.org binary distribution
-- 서버 OS:                        Win64
-- HeidiSQL 버전:                  9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 0320 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `0320` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `0320`;

-- 테이블 0320.files 구조 내보내기
CREATE TABLE IF NOT EXISTS `files` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) unsigned NOT NULL,
  `midx` int(11) NOT NULL,
  `size` int(11) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL,
  `change_name` varchar(255) NOT NULL DEFAULT '',
  `com_name` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `change_date` datetime NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.
-- 테이블 0320.infile_list 구조 내보내기
CREATE TABLE IF NOT EXISTS `infile_list` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `fidx` int(11) NOT NULL DEFAULT 0,
  `midx` int(11) NOT NULL DEFAULT 0,
  `regdate` datetime NOT NULL,
  `cnt` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.
-- 테이블 0320.member 구조 내보내기
CREATE TABLE IF NOT EXISTS `member` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(50) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.
-- 테이블 0320.outfile_list 구조 내보내기
CREATE TABLE IF NOT EXISTS `outfile_list` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `fidx` int(11) NOT NULL,
  `midx` int(11) NOT NULL,
  `regdate` datetime NOT NULL,
  `cnt` int(11) NOT NULL DEFAULT 0,
  `ukey` char(4) NOT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `url` (`ukey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
