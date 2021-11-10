#!/bin/bash

flaw4() {
	echo ""
	echo "---VOLVIENDO AL MENU---"
	for i in {0..4}
	do
		g=$i
		((g++))
		echo $g") ""${networkctls[$i]}"
	done
}

networkctls=(
"Reiniciar NetworkManager"
"Habilitar el firewall"
"Deshabilitar el firewall"
"Restablecer la configuración de red"
"Volver al menú"
)
select networkctlse in "${networkctls[@]}"
do
	case $networkctlse in
                "Reiniciar NetworkManager")
			systemctl restart NetworkManager.service
                        clear
                        flaw4
                        ;;
                "Habilitar el firewall")
			ufw enable
                        clear
                        flaw4
                        ;;
                "Deshabilitar el firewall")
			ufw disable
                        clear
                        flaw4
                        ;;


                "Restablecer la configuración de red")
			logname >> /root/logs/log.txt
                        date >> /root/logs/log.txt
                        echo "Ejecuto el script de configuracion inicial de red" >> /root/logs/log.txt
                        echo "" >> /root/logs/log.txt
                        bash /root/networkreset.sh
                        bash /root/networkconf.sh
                        reboot
                        ;;
                "Volver al menú")
                        clear
                        break
                        ;;
                *)
                        clear
                        echo "Ingreso un valor no valido..."
                        flaw4
                        ;;
        esac
done