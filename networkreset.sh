#!/bin/bash

# Elimina redes para que no haya errores al crearlas de nuevo en nmcli

nmcli con del intranet
nmcli con del internet
