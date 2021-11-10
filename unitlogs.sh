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
			clear
			flaw5
			;;
		"Logs de transacciones efectuadas por rsync.")
			less /root/logs/rsynclog.txt
			clear
			flaw5
			;;
		"Volver al menú.")
			clear 
			break
			;;
		*)
            clear
			echo "Ha ingresado un valor inválido..."
            flaw5
			;;
	esac
	done 