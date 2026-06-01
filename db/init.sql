-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS sh1_u1_dwp;
USE sh1_u1_dwp;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    token_recuperacion VARCHAR(100),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de mensajes de contacto
CREATE TABLE IF NOT EXISTS buzon_contacto (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    nombre_remitente VARCHAR(100) NOT NULL,
    email_remitente VARCHAR(150) NOT NULL,
    asunto VARCHAR(200),
    mensaje TEXT NOT NULL,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de secciones para el mapa del sitio
CREATE TABLE IF NOT EXISTS secciones (
    id_seccion INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    url VARCHAR(100) NOT NULL,
    es_secundaria BOOLEAN DEFAULT FALSE
);

-- Tabla de logs de búsqueda
CREATE TABLE IF NOT EXISTS logs_busquedas (
    id_busqueda INT AUTO_INCREMENT PRIMARY KEY,
    termino VARCHAR(100) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);