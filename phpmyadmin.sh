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
