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
	flaw
}

backupdb() {
	logname >> /root/logs/log.txt
	date >> /root/logs/log.txt
	echo "Manualmente realizo un respaldo de la base de datos" >> /root/logs/log.txt
	echo "Resultado de la operación: " >> /root/logs/log.txt
	/bin/bash /root/backup_sql.sh 2>> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
	flaw
}

restoredb() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Restauro base de datos desde respaldo" >> /root/logs/log.txt
	echo "Resultado de la operación: " >> /root/logs/log.txt
    /bin/bash /root/restore_sql.sh 2>> /root/logs/log.txt 
	echo "" >> /root/logs/log.txt
	flaw
}

cronctl() {
	/bin/bash /root/cronctl.sh
	flaw
}

networkctl() {
	/bin/bash /root/networkctl.sh
	flaw 
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
		clear
	echo "Operación exitosa: Crear usuario de oficina"
	fi
	flaw
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
		clear
		echo "Operación exitosa: Crear usuario administrativo"
	fi 
	flaw
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
	clear
	echo "Operación exitosa: Crear usuario de soporte"
	fi
	flaw
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
		clear
		echo "Operación exitosa: añadir grupo"
	fi
	flaw
}

homebackup() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Realizo un backup manual de los directorios home" >> /root/logs/log.txt
    echo "Resultado de la operación: " >> /root/logs/log.txt
	/bin/bash /root/homebackup.sh 2>> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
	flaw
}

remote_backup() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Manualmente realizo un backup al servidor remoto" >> /root/logs/log.txt
    echo "Resultado de la operación: " >> /root/logs/log.txt
	/bin/bash /root/remote_backup.sh 2>> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
	flaw
}

backup_conf() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Realizo un backup manual del directorio de configuracion" >> /root/logs/log.txt
    echo "Resultado de la operación: " >> /root/logs/log.txt
	/bin/bash /root/backup_conf.sh 2>> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
	flaw
}


restore_home() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Inicio la restauración de los directorios home" >> /root/logs/log.txt
    #echo "Salida del comando: " >> /root/logs/log.txt
	/bin/bash /root/restore_home.sh 
	#echo "" >> /root/logs/log.txt
	flaw
}


restore_conf() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Inicio la restauración del directorio de configuracion" >> /root/logs/log.txt
    #echo "Salida del comando: " >> /root/logs/log.txt
	/bin/bash /root/restore_conf.sh
	#echo "" >> /root/logs/log.txt
	flaw
}

restore_remote() {
	logname >> /root/logs/log.txt
    date >> /root/logs/log.txt
    echo "Descargo backups del servidor remoto" >> /root/logs/log.txt
    echo "Resultado de la operación: " >> /root/logs/log.txt
	#/bin/bash /root/restore_remote.sh 2>> /root/logs/log.txt
	/bin/bash /root/restore_ctl.sh 2>> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
	flaw
}


sysdlog() {
	/bin/bash /root/systemdlogs.sh
	flaw
}

unitlogs() {
	/bin/bash /root/unitlogs.sh
	flaw
}

backup_pol() {
	/bin/bash /root/backup_pol.sh
	flaw
}

flaw() {
	echo "---VOLVIENDO AL MENU---"
	for i in {0..18}
	do
		g=$i
		((g++))
		echo $g") ""${choices[$i]}"
	done
}

 
PS3="Seleccione lo que desea hacer, ingresando el correspondiente número: "
choices=(
"Creación de los usuarios por defecto." 
"Crear respaldo de la base de datos." 
"Restaurar base de datos." 
"Control de Cron."
"Control de Red."
"Agregar usuario de oficina."
"Agregar usuario administrativo (Empresa)."
"Agregar usuario de soporte (UNIT)."
"Agregar grupo."
"Backup de la carpeta personal."
"Backup de archivos de configuración."
"Backup a servidor remoto."
"Restaurar archivos directorio Home."
"Restaurar archivos de configuración."
"Recibir respaldos del servidor remoto."
"Acceder a submenú logs systemd (Servicios/usuarios del sistema)."
"Ver logs de auditoría y errores (Scripts de UNIT)."
"Ver/editar política de respaldos."
"Salir."
)
select choice in "${choices[@]}"
do 
case $choice in
	"Creación de los usuarios por defecto.")
		clear
		initusercreation
		;;
	"Crear respaldo de la base de datos.")
		clear
		backupdb
		;;
	"Restaurar base de datos.")
		clear
		restoredb
		;;
	"Control de Cron.")
		clear
		cronctl
		;;
	"Control de Red.")
		clear
		networkctl
		;;
	"Agregar usuario de oficina.")
		clear
		addofficeuser
		;;
	"Agregar usuario administrativo (Empresa).")
		clear
		addadminuser
		;;
	"Agregar usuario de soporte (UNIT).")
		clear
		addunituser
		;;
	"Agregar grupo.")
		clear
		addgroup
		;;

	"Backup de la carpeta personal.") 
		clear
		homebackup
		;;
		

	"Backup de archivos de configuración.")
		clear
		backup_conf
		;;


	"Backup a servidor remoto.") 
		clear
		remote_backup
		;;
		
	"Restaurar archivos directorio Home.")
		clear
		restore_home
		;;
	
	"Restaurar archivos de configuración.")
		clear
		restore_conf
		;;

	"Recibir respaldos del servidor remoto.")	
		clear
		restore_remote
		;;

	"Acceder a submenú logs systemd (Servicios/usuarios del sistema).")
		clear
		sysdlog
		;;

	"Ver logs de auditoría y errores (Scripts de UNIT).")
		clear
		unitlogs
		;;

	"Ver/editar política de respaldos.")
		clear
		backup_pol
		;;

	"Salir.")
		clear
		echo "Adiós..."
		break
		;;
	
	*)
		clear
        echo "Ha ingresado un valor inválido..."
		echo ""
		flaw 
        ;;


esac
done 
	
