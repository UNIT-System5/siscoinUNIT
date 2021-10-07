#!/bin/bash

# Método muy crudo de configurar sudo, cortesía de UNIT.

echo "%empresa ALL=(ALL) ALL
%unit ALL=(ALL) ALL" >> /etc/sudoers
