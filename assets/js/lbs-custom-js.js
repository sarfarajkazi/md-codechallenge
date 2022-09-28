// Requires jQuery

// Initialize slider:
$ = jQuery;
jQuery(document).ready(function () {
    $('#lbs_books_search_wrapper .noUi-handle').on('click', function () {
        $(this).width(50);
    });
    let $min_price = parseFloat(jQuery('#lbs_books_search_wrapper #lbs_min_value').val());
    let $max_price = parseFloat(jQuery('#lbs_books_search_wrapper #lbs_max_value').val());

    let $start_range = parseFloat(jQuery('#lbs_books_search_wrapper #lbs_min_value').attr('data-start'));
    let $end_range = parseFloat(jQuery('#lbs_books_search_wrapper #lbs_max_value').attr('data-end'));

    const rangeSlider = jQuery('#slider-range')[0];
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
    rangeSlider.noUiSlider.on('update', function (values, handle) {
        jQuery('#lbs_books_search_wrapper #slider-range-value1').html(values[0])
        jQuery('#lbs_books_search_wrapper #slider-range-value2').html(values[1])
        jQuery('#lbs_books_search_wrapper #lbs_min_value').val(moneyFormat.from(values[0]));
        jQuery('#lbs_books_search_wrapper #lbs_max_value').val(moneyFormat.from(values[1]));
    });

    jQuery('#lbs_books_search_wrapper #book_search_btn').click(function(e){
        e.preventDefault();
        lbs_do_pagination();
    });
    jQuery('body').on('click','#lbs_books_search_wrapper .page-numbers',function (e){
        e.preventDefault();
        let $page_no = parseInt(jQuery(this).html());
        jQuery('#lbs_books_search_wrapper #pagination_page_no').val($page_no);
        lbs_do_pagination();
    });

    function lbs_do_pagination(){
        let $search_section = jQuery('#lbs_books_search_wrapper #lbs_books_result');
        let $form = jQuery('#lbs_books_search_wrapper #lbs_search_form').serialize();
        let $send_data = {action: 'lbs_fetch_search_result', _wpnonce: lbs_frontend_object.wpnonce, search_data: $form,};
        jQuery.ajax({
            type: 'POST',
            url: lbs_frontend_object.ajaxurl,
            data: $send_data,
            beforeSend: function (xhr) {
                $search_section.block({message: null, overlayCSS: {background: '#fff', opacity: 0.6}});
            },
            success: function (response) {
                $search_section.unblock();
                $search_section.html($($.parseHTML(response.data.html)).filter("#lbs_books_result").html());
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

}, jQuery);