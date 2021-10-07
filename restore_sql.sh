#!/bin/bash

user=director
pswd=director1234

# Hermosa contraseña no profe :)


gunzip /mnt/backup_device/database.sql.gz
mysqladmin drop siscoin_unit -u $user -p$pswd
mysqladmin create siscoin_unit -u $user -p$pswd
mysql siscoin_unit < /mnt/backup_device/database.sql
