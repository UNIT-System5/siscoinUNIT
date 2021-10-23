#!/bin/bash

flaw3() {
	echo ""
	echo "---VOLVIENDO AL MENU---"
	for i in {0..3}
	do
		g=$i
		((g++))
		echo $g") ""${cronctls[$i]}"
	done
}

cronctls=(
"Habilitar Cron"
"Deshabilitar Cron"
"Reiniciar Cron"
"Salir"
)
select cronctlse in "${cronctls[@]}"
do
	case $cronctlse in
                "Habilitar Cron")
                        systemctl enable --now cronie.service
                        ;;
                "Deshabilitar Cron")
                        systemctl disable --now cronie.service
                        ;;
                "Reiniciar Cron")
                        systemctl restart cronie.service
                        ;;
                "Salir")
                        clear
                        break
                        ;;
                *)
                        clear
                        echo "Ingreso un valor no valido..."
                        flaw3
                        ;;
        esac
done