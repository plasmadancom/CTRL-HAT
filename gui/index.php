<?php

/*
 * index.php - CTRL HAT web GUI
 * 
 * Copyright (C) 2020 Dan Jones - https://plasmadan.com
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

require (__DIR__.'/config.php');
require (__DIR__.'/src/inc/functions.php');

?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CTRL HAT - Pinout Guide and Interactive GUI</title>
    <link href="src/css/styles.css" rel="stylesheet" />
    <script src="src/js/jquery.min.js"></script>
</head>
<body>
    <!-- Dev mode -->
    <input id="dev_mode" type="hidden" value="<?= $dev_mode ?>">
    
    <!-- Settings -->
    <input id="pin_base" type="hidden" value="<?= $pin_base ?>">
    <input id="i2c_addr" type="hidden" value="<?= $i2c_addr ?>">
    <div class="container">
        <div class="float wrapper">
            <div class="board">
                <div class="leds">
                    <div class="led led0"<?= show_hide(0) ?>></div>
                    <div class="led led1"<?= show_hide(1) ?>></div>
                    <div class="led led2"<?= show_hide(2) ?>></div>
                    <div class="led led3"<?= show_hide(3) ?>></div>
                </div>
                <div class="board-left">
                    <div class="gpiobase"></div>
                    <ul class="odd">
                        <li class="pin1 link"><a href="#" data-pin="1" data-jumper="link" data-name="LINK (Solid State Relay Power Jumper)"><span class="num">1</span><span class="pin"></span></a></li>
                        <li class="pin3 3v3gpio"><a href="#" data-pin="3" data-jumper="3v3gpio" data-name="3V3 (3.3V GPIO Selection Jumper)"><span class="num">3</span><span class="pin"></span></a></li>
                        <li class="pin5 5vgpio"><a href="#" data-pin="5" data-jumper="5vgpio" data-name="5V (5V GPIO Selection Jumper)"><span class="num">5</span><span class="pin"></span></a></li>
                        <li class="pin7 i2c-a0"><a href="#" data-pin="7" data-jumper="i2c-a0" data-name="A0 (I&sup2;C Address Selection Jumper)"><span class="num">7</span><span class="pin"></span></a></li>
                        <li class="pin9 i2c-a1"><a href="#" data-pin="9" data-jumper="i2c-a1" data-name="A1 (I&sup2;C Address Selection Jumper)"><span class="num">9</span><span class="pin"></span></a></li>
                        <li class="pin11 i2c-a2"><a href="#" data-pin="11" data-jumper="i2c-a2" data-name="A2 (I&sup2;C Address Selection Jumper)"><span class="num">11</span><span class="pin"></span></a></li>
                        <li class="pin13"><a href="#" data-pin="13" data-name="SDA (I&sup2;C DATA)"><span class="num">13</span> SDA<span class="pin"></span></a></li>
                        <li class="pin15 gpio8<?= pin_class(8) ?>"><a href="#" data-pin="15" data-gpio="8" data-logic="<?= $gpios[8][0] ?>" data-mode="<?= $gpios[8][1] ?>" data-name="GPB 0"><span class="num">15</span> GPB 0<span class="pin"></span></a></li>
                        <li class="pin17 gpio10<?= pin_class(10) ?>"><a href="#" data-pin="17" data-gpio="10" data-logic="<?= $gpios[10][0] ?>" data-mode="<?= $gpios[10][1] ?>" data-name="GPB 2"><span class="num">17</span> GPB 2<span class="pin"></span></a></li>
                        <li class="pin19 gpio12<?= pin_class(12) ?>"><a href="#" data-pin="19" data-gpio="12" data-logic="<?= $gpios[12][0] ?>" data-mode="<?= $gpios[12][1] ?>" data-name="GPB 4"><span class="num">19</span> GPB 4<span class="pin"></span></a></li>
                        <li class="pin21 gpio14<?= pin_class(14) ?>"><a href="#" data-pin="21" data-gpio="14" data-logic="<?= $gpios[14][0] ?>" data-mode="<?= $gpios[14][1] ?>" data-name="GPB 6"><span class="num">21</span> GPB 6<span class="pin"></span></a></li>
                        <li class="pin23 gpio0 ssr0<?= pin_class(0) ?>"><a href="#" data-pin="23" data-gpio="0" data-logic="<?= $gpios[0][0] ?>" data-mode="<?= $gpios[0][1] ?>" data-name="GPA 0 (Solid State Relay CH0)"><span class="num">23</span> GPA 0 <small>(CH0)</small><span class="pin"></span></a></li>
                        <li class="pin25 gpio2 ssr2<?= pin_class(2) ?>"><a href="#" data-pin="25" data-gpio="2" data-logic="<?= $gpios[2][0] ?>" data-mode="<?= $gpios[2][1] ?>" data-name="GPA 2 (Solid State Relay CH2)"><span class="num">25</span> GPA 2 <small>(CH2)</small><span class="pin"></span></a></li>
                        <li class="pin27 gpio4<?= pin_class(4) ?>"><a href="#" data-pin="27" data-gpio="4" data-logic="<?= $gpios[4][0] ?>" data-mode="<?= $gpios[4][1] ?>" data-name="GPA 4"><span class="num">27</span> GPA 4<span class="pin"></span></a></li>
                        <li class="pin29 gpio6<?= pin_class(6) ?>"><a href="#" data-pin="29" data-gpio="6" data-logic="<?= $gpios[6][0] ?>" data-mode="<?= $gpios[6][1] ?>" data-name="GPA 6"><span class="num">29</span> GPA 6<span class="pin"></span></a></li>
                        <li class="pin31 interrupt"><a href="#" data-pin="31" data-name="Interrupt A"><span class="num">31</span> IA<span class="pin"></span></a></li>
                    </ul>
                    <ul class="even">
                        <li class="pin2 link"><a href="#" data-pin="2" data-jumper="link" data-name="LINK (Solid State Relay Power Jumper)"><span class="num">2</span> LINK<span class="pin"></span></a></li>
                        <li class="pin4 3v3gpio"><a href="#" data-pin="4" data-jumper="3v3gpio" data-name="3V3 (3.3V GPIO Selection Jumper)"><span class="num">4</span> 3V3<span class="pin"></span></a></li>
                        <li class="pin6 5vgpio"><a href="#" data-pin="6" data-jumper="5vgpio" data-name="5V (5V GPIO Selection Jumper)"><span class="num">6</span> 5V<span class="pin"></span></a></li>
                        <li class="pin8 i2c-a0"><a href="#" data-pin="8" data-jumper="i2c-a0" data-name="A0 (I&sup2;C Address Selection Jumper)"><span class="num">8</span> A0<span class="pin"></span></a></li>
                        <li class="pin10 i2c-a1"><a href="#" data-pin="10" data-jumper="i2c-a1" data-name="A1 (I&sup2;C Address Selection Jumper)"><span class="num">10</span> A1<span class="pin"></span></a></li>
                        <li class="pin12 i2c-a2"><a href="#" data-pin="12" data-jumper="i2c-a2" data-name="A2 (I&sup2;C Address Selection Jumper)"><span class="num">12</span> A2<span class="pin"></span></a></li>
                        <li class="pin14"><a href="#" data-pin="14" data-name="SCL (I&sup2;C CLOCK)"><span class="num">14</span> SCL<span class="pin"></span></a></li>
                        <li class="pin16 gpio9<?= pin_class(9) ?>"><a href="#" data-pin="16" data-gpio="9" data-logic="<?= $gpios[9][0] ?>" data-mode="<?= $gpios[9][1] ?>" data-name="GPB 1"><span class="num">16</span> GPB 1<span class="pin"></span></a></li>
                        <li class="pin18 gpio11<?= pin_class(11) ?>"><a href="#" data-pin="18" data-gpio="11" data-logic="<?= $gpios[11][0] ?>" data-mode="<?= $gpios[11][1] ?>" data-name="GPB 3"><span class="num">18</span> GPB 3<span class="pin"></span></a></li>
                        <li class="pin20 gpio13<?= pin_class(13) ?>"><a href="#" data-pin="20" data-gpio="13" data-logic="<?= $gpios[13][0] ?>" data-mode="<?= $gpios[13][1] ?>" data-name="GPB 5"><span class="num">20</span> GPB 5<span class="pin"></span></a></li>
                        <li class="pin22 gpio15<?= pin_class(15) ?>"><a href="#" data-pin="22" data-gpio="15" data-logic="<?= $gpios[15][0] ?>" data-mode="<?= $gpios[15][1] ?>" data-name="GPB 7"><span class="num">22</span> GPB 7<span class="pin"></span></a></li>
                        <li class="pin24 gpio1 ssr1<?= pin_class(1) ?>"><a href="#" data-pin="24" data-gpio="1" data-logic="<?= $gpios[1][0] ?>" data-mode="<?= $gpios[1][1] ?>" data-name="GPA 1 (Solid State Relay CH1)"><span class="num">24</span> GPA 1 <small>(CH1)</small></small><span class="pin"></span></a></li>
                        <li class="pin26 gpio3 ssr3<?= pin_class(3) ?>"><a href="#" data-pin="26" data-gpio="3" data-logic="<?= $gpios[3][0] ?>" data-mode="<?= $gpios[3][1] ?>" data-name="GPA 3 (Solid State Relay CH3)"><span class="num">26</span> GPA 3 <small>(CH3)</small></small><span class="pin"></span></a></li>
                        <li class="pin28 gpio5<?= pin_class(5) ?>"><a href="#" data-pin="28" data-gpio="5" data-logic="<?= $gpios[5][0] ?>" data-mode="<?= $gpios[5][1] ?>" data-name="GPA 5"><span class="num">28</span> GPA 5<span class="pin"></span></a></li>
                        <li class="pin30 gpio7<?= pin_class(7) ?>"><a href="#" data-pin="30" data-gpio="7" data-logic="<?= $gpios[7][0] ?>" data-mode="<?= $gpios[7][1] ?>" data-name="GPA 7"><span class="num">30</span> GPA 7<span class="pin"></span></a></li>
                        <li class="pin32 interrupt"><a href="#" data-pin="32" data-name="Interrupt B"><span class="num">32</span> IB<span class="pin"></span></a></li>
                    </ul>
                </div>
                <div class="board-right">
                    <div class="ssr ssr0<?= ssr_class($ch0_relay) ?>"></div>
                    <div class="ssr ssr1<?= ssr_class($ch1_relay) ?>"></div>
                    <div class="ssr ssr2<?= ssr_class($ch2_relay) ?>"></div>
                    <div class="ssr ssr3<?= ssr_class($ch3_relay) ?>"></div>
                </div>
            </div>
        </div>
        <div class="info">
            <span class="dev_mode_label" style="display: none;">Dev Mode<span class="dev_mode_tooltip">Test environment to demo the GUI without a Raspberry Pi.</span></span>
            <img class="logo" src="src/img/ctrl-hat-logo.png" alt="CTRL HAT" width="200px" height="20px" />
            <div class="intro">
                <h3>Pinout Guide &amp; Interactive GUI</h3>
                <p>This landing page is designed to be both a user guide &amp; quick reference to the CTRL HAT pinout, plus an interactive GUI to get you started. Check-out the <a href="https://github.com/plasmadancom/CTRL-HAT" target="_blank">GitHub page</a> for more information.</p>
                <h1>Go ahead, select a pin from the board!</h1>
            </div>
            
            <!-- Placeholder gpio pin data -->
            <div class="pindata gpio8" style="display: none;">
                <h1 class="pinname"></h1>
                <ul>
                    <li>Physical pin <span class="physpin"></span></li>
                    <li class="int-hide">Wiring Pi pin <span class="io"></span></li>
                    <li class="int-hide">Currently <span class="status-wrapper"><span class="status"></span><span class="logic"></span>, </span><span class="mode"></span></li>
                </ul>
                
                <!-- Toggle output button -->
                <a href="#" class="toggle" data-gpio="8">Toggle Output</a>
            </div>
            
            <!-- WiringPi guide -->
            <div class="guide" style="display: none;">
                <h3>WiringPi Guide</h3>
                <p></p>
                <h4>Read</h4>
                <pre>gpio -x mcp23017:<span class="pinbase" title="Pin Base">100</span>:<span class="i2c_addr" title="I&sup2;C Address">0x20</span> read <span class="io">108</span></pre>
                <h4>Write</h4>
                <pre>gpio -x mcp23017:<span class="pinbase" title="Pin Base">100</span>:<span class="i2c_addr" title="I&sup2;C Address">0x20</span> mode <span class="io">108</span> out<br>gpio -x mcp23017:<span class="pinbase" title="Pin Base">100</span>:<span class="i2c_addr" title="I&sup2;C Address">0x20</span> write <span class="io">108</span> 1</pre>
            </div>
            
            <!-- System log area -->
            <textarea class="log" placeholder="System log..." style="display: none;" readonly></textarea>
        </div>
    </div>
    <div class="footer">
        <p>Spotted a problem? Submit an Issue or a Pull Request on our <a href="https://github.com/plasmadancom/CTRL-HAT">GitHub repository</a>!</p>
        <p>Built by <a href="https://plasmadan.com">PlasmaDan</a>. Tweet us at <a href="https://twitter.com/Plasma_Dan">@Plasma_Dan</a>. Theme based on the awesome <a href="https://pinout.xyz">Pinout.xyz</a>.</p>
    </div>
</body>
<script src="src/js/scripts.js"></script>
</html>