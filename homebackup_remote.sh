#!/bin/bash

# Script deprecado...

# Cortesia, nuevamente, de la fantastica wiki de Arch Linux.
# NOTA: Los datos son genericos; se desconoce el esquema de red del servidor
# del cliente, por ende no se puede definir nada. Naturalmente se asume
# tambien que se trabajara con keys, no con contraseñas, de ahi su ausencia.


if ! rsync -a --delete --quiet  -e ssh /home administrador@192.168.56.201:/home/administrador/ --log-file=/root/logs/rsynclog.txt
    then
        echo "Ha ocurrido un error al hacer el backup remoto del directorio home"
        echo "Ha ocurrido un error al hacer el backup remoto del directorio home" >> /root/logs/log.txt 
        echo "La salida del programa se encuentra en el archivo /root/logs/log.txt"
    else
        echo "Operación exitosa" >> /root/logs/log.txt
        echo "Operación exitosa"
fi