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
ALTER TABLE article ADD COLUMN `view` INT(10) UNSIGNED NOT NULL

INSERT INTO article
    SET regDate= NOW(),
    updateDate = NOW(),
    `title` = '게시글1',
    `body` = '내용1'

		SELECT A.num, A.title,
		IFNULL(M.nickname, "탈퇴회원") AS extra__writer,
		DATE_FORMAT(A.regDate, '%m-%d'),
		A.view,
		B.name AS extra__board
		FROM article AS A
		LEFT JOIN `member` AS M
		ON A.memberNum = M.num
		LEFT JOIN `board` AS B
		ON A.boardNum = B.num
		WHERE 1

INSERT INTO article
    SET regDate= NOW(),
    updateDate = NOW(),
    `title` = '게시글2',
    memberNum = 2,
    boardNum = 1,
    `body` = '내용2'

UPDATE article
SET memberNum = 3
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

# 기존 패스워드 암호화
UPDATE `member`
SET loginPw = SHA2(loginPw, 256);

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

ALTER TABLE `member` ADD COLUMN authKey CHAR(130) NOT NULL AFTER loginPw;

# 기존 회원의 authKey 데이터 채우기
UPDATE `member`
SET authKey = CONCAT("authKey1__", UUID(), "__", RAND())
WHERE authKey = '';

UPDATE `member`
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

CREATE TABLE board(
    num INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    regDate DATETIME NOT NULL,
    updateDate DATETIME NOT NULL,
    `name` CHAR(30) UNIQUE NOT NULL,
    `code` CHAR(20) UNIQUE NOT NULL
);

INSERT INTO board
    SET regDate = NOW(),
    updateDate = NOW(),
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
    memberNum INT(10) UNSIGNED NOT NULL,
    relNum INT(10) UNSIGNED NOT NULL,
    relTypeCode CHAR(30) NOT NULL,
    `body` LONGTEXT NOT NULL
);
# 고속 검색을 위해 인덱스 걸기
ALTER TABLE reply ADD KEY (relTypeCode, relNum); 
 
INSERT INTO reply
    SET regDate = NOW(),
    updateDate = NOW(),
    memberNum = 2,
    relNum = 31,
    relTypeCode = 'article',
    `body` = '댓글5'
    
CREATE TABLE getFile (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, # 번호
  regDate DATETIME DEFAULT NULL, # 작성날짜
  updateDate DATETIME DEFAULT NULL, # 갱신날짜
  delDate DATETIME DEFAULT NULL, # 삭제날짜
  delStatus TINYINT(1) UNSIGNED NOT NULL DEFAULT 0, # 삭제상태(0:미삭제,1:삭제)
  relTypeCode CHAR(50) NOT NULL, # 관련 데이터 타입(article, member)
  relId INT(10) UNSIGNED NOT NULL, # 관련 데이터 번호
  originFileName VARCHAR(100) NOT NULL, # 업로드 당시의 파일이름
  fileExt CHAR(10) NOT NULL, # 확장자
  typeCode CHAR(20) NOT NULL, # 종류코드 (common)
  type2Code CHAR(20) NOT NULL, # 종류2코드 (attatchment)
  fileSize INT(10) UNSIGNED NOT NULL, # 파일의 사이즈
  fileExtTypeCode CHAR(10) NOT NULL, # 파일규격코드(img, video)
  fileExtType2Code CHAR(10) NOT NULL, # 파일규격2코드(jpg, mp4)
  fileNo SMALLINT(2) UNSIGNED NOT NULL, # 파일번호 (1)
  fileDir CHAR(20) NOT NULL, # 파일이 저장되는 폴더명
  PRIMARY KEY (id),
  KEY relId (relId,relTypeCode,typeCode,type2Code,fileNo)
); 