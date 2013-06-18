CREATE TABLE classmates (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
password CHAR(50) NOT NULL,
name CHAR(20) NOT NULL,
avatar TEXT,
birthday DATE,
sex TINYINT,
hobby TEXT,
nation CHAR(20),
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

CREATE TABLE index_motto (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
content TEXT
);

CREATE TABLE options (
options_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
options_name CHAR(30) NOT NULL,
options_value TEXT
);

CREATE TABLE index_picture (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
url TEXT NOT NULL
);
