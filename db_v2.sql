create database ordenes1 character set utf8 collate utf8_general_ci;

use ordenes1;

create table roles (
  id INT NOT NULL AUTO_INCREMENT,
  rol VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO roles (rol) VALUES ('Administrador');
INSERT INTO roles (rol) VALUES ('Coordinador');
INSERT INTO roles (rol) VALUES ('Encargado');
INSERT INTO roles (rol) VALUES ('Usuario');

CREATE TABLE sedes (
id INT NOT NULL AUTO_INCREMENT,
sede VARCHAR(20) NOT NULL,
fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(id)
)ENGINE=INNODB;

INSERT INTO sedes (sede) VALUES ('Peru');
INSERT INTO sedes (sede) VALUES ('Chile');

create table usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  rol_id INT NOT NULL,
  sede_id INT NOT NULL,
  funcion VARCHAR(30) NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  usuario VARCHAR(50) NOT NULL,
  email VARCHAR(60) NOT NULL,
  password VARCHAR(150) NOT NULL,
  estado VARCHAR(20) NOT NULL,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_rol
  FOREIGN KEY (rol_id)
  REFERENCES roles (id),
  CONSTRAINT fk_sede
  FOREIGN KEY (sede_id)
  REFERENCES sedes (id)
)ENGINE=INNODB;

INSERT INTO usuarios (rol_id,sede_id,nombre,usuario,email,password,estado) VALUES 
(1, 1, 'Administrador','admin','admin@clonsa.com','123', 'Activo'),
(2, 1, 'Coord_pe','coord_pe','coor@clonsa.com','123', 'Activo'),
(3, 1, 'Enc_pe1','enc_pe1','enc1@clonsa.com','123', 'Activo'),
(3, 1, 'Enc_pe2','enc_pe2','enc2@clonsa.com','123', 'Activo'),
(4, 1, 'User_pe','user_pe','usuario@clonsa.com','123', 'Activo');

INSERT INTO usuarios (rol_id,sede_id,nombre,usuario,email,password,estado) VALUES 
(2, 2, 'Coord_cl','coord_cl','coor@clonsa.com','123', 'Activo'),
(3, 2, 'Enc_cl1','enc_cl1','enc1@clonsa.com','123', 'Activo'),
(3, 2, 'Enc_cl2','enc_cl2','enc2@clonsa.com','123', 'Activo'),
(4, 2, 'User_cl','user_cl','usuario@clonsa.com','123', 'Activo');



CREATE TABLE minas_cl (
  id INT NOT NULL AUTO_INCREMENT,
  codigo INT NOT NULL,
  nombre VARCHAR(100) NOT NULL,
  pais VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO minas_cl (codigo, nombre, pais) VALUES 
  (100, 'GERENCIA DE ADMINISTRACION Y FINANZAS', 'Chile'),
  (200, 'GERENCIA DE MARKETING', 'Chile'),
  (300, 'GERENCIA DE OPERACIONES', 'Chile'),
  (400, 'PROYECTOS Y REPRESENTACIONES', 'Chile'),
  (500, 'LOS BRONCES', 'Chile'),
  (600, 'LOS COLORADOS', 'Chile'),
  (700, 'EL ROMERAL', 'Chile'),
  (800, 'CENTINELA', 'Chile'),
  (900, 'QUEBRADA BLANCA', 'Chile'),
  (1000, 'ZALDIVAR', 'Chile'),
  (1100, 'ESCONDIDA', 'Chile'),
  (1200, 'PERU', 'Chile'),
  (1300, 'LOMAS BAYAS', 'Chile'),
  (1400, 'CERRO COLORADO', 'Chile'),
  (1500, 'CARMEN DE ANDACOLLO', 'Chile'),
  (1600, 'EL SOLDADO ', 'Chile'),
  (1700, 'SPENCE', 'Chile'),
  (1800, 'CEMIN UVA', 'Chile'),
  (1900, 'LA COIPA ', 'Chile');


CREATE TABLE minas_pe (
  id INT NOT NULL AUTO_INCREMENT,
  codigo INT NOT NULL,
  nombre VARCHAR(100) NOT NULL,
  pais VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO minas_pe (codigo, nombre, pais) VALUES 
  (100, 'ADMINISTRACION', 'Peru'),
  (200, 'MARCOBRE', 'Peru'),
  (300, 'CUAJONE', 'Peru'),
  (400, 'BUENAVENTURA', 'Peru'),
  (500, 'HUDBAY ', 'Peru'),
  (600, 'CHINALCO', 'Peru'),
  (700, 'YANACOCHA ', 'Peru'),
  (800, 'ANTAPACCAY ', 'Peru'),
  (900, 'LAS BAMBAS', 'Peru'),
  (1000, 'ANTAMINA', 'Peru');

CREATE TABLE categ_chile (
id INT NOT NULL AUTO_INCREMENT,
mina_cl_id INT NOT NULL,
codigo INT NOT NULL,
categoria VARCHAR(255) NOT NULL,
fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id),
CONSTRAINT fk_mina_cl
FOREIGN KEY (mina_cl_id)
REFERENCES minas_cl (id)
)ENGINE=INNODB;

CREATE TABLE categ_peru (
id INT NOT NULL AUTO_INCREMENT,
mina_pe_id INT NOT NULL,
codigo INT NOT NULL,
categoria VARCHAR(255) NOT NULL,
fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id),
CONSTRAINT fk_mina_pe
FOREIGN KEY (mina_pe_id)
REFERENCES minas_pe (id)
)ENGINE=INNODB;


CREATE TABLE os_chile (
id INT NOT NULL AUTO_INCREMENT,
num_os VARCHAR(30) NOT NULL,
usuario VARCHAR(100) NOT NULL,
mina VARCHAR(50) NOT NULL,
categoria VARCHAR(255) NOT NULL,
item INT NOT NULL,
cantidad VARCHAR(20) NOT NULL,
unidad VARCHAR(20) NOT NULL,
descripcion VARCHAR(250) NOT NULL,
proveedor VARCHAR(100) NOT NULL,
estado VARCHAR(30) NOT NULL,
creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
actualizado DATETIME DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id)
)ENGINE=INNODB;

CREATE TABLE os_peru (
id INT NOT NULL AUTO_INCREMENT,
num_os VARCHAR(30) NOT NULL,
tipo VARCHAR(20) NOT NULL,
usuario VARCHAR(100) NOT NULL,
mina VARCHAR(50) NOT NULL,
categoria VARCHAR(255) NOT NULL,
item INT NOT NULL,
cantidad VARCHAR(20) NOT NULL,
unidad VARCHAR(20) NOT NULL,
descripcion VARCHAR(250) NOT NULL,
proveedor VARCHAR(100) NOT NULL,
valor VARCHAR(20) NOT NULL,
estado VARCHAR(30) NOT NULL,
creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
actualizado DATETIME DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id)
)ENGINE=INNODB;

create table logs (
  id INT NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(50) NOT NULL,
  password VARCHAR(100) NOT NULL,
  estado VARCHAR(15) NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)ENGINE=INNODB;


CREATE TABLE adjuntos_cl (
id INT NOT NULL AUTO_INCREMENT,
num_os VARCHAR(20) NOT NULL,
archivo VARCHAR(100) NOT NULL,
creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE adjuntos_pe (
id INT NOT NULL AUTO_INCREMENT,
num_os VARCHAR(20) NOT NULL,
archivo VARCHAR(100) NOT NULL,
creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE enlaces_pe (
id INT NOT NULL AUTO_INCREMENT,
num_os VARCHAR(20) NOT NULL,
enlace VARCHAR(100) NOT NULL,
creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE enlaces_cl (
id INT NOT NULL AUTO_INCREMENT,
num_os VARCHAR(20) NOT NULL,
enlace VARCHAR(100) NOT NULL,
creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE revision_pe (
id INT NOT NULL AUTO_INCREMENT,
num_os VARCHAR(20) NOT NULL,
tipo VARCHAR(20) NOT NULL,
revisor_1 VARCHAR(100) NOT NULL,
obs_1 VARCHAR(200) NOT NULL,
aprob_1 VARCHAR(30) NOT NULL,
fecha_aprob_1 DATETIME DEFAULT CURRENT_TIMESTAMP,
revisor_2 VARCHAR(100) NOT NULL,
obs_2 VARCHAR(200) NOT NULL,
aprob_2 VARCHAR(30) NOT NULL,
fecha_aprob_2 DATETIME DEFAULT CURRENT_TIMESTAMP,
revisor_3 VARCHAR(100) NOT NULL,
obs_3 VARCHAR(200) NOT NULL,
aprob_3 VARCHAR(30) NOT NULL,
fecha_aprob_3 DATETIME DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE revision_areas {
  id INT NOT NULL AUTO_INCREMENT,
  sede_id 
}

create table revision_areas (
  id INT NOT NULL AUTO_INCREMENT,
  sede VARCHAR(10) NOT NULL,
  area_1 VARCHAR(50) NOT NULL,
  area_2 VARCHAR(50) NOT NULL,
  area_3 VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;


