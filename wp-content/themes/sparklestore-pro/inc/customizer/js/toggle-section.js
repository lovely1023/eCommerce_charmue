jQuery(document).ready(function ($) {
    var toggleSection = $('.sparklestore-pro-toggle-section');

    toggleSection.each(
            function () {
                var controlName = $(this).data('control');
                try{
                var controlValue = wp.customize.control(controlName).setting.get();
                }catch(e){
                    return false;
                }
                
                var parentHeader = $(this).parent();
                if (typeof (controlName) !== 'undefined' && controlName !== '') {
                    var iconClass = 'dashicons-visibility';
                    if (controlValue === 'on') {
                        iconClass = 'dashicons-hidden';
                        parentHeader.addClass('sparklestore-pro-section-hidden').removeClass('sparklestore-pro-section-visible');
                    } else {
                        parentHeader.addClass('sparklestore-pro-section-visible').removeClass('sparklestore-pro-section-hidden');
                    }
                    $(this).children().attr('class', 'dashicons ' + iconClass);
                }
            }
    );

    toggleSection.on(
            'click',
            function (e) {
                e.stopPropagation();
                var controlName = $(this).data('control');
                var parentHeader = $(this).parent();
                try{
                    var controlValue = wp.customize.control(controlName).setting.get();
                }catch(e){
                    return;
                }
                if (typeof (controlName) !== 'undefined' && controlName !== '') {
                    var iconClass = 'dashicons-visibility';

                    if (controlValue === 'off') {
                        iconClass = 'dashicons-hidden';
                        parentHeader.addClass('sparklestore-pro-section-hidden').removeClass('sparklestore-pro-section-visible');
                        wp.customize.control(controlName).setting.set('on');
                        $('[data-customize-setting-link=' + controlName + ']').siblings('.onoffswitch').addClass('switch-on');
                    } else {
                        parentHeader.addClass('sparklestore-pro-section-visible').removeClass('sparklestore-pro-section-hidden');
                        wp.customize.control(controlName).setting.set('off');
                        $('[data-customize-setting-link=' + controlName + ']').siblings('.onoffswitch').removeClass('switch-on');
                    }

                    $(this).children().attr('class', 'dashicons ' + iconClass);
                }
            }
    );
    

    $('body').on('click', '.switch-section.onoffswitch', function () {
        var controlName = $(this).siblings('input').data('customize-setting-link');
        var controlValue = $(this).siblings('input').val();
        var iconClass = 'dashicons-visibility';
        if (controlValue === 'off') {
            iconClass = 'dashicons-hidden';
            $('[data-control=' + controlName + ']').parent().addClass('sparklestore-pro-section-hidden').removeClass('sparklestore-pro-section-visible');
        } else {
            $('[data-control=' + controlName + ']').parent().addClass('sparklestore-pro-section-visible').removeClass('sparklestore-pro-section-hidden');
        }
        $('[data-control=' + controlName + ']').children().attr('class', 'dashicons ' + iconClass);
    });
});
