/*
 * scripts.js - CTRL HAT jQuery scripts for web GUI
 * 
 * Copyright (C) 2019 Dan Jones - https://plasmadan.com
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
    var dev_mode = $('#dev_mode').val() == 'true';
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
    
    // Pin selection
    function pin_click(e) {
        // Collect GPIO data
        var pin = parseInt(e.data('pin'));
        var gpio = parseInt(e.data('gpio'));
        var logic = parseInt(e.data('logic'));
        var mode = e.data('mode');
        var name = e.data('name');
        
        // Highlight selected CH
        $('.ssr').removeClass('selected');
        if (gpio == 0 || gpio == 1 || gpio == 2 || gpio == 3) $('.ssr' + gpio).addClass('selected');
        
        // Highlight selected pin
        $('.board .active').removeClass('active');
        $('.board .pin' + pin).addClass('active');
        
        // Disable button for inputs
        if (mode !== 'out') $('.info .button').addClass('button-disabled');
        else $('.info .button').removeClass('button-disabled');
        
        // Swap content
        $('.info .intro').hide();
        $('.info .pindata, .info .log').show();
        
        // Hide guide for interrupt pins
        if (gpio < 0) $('.info .guide, .info .int-hide').hide();
        else $('.info .guide, .info .int-hide').show();
        
        // Hide data for unconfigured gpios
        if (mode == 'unconfigured') $('.status-wrapper').hide();
        else $('.status-wrapper').show();
        
        // Update DOM
        $('.info').attr('class', 'info').addClass('pindata' + gpio);
        $('.info .pinname').html(name);
        $('.info .physpin').html(pin);
        $('.info .pinbase').html(pin_base);
        $('.info .io').html(pin_base + gpio);
        $('.info .toggle').data({'gpio': gpio, 'logic': logic});
        $('.info .status').html(print_status(logic, mode));
        $('.info .logic').html(print_logic(logic));
        $('.info .mode').html(print_mode(mode));
        $('.info .i2c_addr').html('0x' + i2c_addr);
    }
    
    // Notify user if development mode enabled
    if (dev_mode) {
        $('.dev_mode_label').show();
        print_log('Development mode enabled.');
    }
    
    // Click on pin
    $('.board a').on('click', function(e) {
        e.preventDefault();
        
        pin_click($(this));
    });
    
    // Click on SSR
    $('.ssr').on('click', function(e) {
        e.preventDefault();
        
        // Find CH in DOM
        var ch = $(this).attr('class').split(/\s+/)[1];
        var elm = $('.' + ch + ' a');
        
        pin_click(elm);
    });
    
    // Toggle GPIO
    $('.info .toggle').on('click', function(e) {
        e.preventDefault();
        
        if ($(this).hasClass('button-disabled')) return;
        
        // Collect GPIO data
        var gpio = parseInt($(this).data('gpio'));
        var pin = $('.gpio' + gpio);
        
        // State is reversed because this is a click event, not a change event
        print_log('Toggle gpio ' + parseInt(pin_base + gpio) + '...', true);
        
        // Spoof result for development
        if (dev_mode) {
            result = pin.hasClass('high') ? 0 : 1;
            
            update_gui(gpio, result);
            
            return;
        }
        
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