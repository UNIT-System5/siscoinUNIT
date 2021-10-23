#!/bin/bash
# Controla si el usuario desea restaurar los backups incrementales o los completos.

restorectls=(
"Restaurar incrementales"
"Restaurar no incrementales"
"Salir"
)
select restorectlse in "${restorectls[@]}"
do
	case $restorectlse in
                "Restaurar incrementales")
                        /bin/bash /root/restore_remote.sh 2>> /root/logs/log.txt
                        echo "Ingrese 3 para salir"
                        ;;
                "Restaurar no incrementales")
                        /bin/bash /root/restore_remote_full.sh 2>> /root/logs/log.txt
                        echo "Ingrese 3 para salir"
                        ;;
                "Salir")
                        clear
                        break
                        ;;
                *)
                        clear
                        echo "Ingreso un valor no valido..."
                        echo "1 para los incrementales, 2 para los no incrementales, 3 para salir."
                        ;;
        esac
done