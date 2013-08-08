# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.10)
# Database: course_exchange
# Generation Time: 2013-08-07 06:52:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ce_course
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ce_course`;

CREATE TABLE `ce_course` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FBID` varchar(20) DEFAULT NULL,
  `changeID` varchar(20) DEFAULT NULL,
  `changeName` varchar(50) DEFAULT NULL,
  `wantID` varchar(20) DEFAULT NULL,
  `wantName` varchar(50) DEFAULT NULL,
  `university` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ce_course` WRITE;
/*!40000 ALTER TABLE `ce_course` DISABLE KEYS */;

INSERT INTO `ce_course` (`id`, `FBID`, `name`, `changeID`, `changeName`, `wantID`, `wantName`, `university`, `status`)
VALUES
	(1,1272688531,NULL,'MB2002701','創業與行銷','FB2000701','財務管理','NTUST',NULL),
	(2,1272688531,NULL,'MB2002701','創業與行銷','FB2000701','財務管理','NTUST',NULL),
	(3,1272688531,NULL,'MB2002701','你好','FB2000701','丁丁','NTUST','等待中'),
	(4,1272688531,NULL,'MB2002701','你好','FB2000701','丁丁','NTUST','等待中'),
	(5,1272688531,NULL,'MB2002701','你好','FB2000701','拉拉','NTUST','等待中'),
	(6,1272688531,NULL,'MB2002701','名稱','FB2000701','名稱','NTUST','等待中'),
	(7,1272688531,NULL,'FB2000701','f','MB2002701','a','NTUST','交換中');

/*!40000 ALTER TABLE `ce_course` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ce_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ce_log`;

CREATE TABLE `ce_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FBID` varchar(20) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ce_log` WRITE;
/*!40000 ALTER TABLE `ce_log` DISABLE KEYS */;

INSERT INTO `ce_log` (`id`, `FBID`, `time`, `ip`)
VALUES
	(1,1272688531,'2013-08-06 22:17:23','::1'),
	(2,1272688531,'2013-08-06 22:17:26','::1'),
	(3,1272688531,'2013-08-07 10:42:30','::1');

/*!40000 ALTER TABLE `ce_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ce_university
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ce_university`;

CREATE TABLE `ce_university` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(5) DEFAULT NULL,
  `chinese_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ce_university` WRITE;
/*!40000 ALTER TABLE `ce_university` DISABLE KEYS */;

INSERT INTO `ce_university` (`id`, `name`, `chinese_name`)
VALUES
	(1,'TKU','淡江大學'),
	(2,'NTUST','臺灣科技大學');

/*!40000 ALTER TABLE `ce_university` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ce_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ce_user`;

CREATE TABLE `ce_user` (
  `FBID` varchar(20) unsigned NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `locale` varchar(10) DEFAULT NULL,
  `university` varchar(6) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `token` varchar(300) DEFAULT NULL,
  `expiresin` int(11) DEFAULT NULL,
  `jointime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`FBID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
