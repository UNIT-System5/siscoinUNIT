#!/bin/bash

flog() {
	journalctl -x
	exit
}


bootlog() {
	journalctl -b
	exit
}

lasthour() {
	journalctl -x --since "60 min ago"
	exit
}

realtime() {
	journalctl -fx
	exit
	}

userlog() {
	echo Ingrese el usuario de interés
	read user
	journalctl --user -u $user
	exit
}


authlog() {
	journalctl SYSLOG_FACILITY=10
	exit
}

critical() {
	journalctl -p err..alert
	exit
}

status() {
	echo "Ingrese nombre del servicio a revisar"
	read srv
	journalctl -t $srv
	exit
}

customtime() {
	echo "¿Desea revisar en horas o minutos?
	1. Minutos
	2. Horas"
	read choice
	case $choice in
		1)
			echo "Ingrese cuantos minutos atras desea ver"
			read timemin
			journalctl --since "$timemin ago"
			;;

		2)
			echo "Ingrese cuantas horas atras desea ver"
			read timehr
			journalctl --since "$timehr ago"
			;;

		*) 
			echo "Opción invalida..."
			;;
		esac
}

timeframe() {
	echo "Especifique la ventana de tiempo,"
	echo "primero el inicio, año-mes-día hora-minuto-segundo"
	echo "Ejemplo: 2021-10-5 21:00:00"
	read initframe
	echo "Ahora la fecha final"
	read endframe
	journalctl --since "$initframe" --until "$endframe"
}


clear

echo "Seleccione log de interés:"
echo "1. Log completo"
echo "2. Log del último inicio del sistema"
echo "3. Log de la última hora"
echo "4. Log en tiempo real"
echo "5. Log de un usuario"
echo "6. Log de autorizaciones de acceso"
echo "7. Log de eventos de error/críticos"
echo "8. Log de un servicio/daemon"
echo "9. Log de minutos/horas antes de ahora"
echo "10. Log de una ventana de tiempo a especificar"

read sel

case $sel in
	1)
		clear
		flog
		;;
	2)
		clear
		bootlog
		;;
	3)
		clear
		lasthour
		;;
	4)
		clear
		realtime
		;;
	5)
		clear
		userlog
		;;
	6)
		clear
		authlog
		;;
	7)
		clear
		critical
		;;
	8)
		clear
		status
		;;
	9)
		clear
		customtime
		;;
	10)
		clear
		timeframe
		;;
	*)
		echo "Opción no válida..."
		;;

esac

