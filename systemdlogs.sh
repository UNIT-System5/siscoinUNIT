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
	systemctl status $srv
	exit
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

esac

