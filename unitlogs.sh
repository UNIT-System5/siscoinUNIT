#!/bin/bash

flaw5() {
	echo "---VOLVIENDO AL MENU---"
	for i in {0..2}
	do
		g=$i
		((g++))
		echo $g") ""${logs[$i]}"
	done
}

echo "¿Qué logs desea ver?"
	logs=(
	"Logs de operaciones y errores."
	"Logs de transacciones efectuadas por rsync."
	"Volver al menú."
	)
 	select logch in "${logs[@]}"
	do
	case $logch in
		"Logs de operaciones y errores.")
			less /root/logs/log.txt
			;;
		"Logs de transacciones efectuadas por rsync.")
			less /root/logs/rsynclog.txt
			;;
		"Volver al menú.")
			clear 
			break
			;;
		*)
            clear
			echo "Ha ingresado un valor inválida..."
            flaw5
			;;
	esac
	done 