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

#/bin/bash firewalld.sh

# Configurando red...
/bin/bash /root/networkconf.sh

# Creando el directorio para los backups...
mkdir /mnt/backup_device
#mkdir /mnt/backup_device/full 

# Creando el directorio para los logs de auditoria...
mkdir /root/logs

# Configurando aliases...
/bin/bash /root/aliases.sh

# Deshabilitando la autenticación por sockets de Unix en mariadb...
# Necesario para que no se pueda entrar como root sin contraseña,
# ya que el menu usa sudo.
echo "
[mariadb]
unix_socket=OFF
" >> /etc/my.cnf

# Evitando que phpMyAdmin se queje de la cache y la passphrase...

echo "
\$cfg['TempDir'] = '/tmp/phpmyadmin';
" >> /usr/share/webapps/phpMyAdmin/config.inc.php

echo "
\$cfg['blowfish_secret'] = '69909365658635084776338496446056';
" >> /usr/share/webapps/phpMyAdmin/config.inc.php

# Haciendo el deploy de la página...
mkdir /root/site 
git clone -b main https://github.com/UNIT-System5/siscoinUNIT.git /root/site
sed -i 's|DocumentRoot "/srv/http"|DocumentRoot "/srv/http/proyecto-iti"|' /etc/httpd/conf/httpd.conf 
cp -r /root/site/* /srv/http/
# Para que se puedan crear y ver las fotos de perfil...
chown -R http:http /srv/http 
chmod -R 700 /srv/http

# Habilitando cockpit...

#systemctl enable cockpit.socket

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
