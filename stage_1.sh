#!/bin/bash

systemctl stop reflector

reflector --sort rate --country "United States" --protocol https --latest 10 --save /etc/pacman.d/mirrorlist

timedatectl set-ntp true

echo "type=83" | sfdisk /dev/sda

mkfs.ext4 /dev/sda1

mount /dev/sda1 /mnt

pacstrap /mnt base neovim nano apache networkmanager mariadb php fish htop linux-lts linux-firmware man-db expect cronie grub phpmyadmin git sed openssh rsync intel-ucode amd-ucode sudo virtualbox-guest-utils-nox zram-generator neofetch firewalld packagekit udisks2 cockpit

genfstab -U /mnt >> /mnt/etc/fstab

cp ~/siscoinUNIT/* /mnt/root/

arch-chroot /mnt bash /root/stage_2.sh; reboot


