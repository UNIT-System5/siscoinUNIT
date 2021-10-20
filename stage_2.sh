#!/bin/bash

ln -sf /usr/share/zoneinfo/America/Montevideo /etc/localtime

hwclock --systohc

echo "en_US.UTF-8 UTF-8
es_ES.UTF-8 UTF-8" >> /etc/locale.gen

locale-gen

echo "LANG=en_US.UTF-8" > /etc/locale.conf

echo "KEYMAP=es" > /etc/vconsole.conf

echo "siscoin" > /etc/hostname

echo "127.0.0.1	localhost
::1	localhost
127.0.1.1	siscoin.localdomain siscoin" >> /etc/hosts

systemctl enable NetworkManager

echo "root:20092009" | chpasswd
sleep 1

echo "
@reboot root /bin/bash /root/initconf.sh
" > /etc/crontab  

systemctl enable cronie

grub-install --target=i386-pc /dev/sda

grub-mkconfig -o /boot/grub/grub.cfg


