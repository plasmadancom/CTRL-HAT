#!/usr/bin/python

# shutter_motor_push_button.py - Automatic shutter motor control with single button
# 
# CAUTION!! This script is meant to be used with automatic blind / shutter / projector screen motors with mechanical limits.
# Do not use with the wrong type of motor or you may overwind your motor and damage something!
# You should use the 4-core wired type with 2 x Lives (Up & Down)
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

button = 108                                                 # Motor control input WiringPi port
relay_up = 100                                               # Motor up WiringPi port
relay_dn = 101                                               # Motor down WiringPi port

# Config
button_delay = 0.4                                           # Prevent accidental double button presses with this delay (seconds)
motor_timer = 20                                             # Time to complete one FULL cycle (seconds)
swap_dir = 0                                                 # Swap motor direction if wired backwards (0 or 1)
motor_change_delay = 0.2                                     # Wait before changing motor direction (seconds) - FOR SAFETY!!
motor_delay = 0.5                                            # Minimum time to run motor (seconds)


# Initialise WiringPi
wiringpi.wiringPiSetup()
wiringpi.mcp23017Setup(pin_base,i2c_addr)                    # Set up the pins and i2c address

wiringpi.pinMode(button, 0)                                  # Set button to input mode
wiringpi.pullUpDnControl(button, 2)                          # Set pull-up

wiringpi.pinMode(relay_up, 1)                                # Set relay_up to output mode
wiringpi.digitalWrite(relay_up, 0)

wiringpi.pinMode(relay_dn, 1)                                # Set relay_dn to output mode
wiringpi.digitalWrite(relay_dn, 0)

# Global variables
motor_direction = 1 if swap_dir else 0                       # motor_direction = 1 should always be UP, even if swapped
motor_steps = motor_timer * 20

def stop():
    global motor_direction
    
    wiringpi.digitalWrite(relay_up, 0)                       # Stop relay_up
    wiringpi.digitalWrite(relay_dn, 0)                       # Stop relay_dn
    
    motor_direction = not motor_direction                    # Swap motor motor_direction

def hold():
    if not wiringpi.digitalRead(button):                     # Still pressing! Don't use timer
        while not wiringpi.digitalRead(button):              # Re-check...
            sleep(0.05)
    
    else:                                                    # Use timer
        for i in range(motor_steps):
            sleep(0.05)
            
            if not wiringpi.digitalRead(button):
                break                                        # Interrupt timer

def start(updn=0):
    off = relay_dn if updn else relay_up
    on = relay_up if updn else relay_dn
    
    wiringpi.digitalWrite(off, 0)                            # Stop relay if active
    sleep(motor_change_delay)                                # Wait for relay
    wiringpi.digitalWrite(on, 1)                             # Activate relay
    
    hold()                                                   # Use timer?
    stop()                                                   # Stop & swap motor motor_direction

print 'Motor Push Button Control Loaded!'

try:
    while True:                                              # Loop forever
        if not wiringpi.digitalRead(button):
            if motor_direction:
                start(1)                                     # Up
            
            else:
                start()                                      # Down
            
            sleep(button_delay)                              # Delay

except Exception as e:                                       # Something went wrong
   print e