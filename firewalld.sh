#!/bin/bash

systemctl enable --now firewalld
firewall-cmd --set-default-zone=public --permanent
firewall-cmd --zone=public --add-service=mysql --permanent
firewall-cmd --zone=public --add-service=http --permanent
firewall-cmd --zone=public --add-service=https --permanent
firewall-cmd --zone=public --add-port=9090 --permanent

