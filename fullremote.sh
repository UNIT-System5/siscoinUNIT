#!/bin/bash



# Cortesia, nuevamente, de la fantastica wiki de Arch Linux.
# NOTA: La key pública debe definirse en la ubicación de backup
# La ip probablemente varíe, consideresela un placeholder.

if ! rsync -a --quiet --whole-file --ignore-times --compress-choice=zstd -e ssh /mnt/backup_device administrador@192.168.56.201:/home/administrador/full --log-file=/root/logs/rsynclog.txt;
    then
        echo "Ha ocurrido un error al hacer el backup al servidor remoto (completo)"
        echo "Ha ocurrido un error al hacer el backup al servidor remoto (completo)" >> /root/logs/log.txt 
        echo "La salida del programa se encuentra en el archivo /root/logs/log.txt"
    else
        echo "Operación exitosa" >> /root/logs/log.txt
        echo "Operación exitosa: Backup no incremental a destino remoto"
fi    
