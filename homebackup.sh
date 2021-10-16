#!/bin/bash

# Sintaxis cortesía de la wiki de Arch Linux
# wiki.archlinux.org

if ! rsync -aAXHv --update  --log-file=/root/logs/rsynclog.txt /home /mnt/backup_device;
    then
        echo "Ha ocurrido un error al hacer el backup de los directorios home"
        echo "Ha ocurrido un error al hacer el backup de los directorios home" >> /root/logs/rsynclog.txt 
        echo "La salida del programa se encuentra en el archivo /root/logs/log.txt"
    else
        echo "Operación exitosa" >> /root/logs/log.txt
        echo "Operación exitosa"
fi

