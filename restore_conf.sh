#!/bin/bash

# Sintaxis cortesía de la wiki de Arch Linux
# wiki.archlinux.org

echo "Probablemente sea más seguro
verificar las configuraciones y
copiar uno por uno"
echo "Desea continuar?
s/n"

read sel

case $sel in
	s)
		rsync -aAXHv /mnt/backup_device/etc/* /etc
		;;
	n)
		echo "Mejor no..."
		;;
	*)
		echo "Sos la peor pesadilla de los testers.
		Dale, elegi bien."
		;;

esac



