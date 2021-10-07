#!/bin/bash

# No se como editar varias cosas dentro de un solo sed :(
sed -i "s|;extension=pdo_mysql|extension=pdo_mysql|" /etc/php/php.ini
# mysqli es particularmente importante porque es lo que se usa para ingresar a la base con PHP.
sed -i "s|;extension=mysqli|extension=mysqli|" /etc/php/php.ini
# Ahora que lo pienso, podria simplemente haber clonado un archivo ya editado en vez de hacer
# todo esto. Nah, esto tiene mas estilo.
sed -i "s|;extension=iconv|extension=iconv|" /etc/php/php.ini
# Extensiones para compresion...
sed -i "s|;extension=bz2|extension=bz2|" /etc/php/php.ini
sed -i "s|;extension=zip|extension=zip|" /etc/php/php.ini
