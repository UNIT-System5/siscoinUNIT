#!/bin/bash
# Cortesia, nuevamente, de la fantastica wiki de Arch Linux.
# NOTA: La key pública debe definirse en la ubicación de backup
# La ip probablemente varíe, consideresela un placeholder.

if ! rsync -a --backup --backup-dir=/home/administrador/backup_device/old-files --suffix=.old --quiet --compress-choice=zstd --update -e ssh /mnt/backup_device administrador@192.168.56.201:/home/administrador --log-file=/root/logs/rsynclog.txt;
    then
        echo "Ha ocurrido un error al hacer el backup al servidor remoto"
        echo "Ha ocurrido un error al hacer el backup al servidor remoto" >> /root/logs/log.txt 
        echo "La salida del programa se encuentra en el archivo /root/logs/log.txt"
    else
        echo "Operación exitosa" >> /root/logs/log.txt
        clear
        echo "Operación exitosa: Backup al servidor remoto"
fi
