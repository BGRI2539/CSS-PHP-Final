create database sitedata;

use database sitedata;

CREATE TABLE users (
    userId INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(255),
    email VARCHAR(255) not null,
    username VARCHAR(255) not null,
    password VARCHAR(255) not null,
    avatar MEDIUMBLOB not null,
    PRIMARY KEY (userId)
);

CREATE TABLE posts (
    postId INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    image MEDIUMBLOB, 
    PRIMARY KEY (postId),
    FOREIGN KEY (userId) REFERENCES users(userId)
);