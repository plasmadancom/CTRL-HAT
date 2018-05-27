<?php

/*
 * config.php - CTRL HAT gpio config for web GUI
 * 
 * Copyright (C) 2018 Dan Jones - https://plasmadan.com
 * 
 * 
 * -----------------------------------------------------------------------------
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * -----------------------------------------------------------------------------
 */

$pin_base = 100;      // MCP23017 Pin Base
$i2c_addr = 0x20;     // I2C Address (0x20, 0x21, 0x22, 0x23, 0x24, 0x25, 0x26, 0x27)

/*
 * Here you can configure each gpio pin mode (in, out, up)
 * http://wiringpi.com/the-gpio-utility/i2c-mcp23008-and-mcp23017-extensions/
 * 
 * NOTE: pin modes are setup on each refresh of the web GUI. This may conflict
 * with other scrips. Remove any gpio do not wish to initialise here.
 */

$pin_modes = array(
    // Bank A
    0 => 'out',       // GPA0 (Solid State Relay CH0)
    1 => 'out',       // GPA1 (Solid State Relay CH1)
    2 => 'out',       // GPA2 (Solid State Relay CH2)
    3 => 'out',       // GPA3 (Solid State Relay CH3)
    4 => 'out',       // GPA4
    5 => 'out',       // GPA5
    6 => 'out',       // GPA6
    7 => 'out',       // GPA7
    
    // Bank B
    8 => 'out',       // GPB0
    9 => 'out',       // GPB1
    10 => 'out',      // GPB2
    11 => 'out',      // GPB3
    12 => 'out',      // GPB4
    13 => 'out',      // GPB5
    14 => 'out',      // GPB6
    15 => 'out'       // GPB7
);

/*
 * Enable GUI graphic for each Solid State Relay on your CTRL HAT
 */

$ch0_relay = 1;       // Eable CH0 Solid State Relay
$ch1_relay = 1;       // Eable CH1 Solid State Relay
$ch2_relay = 1;       // Eable CH2 Solid State Relay
$ch3_relay = 1;       // Eable CH3 Solid State Relay

?>
