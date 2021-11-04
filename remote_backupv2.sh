#!/bin/bash
# Cortesia, nuevamente, de la fantastica wiki de Arch Linux.



fecha=$(date +%d-%m-%y_%I:%M%p)
linker="/home/administrador/linker"
remote="administrador@192.168.56.201"

if ! rsync -a --quiet --compress-choice=zstd -e ssh /mnt/backup_device --link-dest $linker $remote:/home/administrador/"$fecha" --log-file=/root/logs/rsynclog.txt 

    then
        echo "Ha ocurrido un error al hacer el backup al servidor remoto"
        echo "Ha ocurrido un error al hacer el backup al servidor remoto" >> /root/logs/log.txt 
        echo "La salida del programa se encuentra en el archivo /root/logs/log.txt"
    else
        echo "Operación exitosa" >> /root/logs/log.txt
	ssh $remote rm -rf $linker
	ssh $remote ln -s /home/administrador/$fecha $linker
        clear
        echo "Operación exitosa: Backup al servidor remoto"
fi
