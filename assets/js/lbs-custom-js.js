// Requires jQuery

// Initialize slider:
$ = jQuery;
jQuery(document).ready(function () {
    $('.noUi-handle').on('click', function () {
        $(this).width(50);
    });
    let $min_price = parseFloat(jQuery('#lbs_min_value').val());
    let $max_price = parseFloat(jQuery('#lbs_max_value').val());

    let $start_range = parseFloat(jQuery('#lbs_min_value').attr('data-start'));
    let $end_range = parseFloat(jQuery('#lbs_max_value').attr('data-end'));

    const rangeSlider = document.getElementById('slider-range');
    const moneyFormat = wNumb({
        decimals: 0,
        thousand: ',',
        prefix: '$'
    });

    noUiSlider.create(rangeSlider, {
        start: [$start_range, $end_range],
        step: 1,
        range: {
            'min': [$min_price],
            'max': [$max_price]
        },
        format: moneyFormat,
        connect: true
    });

    // Set visual min and max values and also update value hidden form inputs
    rangeSlider.noUiSlider.on('update', function (values, handle) {
        document.getElementById('slider-range-value1').innerHTML = values[0];
        document.getElementById('slider-range-value2').innerHTML = values[1];
        jQuery('#lbs_min_value').val(moneyFormat.from(values[0]));
        jQuery('#lbs_max_value').val(moneyFormat.from(values[1]));
    });
}, jQuery);