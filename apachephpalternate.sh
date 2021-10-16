#!/bin/bash

# Configuración alternativa de Apache y PHP, **supuestamente** más rápida que la otra.
# Como siempre, gracias a los cracks de la Arch Wiki por el dataso.
# wiki.archlinux.org

# Instalamos una dependencia...
pacman -Syu --noconfirm php-fpm

# Cargamos algunos modulos...
sed -i "s|#LoadModule proxy_module modules/mod_proxy.so|LoadModule proxy_module modules/mod_proxy.so|" /etc/httpd/conf/httpd.conf

sed -i "s|#LoadModule proxy_fcgi_module modules/mod_proxy_fcgi.so|LoadModule proxy_fcgi_module modules/mod_proxy_fcgi.so|" /etc/httpd/conf/httpd.conf

# Ya que estamos con sed, evitemos que el cliente simplemente vea todos los directorios en la root del servidor...

sed -i "s|Options Indexes FollowSymLinks|Options FollowSymLinks|" /etc/httpd/conf/httpd.conf

# Creamos un archivo de configuracion...
echo '
DirectoryIndex index.php index.html
<FilesMatch \.php$>
    SetHandler "proxy:unix:/run/php-fpm/php-fpm.sock|fcgi://localhost/"
</FilesMatch>
' > /etc/httpd/conf/extra/php-fpm.conf

# Incluimos el anterior archivo de configuracion...
echo "Include conf/extra/php-fpm.conf" >> /etc/httpd/conf/httpd.conf
# Ya que estamos, incluimos la config de phpMyAdmin tambien...
echo "Include conf/extra/phpmyadmin.conf" >> /etc/httpd/conf/httpd.conf