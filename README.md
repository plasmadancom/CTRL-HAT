# CTRL-HAT

## Responsive Web GUI

![CTRL HAT Web GUI](/ctrl-hat-web-gui.gif)

Once installed on your Raspberry Pi, this interactive GUI allows quick & easy control of your CTRL HAT without the need for any coding. It is designed to be both a user guide & quick reference to the CTRL HAT pinout. The GUI is fully responsive and adapts to any screen size.

## Built-in GPIO Expander

Featuring the well-documented MCP23017 16 channel GPIO expander, CTRL HAT is easy to setup and control via I2C. Channels 0-4 (Group A) are utilised for the solid state relays, giving you an extra 12 GPIOs for each CTRL HAT you have installed on your Pi!

## Cross Compatible*

While built primarily to fit onto a Raspberry Pi, CTRL HAT can be used with any device that features an I2C bus. The 2-wire I2C pins are labeled to make it easy to connect to your preferred device.

## Stackable

Multiple CTRL HATs can easily be stacked using standoffs. Since they work off the I2C bus, you can have up to 8 devices on a single Pi, and not just CTRL HATs, other I2C devices can work along-side CTRL HAT simply by configuring the I2C address.

# Web GUI Installation

## Prerequisites

Raspberry Pi with Raspian:
https://www.raspberrypi.org/downloads/raspbian/

I recommend a clean Raspian install before proceeding.

```
sudo bash
```

Update Raspian

```
apt-get update
apt-get upgrade
```

## Install Apache components

```
apt-get install apache2 php5 libapache2-mod-php5
```

## Install WiringPi

```
apt-get install git-core -y
```

Get repo

```
git clone git://git.drogon.net/wiringPi
```

Build WiringPi

```
cd wiringPi
git pull origin
./build
```

Before proceeding, check WiringPi is working correctly.

```
gpio -v
gpio readall
```

## Install SVN

```
apt-get install subversion
```

## Clone Repo Contents

```
cd /var/www/html
```

Empty default Apache files

```
rm -rf *
```

Clone repo

```
svn checkout https://github.com/plasmadancom/CTRL-HAT/trunk/gui .
```

Be sure to set file permissions to 755 in the web directory.

```
chmod -R 755 /var/www
```

Apache requires sudo permission to use WiringPi.
Note: If your Raspberry Pi is on a shared network you may want to find a more secure method than this.

```
echo "www-data ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers
```

## Optional: install vsftpd for easier file editing

```
apt-get install vsftpd -y
```

Change user for vsftpd

```
chown -R pi /var/www
```

Edit vsftpd.conf

```
nano /etc/vsftpd.conf
```

Uncomment the following line:

```
write_enable=YES
```

Add the following line:

```
force_dot_files=YES
```

Restart vsftpd

```
service vsftpd restart
```

## Config

There are various configuration options in the config file :```/gui/config.php```

You can customise the I2C address, GPIO setup, or disable any solid state relay channels you don't need.

## License

MIT © Dan Jones - [PlasmaDan.com](https://plasmadan.com)
