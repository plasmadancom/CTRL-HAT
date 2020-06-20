# CTRL HAT

* [Web GUI Live Demo](https://io.plasmadan.com/ctrlhat)
* [Easy Installer](#easy-installer)
* [Arduino Wiring](#arduino-wiring)
* [Known Compatible Relays](#known-compatible-solid-state-relays)
* [Setup Guide](https://github.com/plasmadancom/HAT-GUI/#setup-guide)

<p align="center">
    <img alt="CTRL HAT" src="/img/ctrl-hat.jpg" width="50%">
</p>

A Raspberry Pi HAT I/O board for use with solid state power relays (SSRs). Designed for switching high power loads without the need for costly extra hardware such as SSR modules or contactors.

CTRL HAT is ideally suited to automation or industrial control applications requiring high-speed switching, or switching of loads not suitable for regular mechanical relays, such as motors, power supplies, or noise sensitive equipment such as amplifiers.

## Features

* Support 4 industry standard SIP type solid state relays
* Easy to use [interactive web GUI](#interactive-web-gui)
* Based on the MCP23017 16-port [GPIO expander](#built-in-gpio-expander)
* Jumper selectable [I2C address](#i2c-addressing) & [GPIO voltage](#device-compatibility) (3.3V / 5V)
* Huge range of compatible solid state relays ([known list](#known-compatible-solid-state-relays))
* Up to 10A @ 250V / 16A @ 250V (forced air cooled)
* Can be used with 3.3V or 5V I2C host devices (eg, [Arduino](#arduino-wiring))
* Built-in user programmable ID EEPROM
* Conforms to Raspberry Pi [HAT Specifications](https://github.com/raspberrypi/hats)

## Why Solid State Relays?

* Low Power – Up-to 32 SSRs using 8 CTRL HATs on a single Raspberry Pi, with a single USB power supply!
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
    <a href="https://ctrlhat.plasmadan.com" target="_blank" rel="nofollow">
        <img alt="CTRL HAT Web GUI" src="/img/ctrl-hat-web-gui.gif">
    </a>
</p>

Once installed on your Raspberry Pi, this interactive GUI allows quick &amp; easy control of your CTRL HAT without the need for any coding. It is designed to be both a user guide &amp; quick reference to the CTRL HAT pinout. The GUI is fully responsive and adapts to any screen size.

Check-out the [Live Demo.](https://io.plasmadan.com/ctrlhat)

## Easy Installer

Our easy installer takes care of the setup process automatically.

```
sudo wget https://git.plasmadan.com/install.sh
sudo sh install.sh
```

This script will automatically enable I2C, install the required packages and setup the Web GUI.

Alternatively, you can install manually. See our [setup guide](https://github.com/plasmadancom/HAT-GUI/#setup-guide).

## Built-in GPIO Expander

Featuring the well-documented MCP23017 16 channel GPIO expander, CTRL HAT is easy to setup and control via I2C. Channels 0-4 (Group A) are utilised for the solid state relays, giving you an extra 12 GPIOs for use with your project.

Easy integration with [Home Assistant](https://www.home-assistant.io/integrations/mcp23017/).

## Arduino Wiring

<p align="center">
    <img alt="CTRL HAT Arduino" src="/img/ctrl-hat-arduino.gif">
</p>

We built CTRL HAT to work with any device featuring an I2C bus. It can be used with either 3.3V devices (eg, Raspberry Pi) or 5V devices (eg, Arduino); by selecting the appropriate jumper (see [device compatibility](#device-compatibility)).

## Known Compatible Solid State Relays

<p align="center">
    <img alt="CTRL HAT Animated" src="/img/ctrl-hat-animated.gif" width="50%">
</p>

Any solid state relay which physically fits onto CTRL HAT and is suited to a control voltage of 5VDC will work. CTRL HAT can also be configured to accept relays with other DC control voltages by using a dedicated power supply (see [isolating the relays](#isolating-the-relays)).

Consider carefully the type of relay to use with your application. Be sure to consider inrush currents and keep in-mind the thermals during operation. More relays = more heat so may need to de-rate or use fewer relays (See [thermal load tests](#thermal-load-tests)). *Proper thermal consideration, along with attention to the steady state current ratings, will result in trouble-free operation.* [Read more](https://www.automation.com/en-us/articles/2017/understanding-solid-state-relays).

Avoid generic solid state relays from China, they often state exaggerated ratings. They're cheap for a reason!

**Note: This is a general list, the type of loads specified here may not apply to your application, read the datasheets!**

### Zero-Cross Turn-On (Resistive Loads)

* [Opto 22 MP240D4](https://uk.farnell.com/opto-22/mp240d4/ssr-4a-240vac/dp/7229082) - 4A 24-280Vrms
* [Kudom / i-Autoc KSD240D5-W](https://www.rapidonline.com/kudom-ksd240d5-w-pcb-ssr-4-32vdc-input-48-280vac-5a-load-with-zero-cross-turn-on-60-1575) - 5A 48-280Vrms
* [Multicomp MCKSD380D5-W(037)](https://uk.farnell.com/multicomp/mcksd380d5-w-037/solid-state-relay-4vdc-32vdc-th/dp/2770575) - 5A 24-440Vrms
* [Crydom CX240D5](https://uk.farnell.com/sensata-crydom/cx240d5/ssr-5a-240vac-3-15vdc/dp/1200213) - 5A 12-280Vrms
* [Crydom PowerFin PF240D25](https://uk.farnell.com/crydom/pf240d25/ssr-3-15vdc-12-280vac-25a/dp/1200285) - 25A 12-280Vrms - (see [maximum PCB ratings](#maximum-pcb-ratings))

### Random Turn-On (Inductive Loads)

* [Kudom / i-Autoc KSD240D5R-W](https://uk.rs-online.com/web/p/interface-relay-modules/1025515/) - 5A 48-280Vrms
* [Crydom CX240D5R](https://uk.farnell.com/crydom/cx240d5r/ssr-5a-240vac/dp/1613825) - 5A 12-280Vrms
* [Crydom PowerFin PF240D25R](https://uk.farnell.com/crydom/pf240d25r/ssr-25a-240vac/dp/1613907) - 25A 12-280Vrms - (see [maximum PCB ratings](#maximum-pcb-ratings))

### MOSFET (DC Loads)

* [Opto 22 DC60MP](https://uk.farnell.com/opto-22/dc60mp/ssr-60vdc-3a/dp/7229124) - 3A 0-60VDC
* [Crydom CMX60D10](https://uk.farnell.com/sensata-crydom/cmx60d10/ssr-10a-60vdc/dp/1200211) - 10A 0-60VDC
* [Crydom CMX100D10](https://uk.farnell.com/sensata-crydom/cmx100d10/ssr-10a-100v-sip/dp/1779773) - 10A 0-100VDC
* [Crydom CMX200D3](https://uk.farnell.com/crydom/cmx200d3/ssr-sip-200vdc-3a-3-10vdc-in/dp/1936439) - 3A 0-200VDC
* [Multicomp MCKSL60D20-L](https://uk.farnell.com/multicomp/mcksl60d20-l/solid-state-relay-3vdc-10vdc-th/dp/2770582) - 20A 0-60VDC - (see [maximum PCB ratings](#maximum-pcb-ratings))

<p align="center">
    <img alt="Crydom SSR Mechanical Specifications" src="/img/crydom-ssr-mechanical-specifications.gif">
</p>

### Maximum PCB Ratings

* 10A @ 250V (ambient temperature)
* 16A @ 250V (forced air cooling required, ~30°C temperature rise)

Exceeding these limits may overload the PCB.

### Thermal Load Tests

Test conditions:
* 5 minute duration @ ~240V AC constant load
* 20°C ambient temperature
* 15cm distance

Note: These results are an example, meant to demonstrate real-world usuage. Your results may differ.

#### 5A Load Test

<img alt="CTRL HAT 5A Load Test" src="/img/ctrl-hat-load-test-5a.jpg" width="480">

Using four Kudom KSD240D5R-W.

#### 5A Load Test - Low Profile

<img alt="CTRL HAT 5A Load Test Low Profile" src="/img/ctrl-hat-load-test-5a-flat.jpg" width="480">

Using one Kudom KSD240D5R-W.

#### 10A Load Test

<img alt="CTRL HAT 10A Load Test" src="/img/ctrl-hat-load-test-10a.jpg" width="480">

Using one Crydom PowerFin PF240D25.

#### 16A Load Test

<img alt="CTRL HAT 16A Load Test - Air Cooled" src="/img/ctrl-hat-load-test-10a-cooled.jpg" width="480">

Using one Crydom PowerFin PF240D25, *forced air cooled*. Clearly a significant improvement over convection cooling.

### Electrical Safety

Mains voltage electricity is extremely dangerous. There is significant risk of death through electrocution, fire or explosion if not wired and fused correctly.

If using with mains voltages CTRL HAT must be installed in an electrically isolated enclosure by a qualified electrican and maintain at-least a 2mm air gap between all conductive parts of the Raspberry Pi ([source](http://www.creepage.com)). See [PoE header](#poe-header).

## Isolating the Relays
<p align="center">
    <img alt="Link Jumper Animated" src="/img/link-jumper-animated.gif" width="50%">
</p>

Removing the LINK jumper from CTRL HAT disconnects 5V power to the solid state relays. This allows you to power the relays independently, but also gives you the option to use solid state relays with other DC control voltages (up to 30V). This opens up a huge range of additional compatible solid state relays for use with your project.

## Back-Powering *

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

__* Note: Back-powering is for CTRL HAT, not for Raspberry Pi. Remove the LINK jumper when back-powering to avoid damaging your Pi.__

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
| Raspberry Pi 3 Model B | &#x2714;&#xFE0F; |
| Raspberry Pi 3 Model B+ | &#x2714;&#xFE0F;<br>[*Note*](#poe-header) |
| Raspberry Pi 4 | &#x2714;&#xFE0F;<br>[*Note*](#poe-header) |
| Raspberry Pi Zero | &#x2714;&#xFE0F; |
| Asus Tinker Board | &#x2714;&#xFE0F; |
| Orange Pi | &#x2714;&#xFE0F; |
| Odroid | &#x2714;&#xFE0F; |

<p align="center">
    <img alt="GPIO Voltage Jumper Animated" src="/img/gpio-voltage-jumper-animated.gif" width="50%">
</p>

To use with Arduino or any other 5V device the 3V3 jumper must be moved to 5V. Use the SDA &amp; SDL breakout pins for I2C communication.

## PoE Header

CTRL HAT is compatible with Raspberry Pi 3B+ &amp; Raspberry Pi 4, however care must be taken to maximise [clearance](#electrical-safety) from the 4-pin PoE header.

There are number of solutions:

1. Separate CTRL HAT from Raspberry Pi, try our [HAT RACK](https://plasmadan.com/hatrack) boards!
2. Use an elevated socket, eg Samtec ESQ-120-12-L-D ([available here](https://www.toby.co.uk/board-to-board-pcb-connectors/254mm-sockets/esq-samtec-254mm-elevated-dual-row-socket-strip-2.29mm-contact-11.05mm-profile-12/ESQ-120-12-L-D/))
3. Add a suitable insulating material over the PoE pins
4. Use a PoE HAT with CTRL HAT
5. Remove the PoE pins from the Raspberry Pi (not always ideal)
6. Simply don't use relay CH0

## Mechanical

<p align="center">
    <img alt="Mechanical Drawing" src="/img/mechanical.gif" width="50%">
</p>

## Known Compatible Cases

* ModMyPi Modular RPi 2/3 Case

There are countless cases compatible with CTRL HAT, limited only by the height of the solid state relays used.

## Where to Go From Here

Integrating CTRL HAT with your own projects is easy, just follow any guide which uses the MCP23017 expander. We have provided some example Python scripts to get you started (see [here](https://github.com/plasmadancom/CTRL-HAT/tree/master/python_examples)).

Integration with [Home Assistant](https://www.home-assistant.io/integrations/mcp23017/) is easy thanks to the MCP23017.

## License

MIT © Dan Jones - [PlasmaDan.com](https://plasmadan.com)
