create database sistema_sos character set utf8 collate utf8_general_ci;

use sistema_sos;

CREATE TABLE logs (
  id INT NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(150) NOT NULL,
  password VARCHAR(150) NOT NULL,
  estado VARCHAR(15) NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)ENGINE=INNODB;

CREATE TABLE roles (
  id INT NOT NULL AUTO_INCREMENT,
  rol VARCHAR(30) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO roles (rol) VALUES ('Administrador');
INSERT INTO roles (rol) VALUES ('Coordinador');
INSERT INTO roles (rol) VALUES ('Encargado');
INSERT INTO roles (rol) VALUES ('Usuario');

CREATE TABLE sedes (
  id INT NOT NULL AUTO_INCREMENT,
  sede VARCHAR(20) NOT NULL,
  PRIMARY KEY(id)
)ENGINE=INNODB;

INSERT INTO sedes (sede) VALUES ('Peru');
INSERT INTO sedes (sede) VALUES ('Chile');

CREATE TABLE supervisores (
  id INT NOT NULL AUTO_INCREMENT,
  sede_id INT NOT NULL,
  tipo VARCHAR (30) NOT NULL,
  funcion VARCHAR (30) NOT NULL,
  usuario VARCHAR(100) NOT NULL,
  nombre VARCHAR (200) NOT NULL,
  email VARCHAR(200) NOT NULL,
  PRIMARY KEY (id)  
)ENGINE=INNODB;


insert into `supervisores` (`sede_id`, `tipo`, `funcion`, `usuario`, `nombre`, `email`) values(1,'Compra','sup_1', 'ejimenez', 'Enzo Jimenez','jluis@clonsa.com');
insert into `supervisores` (`sede_id`, `tipo`, `funcion`, `usuario`, `nombre`, `email`) values(1,'Compra','sup_2','hmorales', 'Hans Morales','');
insert into `supervisores` (`sede_id`, `tipo`, `funcion`, `usuario`, `nombre`, `email`) values(1,'Fondos','sup_1','fduran','Francisco Duran','');
insert into `supervisores` (`sede_id`, `tipo`, `funcion`, `usuario`, `nombre`, `email`) values(1,'Fondos','sup_2','fduran','Francisco Duran','');
insert into `supervisores` (`sede_id`, `tipo`, `funcion`, `usuario`, `nombre`, `email`) values(1,'Caja','', 'fduran', 'Francisco Duran','jtunoquesa@unprg.edu.pe');
insert into `supervisores` (`sede_id`, `tipo`, `funcion`, `usuario`, `nombre`, `email`) values(2,'Compra','sup_1', 'jcvaldivia', 'Juan Carlos Valdivia','');
insert into `supervisores` (`sede_id`, `tipo`, `funcion`, `usuario`, `nombre`, `email`) values(2,'Compra','sup_2', 'vcastillo', 'Victor Castillo','');
insert into `supervisores` (`sede_id`, `tipo`, `funcion`, `usuario`, `nombre`, `email`) values(2,'Fondos','sup_1', 'jcvaldivia', 'Juan Carlos Valdivia','');
insert into `supervisores` (`sede_id`, `tipo`, `funcion`, `usuario`, `nombre`, `email`) values(2,'Fondos','sup_2', 'eporras', 'Enrique Porras','');


CREATE TABLE unidades (
  id INT NOT NULL AUTO_INCREMENT,
  sede_id INT NOT NULL,
  unidad VARCHAR(90) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

insert into `unidades` (`sede_id`, `unidad`) values(1,'Metro');
insert into `unidades` (`sede_id`, `unidad`) values(1,'Kilo');
insert into `unidades` (`sede_id`, `unidad`) values(1,'Pulgadas');
insert into `unidades` (`sede_id`, `unidad`) values(1,'Metro Cuadrado');
insert into `unidades` (`sede_id`, `unidad`) values(1,'Otro(s)');
insert into `unidades` (`sede_id`, `unidad`) values(1,'1/4 Galón');
insert into `unidades` (`sede_id`, `unidad`) values(1,'Pulgadas');
insert into `unidades` (`sede_id`, `unidad`) values(1,'Planchas');
insert into `unidades` (`sede_id`, `unidad`) values(1,'Piezas');
insert into `unidades` (`sede_id`, `unidad`) values(2,'Metro');
insert into `unidades` (`sede_id`, `unidad`) values(2,'Kilo');


create table usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  rol_id INT NOT NULL,
  sede_id INT NOT NULL,
  funcion VARCHAR(50) NOT NULL,
  codigo VARCHAR(50) NOT NULL,  
  nombre VARCHAR(100) NOT NULL,
  usuario VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(150) NOT NULL,
  status INT NOT NULL,
  createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_rol_id_usuario
  FOREIGN KEY (rol_id)
  REFERENCES roles (id),
  CONSTRAINT fk_sede_id_usuario
  FOREIGN KEY (sede_id)
  REFERENCES sedes (id)
)ENGINE=INNODB;

insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('1','1','','','Administrador','admin','admin@clonsa.com','$2y$10$RAGa5VyFZ.CFbO8mGu53l.TZmmeDKxNG7Oxt27vwWcBfNQvc6HOgy',1,'2023-03-26 12:10:28');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('2','1','','','Coord_pe','coord_pe','coor@clonsa.com','$2y$10$RAGa5VyFZ.CFbO8mGu53l.TZmmeDKxNG7Oxt27vwWcBfNQvc6HOgy',1,'2023-03-26 12:10:28');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('3','1','Supervisor','GER-1','Francisco Duran','fduran','enc1@clonsa.com','$2y$10$HcoK22YdITxOivxCgGiXj.oL0VOH71iUJ/PIUH6Gk/tMrH0A79rOu',1,'2023-03-26 12:10:28');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('3','1','Supervisor','ADM-1','Enzo Jimenez','ejimenez','enc2@clonsa.com','$2y$10$jMPYq5vxfPf.6PLIAKgEKO3hDPDcSmqngIWfGzHbNAoWhO4TJPCdC',1,'2023-03-26 12:10:28');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('4','1','Normal','','User_pe1','user_pe','usuario@clonsa.com','$2y$10$PvbtZ2HGcemkXy8w4EBPTe38N8Xp4MonOHU2ehhD.p8DI8ZjC05Xe',1,'2023-03-26 12:10:28');

insert into `usuarios` ( `rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('2','2','','','Coord_cl2','coord_cl','coor@clonsa.com','$2y$10$mJiekp6khMAUZTm6vsbk8u1ve1a2Mb2mYL9GQ45qvcJtjmF2.LT1C',1,'2023-03-26 12:10:28');

insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('3','2','Supervisor','','Juan Carlos Valdivia','jcvaldivia','enc1@clonsa.com','$2y$10$r2eXcFXdpvN7rob/Ul6a8ehXbOytP9DLXTTyXNLgAd3aORvjyd0RS',1,'2023-03-26 12:10:28');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('3','2','Supervisor','','Victor Castillo','vcastillo','enc2@clonsa.com','$2y$10$tBPnQgg5npX0y99r627c6OBWYK3WQGbc/lV2b2kyd7l3DjeH3DLfa',1,'2023-03-26 12:10:28');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('4','2','Normal','','User_cl','user_cl','usuario@clonsa.com','$2y$10$NN6rkSBSF5brujv11kJvQ.GKnnwMxxgh47Cj7LZDw/iibVM7A//Gy',1,'2023-03-26 12:10:28');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('3','1','Supervisor','ASI-1','Hans Morales2','hmorales','hmorales@g.com','$2y$10$.baDmJgoBEZ2fnRD7UfliOVpV2rtQJ0ELJi9g0YL99K/IMF6Y1LBy',1,'2023-03-27 08:58:19');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('3','2','Supervisor','','Enrique Porras','eporras','eporras@g.com','$2y$10$ZfCtTILcyHue4T64Xsml.eR4yMYKPi618jxOW2T1sLO6ocUvn3sL.',1,'2023-03-27 09:02:26');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('3','1','Revisor','','Ivan Rodriguez','irodriguez','jtunoquesa@unprg.edu.pe','$2y$10$AHi/mOAIqP/aERwkbXi5Qe1wDjFbGtgRr/ZFgRS0NbV/VNHM78f0q',1,'2023-08-08 10:40:55');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('3','1','Revisor','','Jose Almenares','jalmenares','jtunoquesa@unprg.edu.pe','$2y$10$yUSeAMgYCk4U7L7s29m2JOS12QXDK7VwFCJ2lUYt5dBSFDHXlpcFC',1,'2023-08-08 10:47:49');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('3','1','Normal','','Amador Contreras','acontreras','jtunoquesa@unprg.edu.pe','$2y$10$61N79IeItqgYaDUawDp9XOTHzsit.1XHKDLN7wKhFLEV.TGYZtd3a',1,'2023-08-08 10:56:51');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('3','1','Normal','','Fernando Quispe','fquispe','jtunoquesa@unprg.edu.pe','$2y$10$6MG4bLw8lqCTfK.2XJ6yb.g1Cbbm18wgpasP0m1Mv9QioYQ587UWu',1,'2023-08-08 10:57:23');
insert into `usuarios` (`rol_id`, `sede_id`, `funcion`, `codigo`, `nombre`, `usuario`, `email`, `password`, `status`, `createdAt`) values('3','1','Normal','','Luis Ruiz','lruiz','jtunoquesa@unprg.edu.pe','$2y$10$U0d/1GrCo982Hw/Ca46qzuJ43gwYMXUr4HAUl1MPWkpLLBZAziHmW',1,'2023-08-08 10:57:38');


CREATE TABLE pe_minas (
  id INT NOT NULL AUTO_INCREMENT,
  sede_id INT NOT NULL,
  codigo INT NOT NULL,
  mina VARCHAR(150) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_sede_id_pe_mina
  FOREIGN KEY (sede_id)
  REFERENCES sedes (id)
)ENGINE=INNODB;

INSERT INTO pe_minas (sede_id, codigo, mina) VALUES 
  (1, 100, 'ADMINISTRACION'),
  (1, 200, 'MARCOBRE'),
  (1, 300, 'CUAJONE'),
  (1, 400, 'BUENAVENTURA'),
  (1, 500, 'HUDBAY '),
  (1, 600, 'CHINALCO'),
  (1, 700, 'YANACOCHA '),
  (1, 800, 'ANTAPACCAY '),
  (1, 900, 'LAS BAMBAS'),
  (1, 1000, 'ANTAMINA');

CREATE TABLE pe_minas_categ (
  id INT NOT NULL AUTO_INCREMENT,
  mina_id INT NOT NULL,
  codigo INT NOT NULL,
  tipo VARCHAR(20) NOT NULL,
  categoria VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_mina_id_pe_categ
  FOREIGN KEY (mina_id)
  REFERENCES pe_minas (id)
)ENGINE=INNODB;

CREATE TABLE pe_adjuntos (
  id INT NOT NULL AUTO_INCREMENT,
  num_os VARCHAR(20) NOT NULL,
  archivo VARCHAR(100) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE pe_enlaces (
  id INT NOT NULL AUTO_INCREMENT,
  num_os VARCHAR(20) NOT NULL,
  enlace TEXT NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE pe_obs (
  id INT NOT NULL AUTO_INCREMENT,
  num_os VARCHAR(20) NOT NULL,
  observaciones VARCHAR(250) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE pe_revision (
  id INT NOT NULL AUTO_INCREMENT,
  num_os VARCHAR(20) NOT NULL,
  tipo VARCHAR(20) NOT NULL,
  revisor_1 VARCHAR(100) NOT NULL,
  obs_1 VARCHAR(250) NOT NULL,
  aprob_1 VARCHAR(30) NOT NULL,
  fecha_aprob_1 DATETIME DEFAULT CURRENT_TIMESTAMP,
  revisor_2 VARCHAR(100) NOT NULL,
  obs_2 VARCHAR(250) NOT NULL,
  aprob_2 VARCHAR(30) NOT NULL,
  fecha_aprob_2 DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE pe_saldos (
  id INT NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(150) NOT NULL,
  saldo DECIMAL(10,2) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  actualizado DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE pe_ordenes (
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

CREATE TABLE pe_caja_obs (
  id INT NOT NULL AUTO_INCREMENT,
  num_os VARCHAR(20) NOT NULL,
  observaciones VARCHAR(250) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;


CREATE TABLE pe_caja_adj (
  id INT NOT NULL AUTO_INCREMENT,
  num_os VARCHAR(20) NOT NULL,
  archivo VARCHAR(250) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;


CREATE TABLE pe_caja_rev (
  id INT NOT NULL AUTO_INCREMENT,
  num_caja INT NOT NULL,
  usuario VARCHAR(150) NOT NULL,
  observacion VARCHAR(250) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;


CREATE TABLE pe_caja (
  id INT NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(100) NOT NULL,
  num_caja INT NOT NULL,
  item INT NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  centro_costo VARCHAR(150) NOT NULL,
  descripcion TEXT NOT NULL,
  proveedor VARCHAR(250) NOT NULL,
  documento VARCHAR(100) NULL,
  monto DECIMAL(20,2) NOT NULL,
  estado VARCHAR(30) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  actualizado DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)ENGINE=INNODB;


INSERT INTO pe_caja (usuario, num_caja, fecha, centro_costo, descripcion, proveedor, documento, monto) VALUES 
  ('hmorales', 1, '2023-02-22 11:47:14', 'EL BROCAL', 'MOVILIDAD CAPACITACION EL BROCAL', '', '', 25.00),
  ('hmorales', 1, '2023-02-22 11:27:14', 'OFICINA', 'MOVILIDAD COMPRA TRAPO INDUSTRIAL', '', '', 10.00),
  ('hmorales', 1, '2023-02-23 12:27:14', 'OFICINA', 'MOVILIDAD AVERIGUAR REPARACION DE MULTITESTER', '', '', 34.00),
  ('hmorales', 1, '2023-02-23 12:47:14', 'OFICINA', 'MOVILIDAD COTIZACION ROPA DE TRABAJO', '', '', 45.00),
  ('hmorales', 1, '2023-02-22 10:37:14', 'CUAJONE', 'MOVILIDAD ENVIO DE INSUMOS PARA MANTENIMIENTO', '', '', 36.00),
  ('hmorales', 1, '2023-02-27 11:37:14', 'OFICINA', 'MOVILIDAD RECOJO DE PROYECTOS Y CABLES', '', '', 30.00),
  ('hmorales', 1, '2023-02-28 12:17:14', 'OFICINA', 'SERVICIO DE JARDINERIA', '', '', 45.00),
  ('hmorales', 1, '2023-02-28 11:17:14', 'YANACOCHA', 'MOVILIDAD RECOJO DE BRAZOS METALICOS', '', '', 36.00),
  ('hmorales', 1, '2023-02-22 10:47:14', 'OFICINA', 'COMPRA DE TRAPO INDUSTRIAL Y CAJAS DE CARTON', 'SODIMAC', 'F869-00082232', 184.06),
  ('hmorales', 1, '2023-02-22 10:43:04', 'OFICINA', 'COMPRA DE FOQUITOS LED', 'YOKA IMPORT SAC', 'E001-287', 120.00),
  ('hmorales', 1, '2023-02-22 10:23:04', 'OFICINA', 'MOVILIDAD OFICINA-NOTARIA-PARURO-OFICINA', 'CCANCHI CHIPANA LIDIA', 'E001-797', 74.00),
  ('hmorales', 1, '2023-02-22 10:13:04', 'YANACOCHA', 'SERVICIO DE ALIMENTACION EN MINA DEL 1 DE ENERO AL 15 DE FEBRERO', 'CONSORCIO KUNTURWASI', 'E001-1203', 76.96),
  ('hmorales', 1, '2023-02-23 10:13:04', 'CUAJONE', 'ENVIO DE INSUMOS PARA MANTENIMIENTO', 'EXPRESO MARVISUR EIRL', 'B070-00012678', 36.00),
  ('hmorales', 1, '2023-02-23 10:43:04', 'OFICINA', 'PAGO MOVILIDAD OFICINA- AEROPUERTO', 'GONZALES CHAVESTA JOSE PEDRO', 'E001-563', 70.00),
  ('hmorales', 1, '2023-02-23 10:53:04', 'LAS BAMBAS', 'REVALIDACION CURSO MATPEL - A.CONTRERAS', 'IGH GROUP PERU S.A', 'F007-00009120', 13.56),
  ('hmorales', 1, '2023-02-23 10:23:04', 'LAS BAMBAS', 'REVALIDACION CURSO MATPEL - L.RUIZ', 'IGH GROUP PERU S.A', 'F007-00009121', 13.56),
  ('hmorales', 1, '2023-02-23 10:27:04', 'LAS BAMBAS', 'REVALIDACION CURSO MANEJO DE TAREAS SEGURAS - L.RUIZ', 'IGH GROUP PERU S.A', 'F007-00009122', 19.92),
  ('hmorales', 1, '2023-02-23 10:28:04', 'LAS BAMBAS', 'REVALIDACION CURSO MANEJO DE TAREAS SEGURAS - A.CONTRERAS', 'IGH GROUP PERU S.A', 'F007-00009123', 19.92),
  ('hmorales', 1, '2023-02-27 10:28:04', 'OFICINA', 'COMPRA DE CONTROL DE AIRE ACONDICIONADO', 'JC CLIMATIZACION Y CONFORT', 'E001-320', 145.00),
  ('hmorales', 1, '2023-02-28 10:18:04', 'YANACOCHA', 'PAGOS GASTOS DE ENVIO CABLE GPS', 'DHL EXPRESS SAC', 'F216-00270482', 45.03),
  ('hmorales', 1, '2023-02-28 10:38:04', 'COIMOLACHE', 'PAGO SERVICIO DE MONTACARGA DESPACHO RADAR MSR-265', 'TRADESUR SAC', 'F001-0002254', 177.00),
  ('hmorales', 1, '2023-03-01 10:28:04', 'OFICINA', 'COMPRA DE PAPEL FOTOCOPIA, ARCHIVADORES', 'TAI LOY', 'F539-0243593', 93.40),
  ('hmorales', 1, '2023-03-01 10:28:04', 'OFICINA', 'MOVILIDAD OFICINA-MIRAFLORES-MTC-METRO-OFICINA', 'CCANCHI CHIPANA LIDIA', 'E001-805', 73.00);



-- Tablas SEDE CHILE


CREATE TABLE cl_minas (
  id INT NOT NULL AUTO_INCREMENT,
  sede_id INT NOT NULL,
  codigo INT NOT NULL,
  mina VARCHAR(150) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_sede_id_cl_mina
  FOREIGN KEY (sede_id)
  REFERENCES sedes (id)
)ENGINE=INNODB;

INSERT INTO cl_minas (sede_id, codigo, mina) VALUES 
  (2, 100, 'GERENCIA DE ADMINISTRACION Y FINANZAS'),
  (2, 200, 'GERENCIA DE MARKETING'),
  (2, 300, 'GERENCIA DE OPERACIONES'),
  (2, 400, 'PROYECTOS Y REPRESENTACIONES'),
  (2, 500, 'LOS BRONCES'),
  (2, 600, 'LOS COLORADOS'),
  (2, 700, 'EL ROMERAL'),
  (2, 800, 'CENTINELA'),
  (2, 900, 'QUEBRADA BLANCA'),
  (2, 1000, 'ZALDIVAR'),
  (2, 1100, 'ESCONDIDA'),
  (2, 1200, 'PERU'),
  (2, 1300, 'LOMAS BAYAS'),
  (2, 1400, 'CERRO COLORADO'),
  (2, 1500, 'CARMEN DE ANDACOLLO'),
  (2, 1600, 'EL SOLDADO '),
  (2, 1700, 'SPENCE'),
  (2, 1800, 'CEMIN UVA'),
  (2, 1900, 'LA COIPA');

CREATE TABLE cl_minas_categ (
  id INT NOT NULL AUTO_INCREMENT,
  mina_id INT NOT NULL,
  codigo INT NOT NULL,
  tipo VARCHAR(20) NOT NULL,
  categoria VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_mina_id_cl_categ
  FOREIGN KEY (mina_id)
  REFERENCES cl_minas (id)
)ENGINE=INNODB;

CREATE TABLE cl_adjuntos (
  id INT NOT NULL AUTO_INCREMENT,
  num_os VARCHAR(20) NOT NULL,
  archivo VARCHAR(100) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE cl_enlaces (
  id INT NOT NULL AUTO_INCREMENT,
  num_os VARCHAR(20) NOT NULL,
  enlace TEXT NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE cl_obs (
  id INT NOT NULL AUTO_INCREMENT,
  num_os VARCHAR(20) NOT NULL,
  observaciones VARCHAR(250) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE cl_revision (
  id INT NOT NULL AUTO_INCREMENT,
  num_os VARCHAR(20) NOT NULL,
  tipo VARCHAR(20) NOT NULL,
  revisor_1 VARCHAR(100) NOT NULL,
  obs_1 VARCHAR(250) NOT NULL,
  aprob_1 VARCHAR(30) NOT NULL,
  fecha_aprob_1 DATETIME DEFAULT CURRENT_TIMESTAMP,
  revisor_2 VARCHAR(100) NOT NULL,
  obs_2 VARCHAR(250) NOT NULL,
  aprob_2 VARCHAR(30) NOT NULL,
  fecha_aprob_2 DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE cl_ordenes (
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



CREATE TABLE revision_areas (
  id INT NOT NULL AUTO_INCREMENT,
  sede_id INT NOT NULL,
  tipo VARCHAR(20) NOT NULL,
  area_1 VARCHAR(50) NOT NULL,
  area_2 VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO revision_areas (sede_id, tipo, area_1, area_2) VALUES 
  (1, 'Fondos', 'JEFE DE PROYECTO', 'AREA CONTABILIDAD'),
  (1, 'Compra', 'AREA TECNICA', 'AREA ADQUISICION'),
  (2, 'Fondos', 'Area Tecnica', 'Area Adq'),
  (2, 'Compra', 'compras chile 1', 'compras chile 2');




