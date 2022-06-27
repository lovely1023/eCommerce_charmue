jQuery(document).ready(function ($) {
    $('.cl-remove-widget').on('click', function (e) {
        e.preventDefault();
        var widget = $(this).attr('data-widget');
        var widgeturl = sparkle_widget_params.widgeturl
        var result = confirm("Are you sure you want to delete " + widget + " Widget?");

        if (result) {
            $.ajax({
                url: sparkle_widget_params.ajaxurl,
                data: ({
                    'action': 'sparklestore_pro_remove_widget_area',
                    'widget': widget,
                }),
                success: function (response) {
                    location.reload();
                }
            });
        }
    });
});
