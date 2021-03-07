/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.17-MariaDB : Database - tempProject
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tempProject` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `tempProject`;

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `memberNum` int(10) unsigned NOT NULL,
  `title` char(100) NOT NULL,
  `body` longtext NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `article` */

insert  into `article`(`num`,`regDate`,`updateDate`,`memberNum`,`title`,`body`) values 
(1,'2021-03-06 11:00:27','2021-03-06 11:00:27',1,'게시글1','내용1'),
(2,'2021-03-06 11:00:28','2021-03-06 11:00:28',1,'게시글2','내용2'),
(3,'2021-03-06 11:01:14','2021-03-06 11:01:14',1,'newArticle','newBody'),
(4,'2021-03-06 14:25:42','2021-03-06 14:25:42',1,'newArticle','newBody'),
(5,'2021-03-06 14:25:44','2021-03-06 14:25:44',1,'newArticle','newBody'),
(7,'2021-03-07 21:56:55','2021-03-07 21:56:55',2,'게시물6','내용6');

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `name` char(20) NOT NULL,
  `loginId` char(30) NOT NULL,
  `loginPw` varchar(200) NOT NULL,
  `nickname` char(50) NOT NULL,
  `email` char(100) NOT NULL,
  `hpNum` char(20) NOT NULL,
  PRIMARY KEY (`num`),
  UNIQUE KEY `loginId` (`loginId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `member` */

insert  into `member`(`num`,`regDate`,`updateDate`,`name`,`loginId`,`loginPw`,`nickname`,`email`,`hpNum`) values 
(1,'2021-03-06 15:37:54','2021-03-06 15:37:54','user1','user1','user1','user1','banggu1997@gmail.com','01012341234'),
(2,'2021-03-06 16:01:12','2021-03-07 20:56:11','test1','test1','test1','test1','banggu1997@gmail.com','01083700420'),
(4,'2021-03-07 19:44:27','2021-03-07 19:44:27','test2','test2','test2','test2','banggu1997@gmail.com','01083700420');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
