#!/bin/bash

echo "Ingrese 1 para reiniciar NetworkManager"
echo "Ingrese 2 para habilitar el firewall"
echo "Ingrese 3 para deshabilitar el firewall"
echo "Ingrese 4 para restablecer la configuración de red"
read optn
	case $optn in
                1)
                        clear
			systemctl restart NetworkManager.service
                        ;;
                2)
                        clear
			ufw enable
                        ;;
                3)
                        clear
			ufw disable
                        ;;


                4)
                        clear
			logname >> /root/logs/log.txt
                        date >> /root/logs/log.txt
                        echo "Ejecuto el script de configuracion inicial de red" >> /root/logs/log.txt
                        echo "" >> /root/logs/log.txt
                        bash /root/networkreset.sh
                        bash /root/networkconf.sh
                        reboot
                        ;;
                *)
			clear
                        echo "Ingreso un valor no valido..."
                        ;;
        esac
