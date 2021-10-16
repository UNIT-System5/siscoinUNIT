#!/bin/bash

# Sintaxis cortesía de la wiki de Arch Linux
# wiki.archlinux.org

if ! rsync -aAXHv --update /etc /mnt/backup_device --log-file=/root/logs/log.txt;
    then
        echo "Ha ocurrido un error al hacer el backup de la configuración"
        echo "Ha ocurrido un error al hacer el backup de la configuración" >> /root/logs/rsynclog.txt 
        echo "La salida del programa se encuentra en el archivo /root/logs/log.txt"
    else
        echo "Operación exitosa" >> /root/logs/log.txt
        echo "Operación exitosa"
fi
