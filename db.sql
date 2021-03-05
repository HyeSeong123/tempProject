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