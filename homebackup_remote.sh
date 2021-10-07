#!/bin/bash
# Cortesia, nuevamente, de la fantastica wiki de Arch Linux.
# NOTA: Los datos son genericos; se desconoce el esquema de red del servidor
# del cliente, por ende no se puede definir nada. Naturalmente se asume
# tambien que se trabajara con keys, no con contraseñas, de ahi su ausencia.


rsync -a --delete --quiet -e ssh /directorio_a_respaldar usuario_backup@servidor_backup:/directorio_backup
