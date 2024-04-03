DROP USER IF EXISTS clinicadental;
CREATE USER clinicadental@'%' IDENTIFIED BY '@admin';
CREATE DATABASE IF NOT EXISTS clinicadental;
GRANT ALL PRIVILEGES ON clinicadental.* TO clinicadental@'%';

USE clinicadental;

CREATE TABLE categorias (
    id_categoria INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    imagen VARCHAR(100) DEFAULT 'default.png'
);

CREATE TABLE servicios(
    id_servicio INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio FLOAT NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    imagen VARCHAR(100) DEFAULT 'default.png',
    id_categoria INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria),
    CHECK (precio >= 0)
);

CREATE TABLE empleado (
    id_empleado INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(100) NOT NULL,
    apellido_materno VARCHAR(100) NOT NULL,
    telefono VARCHAR(10) NOT NULL,
    imagen VARCHAR(100) DEFAULT 'default.png'
);

CREATE TABLE dentista (
    id_medico INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(100) NOT NULL,
    apellido_materno VARCHAR(100) NOT NULL,
    telefono VARCHAR(10) NOT NULL,
    dias_habiles VARCHAR(100) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    imagen VARCHAR(100) DEFAULT 'default.png'
);

CREATE TABLE paciente (
    id_paciente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(100) NOT NULL,
    apellido_materno VARCHAR(100) NOT NULL,
    telefono VARCHAR(10) NOT NULL,
    email VARCHAR(100) NOT NULL,
    direccion VARCHAR(200) NOT NULL
);

CREATE TABLE cita (
    id_cita INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_medico INT NOT NULL,
    id_paciente INT NOT NULL,
    id_servicio INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    FOREIGN KEY (id_medico) REFERENCES dentista(id_medico),
    FOREIGN KEY (id_paciente) REFERENCES paciente(id_paciente),
    FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio)
);

CREATE TABLE usuarios (
    id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(24) NOT NULL
);

CREATE TABLE rol (
    id_rol INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    rol VARCHAR(100) NOT NULL
);

CREATE TABLE privilegio(
    id_privilegio INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    privilegio VARCHAR(100) NOT NULL
);

CREATE TABLE usuario_rol(
    id_usuario INT NOT NULL,
    id_rol INT NOT NULL,
    PRIMARY KEY (id_usuario, id_rol),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
);

CREATE TABLE rol_privilegio(
    id_rol INT NOT NULL,
    id_privilegio INT NOT NULL,
    PRIMARY KEY (id_rol, id_privilegio),
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol),
    FOREIGN KEY (id_privilegio) REFERENCES privilegio(id_privilegio)
);