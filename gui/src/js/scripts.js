/*
 * scripts.js - CTRL HAT jQuery scripts for web GUI
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

$(document).ready(function() {
    // Parse settings from DOM
    var pin_base = parseInt($('#pin_base').val());
    var i2c_addr = parseInt($('#i2c_addr').val()).toString(16);
    
    // Return pin status in plain text
    function print_status(i, mode) {
        if (mode == 'up') {
            return !i ? 'active' : 'inactive';
        }
        
        return i ? 'active' : 'inactive';
            
    }
    
    // Return pin logic in plain text
    function print_logic(i) {
        return i ? ' (high)' : ' (low)';
    }
    
    // Return mode in plain text
    function print_mode(i) {
        switch (i) {
            case 'out':
                return 'output mode';
            
            case 'in':
                return 'input mode';
            
            case 'up':
                return 'pull-up mode';
            
            default:
                return 'unconfigured, must be initialised before use!';
        }
    }
    
    // Print to log
    function print_log(i, result=false) {
        var log = result ? i + ' ' : i + "\n";
        var out = $('.log');
        
        if (out.length) out.append(log).scrollTop(out[0].scrollHeight - out.height());
    }
    
    // Update GUI
    function update_gui(gpio, result) {
        var pin = $('.gpio' + gpio);
        var led = $('.leds .led' + gpio);
        
        switch (result) {
            case 1:
                pin.removeClass('high').addClass('high');
                led.show();
                
                break;
            
            case 0:
                pin.removeClass('high');
                led.hide();
                
                break;
            
            default:
                return false;
        }
        
        $('.pindata' + gpio + ' .status').html(print_status(result));
        $('.pindata' + gpio + ' .logic').html(print_logic(result));
        
        print_log('Done.');
    }
    
    $('.board a').on('click', function() {
        // Collect GPIO data
        var pin = parseInt($(this).data('pin'));
        var gpio = parseInt($(this).data('gpio'));
        var logic = parseInt($(this).data('logic'));
        var mode = $(this).data('mode');
        var name = $(this).data('name');
        
        // Highlight selected pin
        $('.board .active').removeClass('active');
        $('.board .pin' + pin).addClass('active');
        
        // Disable button for inputs
        if (mode !== 'out') $('article .button').addClass('button-disabled');
        else $('article .button').removeClass('button-disabled');
        
        // Highlight Selected CH
        if (gpio == 0 || gpio == 1 || gpio == 2 || gpio == 3) {
            // Hide unselected
            $('.board-right .ssr:not(.ssr' + gpio + ')').hide();
            
            // Show selected if enabled
            if ($('.ssr' + gpio).hasClass('enabled')) {
                $('.board-right .ssr' + gpio).show();
            }
        }
        else $('.board-right .enabled').show();
        
        // Swap content
        $('.content .intro').hide();
        $('.content .pindata, .content .log').show();
        
        // Hide guide for interrupt pins
        if (gpio < 0) $('.content .guide, .content .int-hide').hide();
        else $('.content .guide, .content .int-hide').show();
        
        // Hide data for unconfigured gpios
        if (mode == 'unconfigured') $('.status-wrapper').hide();
        else $('.status-wrapper').show();
        
        // Update DOM
        $('article').removeClass().addClass('pindata' + gpio);
        $('article .pinname').html(name);
        $('article .physpin').html(pin);
        $('article .io').html(pin_base + gpio);
        $('article .toggle').data({'gpio': gpio, 'logic': logic});
        $('article .status').html(print_status(logic, mode));
        $('article .logic').html(print_logic(logic));
        $('article .mode').html(print_mode(mode));
        $('article .i2c_addr').html('0x' + i2c_addr);
    });

    // Toggle GPIO
    $('.toggle').on('click', function() {
        if ($(this).hasClass('button-disabled')) return;
        
        // Collect GPIO data
        var gpio = parseInt($(this).data('gpio'));
        
        // State is reversed because this is a click event, not a change event
        print_log('Toggle gpio ' + parseInt(pin_base + gpio) + '...', true);
        
        $.ajax({
            type: 'POST',
            data: 'toggle=' + gpio,
            dataType: 'json',
            timeout: 5000,
            success: function(r) {
                if (!$.trim(r)) {
                    print_log('Ajax error!');
                    return;
                }
                
                var result = JSON.parse(r[0]);
                
                update_gui(gpio, result);
            },
            complete: function() {
                
            },
            error: function(xhr, textStatus, errorThrown) {
                try {
                    print_log(JSON.parse(xhr.responseText));
                }
                catch(e) {
                    print_log(textStatus);
                }
            }
        });
    });
});