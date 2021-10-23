#!/bin/bash

# Sintaxis cortesía de la wiki de Arch Linux
# wiki.archlinux.org


# Deprecado. Realmente es inutil teniendo en cuenta que cuando los archivos se copian localmente como es el caso
# se sobreescribe todo por defecto.


if ! rsync -aAXHv --whole-file --ignore-times  /home /mnt/backup_device/full --log-file=/root/logs/rsynclog.txt;
    then
        echo "Ha ocurrido un error al hacer el backup de los directorios home (completo)"
        echo "Ha ocurrido un error al hacer el backup de los directorios home (completo)" >> /root/logs/log.txt 
        echo "La salida del programa se encuentra en el archivo /root/logs/log.txt"
    else
        echo "Operación exitosa" >> /root/logs/log.txt
        echo "Operación exitosa: Backup no incremental de los directorios home"
fi

