#!/usr/bin/python

# relay_chaser.py - Infinate chaser sequence for CTRL HAT relays
# 
# Copyright (C) 2020 Dan Jones - https://plasmadan.com
# 
# -----------------------------------------------------------------------------
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
# 
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
# -----------------------------------------------------------------------------


# Import dependancies
import wiringpi
from time import sleep


# Setup
pin_base = 100
i2c_addr = 0x20

relays = [100, 101, 102, 103]                                # Relay WiringPi ports

# Config
hold_on = 0.05                                               # Time to hold relays on (seconds)
hold_off = 0.05                                              # Delay between each relay on (seconds)


# Initialise WiringPi
wiringpi.wiringPiSetup()
wiringpi.mcp23017Setup(pin_base,i2c_addr)                    # Set up the pins and i2c address

for i in relays:
    wiringpi.pinMode(i, 1)                                   # Set relay to output mode
    wiringpi.digitalWrite(i, 0)                              # Set output 0

print 'Relay Chaser Loaded!'

rlen = len(relays)

try:
    while True:                                              # Loop forever
        for r in relays + list(reversed(relays))[1:rlen-1]:  # Loop relay list then reverse (skipping repeats)
            wiringpi.digitalWrite(r, 1)                      # Relay on
            sleep(hold_on)
            wiringpi.digitalWrite(r, 0)                      # Relay off
            sleep(hold_off)

except Exception as e:                                       # Something went wrong
   print e

finally:
    for i in relays:
        wiringpi.digitalWrite(i, 0)                          # Reset