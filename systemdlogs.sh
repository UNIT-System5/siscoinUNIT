#!/bin/bash
flaw2() {
	echo "---VOLVIENDO AL MENU---"
	for i in {0..10}
	do
		g=$i
		((g++))
		echo $g") ""${sysdc[$i]}"
	done
}

flog() {
	journalctl -x
}


bootlog() {
	journalctl -b
}

lasthour() {
	journalctl -x --since "60 min ago"
}

realtime() {
	journalctl -fx
	}

userlog() {
	echo Ingrese el usuario de interés
	read user
	journalctl --user -u $user
}


authlog() {
	journalctl SYSLOG_FACILITY=10
}

critical() {
	journalctl -p err..alert
}

status() {
	echo "Ingrese nombre del servicio a revisar"
	read srv
	journalctl -t $srv
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
			clear
			echo "Opción invalida..."
			flaw2
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
sysdc=(
"Log completo"
"Log del último inicio del sistema"
"Log de la última hora"
"Log en tiempo real"
"Log de un usuario"
"Log de autorizaciones de acceso"
"Log de eventos de error/críticos"
"Log de un servicio/daemon"
"Log de minutos/horas antes de ahora"
"Log de una ventana de tiempo a especificar"
"Volver al menú anterior"
)
select sysdce in "${sysdc[@]}" 

do
case $sysdce in
	"Log completo")
		clear
		flog
		flaw2
		;;
	"Log del último inicio del sistema")
		clear
		bootlog
		flaw2
		;;
	"Log de la última hora")
		clear
		lasthour
		flaw2
		;;
	"Log en tiempo real")
		clear
		realtime
		flaw2
		;;
	"Log de un usuario")
		clear
		userlog
		flaw2
		;;
	"Log de autorizaciones de acceso")
		clear
		authlog
		flaw2
		;;
	"Log de eventos de error/críticos")
		clear
		critical
		flaw2
		;;
	"Log de un servicio/daemon")
		clear
		status
		flaw2
		;;
	"Log de minutos/horas antes de ahora")
		clear
		customtime
		flaw2
		;;
	"Log de una ventana de tiempo a especificar")
		clear
		timeframe
		flaw2
		;;

	"Volver al menú anterior")
		clear
		break
		;;
	*)
		clear
		echo "Opción no válida..."
		flaw2
		;;

esac
done
