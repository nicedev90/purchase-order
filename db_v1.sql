create database purchase character set utf8 collate utf8_general_ci;

use purchase;

create table roles (
  id INT NOT NULL AUTO_INCREMENT,
  rol VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

create table usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  rol_id INT NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  apellido VARCHAR(50) NOT NULL,
  usuario VARCHAR(50) NOT NULL,
  email VARCHAR(60) NOT NULL,
  password VARCHAR(150) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_rol
  FOREIGN KEY (rol_id)
  REFERENCES roles (id)
)ENGINE=INNODB;

create table orden_servicio (
  id INT NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(40) NOT NULL,
  num_os VARCHAR(20) NOT NULL,
  item INT NOT NULL,
  cantidad INT,
  unidad VARCHAR(20),
  descripcion VARCHAR(200) NOT NULL,
  proveedor VARCHAR(100),
  costo_unit VARCHAR(15),
  tipo_solicitud VARCHAR(40),
  centro_costos VARCHAR(20),
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)ENGINE=INNODB;

create table registro_acceso (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(100) NOT NULL,
  status VARCHAR(15) NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)ENGINE=INNODB;


INSERT INTO roles (rol) VALUES ('Administrador');
INSERT INTO roles (rol) VALUES ('Encargado');
INSERT INTO roles (rol) VALUES ('Usuario');