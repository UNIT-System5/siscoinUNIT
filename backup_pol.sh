#!/bin/bash
# Script para ver la politica de respaldo del servidor. Realmente lo unico
# que hace es mostrar el crontab.

echo "Desea ver la rutina de respaldo o editarla?
1. Ver
2. Editar"

read choice 

case $choice in
	1)
		clear
		less /etc/crontab
		;;
	2)
		nano /etc/crontab
		;;
	*)
		echo "Dale, elegi bien..."
		;;
esac
