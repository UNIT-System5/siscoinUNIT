#!/bin/bash

# Lo habilitamos con systemd...
# systemctl enable --now ufw

# Configuramos la politica por defecto
ufw default deny

# Permitimos trafico por la intranet...
ufw allow from 192.168.56.0/24
ufw allow from any to any port 3306

# Lo habilitamos...
ufw enable
systemctl enable ufw


