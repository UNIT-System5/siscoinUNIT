CREATE DATABASE siscoin_unit;
USE siscoin_unit;

CREATE TABLE proveedor (
    id_prov int(4) PRIMARY KEY AUTO_INCREMENT,
    nom_prov varchar(20) CHARSET utf8 NOT NULL,
    dir_prov varchar(40) NOT NULL,
    tel_prov int(9) NOT NULL
) ENGINE=INNODB;

CREATE TABLE tipo_equipamiento (
    id_tipo int(2) PRIMARY KEY AUTO_INCREMENT,
    nom_tipo varchar(40) CHARSET utf8 NOT NULL,
    prestock int(5) NOT NULL
) ENGINE=INNODB;

CREATE TABLE provee (
    fecha_compra date NOT NULL,
    tipo_compra varchar(20) NOT NULL,
    fk_prov int(4) NOT NULL,
    fk_tipo int(2) NOT NULL,
    PRIMARY KEY(fecha_compra, fk_tipo, fk_prov),
    FOREIGN KEY(fk_prov) REFERENCES proveedor(id_prov),
    FOREIGN KEY(fk_tipo) REFERENCES tipo_equipamiento(id_tipo)
) ENGINE=INNODB;

CREATE TABLE estado (
    id_estado int(2) PRIMARY KEY AUTO_INCREMENT,
    nombre_estado varchar(20) CHARSET utf8 NOT NULL
) ENGINE=INNODB;

CREATE TABLE equipamiento (
    id_equip int PRIMARY KEY AUTO_INCREMENT,
    fecha_adq date NOT NULL,
    garantia int(2),
    desc_equip varchar(40) CHARSET utf8 NOT NULL,
    marca_equip varchar(20) CHARSET utf8 NOT NULL,
    tipo varchar(20) CHARSET utf8 NOT NULL,
    lugar_equip varchar(20) CHARSET utf8 NOT NULL,
    estado_equip varchar(20) CHARSET utf8 NOT NULL,
    fk_estado int(2) NOT NULL,
    fk_tipo int(2) NOT NULL,
    fk_prov int(4),
    FOREIGN KEY(fk_estado) REFERENCES estado(id_estado),
    FOREIGN KEY(fk_tipo) REFERENCES tipo_equipamiento(id_tipo),
    FOREIGN KEY(fk_prov) REFERENCES proveedor(id_prov)
) ENGINE=INNODB;

CREATE TABLE est_sucesor (
    fk_estado int(2) NOT NULL,
    fk_est_sucesor int(2),
    FOREIGN KEY(fk_estado) REFERENCES estado(id_estado),
    FOREIGN KEY(fk_est_sucesor) REFERENCES estado(id_estado)
) ENGINE=INNODB;

CREATE TABLE asign_comp (
    fecha_asign date NOT NULL,
    fk_equip int(2) NOT NULL,
    fk_comp int(2) NOT NULL,
    FOREIGN KEY(fk_equip) REFERENCES equipamiento(id_equip),
    FOREIGN KEY(fk_comp) REFERENCES equipamiento(id_equip)
) ENGINE=INNODB;

CREATE TABLE equip_estado (
    fecha_inic_estado date NOT NULL,
    fecha_fin_estado date,
    fk_estado int(2) NOT NULL,
    fk_equip int(2) NOT NULL,
    FOREIGN KEY(fk_estado) REFERENCES estado(id_estado),
    FOREIGN KEY(fk_equip) REFERENCES equipamiento(id_equip)
) ENGINE=INNODB;

CREATE TABLE grupo (
    id_grupo int(2) PRIMARY KEY AUTO_INCREMENT,
    nom_grupo varchar(20) CHARSET utf8 NOT NULL
) ENGINE=INNODB;

CREATE TABLE departamento (
    id_dep int(2) PRIMARY KEY AUTO_INCREMENT,
    nom_dep varchar(20) NOT NULL
) ENGINE=INNODB;

CREATE TABLE oficina (
    id_lugar int(7) PRIMARY KEY AUTO_INCREMENT,
    desc_lugar varchar(20) CHARSET utf8 NOT NULL,
    grupo_lugar varchar(20) CHARSET utf8 NOT NULL,
    dir_lugar varchar(40) CHARSET utf8 NOT NULL,
    depart_lugar varchar(40) CHARSET utf8 NOT NULL,
    ciudad_lugar varchar(40) CHARSET utf8 NOT NULL,
    tel_lugar int(9) NOT NULL,
    fk_dep int(2) NOT NULL,
    fk_grupo int(2) NOT NULL,
    FOREIGN KEY(fk_dep) REFERENCES departamento(id_dep),
    FOREIGN KEY(fk_grupo) REFERENCES grupo(id_grupo)
) ENGINE=INNODB;

CREATE TABLE instala_cambia (
    id_inst_cambio int PRIMARY KEY AUTO_INCREMENT,
    tipo_accion varchar(40) CHARSET utf8 NOT NULL,
    desc_inst_cambio varchar(40) CHARSET utf8,
    fecha_inst_cambio date NOT NULL,
    fk_equip int(2) NOT NULL,
    fk_ofic int(2) NOT NULL,
    FOREIGN KEY(fk_equip) REFERENCES equipamiento(id_equip),
    FOREIGN KEY(fk_ofic) REFERENCES oficina(id_lugar)
) ENGINE=INNODB;

CREATE TABLE reporta_fallo (
    id_fallo  int PRIMARY KEY AUTO_INCREMENT,
    fecha_ini_fallo date NOT NULL,
    fecha_fin_fallo date,
    tipo_fallo varchar(20) CHARSET utf8 NOT NULL,
    estado_fallo varchar(20) CHARSET utf8 NOT NULL,
    fk_equip int(2) NOT NULL,
    fk_ofic int(2) NOT NULL,
    FOREIGN KEY(fk_equip) REFERENCES equipamiento(id_equip),
    FOREIGN KEY(fk_ofic) REFERENCES oficina(id_lugar)
) ENGINE=INNODB;

CREATE TABLE realiza_soli (
    id_soli int PRIMARY KEY AUTO_INCREMENT,
    tipo_soli varchar(30) CHARSET utf8 NOT NULL,
    desc_soli varchar(180) CHARSET utf8 NOT NULL,
    estado_soli varchar(20) CHARSET utf8 NOT NULL,
    fecha_ini_soli date NOT NULL,
    fecha_fin_soli date,
    fk_tipo int(2) NOT NULL,
    fk_ofic int(2) NOT NULL,
    FOREIGN KEY(fk_tipo) REFERENCES tipo_equipamiento(id_tipo),
    FOREIGN KEY(fk_ofic) REFERENCES oficina(id_lugar)
) ENGINE=INNODB;

CREATE TABLE usuario (
    id_user int(7) PRIMARY KEY AUTO_INCREMENT,
    grupo_user varchar(20) CHARSET utf8 NOT NULL,
    mail_user varchar(320) NOT NULL UNIQUE,
    pass_user char(60) NOT NULL,
    nom_comp_user varchar(60) CHARSET utf8 NOT NULL,
    pic_user varchar(69) CHARSET utf8,
    fk_ofic int(2) NOT NULL,
    fk_grupo int(2) NOT NULL,
    FOREIGN KEY(fk_ofic) REFERENCES oficina(id_lugar),
    FOREIGN KEY(fk_grupo) REFERENCES grupo(id_grupo)
) ENGINE=INNODB;

CREATE TABLE asign_usuario (
    fecha_asign date NOT NULL,
    fk_user int(7) NOT NULL,
    fk_ofic int(7) NOT NULL,
    FOREIGN KEY(fk_user) REFERENCES usuario(id_user),
    FOREIGN KEY(fk_ofic) REFERENCES oficina(id_lugar)
) ENGINE=INNODB;

INSERT INTO departamento (nom_dep)
VALUES ("Montevideo"), ("Canelones"),
("Maldonado"), ("San José"),
("Colonia"), ("Soriano"),
("Flores"), ("Florida"),
("Lavalleja"), ("Rocha"),
("Río Negro"), ("Durazno"),
("Treinta y Tres"), ("Cerro Largo"),
("Tacuarembó"), ("Rivera"),
("Paysandú"), ("Salto"), ("Artigas");

INSERT INTO grupo (nom_grupo)
VALUES
    ("Director"),
    ("Informática"),
    ("Subdirección A"),
    ("Subdirección B"),
    ("Oficina"),
    ("Compras"),
    ("Auditoría")
;

INSERT INTO oficina (
    desc_lugar, grupo_lugar, dir_lugar, depart_lugar,
    ciudad_lugar, tel_lugar, fk_grupo, fk_dep
) VALUES (
    "Oficina Número 1", "Oficina", "Calle Random 1",
    "Montevideo", "Montevideo", 094132471,
    5, 1
),
(
    "Oficina Número 2", "Oficina", "Calle Random 2",
    "Montevideo", "Montevideo", 091356985,
    5, 1
),
(
    "Oficina Número 3", "Oficina", "Calle Random 3",
    "Montevideo", "Montevideo", 092358985,
    5, 1
),
(
    "Oficina Número 4", "Oficina", "Calle Random 4",
    "Montevideo", "Montevideo", 095355685,
    5, 1
),
(
    "Oficina Número 5", "Oficina", "Calle Random 5",
    "Montevideo", "Montevideo", 097356990,
    5, 1
),
(
    "Oficina Número 6", "Oficina", "Calle Random 6",
    "Montevideo", "Montevideo", 099344985,
    5, 1
),
(
    "Oficina Número 7", "Oficina", "Calle Random 7",
    "Montevideo", "Montevideo", 091234567,
    5, 1
);

INSERT INTO proveedor (
    nom_prov, dir_prov, tel_prov
) VALUES (
    "Proveedor 1", "Dirección 1", 099078031
),
(
    "Proveedor 2", "Dirección 2", 069075031
),
(
    "Proveedor 3", "Dirección 3", 099065731
),
(
    "Proveedor 4", "Dirección 4", 092347803
),
(
    "Proveedor 5", "Dirección 5", 099067431
);

INSERT INTO estado (nombre_estado)
VALUES 
    ("Pre Stock"), ("Stock"),
    ("Taller"), ("Instalado"),
    ("Garantía"), ("Desaparecido"),
    ("Desguazado")
;

INSERT INTO tipo_equipamiento (nom_tipo)
VALUES
    ("Monitor"), ("Computadora"), ("Gabinete"),
    ("Impresora"), ("Tarjeta de Red"),
    ("Tarjeta Gráfica"), ("Memoria RAM"),
    ("HDD"), ("SSD"), ("Procesador"),
    ("Lectora/Grabadora de CD/DVD"),
    ("Router"), ("Switch"), ("Cable RJ45"),
    ("Cable VGA"), ("Cable HDMI"), ("Placa Madre"),
    ("Fuente de Alimentación"), ("Cartucho de Tinta"),
    ("Mouse"), ("Teclado"), ("Parlante")
;

INSERT INTO est_sucesor (fk_estado, fk_est_sucesor)
VALUES 
    (1, 2), (2, 4), (2, 6),
    (3, 4), (3, 5), (3, 7),
    (3, 6), (3, 2), (4, 3),
    (4, 6), (5, 3), (6, NULL),
    (7, 2)
;

INSERT INTO usuario (
    grupo_user, mail_user, pass_user,
    nom_comp_user, fk_ofic, fk_grupo
) VALUES (
    "Director", "director@gmail.com",
    "$2y$10$7mrHFVxutyrBGlOEpDAtXO6HBasVgdEjUQJGsCzZDBhVG/mj7YaoG",
    "Director Prueba", 2, 1
),
(
    "Informática", "informatica@gmail.com",
    "$2y$10$gEAGR575J8j486RN/i5RAeDcznz8Uf4Ne323Vr/kVCS..gsWq5Key",
    "Informática Prueba", 2, 2
),
(
    "Subdirección A", "subA@gmail.com",
    "$2y$10$rl1L6K9bw279xebuTA7C4uRFayq.HBvkfOp3kzZdY0cPrbGiPY3mu",
    "Subdirección A Prueba", 1, 3
),
(
    "Subdirección B", "subB@gmail.com",
    "$2y$10$7O1BKIBCBAnLDbt7kK8z2OFAJjAKsjuyPu7mdXIZgAMUfzAv/jahy",
    "Subdirección B Prueba", 1, 4
),
(
    "Oficina", "oficina@gmail.com",
    "$2y$10$nKpCongAWAuOksAimvdz3uLN/GfIESd5HDVscvhamgi2POovQBnl6",
    "Oficina Prueba", 2, 5
),
(
    "Compras", "compras@gmail.com",
    "$2y$10$cOzj1yhAEMHoExDEvIqHxe.KgZPA7zwOVBk7W1wP9WHa5/SU5Xmiq",
    "Compras Prueba", 1, 6
),
(
    "Auditoría", "auditoria@gmail.com",
    "$2y$10$ZnokG31469ORzcdk78/2w.8drgkrLp9zJhPBhzlupM66cxWCTupaG",
    "Auditoría Prueba", 2, 7
);

CREATE USER 'login'@'%' IDENTIFIED BY 'monitor.2701';

GRANT SELECT ON siscoin_unit.usuario TO 'login'@'%';

CREATE USER 'director'@'%' IDENTIFIED BY 'director1234';
CREATE USER 'informatica'@'%' IDENTIFIED BY 'info1234';
CREATE USER 'subA'@'%' IDENTIFIED BY 'subA1234';
CREATE USER 'subB'@'%' IDENTIFIED BY 'subB234';
CREATE USER 'oficina'@'%' IDENTIFIED BY 'oficina1234';
CREATE USER 'compras'@'%' IDENTIFIED BY 'compras1234';
CREATE USER 'auditoria'@'%' IDENTIFIED BY 'audi1234';

GRANT ALL PRIVILEGES ON siscoin_unit.* TO 'director'@'%';

GRANT SELECT, INSERT, DELETE, UPDATE ON siscoin_unit.* TO 'informatica'@'%';

GRANT SELECT, INSERT, UPDATE ON siscoin_unit.realiza_soli TO 'subA'@'%';
GRANT SELECT ON siscoin_unit.estado TO 'subA'@'%';
GRANT SELECT ON siscoin_unit.oficina TO 'subA'@'%';

GRANT SELECT, INSERT, UPDATE ON siscoin_unit.realiza_soli TO 'subB'@'%';
GRANT SELECT ON siscoin_unit.oficina TO 'subB'@'%';

GRANT SELECT, INSERT ON siscoin_unit.realiza_soli TO 'oficina'@'%';
GRANT SELECT ON siscoin_unit.estado TO 'oficina'@'%';

GRANT SELECT, INSERT, UPDATE ON siscoin_unit.realiza_soli TO 'compras'@'%';
GRANT SELECT ON siscoin_unit.proveedor TO 'compras'@'%';
GRANT SELECT ON siscoin_unit.oficina TO 'compras'@'%';

GRANT SELECT ON siscoin_unit.realiza_soli TO 'auditoria'@'%';
GRANT SELECT ON siscoin_unit.oficina TO 'auditoria'@'%';

FLUSH PRIVILEGES;