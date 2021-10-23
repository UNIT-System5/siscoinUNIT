#!/bin/bash

# Sintaxis cortesía de la wiki de Arch Linux
# wiki.archlinux.org


echo "ADVERTENCIA
Si bien se restauran los archivos,
al estarse ejecutando la operacion como root
se VAN A ARRUINAR LOS PERMISOS"
echo "Continuar?
"

select desth in Si No;

do
case $desth in

	Si)	
		rsync -aAXHv /mnt/backup_device/home/* /home
		echo "Se ha ejecutado la restauración" >> /root/logs/log.txt
		;;
	No)
		echo "Bien hecho."
		echo "Se ha abortado la restauración" >> /root/logs/log.txt
		break
		;;
	*)
		echo "Solo hay dos opciones.
		Como haces para errarle?"
		;;
	
esac
done
