#!/bin/bash
# Creamos un archivo de conf necesario para que PHP funcione con Apache.
echo "
# Cortesía de la Arch wiki, wiki.archlinux.org
# Required modules: fcgid_module

<IfModule fcgid_module>
    AddHandler php-fcgid .php
    AddType application/x-httpd-php .php
    Action php-fcgid /fcgid-bin/php-fcgid-wrapper
    ScriptAlias /fcgid-bin/ /srv/http/fcgid-bin/
    SocketPath /var/run/httpd/fcgidsock
    SharememPath /var/run/httpd/fcgid_shm
        # If you don't allow bigger requests many applications may fail (such as WordPress login)
        FcgidMaxRequestLen 536870912
        # Path to php.ini – defaults to /etc/phpX/cgi
        DefaultInitEnv PHPRC=/etc/php/
        # Number of PHP childs that will be launched. Leave undefined to let PHP decide.
        #DefaultInitEnv PHP_FCGI_CHILDREN 3
        # Maximum requests before a process is stopped and a new one is launched
        #DefaultInitEnv PHP_FCGI_MAX_REQUESTS 5000
    <Location /fcgid-bin/>
        SetHandler fcgid-script
        Options +ExecCGI
    </Location>
</IfModule>
" > /etc/httpd/conf/extra/php-fcgid.conf

# Ahora usamos sed para poder cargar ciertos modulos de interes.
# Tuve que aprender a usar sed para haceresto :)
# Bueno, de que me quejo, esta buena la herramienta.

sed -i "s|#LoadModule actions_module modules/mod_actions.so|LoadModule actions_module modules/mod_actions.so|" /etc/httpd/conf/httpd.conf

sed -i "/<IfModule unixd_module>/a LoadModule fcgid_module modules\/mod_fcgid.so" /etc/httpd/conf/httpd.conf


# Algunos includes...

echo "
Include conf/extra/php-fcgid.conf

Include conf/extra/phpmyadmin.conf
" >> /etc/httpd/conf/httpd.conf
