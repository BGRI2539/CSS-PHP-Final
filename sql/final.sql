CREATE TABLE users(
    userId int not null auto increment primary key,
    firstName varchar(255) not null,
    email varchar(255) not null,
    username varchar(255) not null,
    password varchar(255) not null,
);