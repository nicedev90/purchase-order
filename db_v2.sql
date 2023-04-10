create database ordenes3 character set utf8 collate utf8_general_ci;

use ordenes3;

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

insert  into `usuarios`(`id`,`rol_id`,`sede_id`,`funcion`,`nombre`,`usuario`,`email`,`password`,`estado`,`fecha_creacion`) values 
(1,1,1,'','Administrador','admin','admin@clonsa.com','123','Activo','2023-03-26 12:10:28'),
(2,2,1,'','Coord_pe','coord_pe','coor@clonsa.com','123','Activo','2023-03-26 12:10:28'),
(3,3,1,'Supervisor','Francisco Duran','fduran','enc1@clonsa.com','123','Activo','2023-03-26 12:10:28'),
(4,3,1,'Supervisor','Enzo Jimenez','ejimenez','enc2@clonsa.com','123','Activo','2023-03-26 12:10:28'),
(5,4,1,'Normal','User_pe','user_pe','usuario@clonsa.com','123','Activo','2023-03-26 12:10:28'),
(6,2,2,'','Coord_cl','coord_cl','coor@clonsa.com','123','Activo','2023-03-26 12:10:28'),
(7,3,2,'Supervisor','Juan Carlos Valdivia','jvaldivia','enc1@clonsa.com','123','Activo','2023-03-26 12:10:28'),
(8,3,2,'Supervisor','Victor Castillo','vcastillo','enc2@clonsa.com','123','Activo','2023-03-26 12:10:28'),
(9,4,2,'Normal','User_cl','user_cl','usuario@clonsa.com','123','Activo','2023-03-26 12:10:28'),
(10,3,1,'Supervisor','Hans Morales','hmorales','hmorales@g.com','123','Activo','2023-03-27 08:58:19'),
(11,3,2,'Supervisor','Enrique Porras','eporras','eporras@g.com','123','Activo','2023-03-27 09:02:26');


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
tipo VARCHAR(20) NOT NULL,
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
tipo VARCHAR(20) NOT NULL,
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
tipo VARCHAR(20) NOT NULL,
usuario VARCHAR(100) NOT NULL,
mina VARCHAR(50) NOT NULL,
categoria VARCHAR(255) NOT NULL,
item INT NOT NULL,
cantidad VARCHAR(20) NULL,
unidad VARCHAR(20) NULL,
descripcion VARCHAR(250) NOT NULL,
proveedor VARCHAR(100) NULL,
valor VARCHAR(20) NOT NULL,
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
cantidad VARCHAR(20) NULL,
unidad VARCHAR(20) NULL,
descripcion VARCHAR(250) NOT NULL,
proveedor VARCHAR(100) NULL,
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
PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE revision_cl (
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
PRIMARY KEY(id)
)ENGINE=INNODB;

create table revision_areas (
  id INT NOT NULL AUTO_INCREMENT,
  sede VARCHAR(10) NOT NULL,
  tipo VARCHAR(20) NOT NULL,
  area_1 VARCHAR(50) NOT NULL,
  area_2 VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO revision_areas (sede,tipo,area_1,area_2) VALUES 
  ('Peru', 'Fondos', 'JEFE DE PROYECTO', 'AREA CONTABILIDAD'),
  ('Peru', 'Compra', 'AREA TECNICA', 'AREA ADQUISICION'),
  ('Chile', 'Fondos', 'Area Tecnica', 'Area Adq'),
  ('Chile', 'Compra', 'compras chile 1', 'compras chile 2');


CREATE TABLE supervisores (
id INT NOT NULL AUTO_INCREMENT,
sede VARCHAR (30) NOT NULL,
tipo VARCHAR (30) NOT NULL,
funcion VARCHAR (30) NOT NULL,
nombre VARCHAR (100) NOT NULL,
email VARCHAR(100) NOT NULL,
PRIMARY KEY (id)  
)ENGINE=INNODB;


INSERT INTO `supervisores` (`id`, `sede`, `tipo`, `funcion`, `nombre`, `email`) VALUES
(1, 'Peru', 'Compra', 'sup_1', 'Enzo Jimenez', 'jluis@g.com'),
(2, 'Peru', 'Compra', 'sup_2', 'Hans Morales', ''),
(3, 'Peru', 'Fondos', 'sup_1', 'Francisco Duran', ''),
(4, 'Peru', 'Fondos', 'sup_2', 'Francisco Duran', ''),
(5, 'Chile', 'Compra', 'sup_1', 'Juan Carlos Valdivia', ''),
(6, 'Chile', 'Compra', 'sup_2', 'Victor Castillo', ''),
(7, 'Chile', 'Fondos', 'sup_1', 'Juan Carlos Valdivia', ''),
(8, 'Chile', 'Fondos', 'sup_2', 'Enrique Porras', '');

CREATE TABLE obs_cl (
id INT NOT NULL AUTO_INCREMENT,
num_os VARCHAR(20) NOT NULL,
observaciones VARCHAR(100) NOT NULL,
creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE obs_pe (
id INT NOT NULL AUTO_INCREMENT,
num_os VARCHAR(20) NOT NULL,
observaciones VARCHAR(100) NOT NULL,
creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(id)
)ENGINE=INNODB;




INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (1, 101, 'Fondos', 'VIATICOS'),
  (1, 102, 'Fondos', 'REEMBOLSABLES'),
  (1, 103, 'Compra', 'HERRAMIENTAS'),
  (1, 104, 'Compra', 'INSUMOS Y REPUESTOS'),
  (1, 105, 'Compra', 'ACCESORIOS '),
  (1, 106, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (2, 201, 'Fondos', 'VIATICOS'),
  (2, 202, 'Fondos', 'REEMBOLSABLES'),
  (2, 203, 'Compra', 'HERRAMIENTAS'),
  (2, 204, 'Compra', 'INSUMOS Y REPUESTOS'),
  (2, 205, 'Compra', 'ACCESORIOS '),
  (2, 206, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (3, 301, 'Fondos', 'VIATICOS'),
  (3, 302, 'Fondos', 'REEMBOLSABLES'),
  (3, 303, 'Compra', 'HERRAMIENTAS'),
  (3, 304, 'Compra', 'INSUMOS Y REPUESTOS'),
  (3, 305, 'Compra', 'ACCESORIOS '),
  (3, 306, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (4, 401, 'Fondos', 'VIATICOS'),
  (4, 402, 'Fondos', 'REEMBOLSABLES'),
  (4, 403, 'Compra', 'HERRAMIENTAS'),
  (4, 404, 'Compra', 'INSUMOS Y REPUESTOS'),
  (4, 405, 'Compra', 'ACCESORIOS '),
  (4, 406, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (5, 501, 'Fondos', 'VIATICOS'),
  (5, 502, 'Fondos', 'REEMBOLSABLES'),
  (5, 503, 'Compra', 'HERRAMIENTAS'),
  (5, 504, 'Compra', 'INSUMOS Y REPUESTOS'),
  (5, 505, 'Compra', 'ACCESORIOS '),
  (5, 506, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (6, 601, 'Fondos', 'VIATICOS'),
  (6, 602, 'Fondos', 'REEMBOLSABLES'),
  (6, 603, 'Compra', 'HERRAMIENTAS'),
  (6, 604, 'Compra', 'INSUMOS Y REPUESTOS'),
  (6, 605, 'Compra', 'ACCESORIOS '),
  (6, 606, 'Compra', 'OTROS');


INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (7, 701, 'Fondos', 'VIATICOS'),
  (7, 702, 'Fondos', 'REEMBOLSABLES'),
  (7, 703, 'Compra', 'HERRAMIENTAS'),
  (7, 704, 'Compra', 'INSUMOS Y REPUESTOS'),
  (7, 705, 'Compra', 'ACCESORIOS '),
  (7, 706, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (8, 801, 'Fondos', 'VIATICOS'),
  (8, 802, 'Fondos', 'REEMBOLSABLES'),
  (8, 803, 'Compra', 'HERRAMIENTAS'),
  (8, 804, 'Compra', 'INSUMOS Y REPUESTOS'),
  (8, 805, 'Compra', 'ACCESORIOS '),
  (8, 806, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (9, 901, 'Fondos', 'VIATICOS'),
  (9, 902, 'Fondos', 'REEMBOLSABLES'),
  (9, 903, 'Compra', 'HERRAMIENTAS'),
  (9, 904, 'Compra', 'INSUMOS Y REPUESTOS'),
  (9, 905, 'Compra', 'ACCESORIOS '),
  (9, 906, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (10, 1001, 'Fondos', 'VIATICOS'),
  (10, 1002, 'Fondos', 'REEMBOLSABLES'),
  (10, 1003, 'Compra', 'HERRAMIENTAS'),
  (10, 1004, 'Compra', 'INSUMOS Y REPUESTOS'),
  (10, 1005, 'Compra', 'ACCESORIOS '),
  (10, 1006, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (11, 1101, 'Fondos', 'VIATICOS'),
  (11, 1102, 'Fondos', 'REEMBOLSABLES'),
  (11, 1103, 'Compra', 'HERRAMIENTAS'),
  (11, 1104, 'Compra', 'INSUMOS Y REPUESTOS'),
  (11, 1105, 'Compra', 'ACCESORIOS '),
  (11, 1106, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (12, 1201, 'Fondos', 'VIATICOS'),
  (12, 1202, 'Fondos', 'REEMBOLSABLES'),
  (12, 1203, 'Compra', 'HERRAMIENTAS'),
  (12, 1204, 'Compra', 'INSUMOS Y REPUESTOS'),
  (12, 1205, 'Compra', 'ACCESORIOS '),
  (12, 1206, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (13, 1301, 'Fondos', 'VIATICOS'),
  (13, 1302, 'Fondos', 'REEMBOLSABLES'),
  (13, 1303, 'Compra', 'HERRAMIENTAS'),
  (13, 1304, 'Compra', 'INSUMOS Y REPUESTOS'),
  (13, 1305, 'Compra', 'ACCESORIOS '),
  (13, 1306, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (14, 1401, 'Fondos', 'VIATICOS'),
  (14, 1402, 'Fondos', 'REEMBOLSABLES'),
  (14, 1403, 'Compra', 'HERRAMIENTAS'),
  (14, 1404, 'Compra', 'INSUMOS Y REPUESTOS'),
  (14, 1405, 'Compra', 'ACCESORIOS '),
  (14, 1406, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (15, 1501, 'Fondos', 'VIATICOS'),
  (15, 1502, 'Fondos', 'REEMBOLSABLES'),
  (15, 1503, 'Compra', 'HERRAMIENTAS'),
  (15, 1504, 'Compra', 'INSUMOS Y REPUESTOS'),
  (15, 1505, 'Compra', 'ACCESORIOS '),
  (15, 1506, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (16, 1601, 'Fondos', 'VIATICOS'),
  (16, 1602, 'Fondos', 'REEMBOLSABLES'),
  (16, 1603, 'Compra', 'HERRAMIENTAS'),
  (16, 1604, 'Compra', 'INSUMOS Y REPUESTOS'),
  (16, 1605, 'Compra', 'ACCESORIOS '),
  (16, 1606, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (17, 1701, 'Fondos', 'VIATICOS'),
  (17, 1702, 'Fondos', 'REEMBOLSABLES'),
  (17, 1703, 'Compra', 'HERRAMIENTAS'),
  (17, 1704, 'Compra', 'INSUMOS Y REPUESTOS'),
  (17, 1705, 'Compra', 'ACCESORIOS '),
  (17, 1706, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (18, 1801, 'Fondos', 'VIATICOS'),
  (18, 1802, 'Fondos', 'REEMBOLSABLES'),
  (18, 1803, 'Compra', 'HERRAMIENTAS'),
  (18, 1804, 'Compra', 'INSUMOS Y REPUESTOS'),
  (18, 1805, 'Compra', 'ACCESORIOS '),
  (18, 1806, 'Compra', 'OTROS');

INSERT INTO categ_chile (mina_cl_id, codigo, tipo, categoria) VALUES 
  (19, 1901, 'Fondos', 'VIATICOS'),
  (19, 1902, 'Fondos', 'REEMBOLSABLES'),
  (19, 1903, 'Compra', 'HERRAMIENTAS'),
  (19, 1904, 'Compra', 'INSUMOS Y REPUESTOS'),
  (19, 1905, 'Compra', 'ACCESORIOS '),
  (19, 1906, 'Compra', 'OTROS');





  INSERT INTO categ_peru (mina_pe_id, codigo, tipo, categoria) VALUES 
  (1, 101, 'Fondos', 'VIATICOS'),
  (1, 102, 'Fondos', 'REEMBOLSABLES'),
  (1, 103, 'Compra', 'HERRAMIENTAS'),
  (1, 104, 'Compra', 'INSUMOS Y REPUESTOS'),
  (1, 105, 'Compra', 'ACCESORIOS '),
  (1, 106, 'Compra', 'OTROS');

INSERT INTO categ_peru (mina_pe_id, codigo, tipo, categoria) VALUES 
  (2, 201, 'Fondos', 'VIATICOS'),
  (2, 202, 'Fondos', 'REEMBOLSABLES'),
  (2, 203, 'Compra', 'HERRAMIENTAS'),
  (2, 204, 'Compra', 'INSUMOS Y REPUESTOS'),
  (2, 205, 'Compra', 'ACCESORIOS '),
  (2, 206, 'Compra', 'OTROS');

INSERT INTO categ_peru (mina_pe_id, codigo, tipo, categoria) VALUES 
  (3, 301, 'Fondos', 'VIATICOS'),
  (3, 302, 'Fondos', 'REEMBOLSABLES'),
  (3, 303, 'Compra', 'HERRAMIENTAS'),
  (3, 304, 'Compra', 'INSUMOS Y REPUESTOS'),
  (3, 305, 'Compra', 'ACCESORIOS '),
  (3, 306, 'Compra', 'OTROS');

INSERT INTO categ_peru (mina_pe_id, codigo, tipo, categoria) VALUES 
  (4, 401, 'Fondos', 'VIATICOS'),
  (4, 402, 'Fondos', 'REEMBOLSABLES'),
  (4, 403, 'Compra', 'HERRAMIENTAS'),
  (4, 404, 'Compra', 'INSUMOS Y REPUESTOS'),
  (4, 405, 'Compra', 'ACCESORIOS '),
  (4, 406, 'Compra', 'OTROS');

INSERT INTO categ_peru (mina_pe_id, codigo, tipo, categoria) VALUES 
  (5, 501, 'Fondos', 'VIATICOS'),
  (5, 502, 'Fondos', 'REEMBOLSABLES'),
  (5, 503, 'Compra', 'HERRAMIENTAS'),
  (5, 504, 'Compra', 'INSUMOS Y REPUESTOS'),
  (5, 505, 'Compra', 'ACCESORIOS '),
  (5, 506, 'Compra', 'OTROS');

INSERT INTO categ_peru (mina_pe_id, codigo, tipo, categoria) VALUES 
  (6, 601, 'Fondos', 'VIATICOS'),
  (6, 602, 'Fondos', 'REEMBOLSABLES'),
  (6, 603, 'Compra', 'HERRAMIENTAS'),
  (6, 604, 'Compra', 'INSUMOS Y REPUESTOS'),
  (6, 605, 'Compra', 'ACCESORIOS '),
  (6, 606, 'Compra', 'OTROS');

INSERT INTO categ_peru (mina_pe_id, codigo, tipo, categoria) VALUES 
  (7, 701, 'Fondos', 'VIATICOS'),
  (7, 702, 'Fondos', 'REEMBOLSABLES'),
  (7, 703, 'Compra', 'HERRAMIENTAS'),
  (7, 704, 'Compra', 'INSUMOS Y REPUESTOS'),
  (7, 705, 'Compra', 'ACCESORIOS '),
  (7, 706, 'Compra', 'OTROS');

INSERT INTO categ_peru (mina_pe_id, codigo, tipo, categoria) VALUES 
  (8, 801, 'Fondos', 'VIATICOS'),
  (8, 802, 'Fondos', 'REEMBOLSABLES'),
  (8, 803, 'Compra', 'HERRAMIENTAS'),
  (8, 804, 'Compra', 'INSUMOS Y REPUESTOS'),
  (8, 805, 'Compra', 'ACCESORIOS '),
  (8, 806, 'Compra', 'OTROS');

INSERT INTO categ_peru (mina_pe_id, codigo, tipo, categoria) VALUES 
  (9, 901, 'Fondos', 'VIATICOS'),
  (9, 902, 'Fondos', 'REEMBOLSABLES'),
  (9, 903, 'Compra', 'HERRAMIENTAS'),
  (9, 904, 'Compra', 'INSUMOS Y REPUESTOS'),
  (9, 905, 'Compra', 'ACCESORIOS '),
  (9, 906, 'Compra', 'OTROS');

INSERT INTO categ_peru (mina_pe_id, codigo, tipo, categoria) VALUES 
  (10, 1001, 'Fondos', 'VIATICOS'),
  (10, 1002, 'Fondos', 'REEMBOLSABLES'),
  (10, 1003, 'Compra', 'HERRAMIENTAS'),
  (10, 1004, 'Compra', 'INSUMOS Y REPUESTOS'),
  (10, 1005, 'Compra', 'ACCESORIOS '),
  (10, 1006, 'Compra', 'OTROS');



INSERT INTO `os_chile` (`id`, `num_os`, `tipo`, `usuario`, `mina`, `categoria`, `item`, `cantidad`, `unidad`, `descripcion`, `proveedor`, `valor`, `estado`, `creado`, `actualizado`) VALUES
(1, '1', 'fondos', 'user_cl', '1700', '1701', 1, '', '', 'ALOJAMIENTO', '', '200000', 'Aprobado', '2023-03-31 05:19:01', '2023-03-31 00:22:38'),
(2, '1', 'fondos', 'user_cl', '1700', '1701', 2, '', '', 'VIATICO', '', '112000', 'Aprobado', '2023-03-31 05:19:01', '2023-03-31 00:22:38'),
(3, '1', 'fondos', 'user_cl', '1700', '1701', 3, '', '', 'MOVILIZACI&Oacute;N', '', '50000', 'Aprobado', '2023-03-31 05:19:01', '2023-03-31 00:22:38'),
(4, '2', 'fondos', 'user_cl', '300', '301', 1, '', '', 'COMBUSTIBLE VEHICULOS CLONSA', '', '600000', 'Rechazado', '2023-03-31 05:25:33', '2023-03-31 00:26:30'),
(5, '3', 'fondos', 'user_cl', '1300', '1301', 1, '', '', 'CONSUMO VIATICOS', '', '150000', 'En Proceso', '2023-03-31 05:30:22', '2023-03-31 00:30:22'),
(6, '3', 'fondos', 'user_cl', '1300', '1301', 2, '', '', 'MOVILIDAD', '', '100000', 'En Proceso', '2023-03-31 05:30:22', '2023-03-31 00:30:22'),
(7, '3', 'fondos', 'user_cl', '1300', '1301', 3, '', '', 'GAS COCHE AUTOMOVIL', '', '20000', 'En Proceso', '2023-03-31 05:30:22', '2023-03-31 00:30:22'),
(8, '3', 'fondos', 'user_cl', '1300', '1301', 4, '', '', 'HOSPEDAJE', '', '50000', 'En Proceso', '2023-03-31 05:30:22', '2023-03-31 00:30:22'),
(9, '4', 'fondos', 'user_cl', '700', '701', 1, '', '', 'COSTES ROMERAL', '', '20000', 'En Proceso', '2023-03-31 05:32:44', '2023-03-31 00:32:44'),
(10, '4', 'fondos', 'user_cl', '700', '701', 2, '', '', 'PASAJES AEREOS', '', '10000', 'En Proceso', '2023-03-31 05:32:44', '2023-03-31 00:32:44'),
(11, '4', 'fondos', 'user_cl', '700', '701', 3, '', '', 'ALOJAMIENTO', '', '50000', 'En Proceso', '2023-03-31 05:32:44', '2023-03-31 00:32:44'),
(12, '4', 'fondos', 'user_cl', '700', '701', 4, '', '', 'OTROS', '', '45000', 'En Proceso', '2023-03-31 05:32:44', '2023-03-31 00:32:44'),
(13, '5', 'fondos', 'user_cl', '800', '801', 1, '', '', 'Movilidad', '', '100000', 'En Proceso', '2023-03-31 05:34:38', '2023-03-31 00:34:38'),
(14, '5', 'fondos', 'user_cl', '800', '801', 2, '', '', 'Gastos Alimentos', '', '50000', 'En Proceso', '2023-03-31 05:34:38', '2023-03-31 00:34:38'),
(15, '5', 'fondos', 'user_cl', '800', '801', 3, '', '', 'Vuelos &Aacute;ereos', '', '30000', 'En Proceso', '2023-03-31 05:34:38', '2023-03-31 00:34:38'),
(16, '5', 'fondos', 'user_cl', '800', '801', 4, '', '', 'Otros', '', '15000', 'En Proceso', '2023-03-31 05:34:38', '2023-03-31 00:34:38'),
(17, '6', 'fondos', 'user_cl', '500', '501', 1, '', '', 'GASTOS MEDICOS', '', '40000', 'En Proceso', '2023-03-31 05:35:59', '2023-03-31 00:35:59'),
(18, '6', 'fondos', 'user_cl', '500', '501', 2, '', '', 'GASTOS PRUEBA DE COVID', '', '35000', 'En Proceso', '2023-03-31 05:35:59', '2023-03-31 00:35:59'),
(19, '6', 'fondos', 'user_cl', '500', '501', 3, '', '', 'MOVILIDAD', '', '10000', 'En Proceso', '2023-03-31 05:35:59', '2023-03-31 00:35:59'),
(20, '6', 'fondos', 'user_cl', '500', '501', 4, '', '', 'COMBUSTIBLES 1X', '', '25000', 'En Proceso', '2023-03-31 05:35:59', '2023-03-31 00:35:59'),
(21, '7', 'compra', 'user_cl', '1500', '1503', 1, '10', 'Metro', 'CABLE RJ45 CAT 6A', 'NET TEC CL', '150000', 'En Proceso', '2023-03-31 05:38:50', '2023-03-31 00:38:50'),
(22, '7', 'compra', 'user_cl', '1500', '1503', 2, '20', 'Metro', 'CABLE DE SOLDAR INDUSTRIAL AWG 50', 'SONTEC CL', '30500', 'En Proceso', '2023-03-31 05:38:50', '2023-03-31 00:38:50'),
(23, '7', 'compra', 'user_cl', '1500', '1503', 3, '5', 'Kilo', 'ESTA&Ntilde;O SOLDADURA', 'FERRETEC CL', '20000', 'En Proceso', '2023-03-31 05:38:50', '2023-03-31 00:38:50'),
(24, '8', 'compra', 'user_cl', '900', '903', 1, '90', 'Metro', 'SILICONA SINTETICA', 'MISOTEC ', '50000', 'En Proceso', '2023-03-31 05:45:47', '2023-03-31 00:45:47'),
(25, '8', 'compra', 'user_cl', '900', '903', 2, '1', 'Litro', 'Gas  Natural', 'KOLTEC', '20300', 'En Proceso', '2023-03-31 05:45:47', '2023-03-31 00:45:47'),
(26, '8', 'compra', 'user_cl', '900', '903', 3, '5', 'Kilo', 'Tornillos 8&quot;', 'FERRYTEC', '12000', 'En Proceso', '2023-03-31 05:45:47', '2023-03-31 00:45:47'),
(27, '9', 'compra', 'user_cl', '600', '603', 1, '15', 'Metro', 'SECTION METRICO', 'KAULTERS', '156000', 'En Proceso', '2023-03-31 05:47:15', '2023-03-31 00:47:15'),
(28, '10', 'compra', 'user_cl', '1100', '1103', 1, '60', 'Metro', 'CABLE SISTEMA ELECTRICO 9AWG COBRE ALTO IMPACTO', 'ELETRICSCT', '120000', 'En Proceso', '2023-03-31 05:48:06', '2023-03-31 00:48:06');


INSERT INTO `os_peru` (`id`, `num_os`, `tipo`, `usuario`, `mina`, `categoria`, `item`, `cantidad`, `unidad`, `descripcion`, `proveedor`, `valor`, `estado`, `creado`, `actualizado`) VALUES
(1, '1', 'fondos', 'user_pe', '1700', '1701', 1, '', '', 'ALOJAMIENTO', '', '200000', 'Aprobado', '2023-03-31 05:19:01', '2023-03-31 00:22:38'),
(2, '1', 'fondos', 'user_pe', '1700', '1701', 2, '', '', 'VIATICO', '', '112000', 'Aprobado', '2023-03-31 05:19:01', '2023-03-31 00:22:38'),
(3, '1', 'fondos', 'user_pe', '1700', '1701', 3, '', '', 'MOVILIZACI&Oacute;N', '', '50000', 'Aprobado', '2023-03-31 05:19:01', '2023-03-31 00:22:38'),
(4, '2', 'fondos', 'user_pe', '300', '301', 1, '', '', 'COMBUSTIBLE VEHICULOS CLONSA', '', '600000', 'Rechazado', '2023-03-31 05:25:33', '2023-03-31 00:26:30'),
(5, '3', 'fondos', 'user_pe', '1300', '1301', 1, '', '', 'CONSUMO VIATICOS', '', '150000', 'En Proceso', '2023-03-31 05:30:22', '2023-03-31 00:30:22'),
(6, '3', 'fondos', 'user_pe', '1300', '1301', 2, '', '', 'MOVILIDAD', '', '100000', 'En Proceso', '2023-03-31 05:30:22', '2023-03-31 00:30:22'),
(7, '3', 'fondos', 'user_pe', '1300', '1301', 3, '', '', 'GAS COCHE AUTOMOVIL', '', '20000', 'En Proceso', '2023-03-31 05:30:22', '2023-03-31 00:30:22'),
(8, '3', 'fondos', 'user_pe', '1300', '1301', 4, '', '', 'HOSPEDAJE', '', '50000', 'En Proceso', '2023-03-31 05:30:22', '2023-03-31 00:30:22'),
(9, '4', 'fondos', 'user_pe', '700', '701', 1, '', '', 'COSTES ROMERAL', '', '20000', 'En Proceso', '2023-03-31 05:32:44', '2023-03-31 00:32:44'),
(10, '4', 'fondos', 'user_pe', '700', '701', 2, '', '', 'PASAJES AEREOS', '', '10000', 'En Proceso', '2023-03-31 05:32:44', '2023-03-31 00:32:44'),
(11, '4', 'fondos', 'user_pe', '700', '701', 3, '', '', 'ALOJAMIENTO', '', '50000', 'En Proceso', '2023-03-31 05:32:44', '2023-03-31 00:32:44'),
(12, '4', 'fondos', 'user_pe', '700', '701', 4, '', '', 'OTROS', '', '45000', 'En Proceso', '2023-03-31 05:32:44', '2023-03-31 00:32:44'),
(13, '5', 'fondos', 'user_pe', '800', '801', 1, '', '', 'Movilidad', '', '100000', 'En Proceso', '2023-03-31 05:34:38', '2023-03-31 00:34:38'),
(14, '5', 'fondos', 'user_pe', '800', '801', 2, '', '', 'Gastos Alimentos', '', '50000', 'En Proceso', '2023-03-31 05:34:38', '2023-03-31 00:34:38'),
(15, '5', 'fondos', 'user_pe', '800', '801', 3, '', '', 'Vuelos &Aacute;ereos', '', '30000', 'En Proceso', '2023-03-31 05:34:38', '2023-03-31 00:34:38'),
(16, '5', 'fondos', 'user_pe', '800', '801', 4, '', '', 'Otros', '', '15000', 'En Proceso', '2023-03-31 05:34:38', '2023-03-31 00:34:38'),
(17, '6', 'fondos', 'user_pe', '500', '501', 1, '', '', 'GASTOS MEDICOS', '', '40000', 'En Proceso', '2023-03-31 05:35:59', '2023-03-31 00:35:59'),
(18, '6', 'fondos', 'user_pe', '500', '501', 2, '', '', 'GASTOS PRUEBA DE COVID', '', '35000', 'En Proceso', '2023-03-31 05:35:59', '2023-03-31 00:35:59'),
(19, '6', 'fondos', 'user_pe', '500', '501', 3, '', '', 'MOVILIDAD', '', '10000', 'En Proceso', '2023-03-31 05:35:59', '2023-03-31 00:35:59'),
(20, '6', 'fondos', 'user_pe', '500', '501', 4, '', '', 'COMBUSTIBLES 1X', '', '25000', 'En Proceso', '2023-03-31 05:35:59', '2023-03-31 00:35:59'),
(21, '7', 'compra', 'user_pe', '1500', '1503', 1, '10', 'Metro', 'CABLE RJ45 CAT 6A', 'NET TEC CL', '150000', 'En Proceso', '2023-03-31 05:38:50', '2023-03-31 00:38:50'),
(22, '7', 'compra', 'user_pe', '1500', '1503', 2, '20', 'Metro', 'CABLE DE SOLDAR INDUSTRIAL AWG 50', 'SONTEC CL', '30500', 'En Proceso', '2023-03-31 05:38:50', '2023-03-31 00:38:50'),
(23, '7', 'compra', 'user_pe', '1500', '1503', 3, '5', 'Kilo', 'ESTA&Ntilde;O SOLDADURA', 'FERRETEC CL', '20000', 'En Proceso', '2023-03-31 05:38:50', '2023-03-31 00:38:50'),
(24, '8', 'compra', 'user_pe', '900', '903', 1, '90', 'Metro', 'SILICONA SINTETICA', 'MISOTEC ', '50000', 'En Proceso', '2023-03-31 05:45:47', '2023-03-31 00:45:47'),
(25, '8', 'compra', 'user_pe', '900', '903', 2, '1', 'Litro', 'Gas  Natural', 'KOLTEC', '20300', 'En Proceso', '2023-03-31 05:45:47', '2023-03-31 00:45:47'),
(26, '8', 'compra', 'user_pe', '900', '903', 3, '5', 'Kilo', 'Tornillos 8&quot;', 'FERRYTEC', '12000', 'En Proceso', '2023-03-31 05:45:47', '2023-03-31 00:45:47'),
(27, '9', 'compra', 'user_pe', '600', '603', 1, '15', 'Metro', 'SECTION METRICO', 'KAULTERS', '156000', 'En Proceso', '2023-03-31 05:47:15', '2023-03-31 00:47:15'),
(28, '10', 'compra', 'user_pe', '1100', '1103', 1, '60', 'Metro', 'CABLE SISTEMA ELECTRICO 9AWG COBRE ALTO IMPACTO', 'ELETRICSCT', '120000', 'En Proceso', '2023-03-31 05:48:06', '2023-03-31 00:48:06');

create table unidades (
  id INT NOT NULL AUTO_INCREMENT,
  sede VARCHAR(10) NOT NULL,
  unidad VARCHAR(30) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO unidades (sede,unidad) VALUES 
  ('Peru', 'Metro'),
  ('Peru', 'Kilo'),
  ('Chile', 'Metro'),
  ('Chile', 'Kilo');





INSERT INTO `os_peru` (`num_os`, `tipo`, `usuario`, `mina`, `categoria`, `item`, `cantidad`, `unidad`, `descripcion`, `proveedor`, `valor`, `estado`, `creado`, `actualizado`) VALUES
('1', 'compra', 'user_pe', '100', '103', 1, '3', 'Metro', 'CABLE DE COBRE AWG 10 ', 'SAC', '1500', 'En Proceso', '2023-04-08 17:31:29', '2023-04-08 12:31:29'),
('2', 'compra', 'user_pe', '900', '903', 1, '8', 'Kilo', 'COBRE TRENZADO', 'SAC', '4888', 'En Proceso', '2023-04-08 17:35:46', '2023-04-08 12:35:46'),
('3', 'fondos', 'user_pe', '400', '401', 1, '', '', 'VIATICOS ', '', '1580', 'En Proceso', '2023-04-08 17:37:03', '2023-04-08 12:37:03'),
('4', 'fondos', 'user_pe', '500', '502', 1, '', '', 'PERSONALES', '', '1500', 'En Proceso', '2023-04-08 17:40:20', '2023-04-08 12:40:20'),
('5', 'compra', 'user_pe', '200', '203', 1, '6', 'Metro', 'PROTECTOR ANTIBAS', 'SAC', '1500', 'En Proceso', '2023-04-08 17:44:23', '2023-04-08 12:44:23'),
('5', 'compra', 'user_pe', '200', '203', 2, '12', 'Metro', 'BAS TEC', 'PRIN', '1000', 'En Proceso', '2023-04-08 17:44:23', '2023-04-08 12:44:23'),
('6', 'fondos', 'user_pe', '700', '701', 1, '', '', 'MATERIALES BASICOS RED', '', '500', 'En Proceso', '2023-04-08 17:46:55', '2023-04-08 12:46:55'),
('6', 'fondos', 'user_pe', '700', '701', 2, '', '', 'PRUEBA DE RED TESTE', '', '100', 'En Proceso', '2023-04-08 17:46:55', '2023-04-08 12:46:55'),
('7', 'fondos', 'user_pe', '800', '801', 1, '', '', 'VIATICOS PRIMARIOS', '', '1200', 'En Proceso', '2023-04-08 17:49:28', '2023-04-08 12:49:28'),
('7', 'fondos', 'user_pe', '800', '801', 2, '', '', 'COMBUSTIBLE AUTOMOVIL', '', '120', 'En Proceso', '2023-04-08 17:49:28', '2023-04-08 12:49:28'),
('8', 'compra', 'user_pe', '600', '603', 1, '18', 'Metro', 'TOMA CORRIENTE', 'PLIMTEC', '430', 'En Proceso', '2023-04-08 17:56:06', '2023-04-08 12:56:06'),
('9', 'fondos', 'user_pe', '700', '701', 1, '', '', 'Servicios Primarios', '', '2600', 'En Proceso', '2023-04-08 17:57:39', '2023-04-08 12:57:39'),
('9', 'fondos', 'user_pe', '700', '701', 2, '', '', 'Servicios de Movilidad', '', '150', 'En Proceso', '2023-04-08 17:57:39', '2023-04-08 12:57:39'),
('10', 'fondos', 'user_pe', '700', '701', 1, '', '', 'AGRO INDUSTRIAL SERVICIOS', '', '1500', 'En Proceso', '2023-04-08 17:59:43', '2023-04-08 12:59:43'),
('10', 'fondos', 'user_pe', '700', '701', 2, '', '', 'MOVILIDAD', '', '140', 'En Proceso', '2023-04-08 17:59:43', '2023-04-08 12:59:43');


INSERT INTO `os_chile` (`num_os`, `tipo`, `usuario`, `mina`, `categoria`, `item`, `cantidad`, `unidad`, `descripcion`, `proveedor`, `valor`, `estado`, `creado`, `actualizado`) VALUES
('1', 'compra', 'user_cl', '100', '103', 1, '2', 'Metro', 'CABLE DE COBRE AWG 10 ', 'SAC', '10000', 'En Proceso', '2023-04-08 17:32:55', '2023-04-08 12:32:55'),
('2', 'compra', 'user_cl', '400', '403', 1, '10', 'Metro', 'COBRE TRENZADO', 'SAC', '160000', 'En Proceso', '2023-04-08 17:35:45', '2023-04-08 12:35:45'),
('3', 'fondos', 'user_cl', '800', '801', 1, '', '', 'VIATICOS PERSONALES', '', '100000', 'En Proceso', '2023-04-08 17:37:02', '2023-04-08 12:37:02'),
('4', 'fondos', 'user_cl', '1100', '1101', 1, '', '', 'COMBUSTIBLE CARRO', '', '230000', 'En Proceso', '2023-04-08 17:40:19', '2023-04-08 12:40:19'),
('4', 'fondos', 'user_cl', '1100', '1101', 2, '', '', 'PASAJES AEREOS', '', '10000', 'En Proceso', '2023-04-08 17:40:19', '2023-04-08 12:40:19'),
('5', 'compra', 'user_cl', '700', '703', 1, '3', 'Metro', 'PROTECTOR ANTIBAS', 'Ssac', '23000', 'En Proceso', '2023-04-08 17:44:22', '2023-04-08 12:44:22'),
('5', 'compra', 'user_cl', '700', '703', 2, '50', 'Metro', 'bas tec', '50 CENT', '150000', 'En Proceso', '2023-04-08 17:44:22', '2023-04-08 12:44:22'),
('6', 'fondos', 'user_cl', '900', '901', 1, '', '', 'MATERIALES BASICOS RED', '', '15000', 'En Proceso', '2023-04-08 17:46:56', '2023-04-08 12:46:56'),
('6', 'fondos', 'user_cl', '900', '901', 2, '', '', 'PRUEBA DE RED TESTE', '', '1500', 'En Proceso', '2023-04-08 17:46:56', '2023-04-08 12:46:56'),
('7', 'fondos', 'user_cl', '500', '501', 1, '', '', 'VIATICOS PRIMARIOS', '', '132000', 'En Proceso', '2023-04-08 17:49:27', '2023-04-08 12:49:27'),
('7', 'fondos', 'user_cl', '500', '501', 2, '', '', 'COMBUSTIBLE CARRO', '', '14000', 'En Proceso', '2023-04-08 17:49:27', '2023-04-08 12:49:27'),
('8', 'compra', 'user_cl', '600', '603', 1, '5', 'Metro', 'TOMA CORRIENTE TRENZADO', 'PLIMTEC', '50000', 'En Proceso', '2023-04-08 17:56:07', '2023-04-08 12:56:07'),
('9', 'fondos', 'user_cl', '1000', '1001', 1, '', '', 'Servicios Primarios', '', '15000', 'En Proceso', '2023-04-08 17:57:40', '2023-04-08 12:57:40'),
('9', 'fondos', 'user_cl', '1000', '1001', 2, '', '', 'Servicios de Movilidad', '', '4200', 'En Proceso', '2023-04-08 17:57:40', '2023-04-08 12:57:40'),
('9', 'fondos', 'user_cl', '1000', '1001', 3, '', '', 'Gas vehicular', '', '15000', 'En Proceso', '2023-04-08 17:57:40', '2023-04-08 12:57:40'),
('10', 'fondos', 'user_cl', '1300', '1301', 1, '', '', 'ON PREMISE SERVICE', '', '140000', 'En Proceso', '2023-04-08 17:59:42', '2023-04-08 12:59:42'),
('10', 'fondos', 'user_cl', '1300', '1301', 2, '', '', 'VIAJES SUB MINA INTERNA', '', '1300', 'En Proceso', '2023-04-08 17:59:42', '2023-04-08 12:59:42');

--



INSERT INTO `obs_pe` (`id`, `num_os`, `observaciones`, `creado`) VALUES
(1, '1', 'Ninguna', '2023-04-08 17:31:29'),
(2, '2', 'Ninguna', '2023-04-08 17:35:46'),
(3, '3', 'Ninguna', '2023-04-08 17:37:03'),
(4, '4', 'Ninguna', '2023-04-08 17:40:20'),
(5, '5', 'Ninguna', '2023-04-08 17:44:23'),
(6, '6', 'NINGUNA', '2023-04-08 17:46:55'),
(7, '7', 'SIN OBERSACIONES', '2023-04-08 17:49:28'),
(8, '8', 'Sin Obervaciones', '2023-04-08 17:56:06'),
(9, '9', 'Sin obervaciones', '2023-04-08 17:57:39'),
(10, '10', 'SIN OBSERVACIONES', '2023-04-08 17:59:43');




INSERT INTO `obs_cl` (`id`, `num_os`, `observaciones`, `creado`) VALUES
(1, '1', 'Ninguna', '2023-04-08 17:32:55'),
(2, '2', 'Ninguna', '2023-04-08 17:35:45'),
(3, '3', 'Ninguna', '2023-04-08 17:37:02'),
(4, '4', 'Ninguna', '2023-04-08 17:40:19'),
(5, '5', 'Ninguna', '2023-04-08 17:44:22'),
(6, '6', 'NINGUNA', '2023-04-08 17:46:56'),
(7, '7', 'SIN OBERSERVACIONES', '2023-04-08 17:49:27'),
(8, '8', 'Sin Obervaciones', '2023-04-08 17:56:07'),
(9, '9', 'Sin obervaciones', '2023-04-08 17:57:40'),
(10, '10', 'SIN OBSERVACIONES', '2023-04-08 17:59:42');

--

INSERT INTO `enlaces_pe` (`id`, `num_os`, `enlace`, `creado`) VALUES
(1, '1', 'https://listado.mercadolibre.com.pe/cable-awg', '2023-04-08 17:31:29'),
(2, '2', 'https://listado.mercadolibre.com.pe/cobre#D[A:cobre]', '2023-04-08 17:35:46'),
(3, '3', '', '2023-04-08 17:37:03'),
(4, '4', '', '2023-04-08 17:40:20'),
(5, '5', 'https://articulo.mercadolibre.com.pe/MPE-430015442-moneda-unc-tumi-de-oro-2010-riqueza-y-orgullo-del', '2023-04-08 17:44:23'),
(6, '6', '', '2023-04-08 17:46:55'),
(7, '7', '', '2023-04-08 17:49:28'),
(8, '8', 'https://articulo.mercadolibre.com.pe/MPE-621248218-extension-toma-corriente-con-obturador-3-usb-5-so', '2023-04-08 17:56:06'),
(9, '9', '', '2023-04-08 17:57:39'),
(10, '10', '', '2023-04-08 17:59:43');

--


INSERT INTO `enlaces_cl` (`id`, `num_os`, `enlace`, `creado`) VALUES
(1, '1', ' https://listado.mercadolibre.com.pe/cable-awg', '2023-04-08 17:32:55'),
(2, '2', 'https://listado.mercadolibre.com.pe/cobre#D[A:cobre]', '2023-04-08 17:35:45'),
(3, '3', '', '2023-04-08 17:37:02'),
(4, '4', '', '2023-04-08 17:40:19'),
(5, '5', 'https://articulo.mercadolibre.com.pe/MPE-430015442-moneda-unc-tumi-de-oro-2010-riqueza-y-orgullo-del', '2023-04-08 17:44:22'),
(6, '6', '', '2023-04-08 17:46:56'),
(7, '7', '', '2023-04-08 17:49:27'),
(8, '8', 'https://articulo.mercadolibre.com.pe/MPE-621248218-extension-toma-corriente-con-obturador-3-usb-5-so', '2023-04-08 17:56:07'),
(9, '9', '', '2023-04-08 17:57:40'),
(10, '10', '', '2023-04-08 17:59:42');

--
-- Índices para


INSERT INTO `adjuntos_pe` (`id`, `num_os`, `archivo`, `creado`) VALUES
(1, '1', '/files/pe/1/RP.txt', '2023-04-08 17:31:29'),
(2, '2', '/files/pe/2/RP.txt', '2023-04-08 17:35:46'),
(3, '3', '/files/pe/3/h9vwwrd6-1-200x200.png', '2023-04-08 17:37:03'),
(4, '4', '/files/pe/4/po.png', '2023-04-08 17:40:20'),
(5, '5', '/files/pe/5/RP.txt', '2023-04-08 17:44:23'),
(6, '6', '/files/pe/6/RP.txt', '2023-04-08 17:46:55'),
(7, '7', '/files/pe/7/RP.txt', '2023-04-08 17:49:28'),
(8, '8', '/files/pe/8/RP.txt', '2023-04-08 17:56:06'),
(9, '9', '/files/pe/9/RP.txt', '2023-04-08 17:57:39'),
(10, '10', '/files/pe/10/RP.txt', '2023-04-08 17:59:43');

--

INSERT INTO `adjuntos_cl` (`id`, `num_os`, `archivo`, `creado`) VALUES
(1, '1', '/files/cl/1/RP.txt', '2023-04-08 17:32:55'),
(2, '2', '/files/cl/2/RP.txt', '2023-04-08 17:35:45'),
(3, '3', '/files/cl/3/RP.txt', '2023-04-08 17:37:02'),
(4, '4', '/files/cl/4/RP.txt', '2023-04-08 17:40:19'),
(5, '5', '/files/cl/5/RP.txt', '2023-04-08 17:44:22'),
(6, '6', '/files/cl/6/RP.txt', '2023-04-08 17:46:56'),
(7, '7', '/files/cl/7/RP.txt', '2023-04-08 17:49:27'),
(8, '8', '/files/cl/8/RP.txt', '2023-04-08 17:56:07'),
(9, '9', '/files/cl/9/RP.txt', '2023-04-08 17:57:40'),
(10, '10', '/files/cl/10/RP.txt', '2023-04-08 17:59:42');

--
-- Índices para tablas volcadas
--
