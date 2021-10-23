#!/bin/bash
# Script crudo, sucio, asquerosisímo, hasta peligroso, para configurar cron.
# Tener que automatizar estas cosas implica tener que usar cosas así,
# en vez de hacerlo como se debe con crontab -e, o visudo para sudo.
# Bueno, en realidad no es tan malo ya que /etc/crontab es para tareas del
# sistema. La unica diferencia en el formato del archivo es que hay que 
# especificar el usuario. Los scripts necesitan root, asi que eso es 
# lo que les di.
# Los crontab normales de los usuarios irian en /var/spool/cron 
# Todos los dias se aprende algo. Tengo que decidir igual si voy a permitir
# que los usuarios manejen cron, es decir, si los pongo en el archivo
# /etc/cron.allow y como lo automatizo para nuevos usuarios si lo termino
# haciendo.


echo '
# Automatiza el backup de la base de datos... 
0 6 * * * root /root/backup_sql.sh
# Automatiza el backup de los directorios home...
0 6 * * * root /root/homebackup.sh
# Automatiza el backup de /etc...
0 6 * * * root /root/backup_conf.sh
# 2da iteracion diaria del backup de la bd...
0 19 * * * root /root/backup_sql.sh
# 2da iteracion diaria del backup de los dir home...
0 19 * * * root /root/homebackup.sh
# 2da iteracion diaria del backup de /etc...
0 19 * * * root /root/backup_conf.sh
# Se manda todo lo que esta en /mnt/backup_device al servidor de backup remoto,
# con un retraso de 15 minutos respecto a la ejecucion del "backup" local.
15 6 * * * root /root/remote_backup.sh
# Lo mismo, pero la 2da iteracion diaria.
15 19 * * * root /root/remote_backup.sh
# Hace un backup no incremental del directorio home. DEPRECADO
# 0 6 * * 0 root /root/fullhome.sh
# Hace un backup no incremental de /etc. DEPRECADO
# 0 6 * * 0 root /root/fullconf.sh
# Realiza un backup no incremental a la ubicacion de red.
15 6 * * 0 root /root/fullremote.sh
' > /etc/crontab
