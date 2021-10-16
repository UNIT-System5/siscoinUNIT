#!/bin/bash
# Prepara algunas cosas para phpMyAdmin...

echo '
Alias /phpmyadmin "/usr/share/webapps/phpMyAdmin"
<Directory "/usr/share/webapps/phpMyAdmin">
    DirectoryIndex index.php
    AllowOverride All
    Options FollowSymlinks
    Require all granted
</Directory>

' > /etc/httpd/conf/extra/phpmyadmin.conf

#echo '   
#$cfg['TempDir'] = '/tmp/phpmyadmin';
#' >> /usr/share/webapps/phpMyAdmin/config.inc.php

#echo '
#$cfg['blowfish_secret'] = 'hNvfYjiYTghNhGjKhyh9HgnNhUkLnBaQ';
#' >> /usr/share/webapps/phpMyAdmin/config.inc.php


#sed -i  "\/$cfg\[\'TempDir\'\] = \'/tmp/phpmyadmin\';" /usr/share/webapps/phpMyAdmin/config.inc.php
