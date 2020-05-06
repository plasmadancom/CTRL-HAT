# CTRL-HAT
<p align="center">
    <img alt="CTRL HAT Animated" src="/img/ctrl-hat-animated.gif">
</p>

A Raspberry Pi HAT I/O board specifically designed for use with Crydom style SIP PCB mounted solid state relays (SSRs).

This project is an evolution of previous I/O &amp; relay interface boards we have created primarily for home automation purposes. We saw a need for a low cost high current capacity solid state relay control board for switching inductive loads such as motorised blinds, without the need for costly extra hardware such as SSR modules or contactors. CTRL HAT is ideally suited to automation or industrial control applications requiring high-speed switching, or switching of loads not suitable for regular mechanical relays, such as motors, power supplies, or noise sensitive equipment such as amplifiers.

## Features

* Support 4 Industry Standard SIP type Solid State Relays
* Easy to use [interactive web GUI](#interactive-web-gui)
* Stackable. Use up-to eight CTRL HATs with a single Pi
* 16-port [GPIO expander](#built-in-gpio-expander)
* 5V / 3.3V GPIO voltage selection via [jumper](#device-compatibility)
* Supports range of [SSR control voltages](#isolating-the-relays)
* Can be used with any MCP23017 compatible host device
* Built-in user programmable ID EEPROM
* Support for multiple connector types
* Conforms to Raspberry Pi HAT Specifications
* Enormous range of applications

## Why Solid State Relays?

* Low Power – Up-to 32 SSRs using 8 CTRL HATs on a single Raspberry Pi, with a single power supply!
* Low Noise – SSRs generate minimal electrical noise compared to mechanical relays
* High Speed – SSRs typically switch around 100 times faster than mechanical relays with no contact bounce
* Reliability – High resistance to shock & vibration makes SSRs suitable for use in demanding environments
* Opto-Isolated – Typical opto-osolation of > 4000VAC
* Zero Sparks – SSRs do not generate electrical arcs or sparks like mechanical relays
* Zero Noise – No moving parts means completely silent switching operation
* Life Expectancy – Increased operational cycles compared to mechanical relays

## Typical Applications

* High speed and frequent switching operations
* Applications in high vibration environments
* Applications near sensitive electronic components
* Dusty or humid environments
* Hazardous locations

## Interactive Web GUI
<p align="center">
    <a href="http://ctrlhat.plasmadan.com/" target="_blank" rel="nofollow">
        <img alt="CTRL HAT Web GUI" src="/img/ctrl-hat-web-gui.gif">
    </a>
</p>

Once installed on your Raspberry Pi, this interactive GUI allows quick &amp; easy control of your CTRL HAT without the need for any coding. It is designed to be both a user guide &amp; quick reference to the CTRL HAT pinout. The GUI is fully responsive and adapts to any screen size.

Check-out the [Live Demo.](http://ctrlhat.plasmadan.com/)

## Easy Installer

<p align="center">
    <img alt="CTRL HAT Installer" src="/img/ctrlhat-install.gif" width="75%">
</p>

This bash script will automatically enable I2C, install the required packages and setup the Web GUI.<br/>**Note: The installer will delete all files in `/var/www/html` in order to install the web GUI.**

```
sudo wget https://github.com/plasmadancom/CTRL-HAT/raw/master/ctrlhat-install.sh
sudo bash ctrlhat-install.sh
```

Alternatively, you can [install manually](#installation).

## Built-in GPIO Expander

Featuring the well-documented MCP23017 16 channel GPIO expander, CTRL HAT is easy to setup and control via I2C. Channels 0-4 (Group A) are utilised for the solid state relays, giving you an extra 12 GPIOs for each CTRL HAT you have.

## Not Just Raspberry Pi

We built CTRL HAT to work with any device featuring an I2C bus, the 2-wire connection makes it easy to connect to your preferred device. It can be used with either 3.3V devices (eg, Raspberry Pi) or 5V devices (eg, Arduino); by selecting the appropriate jumper (see [device compatibility](#device-compatibility)).

We believe the Raspberry Pi HAT specification is the perfect footprint. Compact yet familiar, with 4x mounting holes, the option to stack with other Raspberry Pi HATs / pHATs and of course a wide range of compatible cases to choose from.

## Known Compatible Solid State Relays
<p align="center">
    <img alt="Crydom SSR Mechanical Specifications" src="/img/crydom-ssr-mechanical-specifications.gif">
</p>

Any solid state relay which physically fits onto CTRL HAT and is suited to a control voltage of 5VDC will work. CTRL HAT can also be configured to accept relays with other DC control voltages by using a dedicated power supply (see [isolating the relays](#isolating-the-relays)).

### Zero Cross Turn On (Resistive Loads)

* [Opto 22 MP240D4](https://uk.farnell.com/opto-22/mp240d4/ssr-4a-240vac/dp/7229082) - 4A 24-280Vrms
* [Kudom KSD240D5-W](https://www.rapidonline.com/kudom-ksd240d5-w-pcb-ssr-4-32vdc-input-48-280vac-5a-load-with-zero-cross-turn-on-60-1575) - 5A 48-280Vrms
* [Multicomp MCKSD380D5-W(037)](https://uk.farnell.com/multicomp/mcksd380d5-w-037/solid-state-relay-4vdc-32vdc-th/dp/2770575) - 5A 24-440Vrms
* [Crydom CX240D5](https://uk.farnell.com/sensata-crydom/cx240d5/ssr-5a-240vac-3-15vdc/dp/1200213) - 5A 12-280Vrms
* [Crydom PowerFin PF240D25](https://uk.farnell.com/crydom/pf240d25/ssr-3-15vdc-12-280vac-25a/dp/1200285) - 25A 12-280Vrms - (see [maximum ratings](#maximum-ratings))

### Random Turn On (Inductive Loads)

* [Kudom KSD240D5R-W](https://www.rapidonline.com/kudom-ksd240d5r-w-pcb-ssr-4-32vdc-input-48-280vac-5a-load-with-random-turn-on-60-1574) - 5A 48-280Vrms
* [Crydom CX240D5R](https://uk.farnell.com/crydom/cx240d5r/ssr-5a-240vac/dp/1613825) - 5A 12-280Vrms
* [Crydom PowerFin PF240D25R](https://uk.farnell.com/crydom/pf240d25r/ssr-25a-240vac/dp/1613907) - 25A 12-280Vrms - (see [maximum ratings](#maximum-ratings))

### MOSFET (DC Loads)

* [Opto 22 DC60MP](https://uk.farnell.com/opto-22/dc60mp/ssr-60vdc-3a/dp/7229124) - 3A 0-60VDC
* [Crydom CMX60D10](https://uk.farnell.com/sensata-crydom/cmx60d10/ssr-10a-60vdc/dp/1200211) - 10A 0-60VDC
* [Crydom CMX100D10](https://uk.farnell.com/sensata-crydom/cmx100d10/ssr-10a-100v-sip/dp/1779773) - 10A 0-100VDC
* [Crydom CMX200D3](https://uk.farnell.com/crydom/cmx200d3/ssr-sip-200vdc-3a-3-10vdc-in/dp/1936439) - 3A 0-200VDC
* [Multicomp MCKSL60D20-L](https://uk.farnell.com/multicomp/mcksl60d20-l/solid-state-relay-3vdc-10vdc-th/dp/2770582) - 20A 0-60VDC - (see [maximum ratings](#maximum-ratings))

### Maximum Ratings

* 10A @ 250V (ambient temperature)
* 16A @ 250V (forced air cooling recommended, ~30° temperature rise)

Exceeding these limits may overload the PCB.

## Isolating the Relays
<p align="center">
    <img alt="Link Jumper Animated" src="/img/link-jumper-animated.gif" width="50%">
</p>

Removing the LINK jumper from CTRL HAT disconnects 5V power to the solid state relays. This allows you to power the relays independently, but also gives you the option to use solid state relays with other DC control voltages (up to 30V). This opens up a huge range of additional compatible solid state relays for use with your project.

## Back-Powering

Using a decent power supply, such as the official Raspberry Pi adaptor, you can expect to pull around 1.5A from the 5V pins on a Raspberry Pi. You can use up to 8 CTRL HATs with a single Raspberry Pi. That's up to 32 solid state relays, 32 LEDs and 8 GPIO expanders which all need power. It's easy to see how quickly we can go over the limit, especially if the GPIO expanders are used to drive other devices. Back-powering can solve this.

The easiest way to back-power CTRL HAT is using the 5V power pins. However there are some other options.

<p align="center">
    <img alt="Back-Powering with Terminal" src="/img/back-powering-terminal.gif">
</p>

Use one of the 5.08mm pitch terminal blocks in-place of relay channel 3. You must also solder the BACK-PWR jumper on the underside of the board for this to work.

<p align="center">
    <img alt="Back-Powering Supplementary" src="/img/back-powering-supplementary.gif">
</p>

Alternatively, solder directly to the supplementary power-in pads as shown above, but DO NOT solder the BACK-PWR jumper!

## I2C Addressing

| Address | A2 | A1 | A0 |
| :---: | :---: | :---: | :---: |
| 0x20 | | | |
| 0x21 | | | &#x2B1B; |
| 0x22 | | &#x2B1B; | |
| 0x23 | | &#x2B1B; | &#x2B1B; |
| 0x24 | &#x2B1B; | | |
| 0x25 | &#x2B1B; | | &#x2B1B; |
| 0x26 | &#x2B1B; | &#x2B1B; | |
| 0x27 | &#x2B1B; | &#x2B1B; | &#x2B1B; |

## Device Compatibility

CTRL HAT is fully compatible out of the box with most Raspberry Pi models and clones.

| Device Model | Compatibility |
| --- | :---: |
| Raspberry Pi Model A | &#x26A0;&#xFE0F;<br>Requires 26-way adaptor |
| Raspberry Pi Model B | &#x26A0;&#xFE0F;<br>Requires 26-way adaptor |
| Raspberry Pi 1 Model A+ | &#x2714;&#xFE0F; |
| Raspberry Pi 1 Model B | &#x2714;&#xFE0F; |
| Raspberry Pi 1 Model B+ | &#x2714;&#xFE0F; |
| Raspberry Pi 2 Model B | &#x2714;&#xFE0F; |
| Raspberry Pi 3 Model B &amp; 3+ | &#x2714;&#xFE0F; |
| Raspberry Pi 4 | &#x2714;&#xFE0F; |
| Raspberry Pi Zero | &#x2714;&#xFE0F; |
| Asus Tinker Board | &#x2714;&#xFE0F; |
| Orange Pi | &#x2714;&#xFE0F; |
| Odroid | &#x2714;&#xFE0F; |

<p align="center">
    <img alt="GPIO Voltage Jumper Animated" src="/img/gpio-voltage-jumper-animated.gif" width="50%">
</p>

To use with Arduino or any other 5V device the 3V3 jumper must be moved to 5V. Use the SDA &amp; SDL breakout pins for I2C communication.

## Mechanical

<p align="center">
    <img alt="Mechanical Drawing" src="/img/mechanical.gif" width="50%">
</p>

## Known Compatible Cases

* ModMyPi Modular RPi 2/3 Case

There are countless cases compatible with CTRL HAT, limited only by the height of the solid state relays used.

# Installation

## Prerequisites

Raspberry Pi with Raspian:
https://www.raspberrypi.org/downloads/raspbian/

I recommend a clean Raspian install before proceeding.

Tip: For headless setup, SSH can be enabled by placing a file named 'ssh' (no extension) onto the boot partition of the SD card.

## Enable I2C

I2C must be enabled in raspi-config to allow CTRL HAT to communcate with Raspberry Pi.

```
sudo raspi-config
```

Select 5 Interfacing Options, then P5 I2C. A prompt will appear asking Would you like the I2C interface to be enabled?, select Yes, exit the utility and reboot your Raspberry Pi.

```
sudo reboot
```

Update your Raspberry Pi to ensure all the latest packages are installed.

```
sudo apt update
sudo apt upgrade
```

Install I2C-Tools

```
sudo apt install i2c-tools -y
```

Enable i2c_vc so your Raspberry Pi can detect and read the EEPROM.

```
sudo sh -c "echo 'dtparam=i2c_vc=on' >> /boot/config.txt"
```

For recent versions of the Raspberry Pi (3.18 kernel or later) you will need to add `dtparam=i2c1=on` to the end of `/boot/config.txt`.

```
sudo sh -c "echo 'dtparam=i2c1=on' >> /boot/config.txt"
```

You can increase the I2C bus speed by adding the i2c_baudrate paramter to `/boot/config.txt`. CTRL HAT supports up to 1.7 MHz (1700000) I2C bus speeds, although we recommend starting with 400kHz (Fast Mode) for reliable operation with Raspberry Pi.

```
sudo sh -c "echo 'dtparam=i2c_baudrate=400000' >> /boot/config.txt"
```

Add the 'pi' user to the I2C group to avoid having to run the I2C tools as root.

```
sudo adduser pi i2c
```

Reboot your Raspberry Pi.

```
sudo reboot
```

Now test if CTRL HAT is detectable.

```
sudo i2cdetect -y 1
```

You should see a grid of all populated I2C devices.

<p align="center">
    <img alt="I2cdetect output" src="/img/i2cdetect.gif">
</p>

## Install WiringPi

```
sudo apt install wiringpi -y
```

Before proceeding, check WiringPi is working correctly.

```
gpio -v
gpio readall
```

If you wish to write your own scripts using Python, you will need to install WiringPi for Python also.

```
sudo apt install python-pip -y
```

Install WiringPi for Python.

```
sudo pip install wiringpi
```

## Install Apache & PHP

```
sudo apt install apache2 php libapache2-mod-php -y
```

Test the webserver is working. Navigate to http://localhost/ on the Pi itself, or http://192.168.1.10 (whatever the Pi's IP address is) from another computer on the network. Use the snippet below to get the Pi's IP address in command line.

```
hostname -I
```

## Install CTRL HAT Web GUI

You need to clone the web GUI files from the 'gui' subfolder on GitHub, to do that we need to install subversion.

```
sudo apt install subversion -y
```

Navigate to the web root.

```
cd /var/www/html
```

Empty default Apache files

```
sudo rm -rf *
```

Clone web GUI files (you must include the period at the end).

```
sudo svn checkout https://github.com/plasmadancom/CTRL-HAT/trunk/gui .
```

Be sure to set file permissions to 755 in the web directory.

```
sudo chmod -R 755 /var/www
```

That's it! reload the web page to see the CTRL HAT web GUI. Select any of the relays or pins to toggle them on/off.

## Optional: Install vsftpd for Easier File Editing

```
sudo apt install vsftpd -y
```

Change user for vsftpd.

```
sudo chown -R pi /var/www
```

Edit vsftpd.conf.

```
sudo nano /etc/vsftpd.conf
```

Uncomment the following line:

```
write_enable=YES
```

Add the following line:

```
force_dot_files=YES
```

Save and exit nano, then restart vsftpd.

```
sudo service vsftpd restart
```

You should now be able to login via FTP.

## Where to Go From Here

Integrating CTRL HAT with your own projects is easy, just follow any guide which uses the MCP23017 expander. We have written some example Python scripts to get you started (see [here](https://github.com/plasmadancom/CTRL-HAT/tree/master/python_examples)).

You will need to install [WiringPi for Python](#install-wiringpi) to use them.

## Config

There are various configuration options in the config file: ```/config.php```

You can customise the I2C address, GPIO setup, or disable any solid state relay channels you don't need.

```
sudo nano /var/www/html/config.php
```

## License

MIT © Dan Jones - [PlasmaDan.com](https://plasmadan.com)
