DROP USER IF EXISTS 'clinicadental'@'%';
CREATE USER 'clinicadental'@'%' IDENTIFIED BY '@admin';
GRANT ALL PRIVILEGES ON *.* TO 'clinicadental'@'%' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
CREATE DATABASE IF NOT EXISTS 'clinicadental';
GRANT ALL PRIVILEGES ON 'clinicadental'.* TO 'clinicadental'@'%';
GRANT ALL PRIVILEGES ON 'clinicadental\_%'.* TO 'clinicadental'@'%';

USE clinicadental;

CREATE TABLE categorias () {
    id_categoria INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    imagen VARCHAR(100) DEFAULT 'default.png'
}

CREATE TABLE servicios(
    id_servicio INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio FLOAT NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    imagen VARCHAR(100) DEFAULT 'default.png',
    id_categoria INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria),
    CHECK precio >= 0
);

