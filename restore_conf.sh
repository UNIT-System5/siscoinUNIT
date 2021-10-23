#!/bin/bash

# Sintaxis cortesía de la wiki de Arch Linux
# wiki.archlinux.org

echo "Probablemente sea más seguro
verificar las configuraciones y
copiar uno por uno"
echo "Desea continuar?
"

select destc in Si No;

do 
case $destc in
	Si)
		rsync -aAXHv /mnt/backup_device/etc/* /etc
		echo "Se ha ejecutado la restauración" >> /root/logs/log.txt
		;;
	No)
		echo "Mejor no..."
		echo "Se ha abortado la restauración" >> /root/logs/log.txt
		break
		;;
	*)
		echo "Selección inválida"
		;;

esac
done


