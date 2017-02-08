#DROP DATABASE IF EXISTS feedback;
CREATE DATABASE feedback CHARACTER SET utf8 COLLATE utf8_general_ci;
USE feedback;

CREATE TABLE users (
    id INT(10) AUTO_INCREMENT,
    login VARCHAR(50),
    password CHAR(32),
    email VARCHAR(100),
    privileges TINYINT(1) DEFAULT 0,
    user_id INT(10),
    PRIMARY KEY (id)
);

CREATE TABlE feed (
    id INT(10) AUTO_INCREMENT,
    text TEXT,
    feed_date DATETIME,
    is_changed TINYINT(1) DEFAULT 0,
    image_name VARCHAR(100),
    visibility TINYINT(1) DEFAULT 1,
    PRIMARY KEY (id)
);