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
        // Swap status in pull-up mode 
        var i = mode == 'up' ? !i : i;
        
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
    function print_log(log, response=false) {
        var out = $('.log');
        
        if (response) {
            if (response !== true) {
                // Append response to log
                if (out.length) out.find('#' + response).after(log);
                
                return;
            }
            
            // Mark new log lines awaiting response
            var response = Date.now();
            log += '<span id="' + Date.now() + '"></span>';
        }
        
        log += "\n";
        
        // Append log and scroll
        if (out.length) out.append(log).scrollTop(out[0].scrollHeight - out.height());
        
        return response;
    }
    
    // Append result to request
    function log_response(request, result) {
        print_log('Done (output ' + print_status(result) + ').', request)
    };
    
    // Update GUI
    function update_gui(gpio, result) {
        var pin = $('.gpio' + gpio);
        var led = $('.leds .led' + gpio);
        
        pin.removeClass('high');
        pin.find('a').data('logic', result);
        
        $('.pindata' + gpio + ' .status').html(print_status(result));
        $('.pindata' + gpio + ' .logic').html(print_logic(result));
        
        if (result) {
            pin.addClass('high');
            led.show();
        }
        else led.hide();
    }
    
    // Pin selection
    function pin_click(e) {
        // Collect GPIO data
        var pin = parseInt(e.data('pin'));
        var gpio = parseInt(e.data('gpio'));
        var logic = parseInt(e.data('logic'));
        var mode = e.data('mode');
        var name = e.data('name');
        
        // Display guide and hide intro
        $('.info .intro').hide();
        $('.info .pindata, .info .log').show();
        
        // Reset GUI
        $('.ssr').removeClass('selected');
        $('.board .active').removeClass('active');
        $('.info .toggle').attr('class', 'toggle button-disabled');
        $('.status-wrapper').show();
        
        // Highlight selected SSR
        if (0 <= gpio == gpio <= 3) $('.ssr' + gpio).addClass('selected');
        
        // Highlight selected pin
        $('.board .pin' + pin).addClass('active');
        
        // Hide guide for interrupt pins
        var guide = $('.info .guide, .info .int-hide');
        gpio < 0 ? guide.hide() : guide.show();
        
        switch (mode) {
            case 'out':
                // Enable toggle button for outputs
                $('.info .toggle').removeClass('button-disabled');
                
                break;
            
            case 'unconfigured':
                // Hide data for unconfigured gpios
                $('.status-wrapper').hide();
                
                break;
        }
        
        // Update DOM
        $('.info').attr('class', 'info pindata' + gpio);
        $('.info .pinname').html(name);
        $('.info .physpin').html(pin);
        $('.info .pinbase').html(pin_base);
        $('.info .io').html(pin_base + gpio);
        $('.info .toggle').data('gpio', gpio);
        $('.info .status').html(print_status(logic, mode));
        $('.info .logic').html(print_logic(logic));
        $('.info .mode').html(print_mode(mode));
        $('.info .i2c_addr').html('0x' + i2c_addr);
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
        var request = print_log('Toggle gpio ' + parseInt(pin_base + gpio) + '... ', true);
        
        // Spoof result for development
        if (dev_mode) {
            // Swap logic
            result = pin.find('a').data('logic') ? 0 : 1;
            
            // Spoof response delay
            setTimeout(function() {
                log_response(request, result);
                update_gui(gpio, result);
            }, 200);
            
            return;
        }
        
        $.ajax({
            type: 'POST',
            data: 'toggle=' + gpio,
            dataType: 'json',
            timeout: 5000,
            success: function(r) {
                if (!$.trim(r)) {
                    print_log('Ajax error!', request);
                    return;
                }
                
                var result = JSON.parse(r[0]);
                
                log_response(request, result);
                update_gui(gpio, result);
            },
            complete: function() {
                
            },
            error: function(xhr, textStatus, errorThrown) {
                try {
                    print_log(JSON.parse(xhr.responseText), request);
                }
                catch(e) {
                    print_log(textStatus, request);
                }
            }
        });
    });

    // Notify user if development mode enabled
    if (dev_mode) {
        $('.dev_mode_label').show();
        print_log('Development mode enabled.');
    }
    
});