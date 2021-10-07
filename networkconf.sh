#!/bin/bash

# Script de configuración de red
#!!!REQUIERE NETWORKMANAGER!!!
# Realmente lo que se configura es la red local, acorde al esquema de red de VirtualBox.
# La otra conexion, la NAT, se deja intacta para que el sistema pueda recibir actualizaciones
# desde internet y clonar los scripts necesarios para la instalacion inicial.
# De especificarse que la conexion a internet debe ser eliminada, se dejara solo la interna.


# Quitamos las conexiones predefinidas por NetworkManager. 
# Realmente solo se hace para poder automatizarlo mejor, a 
# veces es impredecible a cual dispositivo (enp0s3 o enp0s8)
# se le va a otorgar el nombre Wired connection 1 y a cual 
# el Wired connection 2, dificultando automatizarlo por
# scripts.
nmcli con del "Wired connection 1"
nmcli con del "Wired connection 2"

# Agregamos la conexion con ip estatica
nmcli connection add type ethernet con-name intranet ifname enp0s3 ip4 192.168.56.101 gw4 192.168.56.1

# Le asignamos un servidor dns
nmcli con mod intranet ipv4.dns 192.168.56.1 ipv4.never-default yes

# Agregamos la conexion DHCP
nmcli connection add type ethernet con-name internet ifname enp0s8

# Levantamos las conexiones
nmcli con up intranet
nmcli con up internet


# Codigo legacy...
#nmcli con mod "Wired connection 2" ipv4.addresses "192.168.56.101/24" ipv4.gateway "192.168.56.1" ipv4.dns "8.8.8.8" ipv4.method "manual"
