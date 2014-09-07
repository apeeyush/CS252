CREATE DATABASE `cs252`;
CREATE USER 'cs252_admin'@'localhost' IDENTIFIED BY 'adminuser';
GRANT ALL PRIVILEGES ON `cs252`.* TO 'cs252_admin'@'localhost';
CREATE TABLE `cs252`.`users` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` CHAR(128) NOT NULL
);