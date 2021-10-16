#!/bin/bash

# Script que genera la configuración inicial del sistema. No instala el sistema operativo,
# lo configura. Se asume que existe una instalación limpia.

clear

echo "Realizando configuración inicial..."
echo "Asegurandonos de que no falten paquetes..."
pacman -Syu --noconfirm --needed networkmanager cronie openssh apache php mariadb sudo expect 

# Creacion + configuracion de usuarios y grupos...
echo "Creando usuarios y grupos..."
/bin/bash /root/users.sh

# Configuracion de sudo...
echo "Configurando sudo..."
/bin/bash /root/sudoconf.sh

# Crear crontab...
echo "Configurando cron..."
/bin/bash /root/croncfg.sh

# Realizando configuracion inicial de Apache
echo "Instalando componentes necesarios para PHP"
#pacman -S --noconfirm mod_fcgid php-cgi

#mkdir /srv/http/fcgid-bin
#ln -s /usr/bin/php-cgi /srv/http/fcgid-bin/php-fcgid-wrapper

#/bin/bash /root/apachephp.sh

/bin/bash /root/apachephpalternate.sh

# Algunas extensiones de PHP...
echo "Habilitando extensiones de PHP..."
/bin/bash /root/phpext.sh

# Realizando ajustes a MariaDB, la version no Oraclizada de MySQL. Devuelvanme a SUN!
echo "Configurando MariaDB..."

# !!!Antes de habilitar mariadb se tiene que ejecutar el siguiente comando!!!
mariadb-install-db --user=mysql --basedir=/usr --datadir=/var/lib/mysql

# Iniciando el daemon de MariaDB para poder hacer mas ajustes
systemctl start mariadb

# Instalando otro programa mas solo para que haga esto...
pacman -Syu --noconfirm expect

/bin/expect /root/mysql_security.sh


# Destruyendo el script para que no quede la contra ahi...
rm /root/mysql_security.sh

# Haciendo el setup de la db...
/bin/bash /root/db_setup.sh

# Configurando cosas para phpMyAdmin...
echo "Preparando phpMyAdmin..."
/bin/bash /root/phpmyadmin.sh

# Habilitando el firewall...
/bin/bash /root/ufwconf.sh

# Configurando red...
/bin/bash /root/networkconf.sh

# Creando el directorio para los backups...
mkdir /mnt/backup_device
mkdir /mnt/backup_device/full 

# Creando el directorio para los logs de auditoria...
mkdir /root/logs

# Configurando aliases...
/bin/bash /root/aliases.sh

echo "Configuración lista. Procediendo a iniciar servicios..."

# Asegurandonos de que estan habilitados servicios importantes...
# El .service no es necesario. 
systemctl enable --now NetworkManager
systemctl enable --now cronie
systemctl enable --now mariadb
systemctl enable --now sshd
systemctl enable --now php-fpm 
systemctl enable --now httpd

reboot
