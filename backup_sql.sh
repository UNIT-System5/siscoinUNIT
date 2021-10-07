#!/bin/bash
mysqldump --all-databases --single-transaction | gzip > /mnt/backup_device/database.sql.gz


# Idealmente puede ser copiado al mismo directorio que trabaja con el servidor 
# remoto, copiando todo de una vez y no teniendo que hacer otro script para
# respaldar MySQL por SSH.
