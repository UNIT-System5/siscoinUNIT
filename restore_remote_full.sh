#!/bin/bash
# Virtualmente idéntico a restore_remote.sh, pero restaura las versiones no incrementales
# de los backups.

if ! rsync -a --quiet --whole-file --ignore-times --compress-choice=zstd  --compress-choice=zstd -e ssh administrador@192.168.56.201:/home/administrador/full/backup_device/* /mnt/backup_device 
    then
        echo "Ha ocurrido un error al descargar los datos del servidor remoto"
        echo "Ha ocurrido un error al descargar los datos del servidor remoto" >> /root/logs/log.txt 
        echo "La salida del programa se encuentra en el archivo /root/logs/log.txt"
    else
        echo "Operación exitosa, recibir respaldos no incrementales" >> /root/logs/log.txt
        echo "Operación exitosa: Recibir respaldos no incrementales del servidor"
fi