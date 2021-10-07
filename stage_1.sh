#!/bin/bash

timedatectl set-ntp true

echo "type=83" | sfdisk /dev/sda

mkfs.ext4 /dev/sda1

mount /dev/sda1 /mnt

pacstrap /mnt base neovim nano apache networkmanager mariadb php fish htop linux linux-firmware man-db expect cronie grub phpmyadmin git sed ufw 

genfstab -U /mnt >> /mnt/etc/fstab

cp ~/siscoinUNIT/*.sh /mnt/root/

arch-chroot /mnt

reboot
