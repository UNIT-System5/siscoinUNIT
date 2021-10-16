#!/bin/bash
# Cortesia, nuevamente, de la fantastica wiki de Arch Linux.
# NOTA: La key pública debe definirse en la ubicación de backup
# La ip probablemente varíe, consideresela un placeholder.

if ! rsync -a --quiet -e ssh administrador@192.168.56.201:/home/administrador/backup_device/* /mnt/backup_device 
    then
        echo "Ha ocurrido un error al descargar los datos del servidor remoto"
        echo "Ha ocurrido un error al descargar los datos del servidor remoto" >> /root/logs/log.txt 
        echo "La salida del programa se encuentra en el archivo /root/logs/log.txt"
    else
        echo "Operación exitosa" >> /root/logs/log.txt
        echo "Operación exitosa"
fi