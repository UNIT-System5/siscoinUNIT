USE siscoin_unit;

CREATE USER 'login'@'%' IDENTIFIED BY 'monitor.2701';

GRANT SELECT ON siscoin_unit.usuario TO 'login'@'%';