// Requires jQuery

// Initialize slider:
$ =jQuery;
jQuery(document).ready(function() {
    $('.noUi-handle').on('click', function() {
        $(this).width(50);
    });
    $min_price =  parseFloat(jQuery('#lbs-min-value').val());
    $max_price = parseFloat(jQuery('#lbs-max-value').val());
    console.log($min_price,$max_price);
    var rangeSlider = document.getElementById('slider-range');
    var moneyFormat = wNumb({
        decimals: 0,
        thousand: ',',
        prefix: '$'
    });
    noUiSlider.create(rangeSlider, {
        start: [$min_price, $max_price],
        step: 1,
        range: {
            'min': [$min_price],
            'max': [$max_price]
        },
        format: moneyFormat,
        connect: true
    });

    // Set visual min and max values and also update value hidden form inputs
    rangeSlider.noUiSlider.on('update', function(values, handle) {
        document.getElementById('slider-range-value1').innerHTML = values[0];
        document.getElementById('slider-range-value2').innerHTML = values[1];
        jQuery('#lbs-min-value').val(moneyFormat.from(values[0]));
        jQuery('#lbs-max-value').val(moneyFormat.from(values[1]));
    });
},jQuery);