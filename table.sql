# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.10)
# Database: course_exchange
# Generation Time: 2013-08-05 08:08:54 +0000
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
  `FBID` int(11) DEFAULT NULL,
  `changeID` varchar(20) DEFAULT NULL,
  `changeName` varchar(50) DEFAULT NULL,
  `wantID` varchar(20) DEFAULT NULL,
  `wantName` varchar(50) DEFAULT NULL,
  `university` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table ce_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ce_log`;

CREATE TABLE `ce_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FBID` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table ce_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ce_user`;

CREATE TABLE `ce_user` (
  `FBID` int(11) unsigned NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `locale` varchar(10) DEFAULT NULL,
  `university` int(6) DEFAULT NULL,
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
