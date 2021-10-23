#!/bin/bash

# Deprecado. Realmente es inutil teniendo en cuenta que cuando los archivos se copian localmente como es el caso
# se sobreescribe todo por defecto.

# Sintaxis cortesía de la wiki de Arch Linux
# wiki.archlinux.org
echo "Realizando backup completo de /etc..."
if ! rsync -aAXHv --whole-file --ignore-times  /etc /mnt/backup_device/full --log-file=/root/logs/rsynclog.txt;
    then
        echo "Ha ocurrido un error al hacer el backup de la configuración (completo)"
        echo "Ha ocurrido un error al hacer el backup de la configuración (completo)" >> /root/logs/log.txt 
        echo "La salida del programa se encuentra en el archivo /root/logs/log.txt"
    else
        echo "Operación exitosa" >> /root/logs/log.txt
        echo "Operación exitosa: Backup no incremental de /etc"
fi

