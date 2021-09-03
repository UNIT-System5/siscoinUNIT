CREATE DATABASE siscoin_unit;
USE siscoin_unit;

CREATE TABLE proveedor (
    id_prov int(2) PRIMARY KEY AUTO_INCREMENT,
    nom_prov varchar(20) CHARSET utf8 NOT NULL,
    dir_prov varchar(40) NOT NULL,
    tel_prov int(9) NOT NULL
) ENGINE=INNODB;

CREATE TABLE tipo_equipamiento (
    id_tipo int(2) PRIMARY KEY AUTO_INCREMENT,
    nom_tipo varchar(20) CHARSET utf8 NOT NULL,
    stock int(5) NOT NULL,
    fk_prov int(2) NOT NULL,
    FOREIGN KEY(fk_prov) REFERENCES proveedor(id_prov)
) ENGINE=INNODB;

CREATE TABLE provee (
    fecha_compra date NOT NULL,
    fk_prov int(2) NOT NULL,
    fk_tipo int(2) NOT NULL,
    FOREIGN KEY(fk_prov) REFERENCES proveedor(id_prov),
    FOREIGN KEY(fk_tipo) REFERENCES tipo_equipamiento(id_tipo)
) ENGINE=INNODB;

CREATE TABLE estado (
    id_estado int(2) PRIMARY KEY AUTO_INCREMENT,
    nombre_estado varchar(20) CHARSET utf8 NOT NULL,
    estado_sucesor varchar(40) CHARSET utf8 NOT NULL
) ENGINE=INNODB;

CREATE TABLE equipamiento (
    id_equip int(2) PRIMARY KEY AUTO_INCREMENT,
    desc_equip varchar(40) CHARSET utf8 NOT NULL,
    marca_equip varchar(20) NOT NULL,
    tipo_comp varchar(20) CHARSET utf8 NOT NULL,
    lugar_equip varchar(20) CHARSET utf8 NOT NULL,
    estado_equip varchar(20) CHARSET utf8 NOT NULL,
    fk_estado int(2) NOT NULL,
    fk_tipo int(2) NOT NULL,
    FOREIGN KEY(fk_estado) REFERENCES estado(id_estado),
    FOREIGN KEY(fk_tipo) REFERENCES tipo_equipamiento(id_tipo)
) ENGINE=INNODB;

CREATE TABLE equip_estado (
    fecha_inic_estado date NOT NULL,
    fecha_fin_estado date,
    fk_estado int(2) NOT NULL,
    fk_equip int(2) NOT NULL,
    FOREIGN KEY(fk_estado) REFERENCES estado(id_estado),
    FOREIGN KEY(fk_equip) REFERENCES equipamiento(id_equip)
) ENGINE=INNODB;

CREATE TABLE oficina (
    id_lugar int(2) PRIMARY KEY AUTO_INCREMENT,
    desc_lugar varchar(20) CHARSET utf8 NOT NULL,
    dir_lugar varchar(40) CHARSET utf8 NOT NULL,
    tel_lugar int(9) NOT NULL
) ENGINE=INNODB;

CREATE TABLE instala_cambia (
    tipo_accion varchar(40) CHARSET utf8 NOT NULL,
    desc_inst_cambio varchar(40) CHARSET utf8,
    fecha_inst_cambio date NOT NULL,
    fk_equip int(2) NOT NULL,
    fk_ofic int(2) NOT NULL,
    FOREIGN KEY(fk_equip) REFERENCES equipamiento(id_equip),
    FOREIGN KEY(fk_ofic) REFERENCES oficina(id_lugar)
) ENGINE=INNODB;

CREATE TABLE realiza_soli (
    id_soli int(2) PRIMARY KEY AUTO_INCREMENT,
    tipo_soli varchar(20) CHARSET utf8 NOT NULL,
    desc_soli varchar(40) CHARSET utf8 NOT NULL,
    licit_estado varchar(10) CHARSET utf8,
    fecha_soli date NOT NULL,
    fk_tipo int(2) NOT NULL,
    fk_ofic int(2) NOT NULL,
    FOREIGN KEY(fk_tipo) REFERENCES tipo_equipamiento(id_tipo),
    FOREIGN KEY(fk_ofic) REFERENCES oficina(id_lugar)
) ENGINE=INNODB;

CREATE TABLE grupo (
    id_grupo int(2) PRIMARY KEY AUTO_INCREMENT,
    nom_grupo varchar(20) CHARSET utf8 NOT NULL
) ENGINE=INNODB;

CREATE TABLE usuario (
    id_user int(4) PRIMARY KEY AUTO_INCREMENT,
    grupo_user varchar(20) CHARSET utf8 NOT NULL,
    mail_user varchar(320) NOT NULL UNIQUE,
    pass_user char(60) NOT NULL,
    nom_comp_user varchar(60) CHARSET utf8 NOT NULL,
    fk_grupo int(2) NOT NULL,
    FOREIGN KEY(fk_grupo) REFERENCES grupo(id_grupo)
) ENGINE=INNODB;
