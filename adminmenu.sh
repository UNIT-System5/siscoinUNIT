#!/bin/bash

logname >> /root/logs/log.txt
date >> /root/logs/log.txt
echo "Accedio al menu administrativo" >> /root/logs/log.txt
echo "" >> /root/logs/log.txt

initusercreation() {
	logname >> /root/logs/log.txt
	date >> /root/logs/log.txt
	echo "Ejecuto el script de creacion inicial de usuarios" >> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
	/bin/bash /root/users.sh
}

backupdb() {
	logname >> /root/logs/log.txt
	date >> /root/logs/log.txt
	echo "Manualmente realizo un respaldo de la base de datos" >> /root/logs/log.txt
	echo "Resultado de la operación: " >> /root/logs/log.txt
	/bin/bash /root/backup_sql.sh 2>> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
}

restoredb() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Restauro base de datos desde respaldo" >> /root/logs/log.txt
	echo "Resultado de la operación: " >> /root/logs/log.txt
    /bin/bash /root/restore_sql.sh 2>> /root/logs/log.txt 
	echo "" >> /root/logs/log.txt
}

cronctl() {
	/bin/bash /root/cronctl.sh
}

networkctl() {
	/bin/bash /root/networkctl.sh 
}

addofficeuser() {
	echo "Ingrese el nombre para el nuevo usuario:"
	read usero
	grep "$usero" /etc/passwd >/dev/null
	if [ $? -eq 0 ]; then
		echo "El usuario ya existe"
		exit
	else
		useradd -m "$usero"
	sleep 1
	echo "Ingrese la contraseña para el nuevo usuario"
	read -s pswdo
	echo "$usero:$pswdo" | chpasswd
	sleep 1
	logname >> /root/logs/log.txt
        date >> /root/logs/log.txt
	echo "Creo un usuario de oficina" >> /root/logs/log.txt
        echo "" >> /root/logs/log.txt
	fi
}

addadminuser() {
	echo "Ingrese el nombre para el nuevo usuario:"
	read usera
	grep "$usera" /etc/passwd >/dev/null
	if [ $? -eq 0 ]; then
		echo "El usuario ya existe"
	else
		useradd -m -g empresa "$usera"
	sleep 1
	echo "Ingrese la contraseña para el nuevo usuario"
	read -s pswda
	echo "$usera:$pswda" | chpasswd
	sleep 1
	logname >> /root/logs/log.txt
        date >> /root/logs/log.txt
        echo "Creo un usuario administrativo" >> /root/logs/log.txt
        echo "" >> /root/logs/log.txt
	fi 
}

addunituser() {
	echo "Ingrese el nombre para el nuevo usuario:"
	read useru
	grep "$useru" /etc/passwd >/dev/null
	if [ $? -eq 0 ]; then
		echo "El usuario ya existe"
	else
		useradd -m -g unit "$useru"
	sleep 1 
	echo "Ingrese la contraseña para el nuevo usuario"
	read -s pswdu
	echo "$useru:$pswdu" | chpasswd
	sleep 1
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Creo un usuario del grupo UNIT" >> /root/logs/log.txt
    echo "" >> /root/logs/log.txt
	fi
}

addgroup() {
	echo "Ingrese nombre para el nuevo grupo:"
	read ngroup
	grep "$ngroup" /etc/group >/dev/null
	if [ $? -eq 0 ]; then
		echo "El grupo ya existe"
	else
		groupadd "$ngroup"
		logname >> /root/logs/log.txt
        date >> /root/logs/log.txt
        echo "Creo un grupo" >> /root/logs/log.txt
        echo "" >> /root/logs/log.txt
	fi
}

homebackup() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Realizo un backup manual de los directorios home" >> /root/logs/log.txt
    echo "Resultado de la operación: " >> /root/logs/log.txt
	/bin/bash /root/homebackup.sh 2>> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
}

remote_backup() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Manualmente realizo un backup al servidor remoto" >> /root/logs/log.txt
    echo "Resultado de la operación: " >> /root/logs/log.txt
	/bin/bash /root/remote_backup.sh 2>> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
}

backup_conf() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Realizo un backup manual del directorio de configuracion" >> /root/logs/log.txt
    echo "Resultado de la operación: " >> /root/logs/log.txt
	/bin/bash /root/backup_conf.sh 2>> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
}


restore_home() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Restauro los directorios home" >> /root/logs/log.txt
    #echo "Salida del comando: " >> /root/logs/log.txt
	/bin/bash /root/restore_home.sh 
	#echo "" >> /root/logs/log.txt
}


restore_conf() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Restauro el directorio de configuracion" >> /root/logs/log.txt
    #echo "Salida del comando: " >> /root/logs/log.txt
	/bin/bash /root/restore_conf.sh
	#echo "" >> /root/logs/log.txt
}

restore_remote() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Descargo backups del servidor remoto" >> /root/logs/log.txt
    echo "Resultado de la operación: " >> /root/logs/log.txt
	/bin/bash /root/restore_remote.sh 2>> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
}


sysdlog() {
	/bin/bash /root/systemdlogs.sh
}

unitlogs() {
	echo "¿Qué logs desea ver?"
	echo "1) Logs de operaciones y errores."
	echo "2) Logs de transacciones efectuadas por rsync."
	read logch
	case $logch in
		1)
			less /root/logs/log.txt
			;;
		2)
			less /root/logs/rsynclog.txt
			;;
		*)
			echo "¿Es tan díficil elegir entre dos opciones?"
			;;
	esac 
}

clear
echo "Seleccione lo que desea hacer, ingresando el correspondiente número"
echo "1. Creación de los usuarios por defecto."
echo "2. Crear respaldo de la base de datos."
echo "3. Restaurar base de datos."
echo "4. Control de Cron."
echo "5. Control de Red."
echo "6. Agregar usuario de oficina."
echo "7. Agregar usuario administrativo (Empresa)."
echo "8. Agregar usuario de soporte UNIT."
echo "9. Agregar grupo."
echo "10. Backup de la carpeta personal."
echo "11. Backup de archivos de configuración"
echo "12. Backup a servidor remoto."
echo "13. Restaurar archivos directorio Home"
echo "14. Restaurar archivos de configuración"
echo "15. Recibir respaldos del servidor remoto"
echo "16. Acceder a submenú logs systemd (Servicios/usuarios del sistema)"
echo "17. Ver logs de auditoría y errores (Scripts de UNIT)"

read choice

case $choice in
	1)
		clear
		initusercreation
		;;
	2)
		clear
		backupdb
		;;
	3)
		clear
		restoredb
		;;
	4)
		clear
		cronctl
		;;
	5)
		clear
		networkctl
		;;
	6)
		clear
		addofficeuser
		;;
	7)
		clear
		addadminuser
		;;
	8)
		clear
		addunituser
		;;
	9)
		clear
		addgroup
		;;

	10) 
		clear
		homebackup
		;;
		

	


	11)
		clear
		backup_conf
		;;


	12) 
		clear
		remote_backup
		;;
		
	13)
		clear
		restore_home
		;;
	
	14)
		clear
		restore_conf
		;;

	15)	
		clear
		restore_remote
		;;

	16)
		clear
		sysdlog
		;;

	17)
		clear
		unitlogs
		;;
	*)
                echo "Ingreso un valor no valido..."
                ;;


esac

	
