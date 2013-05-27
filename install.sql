CREATE TABLE classmates (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
password CHAR(50) NOT NULL,
avatar LONGBLOB,
name CHAR(20) NOT NULL,
birthday DATE,
sex TINYINT NOT NULL,
hobby TEXT,
nation CHAR(20) NOT NULL,
weight INT,
height INT,
phone_1 CHAR(20),
phone_2 CHAR(20),
phone_3 CHAR(20),
qq CHAR(20),
speciality TEXT,
life MEDIUMTEXT,
content MEDIUMTEXT
);