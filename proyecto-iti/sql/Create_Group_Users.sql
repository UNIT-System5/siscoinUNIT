USE siscoin_unit;

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