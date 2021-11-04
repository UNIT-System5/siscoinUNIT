#!/bin/bash

flaw6() {
	echo "---VOLVIENDO AL MENU---"
	for i in {0..8}
	do
		g=$i
		((g++))
		echo $g") ""${userc[$i]}"
	done
}

initusercreation() {
	logname >> /root/logs/log.txt
	date >> /root/logs/log.txt
	echo "Ejecuto el script de creacion inicial de usuarios" >> /root/logs/log.txt
	echo "" >> /root/logs/log.txt
	/bin/bash /root/users.sh
    clear
    echo "Ejecución completa"
	flaw6
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
	flaw6
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
	flaw6
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
	flaw6
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
	flaw6
}

userdel() {
    echo "Ingrese el usuario a borrar:"
    read user2del
    grep "$user2del" /etc/passwd > /dev/null
    if [ $? -eq 0 ]; then
        userdel -r$user2del
        echo "Elimino el usuario $user2del" >> /root/logs/log.txt
        echo "" >> /root/logs/log.txt
        clear
        echo "Operación exitosa: Eliminar usuario"
    else
        echo "Error"
        echo "El usuario parece no existir"
    fi
    flaw6
}

groupdel() {
    echo "Ingrese el grupo a borrar:"
    read group2del
    grep "$group2del" /etc/group > /dev/null
    if [ $? -eq 0 ]; then
        groupdel$group2del
        echo "Elimino el grupo $group2del" >> /root/logs/log.txt
        echo "" >> /root/logs/log.txt
        clear
        echo "Operación exitosa: Eliminar grupo"
    else
        clear
        echo "Error"
        echo "El grupo parece no existir"
    fi
    flaw6
}

chgpswd() {
    echo "Ingrese el nombre del usuario cuya contraseña se desea cambiar:"
    read puser
    grep "$puser" /etc/group > /dev/null
    if [ $? -eq 0 ]; then
        echo "Ingrese la contraseña para el usuario:"
        read -s userp
        echo $puser:$userp | chpasswd
        echo "Cambio la contraseña de $puser" >> /root/logs/log.txt
        echo "" >> /root/logs/log.txt
        clear
        echo "Operación exitosa: Cambiar contraseña de usuario"
    else
        clear
        echo "Error"
        echo "El usuario parece no existir"
    fi
    flaw6
}

echo "¿Qué desea hacer?"

userc=(
"Creación de los usuarios por defecto."
"Agregar usuario de oficina."
"Agregar usuario administrativo (Empresa)."
"Agregar usuario de soporte (UNIT)."
"Agregar grupo."
"Eliminar usuario"
"Eliminar grupo"
"Cambiar contraseña de usuario"
"Salir"
)

select uchoice in "${userc[@]}"
do
case $uchoice in 
    
    "Creación de los usuarios por defecto.")
        clear
        initusercreation
        flaw6
        ;;
    "Agregar usuario de oficina.")
        clear
        addofficeuser
        flaw6
        ;;
    "Agregar usuario administrativo (Empresa).")
        clear
        addadminuser
        flaw6
        ;;
    "Agregar usuario de soporte (UNIT).")
        clear
        addunituser
        flaw6
        ;;
    "Agregar grupo.")
        clear
        addgroup
        flaw6
        ;;
    "Eliminar usuario")
        clear
        userdel
        flaw6
        ;;
    "Eliminar grupo")
        clear
        groupdel
        flaw6
        ;;
    "Cambiar contraseña de usuario")
        clear
        chgpasswd
        flaw6
        ;;
    "Salir")
        clear
        break
        ;;
    *)
        clear
        echo "Ha ingresado un valor no válido..."
        echo ""
        flaw6
        ;;
    esac
done