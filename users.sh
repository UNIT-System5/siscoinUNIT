#!/bin/bash
groupadd empresa
groupadd unit


echo "root:20092009" | chpasswd
sleep 1
useradd -m oficina 
sleep 1
echo "oficina:20092009" | chpasswd
sleep 1
useradd -m -g empresa administrador
sleep 1
echo "administrador:20092009" | chpasswd
sleep 1
useradd -m -g unit sysadmin
sleep 1
echo "sysadmin:20092009" | chpasswd 
