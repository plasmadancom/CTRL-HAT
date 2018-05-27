<?php

/*
 * index.php - CTRL HAT web GUI
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
    <!-- Settings -->
    <input id="pin_base" type="hidden" value="<?= $pin_base ?>">
    <input id="i2c_addr" type="hidden" value="<?= $i2c_addr ?>">
    <div class="container">
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
                    <li class="pin1 gpio8<?= pin_class(8) ?>"><a href="#" data-pin="1" data-gpio="8" data-logic="<?= $gpios[8][0] ?>" data-mode="<?= $gpios[8][1] ?>" data-name="GPB 0"><span class="num">1</span> GPB 0<span class="pin"></span></a></li>
                    <li class="pin3 gpio10<?= pin_class(10) ?>"><a href="#" data-pin="3" data-gpio="10" data-logic="<?= $gpios[10][0] ?>" data-mode="<?= $gpios[10][1] ?>"  data-name="GPB 2"><span class="num">3</span> GPB 2<span class="pin"></span></a></li>
                    <li class="pin5 gpio12<?= pin_class(12) ?>"><a href="#" data-pin="5" data-gpio="12" data-logic="<?= $gpios[12][0] ?>" data-mode="<?= $gpios[12][1] ?>"  data-name="GPB 4"><span class="num">5</span> GPB 4<span class="pin"></span></a></li>
                    <li class="pin7 gpio14<?= pin_class(14) ?>"><a href="#" data-pin="7" data-gpio="14" data-logic="<?= $gpios[14][0] ?>" data-mode="<?= $gpios[14][1] ?>"  data-name="GPB 6"><span class="num">7</span> GPB 6<span class="pin"></span></a></li>
                    <li class="pin9 gpio0 relay<?= pin_class(0) ?>"><a href="#" data-pin="9" data-gpio="0" data-logic="<?= $gpios[0][0] ?>" data-mode="<?= $gpios[0][1] ?>"  data-name="GPA 0 (Solid State Relay CH0)"><span class="num">9</span> GPA 0 <small>(CH0)</small><span class="pin"></span></a></li>
                    <li class="pin11 gpio2 relay<?= pin_class(2) ?>"><a href="#" data-pin="11" data-gpio="2" data-logic="<?= $gpios[2][0] ?>" data-mode="<?= $gpios[2][1] ?>"  data-name="GPA 2 (Solid State Relay CH2)"><span class="num">11</span> GPA 2 <small>(CH2)</small><span class="pin"></span></a></li>
                    <li class="pin13 gpio4<?= pin_class(4) ?>"><a href="#" data-pin="13" data-gpio="4" data-logic="<?= $gpios[4][0] ?>" data-mode="<?= $gpios[4][1] ?>"  data-name="GPA 4"><span class="num">13</span> GPA 4<span class="pin"></span></a></li>
                    <li class="pin15 gpio6<?= pin_class(6) ?>"><a href="#" data-pin="15" data-gpio="6" data-logic="<?= $gpios[6][0] ?>" data-mode="<?= $gpios[6][1] ?>"  data-name="GPA 6"><span class="num">15</span> GPA 6<span class="pin"></span></a></li>
                    <li class="pin17 interrupt"><a href="#" data-pin="17" data-gpio="-1" data-name="Interrupt A"><span class="num">17</span> IA<span class="pin"></span></a></li>
                </ul>
                <ul class="even">
                    <li class="pin2 gpio9<?= pin_class(9) ?>"><a href="#" data-pin="2" data-gpio="9" data-logic="<?= $gpios[9][0] ?>" data-mode="<?= $gpios[9][1] ?>"  data-name="GPB 1"><span class="num">2</span> GPB 1<span class="pin"></span></a></li>
                    <li class="pin4 gpio11<?= pin_class(11) ?>"><a href="#" data-pin="4" data-gpio="11" data-logic="<?= $gpios[11][0] ?>" data-mode="<?= $gpios[11][1] ?>"  data-name="GPB 3"><span class="num">4</span> GPB 3<span class="pin"></span></a></li>
                    <li class="pin6 gpio13<?= pin_class(13) ?>"><a href="#" data-pin="6" data-gpio="13" data-logic="<?= $gpios[13][0] ?>" data-mode="<?= $gpios[13][1] ?>"  data-name="GPB 5"><span class="num">6</span> GPB 5<span class="pin"></span></a></li>
                    <li class="pin8 gpio15<?= pin_class(15) ?>"><a href="#" data-pin="8" data-gpio="15" data-logic="<?= $gpios[15][0] ?>" data-mode="<?= $gpios[15][1] ?>"  data-name="GPB 7"><span class="num">8</span> GPB 7<span class="pin"></span></a></li>
                    <li class="pin10 gpio1 relay<?= pin_class(1) ?>"><a href="#" data-pin="10" data-gpio="1" data-logic="<?= $gpios[1][0] ?>" data-mode="<?= $gpios[1][1] ?>"  data-name="GPA 1 (Solid State Relay CH1)"><span class="num">10</span> GPA 1 <small>(CH1)</small></small><span class="pin"></span></a></li>
                    <li class="pin12 gpio3 relay<?= pin_class(3) ?>"><a href="#" data-pin="12" data-gpio="3" data-logic="<?= $gpios[3][0] ?>" data-mode="<?= $gpios[3][1] ?>"  data-name="GPA 3 (Solid State Relay CH3)"><span class="num">12</span> GPA 3 <small>(CH3)</small></small><span class="pin"></span></a></li>
                    <li class="pin14 gpio5<?= pin_class(5) ?>"><a href="#" data-pin="14" data-gpio="5" data-logic="<?= $gpios[5][0] ?>" data-mode="<?= $gpios[5][1] ?>"  data-name="GPA 5"><span class="num">14</span> GPA 5<span class="pin"></span></a></li>
                    <li class="pin16 gpio7<?= pin_class(7) ?>"><a href="#" data-pin="16" data-gpio="7" data-logic="<?= $gpios[7][0] ?>" data-mode="<?= $gpios[7][1] ?>"  data-name="GPA 7"><span class="num">16</span> GPA 7<span class="pin"></span></a></li>
                    <li class="pin18 interrupt"><a href="#" data-pin="18" data-gpio="-2" data-name="Interrupt B"><span class="num">18</span> IB<span class="pin"></span></a></li>
                </ul>
            </div>
            <div class="board-right">
                <div class="ssr ssr0<?= ssr_class($ch0_relay) ?>"></div>
                <div class="ssr ssr1<?= ssr_class($ch1_relay) ?>"></div>
                <div class="ssr ssr2<?= ssr_class($ch2_relay) ?>"></div>
                <div class="ssr ssr3<?= ssr_class($ch3_relay) ?>"></div>
            </div>
        </div>
        <div class="content">
            <article>
                <img class="logo" src="src/img/ctrl-hat-logo.png" alt="CTRL HAT" width="200px" height="20px" />
                <div class="intro">
                    <h3>Pinout Guide &amp; Interactive GUI</h3>
                    <p>This landing page is designed to be both a user guide & quick reference to the CTRL HAT pinout, plus an interactive GUI to get you started. Check-out the <a href="https://github.com/plasmadancom/CTRL-HAT" target="_blank">GitHub page</a> for more information.</p><br />
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
                    <a href="#" class="button toggle" data-gpio="8">Toggle Output</a>
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
            </article>
        </div>
    </div>
    <div class="footer">
        <p>Want to help make this GUI better? Head on over to our <a href="https://github.com/plasmadancom/CTRL-HAT">GitHub repository</a> and submit an Issue or a Pull Request!</p>
        <p>GUI inspired by <a href="https://pinout.xyz/">Pinout.xyz</a>. Tweet us at <a href="https://twitter.com/Plasma_Dan">@Plasma_Dan</a>.</p>
    </div>
</body>
<script src="src/js/scripts.js"></script>
</html>