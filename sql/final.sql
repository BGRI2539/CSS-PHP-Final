CREATE TABLE users (
    userId INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(255),
    email VARCHAR(255) not null,
    username VARCHAR(255) not null,
    password VARCHAR(255) not null,
    PRIMARY KEY (userId)
);
