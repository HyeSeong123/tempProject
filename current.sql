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
  `boardNum` int(10) unsigned NOT NULL,
  `title` char(100) NOT NULL,
  `body` longtext NOT NULL,
  `view` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4;

/*Data for the table `article` */

insert  into `article`(`num`,`regDate`,`updateDate`,`memberNum`,`boardNum`,`title`,`body`,`view`) values 
(0,'2021-03-06 11:00:27','2021-03-06 11:00:27',1,1,'게시글1','내용1',1),
(2,'2021-03-06 11:00:28','2021-03-06 11:00:28',1,1,'게시글2','내용2',0),
(3,'2021-03-06 11:01:14','2021-03-06 11:01:14',1,1,'newArticle','newBody',0),
(4,'2021-03-06 14:25:42','2021-03-06 14:25:42',1,1,'newArticle','newBody',0),
(7,'2021-03-07 21:56:55','2021-03-07 21:56:55',2,1,'게시물6','내용6',0),
(8,'2021-03-08 09:36:27','2021-03-08 09:36:27',2,1,'제목10','내용10',0),
(9,'2021-03-08 09:36:30','2021-03-08 09:36:30',2,1,'제목11','내용11',0),
(10,'2021-03-08 09:36:34','2021-03-08 09:36:34',2,1,'제목12','내용12',0),
(11,'2021-03-08 09:36:36','2021-03-08 09:36:36',2,1,'제목13','내용13',0),
(12,'2021-03-08 09:36:40','2021-03-08 09:36:40',2,1,'제목14','내용14',0),
(13,'2021-03-08 09:36:42','2021-03-08 09:36:42',2,1,'제목15','내용15',0),
(14,'2021-03-08 09:36:45','2021-03-08 09:36:45',2,1,'제목16','내용16',0),
(15,'2021-03-08 09:36:48','2021-03-08 09:36:48',2,1,'제목17','내용17',0),
(16,'2021-03-08 09:36:51','2021-03-08 09:36:51',2,1,'제목18','내용18',0),
(17,'2021-03-08 09:36:54','2021-03-08 09:36:54',2,1,'제목19','내용19',0),
(18,'2021-03-08 09:37:01','2021-03-08 09:37:01',2,1,'제목2','내용20',0),
(19,'2021-03-08 09:37:04','2021-03-08 09:37:04',2,1,'제목20','내용20',0),
(20,'2021-03-08 09:37:07','2021-03-08 09:37:07',2,1,'제목21','내용21',0),
(21,'2021-03-08 09:37:10','2021-03-08 09:37:10',2,1,'제목22','내용22',0),
(22,'2021-03-08 09:37:13','2021-03-08 09:37:13',2,1,'제목23','내용23',0),
(23,'2021-03-08 09:37:15','2021-03-08 09:37:15',2,1,'제목24','내용24',0),
(24,'2021-03-08 09:37:18','2021-03-08 09:37:18',2,1,'제목25','내용25',0),
(25,'2021-03-08 09:37:22','2021-03-08 09:37:22',2,1,'제목26','내용26',0),
(26,'2021-03-08 09:37:25','2021-03-08 09:37:25',2,1,'제목27','내용27',0),
(27,'2021-03-08 09:37:28','2021-03-08 09:37:28',2,1,'제목28','내용28',0),
(28,'2021-03-08 09:37:31','2021-03-08 09:37:31',2,1,'제목29','내용29',0),
(29,'2021-03-08 09:37:35','2021-03-08 09:37:35',2,1,'제목30','내용30',0),
(30,'2021-03-08 09:49:09','2021-03-08 09:49:09',2,1,'제목30','내용30',0),
(33,'2021-03-08 13:26:22','2021-03-08 13:26:22',1,1,'제목','내용',0),
(35,'2021-03-08 16:46:57','2021-03-08 16:46:57',1,1,'제목','내용',0),
(36,'2021-03-08 17:01:04','2021-03-08 17:01:04',1,1,'제목','내용',0),
(37,'2021-03-08 17:01:14','2021-03-08 17:01:14',1,1,'제목','내용',0),
(38,'2021-03-10 16:24:16','2021-03-10 16:24:16',3,1,'게시글2','내용2',0),
(39,'2021-03-10 16:24:17','2021-03-10 16:24:17',3,1,'게시글2','내용2',0),
(40,'2021-03-10 16:24:17','2021-03-10 16:24:17',3,1,'게시글2','내용2',0),
(41,'2021-03-10 16:24:17','2021-03-10 16:24:17',3,1,'게시글2','내용2',0),
(42,'2021-03-10 16:24:17','2021-03-10 16:24:17',3,1,'게시글2','내용2',0),
(43,'2021-03-10 16:24:18','2021-03-10 16:24:18',3,1,'게시글2','내용2',0),
(44,'2021-03-10 16:24:18','2021-03-10 16:24:18',3,1,'게시글2','내용2',0),
(45,'2021-03-10 16:24:18','2021-03-10 16:24:18',3,1,'게시글2','내용2',0),
(46,'2021-03-10 16:24:18','2021-03-10 16:24:18',3,1,'게시글2','내용2',0),
(47,'2021-03-10 16:24:18','2021-03-10 16:24:18',3,1,'게시글2','내용2',0),
(48,'2021-03-10 16:24:18','2021-03-10 16:24:18',3,1,'게시글2','내용2',0),
(49,'2021-03-10 16:24:19','2021-03-10 16:24:19',3,1,'게시글2','내용2',0),
(50,'2021-03-10 16:24:19','2021-03-10 16:24:19',3,1,'게시글2','내용2',0),
(51,'2021-03-10 16:24:19','2021-03-10 16:24:19',3,1,'게시글2','내용2',0),
(52,'2021-03-10 16:25:40','2021-03-10 16:25:40',2,1,'게시글2','내용2',0),
(53,'2021-03-10 16:25:43','2021-03-10 16:25:43',2,1,'게시글2','내용2',0),
(54,'2021-03-10 16:26:25','2021-03-10 16:26:25',2,1,'게시글2','내용2',0),
(55,'2021-03-10 16:26:25','2021-03-10 16:26:25',2,1,'게시글2','내용2',0),
(56,'2021-03-10 16:26:25','2021-03-10 16:26:25',2,1,'게시글2','내용2',0),
(57,'2021-03-10 16:26:25','2021-03-10 16:26:25',2,1,'게시글2','내용2',0),
(58,'2021-03-10 16:26:25','2021-03-10 16:26:25',2,1,'게시글2','내용2',0),
(59,'2021-03-10 16:26:25','2021-03-10 16:26:25',2,1,'게시글2','내용2',0),
(60,'2021-03-10 16:26:26','2021-03-10 16:26:26',2,1,'게시글2','내용2',0),
(61,'2021-03-10 16:26:26','2021-03-10 16:26:26',2,1,'게시글2','내용2',1),
(62,'2021-03-10 16:26:26','2021-03-10 16:26:26',2,1,'게시글2','내용2',1),
(63,'2021-03-10 16:26:26','2021-03-10 16:26:26',2,1,'게시글2','내용2',7),
(65,'2021-03-11 11:21:29','2021-03-11 11:21:29',2,1,'test1','test1',0),
(66,'2021-03-11 11:25:16','2021-03-11 11:25:16',2,1,'test1','test1',0),
(67,'2021-03-11 11:25:49','2021-03-11 11:25:49',2,1,'asd','as',0),
(68,'2021-03-11 11:26:15','2021-03-11 11:26:15',2,1,'125454','234432234',0),
(69,'2021-03-11 11:28:37','2021-03-11 11:28:37',2,1,'125454','234432234',1),
(70,'2021-03-11 13:31:19','2021-03-11 13:31:19',2,1,'asd','asd',0),
(71,'2021-03-11 13:31:55','2021-03-11 13:31:55',2,1,'asd','123',0),
(72,'2021-03-11 13:32:15','2021-03-11 13:32:15',2,1,'123123','123132132',0),
(73,'2021-03-11 14:29:32','2021-03-11 14:29:32',2,1,'test1','test1',0),
(74,'2021-03-11 14:30:26','2021-03-11 14:30:26',2,1,'test1','test1',0),
(75,'2021-03-11 14:34:09','2021-03-11 14:34:09',2,1,'test1','test1',0),
(76,'2021-03-11 14:35:07','2021-03-11 14:35:07',2,1,'test1','test1',0),
(77,'2021-03-11 14:35:58','2021-03-11 14:35:58',2,1,'test1','test1',0),
(78,'2021-03-11 14:36:01','2021-03-11 14:36:01',2,1,'test1','test1',0),
(79,'2021-03-11 14:36:28','2021-03-11 14:36:28',2,1,'123','123',0),
(80,'2021-03-11 14:39:39','2021-03-11 14:39:39',2,1,'123','123',0),
(81,'2021-03-11 14:39:48','2021-03-11 14:39:48',2,1,'1234','1234',0),
(82,'2021-03-11 14:40:25','2021-03-11 14:40:25',2,1,'534','345345',0),
(83,'2021-03-11 14:41:11','2021-03-11 14:41:11',2,1,'5234','12312312',1),
(84,'2021-03-11 15:13:48','2021-03-11 15:13:48',2,1,'123','123',0),
(85,'2021-03-11 15:16:27','2021-03-11 15:16:27',2,1,'123','123',0),
(86,'2021-03-11 15:27:33','2021-03-11 15:27:33',2,1,'테스트','테스트',3),
(87,'2021-03-11 16:00:28','2021-03-11 16:00:28',2,1,'43535','123',0),
(88,'2021-03-11 16:08:06','2021-03-11 16:08:06',2,1,'32423','23423234',0),
(89,'2021-03-11 16:09:00','2021-03-11 16:09:00',2,1,'32423','23423234',0),
(90,'2021-03-11 16:10:35','2021-03-11 16:10:35',2,1,'32423','23423234',0),
(91,'2021-03-11 16:16:36','2021-03-11 16:16:36',2,1,'32423','23423234',1),
(92,'2021-03-11 16:17:57','2021-03-11 16:17:57',2,1,'4553','34535',8),
(93,'2021-03-11 16:54:13','2021-03-11 16:54:13',2,2,'123','123213',2),
(94,'2021-03-11 16:55:59','2021-03-11 16:55:59',2,2,'테스트2','테스트2',0),
(95,'2021-03-11 16:56:23','2021-03-11 16:56:23',2,2,'123','123',9),
(96,'2021-03-11 16:58:45','2021-03-11 16:58:45',2,2,'테스트 게시물4','테스트 게시물 4',10),
(98,'2021-03-12 08:57:35','2021-03-12 08:57:35',2,1,'213132','1232131',16),
(114,'2021-03-12 14:40:03','2021-03-12 14:40:03',2,2,'232321','1113',1),
(115,'2021-03-12 14:40:28','2021-03-12 14:40:28',2,2,'566','6555',1);

/*Table structure for table `board` */

DROP TABLE IF EXISTS `board`;

CREATE TABLE `board` (
  `num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `name` char(30) NOT NULL,
  `code` char(20) NOT NULL,
  PRIMARY KEY (`num`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `board` */

insert  into `board`(`num`,`regDate`,`updateDate`,`name`,`code`) values 
(1,'2021-03-08 09:46:05','2021-03-08 09:46:05','공지사항','normal'),
(2,'2021-03-08 09:46:24','2021-03-08 09:46:24','포토갤러리','photo');

/*Table structure for table `genFile` */

DROP TABLE IF EXISTS `genFile`;

CREATE TABLE `genFile` (
  `num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `delDate` datetime DEFAULT NULL,
  `delStatus` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `relTypeCode` char(50) NOT NULL,
  `relNum` int(10) unsigned NOT NULL,
  `originFileName` varchar(100) NOT NULL,
  `fileExt` char(10) NOT NULL,
  `typeCode` char(20) NOT NULL,
  `type2Code` char(20) NOT NULL,
  `fileSize` int(10) unsigned NOT NULL,
  `fileExtTypeCode` char(10) NOT NULL,
  `fileExtType2Code` char(10) NOT NULL,
  `fileNo` smallint(2) unsigned NOT NULL,
  `fileDir` char(20) NOT NULL,
  PRIMARY KEY (`num`),
  KEY `relId` (`relNum`,`relTypeCode`,`typeCode`,`type2Code`,`fileNo`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

/*Data for the table `genFile` */

insert  into `genFile`(`num`,`regDate`,`updateDate`,`delDate`,`delStatus`,`relTypeCode`,`relNum`,`originFileName`,`fileExt`,`typeCode`,`type2Code`,`fileSize`,`fileExtTypeCode`,`fileExtType2Code`,`fileNo`,`fileDir`) values 
(1,'2021-03-11 14:41:11','2021-03-12 10:42:08',NULL,0,'article',113,'정보.txt','txt','common','attachment',443,'etc','etc',1,'2021_03'),
(2,'2021-03-11 15:13:48','2021-03-12 10:42:08',NULL,0,'article',113,'정보.txt','txt','common','attachment',443,'etc','etc',1,'2021_03'),
(3,'2021-03-11 15:16:27','2021-03-11 15:16:27',NULL,0,'article',0,'정보.txt','txt','common','attachment',443,'etc','etc',1,'2021_03'),
(4,'2021-03-11 15:27:33','2021-03-11 15:27:33',NULL,0,'article',0,'presi01.jpg','jpg','common','attachment',17336,'img','jpg',1,'2021_03'),
(5,'2021-03-11 16:00:28','2021-03-11 16:00:28',NULL,0,'article',0,'제목 없음.png','png','common','attachment',8261,'img','png',1,'2021_03'),
(6,'2021-03-11 16:08:06','2021-03-11 16:08:06',NULL,0,'article',0,'제목 없음.png','png','common','attachment',8261,'img','png',1,'2021_03'),
(7,'2021-03-11 16:09:00','2021-03-11 16:09:00',NULL,0,'article',0,'제목 없음.png','png','common','attachment',8261,'img','png',1,'2021_03'),
(8,'2021-03-11 16:16:36','2021-03-11 16:16:36',NULL,0,'article',91,'제목 없음.png','png','common','attachment',8261,'img','png',1,'2021_03'),
(9,'2021-03-11 16:17:57','2021-03-11 16:17:57',NULL,0,'article',92,'제목 없음.png','png','common','attachment',8261,'img','png',1,'2021_03'),
(10,'2021-03-11 16:54:13','2021-03-11 16:54:13',NULL,0,'article',93,'image-1.jpg','jpg','common','attachment',381743,'img','jpg',1,'2021_03'),
(11,'2021-03-11 16:55:59','2021-03-11 16:55:59',NULL,0,'article',94,'image-1.jpg','jpg','common','attachment',134976,'img','jpg',1,'2021_03'),
(12,'2021-03-11 16:58:45','2021-03-11 16:58:45',NULL,0,'article',96,'image-1.jpg','jpg','common','attachment',203779,'img','jpg',1,'2021_03'),
(16,'2021-03-12 14:35:00','2021-03-12 14:35:00',NULL,0,'article',0,'image-1.jpg','jpg','common','attachment',354247,'img','jpg',1,'2021_03'),
(17,'2021-03-12 14:35:02','2021-03-12 14:35:02',NULL,0,'article',0,'image-1.jpg','jpg','common','attachment',354247,'img','jpg',1,'2021_03'),
(18,'2021-03-12 14:36:01','2021-03-12 14:36:01',NULL,0,'article',0,'image-1.jpg','jpg','common','attachment',354247,'img','jpg',1,'2021_03'),
(19,'2021-03-12 14:36:57','2021-03-12 14:36:57',NULL,0,'article',0,'image-1.jpg','jpg','common','attachment',354247,'img','jpg',1,'2021_03'),
(20,'2021-03-12 14:38:08','2021-03-12 14:38:08',NULL,0,'article',0,'image-1.jpg','jpg','common','attachment',354247,'img','jpg',1,'2021_03'),
(21,'2021-03-12 14:40:03','2021-03-12 14:40:03',NULL,0,'article',114,'image-1.jpg','jpg','common','attachment',354247,'img','jpg',1,'2021_03'),
(22,'2021-03-12 14:40:28','2021-03-12 14:40:28',NULL,0,'article',115,'banner-1.jpg','jpg','common','attachment',276024,'img','jpg',1,'2021_03');

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `name` char(20) NOT NULL,
  `loginId` char(30) NOT NULL,
  `loginPw` varchar(200) NOT NULL,
  `authKey` char(130) NOT NULL,
  `nickname` char(50) NOT NULL,
  `email` char(100) NOT NULL,
  `hpNum` char(20) NOT NULL,
  PRIMARY KEY (`num`),
  UNIQUE KEY `loginId` (`loginId`),
  UNIQUE KEY `authKey` (`authKey`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `member` */

insert  into `member`(`num`,`regDate`,`updateDate`,`name`,`loginId`,`loginPw`,`authKey`,`nickname`,`email`,`hpNum`) values 
(1,'2021-03-09 15:27:19','2021-03-09 15:27:19','방혜성','test3','test3','authKey1__80224c2f-80a0-11eb-9d8c-b025aa3ecfdd__0.20430454165144316','baobab612','banggu1997@naver.com','010-8370-0420'),
(2,'2021-03-09 15:50:34','2021-03-10 16:01:15','방혜성','test1','1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014','authKey1__bf467589-80a3-11eb-9d8c-b025aa3ecfdd__0.3230526822833835','baobab612','banggu1997@naver.com','010-8370-0420'),
(3,'2021-03-09 15:56:58','2021-03-09 15:56:58','방혜성','test2','test2','authKey1__a43b380c-80a4-11eb-9d8c-b025aa3ecfdd__0.5967497831180224','baobab612','banggu1997@naver.com','010-8370-0420'),
(4,'2021-03-09 16:07:15','2021-03-09 16:07:15','방혜성','test5','test5','authKey1__13f841a4-80a6-11eb-9d8c-b025aa3ecfdd__0.373265601110892','baobab612','banggu1997@naver.com','010-8370-0420'),
(10,'2021-03-12 14:11:05','2021-03-12 14:11:05','방혜성','test6','ed0cb90bdfa4f93981a7d03cff99213a86aa96a6cbcf89ec5e8889871f088727','authKey1__590f6ba3-82f1-11eb-baeb-b025aa3ecfdd__0.6455571545712251','banggu1997','banggu1997@naver.com','01083700420');

/*Table structure for table `reply` */

DROP TABLE IF EXISTS `reply`;

CREATE TABLE `reply` (
  `num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `memberNum` int(10) unsigned NOT NULL,
  `relNum` int(10) unsigned NOT NULL,
  `relTypeCode` char(30) NOT NULL,
  `body` longtext NOT NULL,
  PRIMARY KEY (`num`),
  KEY `relTypeCode` (`relTypeCode`,`relNum`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `reply` */

insert  into `reply`(`num`,`regDate`,`updateDate`,`memberNum`,`relNum`,`relTypeCode`,`body`) values 
(2,'2021-03-08 10:29:42','2021-03-08 10:29:42',1,31,'article','댓글2'),
(4,'2021-03-08 10:44:40','2021-03-08 10:44:40',1,31,'article','댓글4'),
(7,'2021-03-08 11:24:27','2021-03-08 11:24:27',2,32,'article','댓글'),
(8,'2021-03-08 11:24:49','2021-03-08 11:24:49',2,32,'article','댓글'),
(9,'2021-03-08 13:10:04','2021-03-08 13:34:57',2,32,'article','수정댓글123'),
(10,'2021-03-08 13:34:25','2021-03-08 13:34:25',1,32,'article','댓글');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
