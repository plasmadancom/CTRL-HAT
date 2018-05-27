<?php

/*
 * functions.php - CTRL HAT functions for web GUI
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

$gpios = array();

// Return GPIO status
function gpio($gpio) {
    global $pin_base, $i2c_addr;
    
    $pin = $pin_base + (int)$gpio;
    
    // Read pin status
    exec("gpio -x mcp23017:$pin_base:$i2c_addr read $pin", $result);
    
	return $result[0];
}

// Return display css
function show_hide($pin) {
    global $gpios;
    
	return (bool)$gpios[$pin][0] ? '' : ' style="display: none;"';
}

// Return style class
function pin_class($pin) {
    global $gpios;
    
	return (bool)$gpios[$pin][0] ? ' high' : '';
}

// Return class
function ssr_class($ssr) {
	return (bool)$ssr ? ' enabled' : '';
}

// Toggle GPIO state & return
function gpio_toggle($gpio) {
	global $pin_base, $i2c_addr;
    
    // Swap bool
	$pin = $pin_base + (int)$gpio;
    
    // Set pin mode to output (disabled, done at page load)
	//exec("gpio -x mcp23017:$pin_base:$i2c_addr mode $pin out");
    
    // Toggle pin output
	exec("gpio -x mcp23017:$pin_base:$i2c_addr toggle $pin $toggle");
	
    // Return new status
	return gpio($gpio);
}

// AJAX requests
if (isset($_POST) && !empty($_POST)) {
    $result = array();
    
    // Toggle GPIO
    if (isset($_POST['toggle']) && is_numeric($_POST['toggle'])) {
        $result[] = gpio_toggle($_POST['toggle']);
    }
    
    // Return result
    if (!empty($result)) {
        echo json_encode($result);
    }
    
    // Done
    exit();
}

// Grab gpio info
for ($i = 0; $i <= 15; $i++) {
    $mode = isset($pin_modes[$i]) ? $pin_modes[$i] : 'unconfigured';
    
    $gpios[$i] = array(gpio($i), $mode);
}

// Initialise GPIOs
foreach ($pin_modes as $gpio => $mode) {
    $pin = $pin_base + (int)$gpio;
    
    // Set pin mode
	exec("gpio -x mcp23017:$pin_base:$i2c_addr mode $pin $mode");
}

?>