#!/bin/sh
# ctrlhat-install.sh Easy installer for CTRL HAT

CONFIG="/boot/config.txt"
VSFTPD="/etc/vsftpd.conf"
INPUT="Please answer yes or no."

# Arguments: 1 search, 2 replace, 3 setting name, 4 file
update_file() {
	if grep -Fq $1 $4
		then
			echo "$3 found in $4, updating ..."
			sed -i "/$1/c\\$2" $4
	
	else
		echo "Added $3 in $4 ..."
		echo "$2" >> $4
	fi
}

update_file "dtparam=i2c_arm" "dtparam=i2c_arm=on" "I2C interface setting" $CONFIG
update_file "dtparam=i2c_vc" "dtparam=i2c_vc=on" "I2C bus 0" $CONFIG
update_file "dtparam=i2c1" "dtparam=i2c1=on" "I2C bus 1" $CONFIG
update_file "dtparam=i2c_baudrate" "dtparam=i2c_baudrate=400000" "I2C bus baudrate setting" $CONFIG


echo "Install CTRL HAT required packages ..."
apt-get install i2c-tools wiringpi apache2 php libapache2-mod-php subversion -y


echo "Add pi user to i2c user group ..."
adduser pi i2c


echo "Install CTRL HAT Web GUI ..."
rm -rf /var/www/html/*
svn checkout https://github.com/plasmadancom/CTRL-HAT/trunk/gui /var/www/html
chmod -R 755 /var/www
echo "CTRL HAT Web GUI Installed."
hostname -I


# vsftpd?
while true; do
    read -p "Install vsftpd?" yn
    case $yn in
        [Yy]* )
			apt install vsftpd -y
			chown -R pi /var/www
			update_file "write_enable" "write_enable=YES" "write_enable setting" VSFTPD
			update_file "force_dot_files" "force_dot_files=YES" "force_dot_files setting" VSFTPD
			service vsftpd restart
			break
			;;
        [Nn]* ) break;;
        * ) echo $INPUT;;
    esac
done


# WiringPi for Python?
while true; do
    read -p "Install WiringPi for Python?" yn
    case $yn in
        [Yy]* )
			apt-get install python-pip
			pip install wiringpi
			break
			;;
        [Nn]* ) break;;
        * ) echo $INPUT;;
    esac
done


# Reboot?
while true; do
    read -p "Install Complete. Reboot?" yn
    case $yn in
        [Yy]* ) reboot; break;;
        [Nn]* ) break;;
        * ) echo $INPUT;;
    esac
done