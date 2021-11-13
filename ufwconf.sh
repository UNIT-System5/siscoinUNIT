#!/bin/bash

# Lo habilitamos con systemd...
# systemctl enable --now ufw

# Configuramos la politica por defecto
ufw default deny

# Permitimos trafico por la intranet...
ufw allow from 192.168.56.0/24
ufw allow "WWW Full"

# Lo habilitamos...
ufw enable


