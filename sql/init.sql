CREATE DATABASE IF NOT EXISTS sistema_auth;
USE sistema_auth;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_insegura VARCHAR(255) NOT NULL,
    password_segura VARCHAR(255) NOT NULL
);

