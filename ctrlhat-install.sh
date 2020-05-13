#!/bin/sh
# ctrlhat-install.sh Easy installer for CTRL HAT

CONFIG="/boot/config.txt"
VSFTPD_CONF="/etc/vsftpd.conf"
CONFIRM_INPUT="Please answer yes or no."
GUI_FILES="https://github.com/plasmadancom/CTRL-HAT/trunk/gui"

INSTALL_WEBROOT=false
INSTALL_FTP=false

# Arguments: 1 search, 2 replace, 3 setting name, 4 file
update_file() {
	if grep -Fq $1 $4
		then
			echo "Update $3 found in $4 ..."
			sed -i "/$1/c\\$2" $4
	else
		echo "Add $3 in $4 ..."
		echo "$2" >> $4
	fi
}


while true; do
    read -p "Install GUI at web root? This will empty the web root! [Y/n] " yn
    case $yn in
        [Yy]* )
			INSTALL_WEBROOT=true
			break
			;;
        [Nn]* )
			echo "GUI will be installed in subdirectory: ctrlhat"
			break
			;;
        * ) echo $CONFIRM_INPUT;;
    esac
done


while true; do
    read -p "Install vsftpd? [Y/n] " yn
    case $yn in
        [Yy]* )
			INSTALL_FTP=true
			break
			;;
        [Nn]* ) break;;
        * ) echo $CONFIRM_INPUT;;
    esac
done


echo "Enable I2C interface ..."
raspi-config nonint do_i2c 0

update_file "dtparam=i2c_arm" "dtparam=i2c_arm=on" "I2C interface setting" $CONFIG
update_file "dtparam=i2c_vc" "dtparam=i2c_vc=on" "I2C bus 0" $CONFIG
update_file "dtparam=i2c1" "dtparam=i2c1=on" "I2C bus 1" $CONFIG
update_file "dtparam=i2c_baudrate" "dtparam=i2c_baudrate=400000" "I2C bus baudrate setting" $CONFIG


echo "Update package lists and upgrade ..."
apt-get update -y
apt-get upgrade -y


echo "Install CTRL HAT required packages ..."
apt-get install i2c-tools wiringpi apache2 php libapache2-mod-php subversion python-pip -y
pip install wiringpi


echo "Add pi user to i2c user group ..."
adduser pi i2c


echo "Install CTRL HAT Web GUI ..."

# Install at web root?
if [ "$INSTALL_WEBROOT" = true ]
	then
		rm -rf /var/www/html/*
		svn checkout $FILES /var/www/html
else
	mkdir /var/www/html/ctrlhat
	svn checkout $FILES /var/www/html/ctrlhat
fi


# Install vsftpd?
if [ "$INSTALL_FTP" = true ]
	then
		apt-get install vsftpd -y
		chown -R pi /var/www
		update_file "write_enable" "write_enable=YES" "write_enable setting" $VSFTPD_CONF
		update_file "force_dot_files" "force_dot_files=YES" "force_dot_files setting" $VSFTPD_CONF
		service vsftpd restart
fi


chmod -R 755 /var/www
hostname -I
echo "CTRL HAT Web GUI Installed. Please reboot."

exit 0