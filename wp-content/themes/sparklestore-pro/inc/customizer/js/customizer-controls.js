jQuery(document).ready(function ($) {

    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    jQuery('html').addClass('colorpicker-ready');

    $('body').on('click', 'a.customizer-sociallink, #customize-control-sparkle_store_pro_social_link a, #customize-control-sparkle_store_pro_social_link_left a, #customize-control-sparkle_store_pro_contact_social_link a', function (e) {
        e.preventDefault();
        wp.customize.section('sparklestore_pro_social_link_activate_settings').expand();
        return false;
    });


    $('body').on('click', '#customize-control-sparkle_store_pro_quick_info_link_left a, #customize-control-sparkle_store_pro_quick_info_link a', function () {
        wp.customize.section('sparkle_store_pro_quick_info').expand();
        return false;
    });

    
    
    wp.customize('sparklestore_pro_preloader', function (setting) {
        var setupControl = function (control) {
            var visibility = function () {
                if ('custom' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControl1 = function (control) {
            var visibility = function () {
                if ('custom' !== setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('sparkle_store_pro_preloader_image', setupControl);
        wp.customize.control('sparkle_store_pro_preloader_color', setupControl1);
    });


    wp.customize('sparklestore_pro_maintenance_bg_type', function (setting) {
        var setupControlSlider = function (control) {
            var visibility = function () {
                if ('slider' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlShortcode = function (control) {
            var visibility = function () {
                if ('revolution' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlBanner = function (control) {
            var visibility = function () {
                if ('banner' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlVideo = function (control) {
            var visibility = function () {
                if ('video' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('sparklestore_pro_maintenance_banner_image', setupControlBanner);
        wp.customize.control('sparklestore_pro_maintenance_slider_shortcode', setupControlShortcode);
        wp.customize.control('sparklestore_pro_maintenance_sliders', setupControlSlider);
        wp.customize.control('sparklestore_pro_maintenance_slider_info', setupControlSlider);
        wp.customize.control('sparklestore_pro_maintenance_slider_pause', setupControlSlider);
        wp.customize.control('sparklestore_pro_maintenance_video', setupControlVideo);
    });

    wp.customize('sparklestore_pro_homepage_slider_type', function (setting) {
        var defaultSlider = function (control) {
            var visibility = function () {
                if ('default' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var advanceSlider = function (control) {
            var visibility = function () {
                if ('advance' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };


        var setupControlRevolution = function (control) {
            var visibility = function () {
                if ('revolution' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlBanner = function (control) {
            var visibility = function () {
                if ('banner' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlBannerAndVideo = function (control) {
            var visibility = function () {
                if ('banner' === setting.get() || 'video' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControllExceptRev = function (control) {
            var visibility = function () {
                if ('advance' === setting.get() || 'banner' === setting.get() || 'default' === setting.get() || 'video' === setting.get() ) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };


        var setupControlSliderSettings = function (control) {
            var visibility = function () {
                if ('default' === setting.get() || 'advance' === setting.get() ) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlSliderVideo = function (control) {
            var visibility = function () {
                if ('video' === setting.get() ) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('sparklestore_pro_banner_all_sliders', defaultSlider);
        wp.customize.control('sparklestore_pro_advance_sliders', advanceSlider);

        wp.customize.control('sparklestore_pro_slider_info', setupControlSliderSettings);
        wp.customize.control('sparklestore_pro_slider_heading', setupControlSliderSettings);
        wp.customize.control('sparklestore_pro_slider_full_screen', setupControlSliderSettings);
        wp.customize.control('sparklestore_pro_slider_arrow', setupControlSliderSettings);
        wp.customize.control('sparklestore_pro_slider_dots', setupControlSliderSettings);
        wp.customize.control('sparklestore_pro_slider_pause', setupControlSliderSettings);
        wp.customize.control('sparklestore_pro_slider_loop', setupControlSliderSettings);
        wp.customize.control('sparklestore_pro_slider_auto_play', setupControlSliderSettings);
        wp.customize.control('sparklestore_pro_slider_mouse_drag', setupControlSliderSettings);             
        wp.customize.control('sparklestore_pro_slider_heading', setupControlSliderSettings);             
            
        wp.customize.control('sparklestore_pro_slider_overlay_color', setupControlSliderSettings);
        wp.customize.control('sparklestore_pro_slider_arrow_color_group', setupControlSliderSettings);
        wp.customize.control('sparklestore_pro_caption_title_background_color', setupControlSliderSettings);

        wp.customize.control('sparklestore_pro_banner_image', setupControlBanner);
        wp.customize.control('sparklestore_pro_banner_promo_image', setupControlBanner);
        wp.customize.control('sparklestore_pro_banner_title', setupControlBannerAndVideo);
        wp.customize.control('sparklestore_pro_banner_subtitle', setupControlBannerAndVideo);
        wp.customize.control('sparklestore_pro_banner_button_text', setupControlBannerAndVideo);
        wp.customize.control('sparklestore_pro_banner_button_link', setupControlBannerAndVideo);
        wp.customize.control('sparklestore_pro_banner_text_alignment', setupControlBanner);
        wp.customize.control('sparklestore_pro_banner_parallax_effect', setupControlBanner);
        wp.customize.control('sparklestore_pro_banner_overlay_color', setupControllExceptRev);

        wp.customize.control('sparklestore_pro_slider_revolution', setupControlRevolution);

        wp.customize.control('sparklestore_pro_caption_title_color', setupControllExceptRev);
        wp.customize.control('sparklestore_pro_caption_subtitle_color', setupControllExceptRev);
        wp.customize.control('sparklestore_pro_caption_button_color_group', setupControllExceptRev);

        wp.customize.control('sparklestore_pro_slider_layout', setupControllExceptRev);

        wp.customize.control('sparklestore_pro_promo_display_side', setupControllExceptRev);
        wp.customize.control('sparklestore_pro_slider_promo_one', setupControllExceptRev);
        wp.customize.control('sparklestore_pro_slider_promo_one_url', setupControllExceptRev);
        wp.customize.control('sparklestore_pro_slider_promo_two', setupControllExceptRev);
        wp.customize.control('sparklestore_pro_slider_promo_two_url', setupControllExceptRev);



               
        /** video banner */
        wp.customize.control('sparklestore_pro_video_banner', setupControlSliderVideo);
        wp.customize.control('sparklestore_pro_vieo_setting_heading', setupControlSliderVideo);
        wp.customize.control('sparklestore_pro_video_auto_play', setupControlSliderVideo);
        wp.customize.control('sparklestore_pro_video_auto_play', setupControlSliderVideo);
        wp.customize.control('sparklestore_pro_video_showcontrols', setupControlSliderVideo);
        wp.customize.control('sparklestore_pro_video_mute', setupControlSliderVideo);
        wp.customize.control('sparklestore_pro_video_loop', setupControlSliderVideo);

        // wp.customize.control('sparklestore_pro_slider_layout').focus();
    });

    wp.customize('sparklestore_pro_slider_layout', function (setting) {
        var promoSlider = function (control) {
            var visibility = function () {
                if ('sliderpromo' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('sparklestore_pro_promo_display_side', promoSlider);
        wp.customize.control('sparklestore_pro_slider_promo_one', promoSlider);
        wp.customize.control('sparklestore_pro_slider_promo_one_url', promoSlider);
        wp.customize.control('sparklestore_pro_slider_promo_two', promoSlider);
        wp.customize.control('sparklestore_pro_slider_promo_two_url', promoSlider);


    });

    /**
     * sparklestore_pro_woo_show_extra_tab
     */
    wp.customize('sparklestore_pro_woo_show_extra_tab', function (setting) {
        var showTab = function (control) {
            var visibility = function () {
                if (setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };
    
        wp.customize.control('sparklestore_pro_woo_product_extra_tab_title', showTab);
        wp.customize.control('sparklestore_pro_woo_product_extra_tab', showTab);
    });

    /** logo section  */
    var settingIds = ['logo', 'services', 'main_header', 'top_footer', 'middle_footer', 'breadcrumbs_normal_page'];
    $.each(settingIds, function (i, settingId) {
        wp.customize('sparklestore_pro_' + settingId + '_bg_type', function (setting) {
            var setupControlColorBg = function (control) {
                var visibility = function () {
                    if ('color-bg' === setting.get() || 'image-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlImageBg = function (control) {
                var visibility = function () {
                    if ('image-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlVideoBg = function (control) {
                var visibility = function () {
                    if ('video-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlGradientBg = function (control) {
                var visibility = function () {
                    if ('gradient-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlOverlay = function (control) {
                var visibility = function () {
                    if ('color-bg' === setting.get() || 'gradient-bg' === setting.get()) {
                        control.container.addClass('customizer-hidden');
                    } else {
                        control.container.removeClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control('sparklestore_pro_' + settingId + '_bg_color', setupControlColorBg);
            wp.customize.control('sparklestore_pro_' + settingId + '_bg_image', setupControlImageBg);
            wp.customize.control('sparklestore_pro_' + settingId + '_parallax_effect', setupControlImageBg);
            wp.customize.control('sparklestore_pro_' + settingId + '_bg_video', setupControlVideoBg);
            wp.customize.control('sparklestore_pro_' + settingId + '_bg_gradient', setupControlGradientBg);
            wp.customize.control('sparklestore_pro_' + settingId + '_overlay_color', setupControlOverlay);

            if( settingId == 'main_header') wp.customize.control('header_image', setupControlImageBg);
        });
    });

    
    /** 
     * notice bar
     * sparklestore_pro_top_notice_bar_type
     */
    wp.customize('sparklestore_pro_top_notice_bar_type', function (setting) {
        var setupNewsControl = function (control) {
            var visibility = function () {
                if ('news-ticker' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupFreeHand = function (control) {
            var visibility = function () {
                if ('free-hand' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };
        
        wp.customize.control('sparklestore_pro_top_notice_bar_editor', setupFreeHand);
        wp.customize.control('sparklestore_pro_top_notice_bar_label', setupNewsControl);
        wp.customize.control('sparklestore_pro_notice_bar_items', setupNewsControl);
                
    });


    /** footer style */
    wp.customize('sparklestore_pro_footer_layout', function (setting) {
        var setupControlFooterColumn = function (control) {
            var visibility = function () {
                if ('footer-style1' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('sparkle_store_pro_footer_col', setupControlFooterColumn);
    });

    /**
     * header cart icon options
     * @since SparkleStore Pro 1.2.8
     */


    /**
     * header cart icon options
     * @since SparkleStore Pro 1.2.8
     */
    var settingIds = ['cart', 'wishlist', 'menu-icon-open', 'account'];
    $.each(settingIds, function (i, settingId) {
        wp.customize(settingId + '-icon-options', function (setting) {
            
            var setupControl = function (control) {
                var visibility = function () {
                    if ('icon' === setting.get()) {
                        control.container.addClass('customizer-hidden');
                    } else {
                        control.container.removeClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control(settingId + '-text', setupControl);

            if( settingId == 'account'){
                wp.customize.control(settingId + '-before-text', setupControl);
            }
        });
    });

    /**
     * header cart icon options
     * @since SparkleStore Pro 1.2.8
     * mobile menu tab enable disable
     */
    
    wp.customize('sparklewp_header_sidebar_enable_tab', function (setting) {
            
        var setupControl = function (control) {
            var visibility = function () {
                if (setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('sparklewp_header_sidebar_tab_1_text', setupControl);
        wp.customize.control('sparklewp_header_sidebar_tab_2_text', setupControl);
        wp.customize.control('sparklecategory-custom-menu', setupControl);
    }); 
    
    /**
     * Top/Bottom Header Height Settings
     * @since SparkleStore Pro 1.2.8
     */
    var settingIds = ['top', 'bottom'];
    $.each(settingIds, function (i, settingId) {
        wp.customize('header-' + settingId +'-height-option', function (setting) {
                
            var setupControl = function (control) {
                var visibility = function () {
                    if (setting.get() == 'custom') {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control(settingId + '-header-height', setupControl);
        });


        /**
         * Top Header Background Settings
         * @since SparkleStore Pro 1.2.8
         */
        
        wp.customize('header-' + settingId +'-bg-options', function (setting) {
                
            var setupControl = function (control) {
                var visibility = function () {
                    if (setting.get() == 'none') {
                        control.container.addClass('customizer-hidden');
                    } else {
                        control.container.removeClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control('header-' + settingId +'-background-options', setupControl);
        });
    });
    
    

      /**
     * header cart icon options
     * @since SparkleStore Pro 1.2.8
     * Customizer navigation value set
     */
    wp.customize(
        'primary-menu-custom-menu',
        function( setting ) {
            setting.bind( function onChange( value ) {
                wp.customize.control( 'nav_menu_locations[sparkleprimary]' ).setting.set( value );
            } );
        }
    );
    wp.customize(
        'secondary-menu-custom-menu',
        function( setting ) {
            setting.bind( function onChange( value ) {
                wp.customize.control( 'nav_menu_locations[sparklesecondrymenu]' ).setting.set( value );
            } );
        }
    );
    wp.customize(
        'sparklecategory-custom-menu',
        function( setting ) {
            setting.bind( function onChange( value ) {
                wp.customize.control( 'nav_menu_locations[sparklecategory]' ).setting.set( value );
            } );
        }
    );
    

    // FontAwesome Icon Control JS
    $('body').on('click', '.sparklestore-pro-customizer-icon-box .sparklestore-pro-icon-list li', function () {
        var icon_class = $(this).find('i').attr('class');
        $(this).closest('.sparklestore-pro-icon-box').find('.sparklestore-pro-icon-list li').removeClass('icon-active');
        $(this).addClass('icon-active');
        $(this).closest('.sparklestore-pro-icon-box').prev('.sparklestore-pro-selected-icon').children('i').attr('class', '').addClass(icon_class);
        $(this).closest('.sparklestore-pro-icon-box').next('input').val(icon_class).trigger('change');
        $(this).closest('.sparklestore-pro-icon-box').slideUp();
    });

    $('body').on('click', '.sparklestore-pro-customizer-icon-box .sparklestore-pro-selected-icon', function () {
        $(this).next().slideToggle();
    });

    $('body').on('change', '.sparklestore-pro-customizer-icon-box .sparklestore-pro-icon-search select', function () {
        var selected = $(this).val();
        $(this).closest('.sparklestore-pro-icon-box').find('.sparklestore-pro-icon-search-input').val('');
        $(this).closest('.sparklestore-pro-icon-box').find('.sparklestore-pro-icon-list li').show();
        $(this).closest('.sparklestore-pro-icon-box').find('.sparklestore-pro-icon-list').hide().removeClass('active');
        $(this).closest('.sparklestore-pro-icon-box').find('.' + selected).fadeIn().addClass('active');
    });

    $('body').on('keyup', '.sparklestore-pro-customizer-icon-box .sparklestore-pro-icon-search input', function (e) {
        var $input = $(this);
        var keyword = $input.val().toLowerCase();
        search_criteria = $input.closest('.sparklestore-pro-icon-box').find('.sparklestore-pro-icon-list.active i');

        delay(function () {
            $(search_criteria).each(function () {
                if ($(this).attr('class').indexOf(keyword) > -1) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        }, 500);
    });

    // Switch Control
    $('body').on('click', '.onoffswitch', function () {
        var $this = $(this);
        if ($this.hasClass('switch-on')) {
            $(this).removeClass('switch-on');
            $this.next('input').val('off').trigger('change')
        } else {
            $(this).addClass('switch-on');
            $this.next('input').val('on').trigger('change')
        }
    });

    // Gallery Control
    $('.upload_gallery_button').click(function (event) {
        var current_gallery = $(this).closest('label');

        if (event.currentTarget.id === 'clear-gallery') {
            //remove value from input
            current_gallery.find('.gallery_values').val('').trigger('change');

            //remove preview images
            current_gallery.find('.gallery-screenshot').html('');
            return;
        }

        // Make sure the media gallery API exists
        if (typeof wp === 'undefined' || !wp.media || !wp.media.gallery) {
            return;
        }
        event.preventDefault();

        // Activate the media editor
        var val = current_gallery.find('.gallery_values').val();
        var final;

        if (!val) {
            final = '[gallery ids="0"]';
        } else {
            final = '[gallery ids="' + val + '"]';
        }
        var frame = wp.media.gallery.edit(final);

        frame.state('gallery-edit').on(
                'update',
                function (selection) {

                    //clear screenshot div so we can append new selected images
                    current_gallery.find('.gallery-screenshot').html('');

                    var element, preview_html = '',
                            preview_img;
                    var ids = selection.models.map(
                            function (e) {
                                element = e.toJSON();
                                preview_img = typeof element.sizes.thumbnail !== 'undefined' ? element.sizes.thumbnail.url : element.url;
                                preview_html = "<div class='screen-thumb'><img src='" + preview_img + "'/></div>";
                                current_gallery.find('.gallery-screenshot').append(preview_html);
                                return e.id;
                            }
                    );

                    current_gallery.find('.gallery_values').val(ids.join(',')).trigger('change');
                }
        );
        return false;
    });

    // MultiCheck box Control JS
    $('.customize-control-checkbox-multiple input[type="checkbox"]').on('change', function () {

        var checkbox_values = $(this).parents('.customize-control').find('input[type="checkbox"]:checked').map(
                function () {
                    return $(this).val();
                }
        ).get().join(',');

        $(this).parents('.customize-control').find('input[type="hidden"]').val(checkbox_values).trigger('change');

    });

    // Chosen JS
    // $(".sp-chosen-select, .customize-control-typography select").chosen({
    //     width: "100%"
    // });

    // Image Selector JS
    $('body').on('click', '.selector-labels label', function () {
        var $this = $(this);
        var value = $this.attr('data-val');
        $this.siblings().removeClass('selector-selected');
        $this.addClass('selector-selected');
        $this.closest('.selector-labels').next('input').val(value).trigger('change');
    });

    $('body').on('change', '.sparklestore-pro-type-radio input[type="radio"]', function () {
        var $this = $(this);
        $this.parent('label').siblings('label').find('input[type="radio"]').prop('checked', false);
        var value = $this.closest('.radio-labels').find('input[type="radio"]:checked').val();
        $this.closest('.radio-labels').next('input').val(value).trigger('change');
    });

    // Range JS
    $('.customize-control-range').each(function () {
        var sliderValue = $(this).find('.slider-input').val();
        var newSlider = $(this).find('.sparklestore-pro-slider');
        var sliderMinValue = parseFloat(newSlider.attr('slider-min-value'));
        var sliderMaxValue = parseFloat(newSlider.attr('slider-max-value'));
        var sliderStepValue = parseFloat(newSlider.attr('slider-step-value'));

        newSlider.slider({
            value: sliderValue,
            min: sliderMinValue,
            max: sliderMaxValue,
            step: sliderStepValue,
            range: 'min',
            slide: function (e, ui) {
                $(this).parent().find('.slider-input').trigger('change');
            },
            change: function (e, ui) {
                $(this).parent().find('.slider-input').trigger('change');
            }
        });
    });

    // Change the value of the input field as the slider is moved
    $('.customize-control-range .sparklestore-pro-slider').on('slide', function (event, ui) {
        $(this).parent().find('.slider-input').val(ui.value);
    });

    // Reset slider and input field back to the default value
    $('.customize-control-range .slider-reset').on('click', function () {
        var resetValue = $(this).attr('slider-reset-value');
        $(this).parents('.customize-control-range').find('.slider-input').val(resetValue);
        $(this).parents('.customize-control-range').find('.sparklestore-pro-slider').slider('value', resetValue);
    });

    // Update slider if the input field loses focus as it's most likely changed
    $('.customize-control-range .slider-input').blur(function () {
        var resetValue = $(this).val();
        var slider = $(this).parents('.customize-control-range').find('.sparklestore-pro-slider');
        var sliderMinValue = parseInt(slider.attr('slider-min-value'));
        var sliderMaxValue = parseInt(slider.attr('slider-max-value'));

        // Make sure our manual input value doesn't exceed the minimum & maxmium values
        if (resetValue < sliderMinValue) {
            resetValue = sliderMinValue;
            $(this).val(resetValue);
        }
        if (resetValue > sliderMaxValue) {
            resetValue = sliderMaxValue;
            $(this).val(resetValue);
        }
        $(this).parents('.customize-control-range').find('.sparklestore-pro-slider').slider('value', resetValue);
    });

    // TinyMCE editor
    $(document).on('tinymce-editor-init', function () {
        $('.customize-control').find('.wp-editor-area').each(function () {
            var tArea = $(this),
                    id = tArea.attr('id'),
                    input = $('input[data-customize-setting-link="' + id + '"]'),
                    editor = tinyMCE.get(id),
                    content;

            if (editor) {
                editor.onChange.add(function () {
                    this.save();
                    content = editor.getContent();
                    input.val(content).trigger('change');
                });
            }

            tArea.css({
                visibility: 'visible'
            }).on('keyup', function () {
                content = tArea.val();
                input.val(content).trigger('change');
            });

        });
    });

    // Select Image Js
    $('.select-image-control').on('change', function () {
        var activeImage = $(this).find(':selected').attr('data-image');
        $(this).next('.select-image-wrap').find('img').attr('src', activeImage);
    });

    // Date Picker Js
    $(".cl-datepicker-control").datepicker({
        dateFormat: "yy/mm/dd"
    });

    // Scroll to Footer
    $('body').on('click', '#accordion-section-sparklestore_pro_footer_section .accordion-section-title', function (event) {
        var preview_section_id = "cl-colophon";
        var $contents = jQuery('#customize-preview iframe').contents();

        if ($contents.find('#' + preview_section_id).length > 0) {
            $contents.find("html, body").animate({
                scrollTop: $contents.find("#" + preview_section_id).offset().top
            }, 1000);
        }
    });

    $('#customize-theme-controls').on('click', '.sparklestore-pro-repeater-field-title', function () {
        $(this).next().slideToggle();
        $(this).closest('.sparklestore-pro-repeater-field-control').toggleClass('expanded');
    });

    $('#customize-theme-controls').on('click', '.sparklestore-pro-repeater-field-close', function () {
        $(this).closest('.sparklestore-pro-repeater-fields').slideUp();
        $(this).closest('.sparklestore-pro-repeater-field-control').toggleClass('expanded');
    });

    $("body").on("click", '.sparklestore-pro-add-control-field', function () {

        var $this = $(this).parent();
        if (typeof $this != 'undefined') {
            if (hideShowButton($this, 1)) return;

            var field = $this.find(".sparklestore-pro-repeater-field-control:first").clone();
            if (typeof field != 'undefined') {

                field.find("input[type='text'][data-name]").each(function () {
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find("textarea[data-name]").each(function () {
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find("select[data-name]").each(function () {
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find(".radio-labels input[type='radio']").each(function () {
                    var defaultValue = $(this).closest('.radio-labels').next('input[data-name]').attr('data-default');
                    $(this).closest('.radio-labels').next('input[data-name]').val(defaultValue);

                    if ($(this).val() == defaultValue) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });

                field.find(".selector-labels label").each(function () {
                    var defaultValue = $(this).closest('.selector-labels').next('input[data-name]').attr('data-default');
                    var dataVal = $(this).attr('data-val');
                    $(this).closest('.selector-labels').next('input[data-name]').val(defaultValue);

                    if (defaultValue == dataVal) {
                        $(this).addClass('selector-selected');
                    } else {
                        $(this).removeClass('selector-selected');
                    }
                });

                field.find('.range-input').each(function () {
                    var $dis = $(this);
                    $dis.removeClass('ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all').empty();
                    var defaultValue = parseFloat($dis.attr('data-defaultvalue'));
                    $dis.siblings(".range-input-selector").val(defaultValue);
                    $dis.slider({
                        range: "min",
                        value: parseFloat($dis.attr('data-defaultvalue')),
                        min: parseFloat($dis.attr('data-min')),
                        max: parseFloat($dis.attr('data-max')),
                        step: parseFloat($dis.attr('data-step')),
                        slide: function (event, ui) {
                            $dis.siblings(".range-input-selector").val(ui.value);
                            sparkle_store_pro_refresh_repeater_values();
                        }
                    });
                });

                field.find('.onoffswitch').each(function () {
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    if (defaultValue == 'on') {
                        $(this).addClass('switch-on');
                    } else {
                        $(this).removeClass('switch-on');
                    }
                });

                field.find('.sparklestore-pro-color-picker').each(function () {
                    $colorPicker = $(this);
                    $colorPicker.closest('.wp-picker-container').after($(this));
                    $colorPicker.prev('.wp-picker-container').remove();
                    $(this).wpColorPicker({
                        change: function (event, ui) {
                            setTimeout(function () {
                                sparkle_store_pro_refresh_repeater_values();
                            }, 100);
                        }
                    });
                });

                field.find(".attachment-media-view").each(function () {
                    var defaultValue = $(this).find('input[data-name]').attr('data-default');
                    $(this).find('input[data-name]').val(defaultValue);
                    if (defaultValue) {
                        $(this).find(".thumbnail-image").html('<img src="' + defaultValue + '"/>').prev('.placeholder').addClass('hidden');
                    } else {
                        $(this).find(".thumbnail-image").html('').prev('.placeholder').removeClass('hidden');
                    }
                });

                field.find(".sparklestore-pro-icon-list").each(function () {
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    $(this).prev('.sparklestore-pro-selected-icon').children('i').attr('class', '').addClass(defaultValue);

                    $(this).find('li').each(function () {
                        var icon_class = $(this).find('i').attr('class');
                        if (defaultValue == icon_class) {
                            $(this).addClass('icon-active');
                        } else {
                            $(this).removeClass('icon-active');
                        }
                    });
                });

                field.find(".sparklestore-pro-multi-category-list").each(function () {
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);

                    $(this).find('input[type="checkbox"]').each(function () {
                        if ($(this).val() == defaultValue) {
                            $(this).prop('checked', true);
                        } else {
                            $(this).prop('checked', false);
                        }
                    });
                });

                //field.find('.sparklestore-pro-fields').show();

                $this.find('.sparklestore-pro-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.sparklestore-pro-repeater-fields').show();
                $('.accordion-section-content').animate({
                    scrollTop: $this.height()
                }, 1000);
                sparkle_store_pro_refresh_repeater_values();
            }
            hideShowButton($this);
        }
        return false;
    });

    function hideShowButton(ele, rtn) {
        var $this = ele;
        setTimeout(function() {
          var limit = $this
            .find(".sparklestore-pro-repeater-collector-limit")
            .val();
          var currentEleCount = $this.find(
            "ul.sparklestore-pro-repeater-field-control-wrap > li"
          ).length;
          // update counter
          var limitBlock = $this.find(".sparklestore-pro-block-limit");
          if (limitBlock.length)
            limitBlock.find(".current-block-count").text(currentEleCount);
    
          if (currentEleCount == limit) {
            ele.find(".sparklestore-pro-add-control-field").hide();
            console.log("Limit Reached");
            if (rtn) return true;
          } else {
            ele.find(".sparklestore-pro-add-control-field").show();
          }
        }, 600);
    }

    $("#customize-theme-controls").on("click", ".sparklestore-pro-repeater-field-remove", function () {
        if (typeof $(this).parent() != 'undefined') {
            $(this).closest('.sparklestore-pro-repeater-field-control').slideUp('normal', function () {
                $(this).remove();
                sparkle_store_pro_refresh_repeater_values();
            });
            hideShowButton($(this).parents(".customize-control-repeater"));
        }
        return false;
    });

    $("#customize-theme-controls").on('keyup change', '[data-name]', function () {
        delay(function () {
            sparkle_store_pro_refresh_repeater_values();
            return false;
        }, 500);
    });

    $("#customize-theme-controls").on('change', 'input[type="checkbox"][data-name]', function () {
        if ($(this).is(":checked")) {
            $(this).val('yes');
        } else {
            $(this).val('no');
        }
        return false;
    });

    // Drag and drop to change order
    $(".sparklestore-pro-repeater-field-control-wrap").sortable({
        orientation: "vertical",
        handle: ".sparklestore-pro-repeater-field-title",
        update: function (event, ui) {
            sparkle_store_pro_refresh_repeater_values();
        }
    });

    // Set all variables to be used in scope
    var frame;

    // ADD IMAGE LINK
    $('.customize-control-repeater').on('click', '.sparklestore-pro-upload-button', function (event) {
        event.preventDefault();

        var imgContainer = $(this).closest('.sparklestore-pro-fields-wrap').find('.thumbnail-image'),
                placeholder = $(this).closest('.sparklestore-pro-fields-wrap').find('.placeholder'),
                imgIdInput = $(this).siblings('.upload-id');

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Image',
            button: {
                text: 'Use Image'
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();

            // Send the attachment URL to our custom image input field.
            imgContainer.html('<img src="' + attachment.url + '" style="max-width:100%;"/>');
            placeholder.addClass('hidden');

            // Send the attachment id to our hidden input
            imgIdInput.val(attachment.url).trigger('change');

        });

        // Finally, open the modal on click
        frame.open();
    });

    // DELETE IMAGE LINK
    $('.customize-control-repeater').on('click', '.sparklestore-pro-delete-button', function (event) {

        event.preventDefault();
        var imgContainer = $(this).closest('.sparklestore-pro-fields-wrap').find('.thumbnail-image'),
                placeholder = $(this).closest('.sparklestore-pro-fields-wrap').find('.placeholder'),
                imgIdInput = $(this).siblings('.upload-id');

        // Clear out the preview image
        imgContainer.find('img').remove();
        placeholder.removeClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val('').trigger('change');

    });

    var ColorChange = false;
    $('.sparklestore-pro-color-picker').wpColorPicker({
        change: function (event, ui) {
            if (jQuery('html').hasClass('colorpicker-ready') && ColorChange) {
                sparkle_store_pro_refresh_repeater_values();
            }
        }
    });
    ColorChange = true;

    //MultiCheck box Control JS
    $('body').on('change', '.sparklestore-pro-type-multicategory input[type="checkbox"]', function () {
        var checkbox_values = $(this).parents('.sparklestore-pro-type-multicategory').find('input[type="checkbox"]:checked').map(function () {
            return $(this).val();
        }).get().join(',');

        $(this).parents('.sparklestore-pro-type-multicategory').find('input[type="hidden"]').val(checkbox_values).trigger('change');
        sparkle_store_pro_refresh_repeater_values();
    });

    $('.sparklestore-pro-repeater-fields .range-input').each(function () {
        var $dis = $(this);
        $dis.slider({
            range: "min",
            value: parseFloat($dis.attr('data-value')),
            min: parseFloat($dis.attr('data-min')),
            max: parseFloat($dis.attr('data-max')),
            step: parseFloat($dis.attr('data-step')),
            slide: function (event, ui) {
                $dis.siblings(".range-input-selector").val(ui.value);
                sparkle_store_pro_refresh_repeater_values();
            }
        });
    });

    $('.color-tab-toggle').on('click', function () {
        $(this).closest('.customize-control').find('.color-tab-wrap').slideToggle();
    });

    $('.color-tab-switchers li').on('click', function () {
        if ($(this).hasClass('active')) {
            return false;
        }
        var clicked = $(this).attr('data-tab');
        $(this).parent('.color-tab-switchers').find('li').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.color-tab-wrap').find('.color-tab-contents > div').hide();
        $(this).closest('.color-tab-wrap').find('.' + clicked).fadeIn();
    });

    function sparkle_store_pro_refresh_repeater_values() {
        $(".sparklestore-pro-repeater-field-control-wrap").each(function () {

            var values = [];
            var $this = $(this);

            $this.find(".sparklestore-pro-repeater-field-control").each(function () {
                var valueToPush = {};

                $(this).find('[data-name]').each(function () {
                    var dataName = $(this).attr('data-name');
                    var dataValue = $(this).val();
                    valueToPush[dataName] = dataValue;
                });

                values.push(valueToPush);
            });

            $this.next('.sparklestore-pro-repeater-collector').val(JSON.stringify(values)).trigger('change');
        });
    }
});

(function (api) {

    // Class extends the UploadControl
    api.controlConstructor['background-image'] = api.UploadControl.extend({

        ready: function () {

            // Re-use ready function from parent class to set up the image uploader
            var image_url = this;
            image_url.setting = this.settings.image_url;
            api.UploadControl.prototype.ready.apply(image_url, arguments);

            // Set up the new controls
            var control = this;

            control.container.addClass('customize-control-image');

            control.container.on('click keydown', '.remove-button',
                function () {
                    control.container.find('.background-image-fields').hide();
                }
            );

            control.container.on('change', '.background-image-repeat select',
                function () {
                    control.settings['repeat'].set(jQuery(this).val());
                }
            );

            control.container.on('change', '.background-image-size select',
                    function () {
                        control.settings['size'].set(jQuery(this).val());
                    }
            );

            control.container.on('change', '.background-image-attach select',
                    function () {
                        control.settings['attach'].set(jQuery(this).val());
                    }
            );

            control.container.on('change', '.background-image-position select',
                    function () {
                        control.settings['position'].set(jQuery(this).val());
                    }
            );

        },

        /**
         * Callback handler for when an attachment is selected in the media modal.
         * Gets the selected image information, and sets it within the control.
         */
        select: function () {
            var attachment = this.frame.state().get('selection').first().toJSON();
            this.params.attachment = attachment;
            this.settings['image_url'].set(attachment.url);
            this.settings['image_id'].set(attachment.id);
        },

    });

    // Tab Control
    api.SparkleTabs = [];

    api.SparkleTab = api.Control.extend({

        ready: function () {
            var control = this;
            control.container.find('a.customizer-tab').click(function (evt) {
                var tab = jQuery(this).data('tab');
                evt.preventDefault();
                control.container.find('a.customizer-tab').removeClass('active');
                jQuery(this).addClass('active');
                control.toggleActiveControls(tab);
            });

            api.SparkleTabs.push(control.id);
        },

        toggleActiveControls: function (tab) {
            var control = this,
                    currentFields = control.params.buttons[tab].fields;
            _.each(control.params.fields, function (id) {
                var tabControl = api.control(id);
                if (undefined !== tabControl) {
                    if (tabControl.active() && jQuery.inArray(id, currentFields) >= 0) {
                        tabControl.toggle(true);
                    } else {
                        tabControl.toggle(false);
                    }
                }
            });
        }

    });

    jQuery.extend(api.controlConstructor, {
        'tab': api.SparkleTab,
    });

    api.bind('ready', function () {
        _.each(api.SparkleTabs, function (id) {
            var control = api.control(id);
            control.toggleActiveControls(0);
        });
    });

    // Alpha Color Picker Control
    api.controlConstructor['alpha-color'] = api.Control.extend({

        ready: function () {

            var control = this;

            var paletteInput = control.container.find('.alpha-color-control').data('palette');

            if (true == paletteInput) {
                palette = true;
            } else if ((typeof (paletteInput) !== 'undefined') && paletteInput.indexOf('|') !== -1) {
                palette = paletteInput.split('|');
            } else {
                palette = false;
            }

            control.container.find('.alpha-color-control').wpColorPicker({
                change: function (event, ui) {
                    var color = ui.color.toString();

                    if (jQuery('html').hasClass('colorpicker-ready')) {
                        control.setting.set(color);
                    }
                },
                clear: function (event) {
                    var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
                    var color = '';

                    if (element) {
                        control.setting.set(color);
                    }
                },
                palettes: palette
            });
        }
    });

    // Color Tab Control
    api.controlConstructor['color-tab'] = api.Control.extend({

        ready: function () {

            var control = this;

            control.container.find('.alpha-color-control').each(function () {
                var $elem = jQuery(this);
                var paletteInput = $elem.data('palette');
                var setting = jQuery(this).attr('data-customize-setting-link');

                if (true == paletteInput) {
                    palette = true;
                } else if ((typeof (paletteInput) !== 'undefined') && paletteInput.indexOf('|') !== -1) {
                    palette = paletteInput.split('|');
                } else {
                    palette = false;
                }

                $elem.wpColorPicker({
                    change: function (event, ui) {
                        var color = ui.color.toString();

                        if (jQuery('html').hasClass('colorpicker-ready')) {
                            wp.customize(setting, function (obj) {
                                obj.set(color);
                            });
                        }
                    },
                    clear: function (event) {
                        var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
                        var color = '';

                        if (element) {
                            wp.customize(setting, function (obj) {
                                obj.set(color);
                            });
                        }
                    },
                    palettes: palette
                });
            });
        }
    });

    // Dimenstion Control
    api.controlConstructor['dimensions'] = wp.customize.Control.extend({

        ready: function () {

            var control = this;

            control.container.on('change keyup paste', '.dimension-desktop_top', function () {
                control.settings['desktop_top'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-desktop_right', function () {
                control.settings['desktop_right'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-desktop_bottom', function () {
                control.settings['desktop_bottom'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-desktop_left', function () {
                control.settings['desktop_left'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-tablet_top', function () {
                control.settings['tablet_top'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-tablet_right', function () {
                control.settings['tablet_right'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-tablet_bottom', function () {
                control.settings['tablet_bottom'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-tablet_left', function () {
                control.settings['tablet_left'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-mobile_top', function () {
                control.settings['mobile_top'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-mobile_right', function () {
                control.settings['mobile_right'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-mobile_bottom', function () {
                control.settings['mobile_bottom'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-mobile_left', function () {
                control.settings['mobile_left'].set(jQuery(this).val());
            });
        }
    });

    // Range Slider Control
    api.controlConstructor['range-slider'] = wp.customize.Control.extend({
        ready: function () {
            var control = this,
                    desktop_slider = control.container.find('.sparklestore-pro-slider.desktop-slider'),
                    desktop_slider_input = desktop_slider.next('.sparklestore-pro-slider-input').find('input.desktop-input'),
                    tablet_slider = control.container.find('.sparklestore-pro-slider.tablet-slider'),
                    tablet_slider_input = tablet_slider.next('.sparklestore-pro-slider-input').find('input.tablet-input'),
                    mobile_slider = control.container.find('.sparklestore-pro-slider.mobile-slider'),
                    mobile_slider_input = mobile_slider.next('.sparklestore-pro-slider-input').find('input.mobile-input'),
                    slider_input,
                    $this,
                    val;

            // Desktop slider
            desktop_slider.slider({
                range: 'min',
                value: desktop_slider_input.val(),
                min: +desktop_slider_input.attr('min'),
                max: +desktop_slider_input.attr('max'),
                step: +desktop_slider_input.attr('step'),
                slide: function (event, ui) {
                    desktop_slider_input.val(ui.value).keyup();
                },
                change: function (event, ui) {
                    control.settings['desktop'].set(ui.value);
                }
            });

            // Tablet slider
            tablet_slider.slider({
                range: 'min',
                value: tablet_slider_input.val(),
                min: +tablet_slider_input.attr('min'),
                max: +tablet_slider_input.attr('max'),
                step: +desktop_slider_input.attr('step'),
                slide: function (event, ui) {
                    tablet_slider_input.val(ui.value).keyup();
                },
                change: function (event, ui) {
                    control.settings['tablet'].set(ui.value);
                }
            });

            // Mobile slider
            mobile_slider.slider({
                range: 'min',
                value: mobile_slider_input.val(),
                min: +mobile_slider_input.attr('min'),
                max: +mobile_slider_input.attr('max'),
                step: +desktop_slider_input.attr('step'),
                slide: function (event, ui) {
                    mobile_slider_input.val(ui.value).keyup();
                },
                change: function (event, ui) {
                    control.settings['mobile'].set(ui.value);
                }
            });

            // Update the slider when the number value change
            jQuery('input.desktop-input').on('change keyup paste', function () {
                $this = jQuery(this);
                val = $this.val();
                slider_input = $this.parent().prev('.sparklestore-pro-slider.desktop-slider');

                slider_input.slider('value', val);
            });

            jQuery('input.tablet-input').on('change keyup paste', function () {
                $this = jQuery(this);
                val = $this.val();
                slider_input = $this.parent().prev('.sparklestore-pro-slider.tablet-slider');

                slider_input.slider('value', val);
            });

            jQuery('input.mobile-input').on('change keyup paste', function () {
                $this = jQuery(this);
                val = $this.val();
                slider_input = $this.parent().prev('.sparklestore-pro-slider.mobile-slider');

                slider_input.slider('value', val);
            });

            // Save the values
            control.container.on('change keyup paste', '.desktop input', function () {
                control.settings['desktop'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.tablet input', function () {
                control.settings['tablet'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.mobile input', function () {
                control.settings['mobile'].set(jQuery(this).val());
            });

        }

    });

    // Sortable Control
    api.controlConstructor['sortable'] = wp.customize.Control.extend({

        ready: function () {

            var control = this;

            // Set the sortable container.
            control.sortableContainer = control.container.find('ul.sortable').first();

            // Init sortable.
            control.sortableContainer.sortable({

                // Update value when we stop sorting.
                stop: function () {
                    control.updateValue();
                }
            }).disableSelection().find('li').each(function () {

                // Enable/disable options when we click on the eye of Thundera.
                jQuery(this).find('i.visibility').click(function () {
                    jQuery(this).toggleClass('dashicons-visibility-faint').parents('li:eq(0)').toggleClass('invisible');
                });
            }).click(function () {

                // Update value on click.
                control.updateValue();
            });
        },

        /**
         * Updates the sorting list
         */
        updateValue: function () {

            var control = this,
                    newValue = [];

            this.sortableContainer.find('li').each(function () {
                if (!jQuery(this).is('.invisible')) {
                    newValue.push(jQuery(this).data('value'));
                }
            });

            control.setting.set(newValue);
        }
    });
})(wp.customize);


(function ($) {
    wp.customize.bind('ready', function () {
        wp.customize.section('sparklestore_pro_gdpr_section', function (section) {

            section.expanded.bind(function (isExpanding) {

                // Value of isExpanding will = true if you're entering the section, false if you're leaving it.
                if (isExpanding) {
                    wp.customize.previewer.send('sparklestore-pro-gdpr-add-class', {
                        expanded: isExpanding
                    });
                } else {
                    wp.customize.previewer.send('sparklestore-pro-gdpr-remove-class', {
                        home_url: wp.customize.settings.url.home
                    });
                }
            });

        });
    });
})(jQuery);



jQuery(document).ready(function ($) {
    // Responsive switchers
    $('.customize-control .responsive-switchers button').on('click', function (event) {

        // Set up variables
        var $this = $(this),
                $devices = $('.responsive-switchers'),
                $device = $(event.currentTarget).data('device'),
                $control = $('.customize-control.has-switchers'),
                $body = $('.wp-full-overlay'),
                $footer_devices = $('.wp-full-overlay-footer .devices');

        // Button class
        $devices.find('button').removeClass('active');
        $devices.find('button.preview-' + $device).addClass('active');

        // Control class
        $control.find('.control-wrap').removeClass('active');
        $control.find('.control-wrap.' + $device).addClass('active');
        $control.removeClass('control-device-desktop control-device-tablet control-device-mobile').addClass('control-device-' + $device);

        // Wrapper class
        $body.removeClass('preview-desktop preview-tablet preview-mobile').addClass('preview-' + $device);

        // Panel footer buttons
        $footer_devices.find('button').removeClass('active').attr('aria-pressed', false);
        $footer_devices.find('button.preview-' + $device).addClass('active').attr('aria-pressed', true);

        // Open switchers
        if ($this.hasClass('preview-desktop')) {
            $control.toggleClass('responsive-switchers-open');
        }

    });

    // If panel footer buttons clicked
    $('.wp-full-overlay-footer .devices button').on('click', function (event) {

        // Set up variables
        var $this = $(this),
                $devices = $('.customize-control.has-switchers .responsive-switchers'),
                $device = $(event.currentTarget).data('device'),
                $control = $('.customize-control.has-switchers');

        // Button class
        $devices.find('button').removeClass('active');
        $devices.find('button.preview-' + $device).addClass('active');

        // Control class
        $control.find('.control-wrap').removeClass('active');
        $control.find('.control-wrap.' + $device).addClass('active');
        $control.removeClass('control-device-desktop control-device-tablet control-device-mobile').addClass('control-device-' + $device);

        // Open switchers
        if (!$this.hasClass('preview-desktop')) {
            $control.addClass('responsive-switchers-open');
        } else {
            $control.removeClass('responsive-switchers-open');
        }

    });

    // Linked button
    $('.sparklestore-pro-linked').on('click', function () {

        // Set up variables
        var $this = $(this);

        // Remove linked class
        $this.parent().parent('.dimension-wrap').prevAll().slice(0, 4).find('input').removeClass('linked').attr('data-element', '');

        // Remove class
        $this.parent('.link-dimensions').removeClass('unlinked');

    });

    // Unlinked button
    $('.sparklestore-pro-unlinked').on('click', function () {

        // Set up variables
        var $this = $(this),
                $element = $this.data('element');

        // Add linked class
        $this.parent().parent('.dimension-wrap').prevAll().slice(0, 4).find('input').addClass('linked').attr('data-element', $element);

        // Add class
        $this.parent('.link-dimensions').addClass('unlinked');

    });

    // Values linked inputs
    $('.dimension-wrap').on('input', '.linked', function () {

        var $data = $(this).attr('data-element'),
                $val = $(this).val();

        $('.linked[ data-element="' + $data + '" ]').each(function (key, value) {
            $(this).val($val).change();
        });

    });

});

