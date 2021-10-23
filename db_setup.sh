#!/bin/bash
# Creacion de usuarios de MySQL e implementacion de la base de datos

# Permitimos mysqldump sin prompt de contraseña siendo root
echo "
[mysqldump]
user=root
password=20092009
" > /root/.my.cnf

user=root
pswd=20092009

mysql -u $user -p$pswd  < /root/Create_Database.sql


# Los usuarios aun no se encuentran 100% definidos
#expect "mysql>" { send "CREATE USER 'director'@'localhost' IDENTIFIED BY 'director1234'"}
