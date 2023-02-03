create database purchase character set utf8 collate utf8_general_ci;

use purchase;

create table roles (
  id INT NOT NULL AUTO_INCREMENT,
  rol VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO roles (rol) VALUES ('Administrador');
INSERT INTO roles (rol) VALUES ('Encargado');
INSERT INTO roles (rol) VALUES ('Usuario');

create table usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  rol_id INT NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  usuario VARCHAR(50) NOT NULL,
  email VARCHAR(60) NOT NULL,
  password VARCHAR(150) NOT NULL,
  sede VARCHAR(10) NOT NULL,
  estado VARCHAR(20) NOT NULL,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_rol
  FOREIGN KEY (rol_id)
  REFERENCES roles (id)
)ENGINE=INNODB;

INSERT INTO usuarios (rol_id,nombre,usuario,email,password,sede,estado) VALUES (1,'Administrador','admin','admin@clonsa.com','123','Peru','Activo');
INSERT INTO usuarios (rol_id,nombre,usuario,email,password,sede,estado) VALUES (2,'Encargado','encargado','enc@clonsa.com','123','Peru','Activo');
INSERT INTO usuarios (rol_id,nombre,usuario,email,password,sede,estado) VALUES (3,'Usuario','usuario','usuario@clonsa.com','123','Peru','Activo');


CREATE TABLE minas (
  id INT NOT NULL AUTO_INCREMENT,
  centro_costo VARCHAR(30) NOT NULL,
  nombre VARCHAR(100) NOT NULL,
  pais VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO minas (centro_costo, nombre, pais) VALUES ('CC-1001', 'Las Bambas', 'Peru');
INSERT INTO minas (centro_costo, nombre, pais) VALUES ('CC-5001', 'Los Pinos', 'Chile');

CREATE TABLE categorias (
id INT NOT NULL AUTO_INCREMENT,
mina_id INT NOT NULL,
categoria VARCHAR(255) NOT NULL,
fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id),
CONSTRAINT fk_mina
FOREIGN KEY (mina_id)
REFERENCES minas (id)
)ENGINE=INNODB;

INSERT INTO categorias (mina_id,categoria) VALUES (1,'Pasajes');
INSERT INTO categorias (mina_id,categoria) VALUES (1,'Alquiler');
INSERT INTO categorias (mina_id,categoria) VALUES (1,'Viaticos');

INSERT INTO categorias (mina_id,categoria) VALUES (2,'Administrativos');
INSERT INTO categorias (mina_id,categoria) VALUES (2,'Comida');
INSERT INTO categorias (mina_id,categoria) VALUES (2,'Compra');


CREATE TABLE ordenes_servicio (
id INT NOT NULL AUTO_INCREMENT,
num_os VARCHAR(30) NOT NULL,
centro_costo VARCHAR(50) NOT NULL,
categoria VARCHAR(255) NOT NULL,
item INT NOT NULL,
cantidad VARCHAR(20) NOT NULL,
unidad VARCHAR(20) NOT NULL,
descripcion VARCHAR(250) NOT NULL,
proveedor VARCHAR(100) NOT NULL,
creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
acttualizado DATETIME DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id)
)ENGINE=INNODB;

create table registro_acceso (
  id INT NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(50) NOT NULL,
  password VARCHAR(100) NOT NULL,
  status VARCHAR(15) NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)ENGINE=INNODB;


