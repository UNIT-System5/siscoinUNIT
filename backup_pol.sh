#!/bin/bash
# Script para ver la politica de respaldo del servidor. Realmente lo unico
# que hace es mostrar el crontab.

echo "Desea ver la rutina de respaldo o editarla?"


select ar in Ver Editar Salir;

do 
case $ar in
	Ver)
		clear
		less /etc/crontab
		echo "1 para ver, 2 para editar, 3 para volver."
		;;
	Editar)
		nano /etc/crontab
		echo "1 para ver, 2 para editar, 3 para volver."
		;;

	Salir)
		clear
		break
		;;
	*)
		echo "Valor inválido."
		echo "1 para ver, 2 para editar, 3 para volver."
		;;
esac
done