var $j = jQuery.noConflict(),
        $window = $j(window);

$j(document).on('ready', function () {
    "use strict";
    // Mega menu
    var brtl = false;

   if ($j("body").hasClass('rtl')) { brtl = false; }

    var $container = $j('.main-menu');

    $j('.menu-item-megamenu.megamenu-full-width').hover(function () {
        var $menuWidth = $container.outerWidth(),
                $menuPosition = $container.offset(),
                $menuItemPosition = $j(this).offset(),
                $PositionLeft = $menuItemPosition.left - $menuPosition.left + 1;

        $j(this).find('.megamenu').css({
            'width': $menuWidth,
            'max-width': $menuWidth,
        });
    });

    // Megamenu auto width
    $j('.menu-item-megamenu.megamenu-auto-width .megamenu').each(function () {
        var $li = $j(this).parent(),
                $window_width = $j(window).width(),
                $liOffset = $li.offset().left,
                $liWidth = $li.outerWidth(),
                $dropdownWidth = $j(this).outerWidth();
        if (brtl == true) {
            if (($window_width - $liOffset - $liWidth) + $dropdownWidth > $window_width + 10) {
                $j(this).css({
                    'right': 'auto',
                    'left': 0
                });
            }

            var $dropdownRight = $dropdownWidth - ($window_width - ($liOffset + $liWidth));

            if ($dropdownRight > 0) {
                $j(this).css({
                    'left': 'auto',
                    'right': -($dropdownWidth - ($liOffset + $liWidth - 10))
                });
            }
        } else {
            if ($liOffset + $dropdownWidth > $window_width + 10) {
                $j(this).css({
                    'left': 'auto',
                    'right': 0
                });
            }

            var $dropdownLeft = $dropdownWidth - ($liOffset + $liWidth);

            if ($dropdownLeft > 0) {
                $j(this).css({
                    'left': 'auto',
                    'right': -($window_width - $liOffset - $liWidth - 10)
                });
            }
        }
    });

    $j('li.heading-yes > a').on('click', function () {
        return false;
    });

    $j('.cat-megamenu-tab > div:first').addClass('active-tab');
});