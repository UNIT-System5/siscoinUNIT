#!/bin/bash

echo "Ingrese el usuario de la base de datos"
read user
echo "Ingrese la contraseña del usuario"
read -s pswd


if ! gunzip -f /mnt/backup_device/database.sql.gz;
then 
    echo "Ocurrio un error al descomprimir la base de datos. ¿Estaba exportada?" >> /root/logs/log.txt
    echo "Ocurrio un error al descomprimir la base de datos. ¿Estaba exportada?"
else 
    if ! mysqladmin drop siscoin_unit -u $user -p$pswd;
    then 
        echo "Ocurrio un error al ingresar al usuario" >> /root/logs/log.txt
        echo "Ocurrio un error al ingresar al usuario"
    else 
        if ! mysqladmin create siscoin_unit -u $user -p$pswd;
        then
            echo "Ocurrio un error al crear la base de datos" >> /root/logs/log.txt
            echo "Ocurrio un error al crear la base de datos"
        else
            if ! mysql -u $user -p$pswd siscoin_unit < /mnt/backup_device/database.sql;
            then
                echo "Ocurrio un error al reimplementar la base de datos" >> /root/logs/log.txt
                echo "Ocurrio un error al reimplementar la base de datos"
            else
                echo "Operación exitosa" >> /root/logs/log.txt
                clear
                echo "Operación exitosa: Restaurar DB"
            fi
        fi
    fi
fi


