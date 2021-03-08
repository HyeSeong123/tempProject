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
ALTER TABLE article ADD COLUMN boardNum INT(10) UNSIGNED NOT NULL AFTER memberNum

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

UPDATE article
SET boardNum = 1
WHERE boardNum = 0
    
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

Alter table `member` add column authKey char(130) not null after loginPw;

# 기존 회원의 authKey 데이터 채우기
UPDATE `member`
SET authKey = CONCAT("authKey1__", UUID(), "__", RAND())
WHERE authKey = '';

update `member`
SET authKey = 'authKey1__1'
WHERE num = 1;

UPDATE `member`
SET authKey = 'authKey1__2'
WHERE num = 2;

UPDATE `member`
SET authKey = 'authKey1__3'
WHERE num = 4;

UPDATE `member`
SET authKey = 'authKey1__4'
WHERE num = 5;

# authKey 칼럼에 유니크 인덱스 추가
ALTER TABLE `member` ADD UNIQUE INDEX (`authKey`);

create table board(
    num int(10) unsigned not null primary key auto_increment,
    regDate datetime not null,
    updateDate datetime not null,
    `name` char(30) UNIQUE not null,
    `code` char(20) UNIQUE not null
);

insert into board
    set regDate = now(),
    updateDate = now(),
    `name` = '공지사항',
    `code` = 'notice'
    
INSERT INTO board
    SET regDate = NOW(),
    updateDate = NOW(),
    `name` = '자유게시판',
    `code` = 'free'
    
CREATE TABLE reply(
    num INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    regDate DATETIME NOT NULL,
    updateDate DATETIME NOT NULL,
    memberNum int(10) unsigned not null,
    relNum int(10) unsigned not null,
    relTypeCode char(30) not null,
    `body` longtext not null
);
# 고속 검색을 위해 인덱스 걸기
ALTER TABLE reply ADD KEY (relTypeCode, relNum); 
 
insert into reply
    set regDate = NOW(),
    updateDate = now(),
    memberNum = 2,
    relNum = 31,
    relTypeCode = 'article',
    `body` = '댓글5'