#!/bin/bash

if ! mysqldump --single-transaction siscoin_unit > /mnt/backup_device/database.sql;
then
    echo "Ha ocurrido un error al exportar la base de datos." >> /root/logs/log.txt
    echo "Ha ocurrido un error al exportar la base de datos."
    echo "La salida del programa puede ser vista en /root/logs/log.txt"
else
    echo "La exportación ha sido exitosa. Procediendo a comprimir el resultado."
    echo "La exportación ha sido exitosa. Procediendo a comprimir el resultado." >> /root/logs/log.txt
    if ! gzip -f /mnt/backup_device/database.sql;
        then
            echo "Ha ocurrido un error al comprimir la base de datos." >> /root/logs/log.txt
            echo "Ha ocurrido un error al comprimir la base de datos."
            echo "La salida del programa puede ser vista en /root/logs/log.txt"
        else
            echo "Operación exitosa."
            echo "Operación exitosa." >> /root/logs/log.txt
        fi
fi    









#if [ $? -eq 0 ]; then
#		echo "Se ha exportado la base de datos. La misma se encuentra compresa con gzip." >> /root/logs/log.txt
#	else
#		echo "Ha ocurrido un error durante la exportación de la base de datos" >> /root/logs/log.txt
#	fi

# Idealmente puede ser copiado al mismo directorio que trabaja con el servidor 
# remoto, copiando todo de una vez y no teniendo que hacer otro script para
# respaldar MySQL por SSH.
