# CTRL-HAT
<p align="center">
    <img alt="CTRL HAT Animated" src="/img/ctrl-hat-animated.gif">
</p>

A Raspberry Pi HAT I/O board specifically designed for use with Crydom style SIP PCB mounted solid state relays, typically used for industrial control applications.

This project is an evolution of previous I/O & relay interface boards we have created primarily for home automation purposes. We saw a need for a low cost high current capacity solid state relay control board for switching inductive loads such as motorised blinds, without the need for costly extra hardware such as SSR modules or contactors. The high EMC and high inrush current capability of these widely available solid state relays make them ideal for home automation, industrial control applications such as lighting, motor control, ATM, medical devices, elevators, door-opening mechanisms, etc.

## Features

* 4x Solid State Relay Control
* 16 Port* GPIO Expander

## Interactive Web GUI
<p align="center">
    <a href="http://ctrlhat.plasmadan.com/" target="_blank" rel="nofollow">
        <img alt="CTRL HAT Web GUI" src="/img/ctrl-hat-web-gui.gif">
    </a>
</p>

Once installed on your Raspberry Pi, this interactive GUI allows quick & easy control of your CTRL HAT without the need for any coding. It is designed to be both a user guide & quick reference to the CTRL HAT pinout. The GUI is fully responsive and adapts to any screen size.

Check-out the [Live Demo.](http://ctrlhat.plasmadan.com/)

## Built-in GPIO Expander

Featuring the well-documented MCP23017 16 channel GPIO expander, CTRL HAT is easy to setup and control via I&sup2;C. Channels 0-4 (Group A) are utilised for the solid state relays, giving you an extra 12 GPIOs for each CTRL HAT you have.

## Not Just Raspberry Pi

We built CTRL HAT to work with any device featuring an I&sup2;C bus, the 2-wire connection makes it easy to connect to your preferred device. It can be used with either 3.3V devices (eg, Raspberry Pi) or 5V devices (eg, Arduino); by selecting the appropriate jumper (see [device compatibility](#device-compatibility)).

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
    <img alt="Link Jumper Animated" src="/img/link-jumper-animated.gif">
</p>

Removing the LINK jumper from CTRL HAT disconnects 5V power from the solid state relays. This allows you to power the relays independently, but also gives you the option to use solid state relays with other DC control voltages (up to 30V). This opens up a huge range of additional compatible solid state relays for use with your project.

## Back-Powering

Using a decent power supply, such as the official Raspberry Pi adaptor, you can expect to pull around 1.5A from the 5V pins on a Raspberry Pi. You can use up to 8 CTRL HATs with a single Raspberry Pi. That's up to 32 solid state relays, 32 LEDs and 8 GPIO expanders which all need power. It's easy to see how quickly we can go over the limit. Back-powering can solve this.

The easiest way to back-power CTRL HAT is using the 5V power pins. However there are some other options.

<p align="center">
    <img alt="Back-Powering with Terminal" src="/img/back-powering-terminal.gif">
</p>

Use one of the 5.08mm pitch terminal blocks in-place of relay channel 3. You must also solder the back-pwr jumper on the underside of the board for this to work.

<p align="center">
    <img alt="Back-Powering Supplementary" src="/img/back-powering-supplementary.gif">
</p>

Alternatively, solder directly to the supplementary power-in pads as shown above, but DO NOT solder the back-pwr jumper!

## I&sup2;C Addressing

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
| Raspberry Pi 3 Model B & 3+ | &#x2714;&#xFE0F; |
| Raspberry Pi 4 | &#x2714;&#xFE0F; |
| Raspberry Pi Zero | &#x2714;&#xFE0F; |
| Asus Tinker Board | &#x2714;&#xFE0F; |
| Orange Pi | &#x2714;&#xFE0F; |
| Odroid | &#x2714;&#xFE0F; |

<p align="center">
    <img alt="GPIO Voltage Jumper Animated" src="/img/gpio-voltage-jumper-animated.gif">
</p>

To use with Arduino or any other 5V device the 3V3 jumper must be moved to 5V. This ensures stable communication over I&sup2;C.

## Known Compatible Cases

* ModMyPi Modular RPi 2/3 Case

There are countless cases compatible with CTRL HAT, limited only by the height of the solid state relays used.

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

You can customise the I&sup2;C address, GPIO setup, or disable any solid state relay channels you don't need.

## License

MIT © Dan Jones - [PlasmaDan.com](https://plasmadan.com)
