DROP DATABASE IF EXISTS tempProject;
CREATE DATABASE tempProject;
USE tempProject;

CREATE TABLE article(
    num INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    regDate DATETIME NOT NULL,
    updateDate DATETIME NOT NULL,
    `title` CHAR(100) NOT NULL,
    `body` LONGTEXT NOT NULL
);

ALTER TABLE article ADD COLUMN memberNum INT(10) UNSIGNED NOT NULL AFTER updateDate

INSERT INTO article
    SET regDate= NOW(),
    updateDate = NOW(),
    `title` = '게시글1',
    `body` = '내용1'
    
INSERT INTO article
    SET regDate= NOW(),
    updateDate = NOW(),
    `title` = '게시글2',
    `body` = '내용2'

UPDATE article
SET memberNum = 1
WHERE memberNum = 0
    
CREATE TABLE `member`(
    num INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    regDate DATETIME NOT NULL,
    updateDate DATETIME NOT NULL,
    `name` CHAR(20) NOT NULL,
    loginId CHAR(30) NOT NULL,
    loginPw VARCHAR(200) NOT NULL,
    nickname CHAR(50) NOT NULL,
    email CHAR(100) NOT NULL,
    hpNum CHAR(20) NOT NULL
);

ALTER TABLE `member` ADD UNIQUE INDEX (`loginId`);

INSERT INTO `member`
SET regDate = NOW(),
updateDate = NOW(),
loginId = "user1",
loginPw = "user1",
`name` = "user1",
nickname = "user1",
hpNum = "01012341234",
email = "banggu1997@gmail.com";

SET updateDate = NOW(), NAME = 'Mtest1' WHERE num = 2