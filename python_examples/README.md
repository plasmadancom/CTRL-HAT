# Python Examples

We have provided some example Python scripts to get you started. You will need to install WiringPi for Python to use them.

```
sudo apt install python-pip -y
sudo pip install wiringpi
```


## relay_chaser.py

An infinate Knight Rider style chaser sequence which works with WiringPi.

```
sudo wget https://github.com/plasmadancom/CTRL-HAT/raw/master/python_examples/relay_chaser.py
sudo python relay_chaser.py
```

## shutter_motor.py

Automatic control of wired shutter / roller blind / projector screen motors.

```
sudo wget https://github.com/plasmadancom/CTRL-HAT/raw/master/python_examples/shutter_motor.py
sudo python shutter_motor.py
```

## shutter_motor_push_button.py

Automatic motor control with single button. Allows use of wired shutter / roller blind motors without the need for an up / down switch, ideal for retrofit installations.

```
sudo wget https://github.com/plasmadancom/CTRL-HAT/raw/master/python_examples/shutter_motor_push_button.py
sudo python shutter_motor_push_button.py
```