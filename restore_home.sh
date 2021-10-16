#!/bin/bash

# Sintaxis cortesía de la wiki de Arch Linux
# wiki.archlinux.org


echo "ADVERTENCIA
Si bien se restauran los archivos,
al estarse ejecutando la operacion como root
se VAN A ARRUINAR LOS PERMISOS"
echo "Continuar?
s/n"

read sel

case $sel in

	s)	
		rsync -aAXHv /mnt/backup_device/home/* /home
		echo "Se ha ejecutado la restauración" >> /root/logs/log.txt
		;;
	n)
		echo "Sabia decision..."
		echo "Se ha abortado la restauración" >> /root/logs/log.txt
		;;
	*)
		echo "Solo hay dos opciones.
		Como haces para errarle?"
		;;
	
esac

