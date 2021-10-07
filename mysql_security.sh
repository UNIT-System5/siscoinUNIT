#!/bin/expect
# Este script ejecuta la configuracion mysql_secure_installation. Podria
# haber editado my.cnf manualmente, pero me parecio mas divertido esto.

spawn mysql_secure_installation
expect "Enter current password for root" { send "\r"}
expect "Switch to unix_socket authentication" { send "n\r"}
expect "Change the root password?" { send "\r"}
expect "New password:" { send "20092009\r"}
expect "Re-enter new password:" { send "20092009\r"}
expect "Remove anonymous users?" { send \r }
expect "Disallow root login remotely?" { send \r }
expect "Remove test database and access to it?" { send \r }
expect "Reload privilege tables now?" { send \r }


# Esto se volvio todavia mas tonto cuando me di cuenta de que
# mysql_secure_installation es un script de bash y de que podria
# simplemente haber copiado los comandos AAAAAAAAAAAAA
