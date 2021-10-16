#!/bin/bash


echo "Ingrese 1 para  habilitar Cron"
echo "Ingrese 2 para deshabilitar Cron"
echo "Ingrese 3 para reiniciar Cron"
read opt
	case $opt in
                1)
                        systemctl enable --now cronie.service
                        ;;
                2)
                        systemctl disable --now cronie.service
                        ;;
                3)
                        systemctl restart cronie.service
                        ;;
                *)
                        echo "Ingreso un valor no valido..."
                        ;;
        esac
