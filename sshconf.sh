#!/bin/expect 
# Configura las keys SSH, crucial para el respaldo remoto.

# Realmente RSA esta bastante desactualizado, pero bueno, por ser el mas comun usemoslo.
# Generamos las keys...
spawn ssh-keygen -t rsa -b 4096 

# Dejamos el directorio por defecto para las keys
expect "Enter file in which to save the key" { send "\r"}

# Estaria bueno usar una passphrase, pero complicaria la 
# automatizacion, asi que no.
expect "Enter passphrase" { send "\r"}
expect "Enter same passphrase again" { send "\r" }

# Exportamos la key publica al servidor remoto...
spawn ssh-copy-id administrador@192.168.56.201
expect "Are you sure you want to continue connecting" { send "yes\r"}
expect "administrador@192.168.56.201's password" { send "20092009\r"}

# Lo se, contraseñas en archivos de config. No soy MacGyver! No tengo todos los trucos.
# Tengo que aprender a manejar esto, encriptarlas, yqc.
# Pero jaja, complicacion adicional.
