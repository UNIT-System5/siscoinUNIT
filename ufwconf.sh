#!/bin/bash

# Lo habilitamos con systemd...
systemctl enable --now ufw

# Lo configuramos...
ufw default deny
ufw enable


