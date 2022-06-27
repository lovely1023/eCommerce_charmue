jQuery(document).ready(function($) {
    "use strict";
    /**
     * Add RTL Class in Body
    */
   var brtl = false;

   if ($("body").hasClass('rtl')) { brtl = true; }

    /**
     * PRE LOADER
    */
    $(window).load(function() {
       $('.sparklestore-preloader').delay(300).fadeOut('slow');
    });

    function delay(callback, ms) {
        var timer = 0;
        return function() {
          var context = this, args = arguments;
          clearTimeout(timer);
          timer = setTimeout(function () {
            callback.apply(context, args);
          }, ms || 0);
        };
    }

    function sparklestore_pro_ajax_search( value ){
        jQuery.ajax({
            url: sparklestore_pro_tabs_ajax_action.ajaxurl,
            type: 'post',
            data: { action: 'sparklestore_pro_search_data_fetch', keyword: value },
            success: function(data) {
                $('.form-ajax-preloader').hide();
                $('.btn-submit .fa-search').show();
                jQuery('.datafetch').show();
                jQuery('.datafetch').html( data );
            }
        });
    }
    /** ajax search form */
    jQuery('.form-search.ajaxsearch input').keyup( delay(function(e){
        if( this.value.length > 2){
            $('.form-ajax-preloader').show();
            $('.btn-submit .fa-search').hide();
            sparklestore_pro_ajax_search(this.value);
        }
        else {
            jQuery('.datafetch').hide();
            $('.form-ajax-preloader').hide();
            $('.btn-submit .fa-search').show();
        }
    }, 500));


    /** sidebar mobile menu */
    $('body').click(function(evt){    
        /** ajax search box  click prevent
        * and if click on body hide list
        */
        if($(evt.target).closest('form.ajaxsearch').length)
           return;
        
        jQuery('#datafetch').hide();
        $('.form-ajax-preloader').hide();
        
       
    });

    /**
     * Masonry Posts Layout
    */
    var grid = document.querySelector(
        '.sparklestore-masonry'
    ),
    masonry;

    if (grid && typeof Masonry !== undefined && typeof imagesLoaded !== undefined ) {
        imagesLoaded( grid, function( instance ) {
            masonry = new Masonry( grid, {
                itemSelector: '.hentry',
                gutter: 15
            } );
        } );
    }

    /****
     * Default Header Slider
    */
    if( $('.sparklestore-slider').length > 0 ) {
        $('.sparklestore-slider').each(function(){
            var that = $(this);
            that.flexslider({
                animation: "fade",
                slideshow: parseInt(that.data('autoplay')),
                animationSpeed: 500,
                rtl: brtl,
                animationLoop: parseInt(that.data('loop')) || 1,
                touch: parseInt(that.data('drag')) || false,
                directionNav: parseInt(that.data('arrow')) || false,
                controlNav: parseInt(that.data('dots')) || false,
                prevText: '<i class="iconfont icofont-thin-left"></i>',
                nextText: '<i class="iconfont icofont-thin-right"></i>',
                before: function(slider) {
                    $('.sparklestore-caption:not(.noanimation)').fadeOut().animate({top:'35%'},{queue:false, easing: 'swing', duration: 700});
                    slider.slides.eq(slider.currentSlide).delay(500);
                    slider.slides.eq(slider.animatingTo).delay(500);
                },
                after: function(slider) {
                    $('.sparklestore-caption:not(.noanimation)').fadeIn().animate({top:'50%'},{queue:false, easing: 'swing', duration: 700});
                },
                useCSS: true
            });
        })
    }


    /**
     * Sparkle Store Category MobileMenu
    */
    jQuery('.toggle-wrap').click(function(){
        jQuery('.main-menu-links').slideToggle();
    });


    /**
     * Vertical Menu
    */
   if ( $('.block-nav-category').length > 0 ) {
        var _value2 = 0;
        $('.block-nav-category').each(function () {
            var _value1 = $(this).data('items') - 1;
            _value2     = $(this).find('.vertical-menu>li').length;

            if ( _value2 > (_value1 + 1) ) {
                $(this).addClass('show-button-all');
            }
            $(this).find('.vertical-menu>li').each(function (i) {
                _value2 = _value2 + 1;
                if ( i > _value1 ) {
                    $(this).addClass('link-other');
                }
            })
        })
    }

    $(document).on('click', '.open-cate', function (e) {
        $(this).closest('.block-nav-category').find('li.link-other').each(function () {
            $(this).slideDown();
        });
        $(this).addClass('close-cate').removeClass('open-cate').html($(this).data('closetext'));
        e.preventDefault();
    });
    $(document).on('click', '.close-cate', function (e) {
        $(this).closest('.block-nav-category').find('li.link-other').each(function () {
            $(this).slideUp();
        });
        $(this).addClass('open-cate').removeClass('close-cate').html($(this).data('alltext'));
        e.preventDefault();
    });

    $('.block-nav-category .block-title').on('click', function () {
        $(this).toggleClass('active');
        $(this).parent().toggleClass('has-open');
        $('body').toggleClass('category-open');
    });

    /**
     * Advance Search Product Category Dropdown
    */
    if ( $('.category-search-option').length > 0 ) {
        $('.category-search-option').chosen();
    }

    /**
     * Wishlist count ajax update
    */
    jQuery( document ).ready( function($){
        $('body').on( 'added_to_wishlist', function(){
            $('.top-wishlist .count').load( yith_wcwl_l10n.ajax_url + '.top-wishlist span', { action: 'yith_wcwl_update_single_product_list'} );
        });
    });

    /**
     * Sparkle Tabs Category Product
    */
    $('.sparkletablinks').each(function(){
        $(this).find('li').first('li').addClass('active');
    })

    $('.sparkletabs .sparkletablinks a').on('click', function(e)  {
        e.preventDefault();
        var that = $(this);

        var currentAttrValue = that.attr('href');
        var product_num = that.parents('ul').data('noofporduct');
        var column =  that.parents('ul').data('column');
        var layout = that.parents('ul').data('layout');
        var active = that.attr('id');

        var parentLi = that.parent('li');
            parentLi.addClass('active').siblings().removeClass('active');

        var contentArea = $(this).parents('.sparkletabs').siblings('.sparkletabsproductwrap .sparkletablinkscontent').find('.sparkletabproductarea').find("#"+currentAttrValue);
        
        //find is ajax or not
        var is_no_ajax = that.data('noajax');
        if( is_no_ajax ){
            
            that.parents('.sparkletabs').parent().find('.sparkletabproductarea .tab-content').hide();
            
            that.parents('.sparkletabs').parent().find('.sparkletabproductarea #' + active).show();
            $(window).trigger('resize');
            return ;
        }

        that.parents('.sparkletabs').parent().find('.sparkletabproductarea ul').addClass('hidden');

        contentArea.removeClass('hidden');
        $(window).trigger('resize');
        
        if( parentLi.attr('data-loaded') == 1) {
            console.log('already loaded');
            return;
        }

        contentArea.hide();

        // Ajax Function
        var preloader = $(this).parents('.sparkletabs').siblings('.sparkletabsproductwrap .sparkletablinkscontent').find('.preloader');
        preloader.show();

        $.ajax({
            url : sparklestore_pro_tabs_ajax_action.ajaxurl,
            data:{
                    action        : 'sparklestore_pro_tabs_ajax_action',
                    category_slug : currentAttrValue,
                    product_num   : product_num,
                    layout        : layout,
                    column        : column
                },
            type:'post',
                success: function(res){
                    parentLi.attr('data-loaded', 1);
                    contentArea.html(res);
                    contentArea.show();
                    contentArea.removeClass('hidden');
                    sparklestore_pro_ajax_cat_tabs();
                    preloader.hide();

                }
        });
    });

    /**
     * WooCommerce Tabs Category Products Functions Area
    */
    function sparklestore_pro_ajax_cat_tabs(){
        $('.widget_sparklestore_pro_cat_collection_tabs_widget_area').each(function(){
            var sliderCount = 4;
            if($(this).parents().hasClass('homemainwidget')){
                sliderCount = 3;
            }

            $(this).find('.storeslider').trigger("destroy.owl.carousel");

            sliderInit($(this));
        });
    }

    sparklestore_pro_ajax_cat_tabs();

    /** sliders for all */
    $('.storeslider').each(function(){
        var that = $(this).closest('.widget');
        var widget = that.attr('id');
        var element = $('#' + widget);

        sliderInit(element);
    });

    function sliderInit(element, column = false){
        var ele = element.find('.storeslider');

        if( column == false) column = ele.data('column');
        var options = {
            items: column,
            loop: true,
            margin:25,
            autoplay:true,
            autoplayTimeout:6000,
            rtl: brtl,
            autoplayHoverPause:false,
            nav: true,
            navText: ['<i class="icofont-thin-left"></i>','<i class="icofont-thin-right"></i>'],
            dots: false,
            responsive:{
                0:{
                    items:1,
                },
                480:{
                    items:1,
                },
                600:{
                    items:2,
                },
                900:{
                    items:3,
                },
                1024:{
                    items: column,
                }
            }
        };
        
        ele.owlCarousel(options);
    }

    
    $('.postgallery-carousel.owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        autoHeight: false,
        nav: true,
        navText: ['<i class="icofont-thin-left"></i>','<i class="icofont-thin-right"></i>'],
        dots: true,
    })
    /**
     * News ticker
    */
    $('.newstirer').AcmeTicker({
        type:'marquee',/*horizontal/horizontal/Marquee/type*/
        direction: 'left',/*up/down/left/right*/
        speed: 0.05,/*true/false/number*/ /*For vertical/horizontal 600*//*For marquee 0.05*//*For typewriter 50*/
        controls: {
            prev: $('.acme-news-ticker-prev'),
            toggle: $('.acme-news-ticker-pause'),
            next: $('.acme-news-ticker-next')
        }
    });

    jQuery('.noticeclose').click(function(){
        jQuery(this).parents('.top-notice-bar').hide('slow');
    });

    /**
     * scrollTop To Top
    */
    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            $('#back-to-top').addClass('show');
        } else {
            $('#back-to-top').removeClass('show');
        }
    });

    $('#back-to-top').click(function(e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 800);
    });

    try{
        var progressPath = document.querySelector('.progress path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 300ms linear';
        var updateProgress = function() {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var percent = Math.round(scroll * 100 / height);
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
            $('.percent').text(percent + "%");
        };
        updateProgress();
        $(window).scroll(updateProgress);
    }catch(e){
        // console.log(e);
    }

    /** video player */
    $(".sp-section[data-property], .cl-maintenance-video[data-property]").YTPlayer({
        showControls: false,
        containment: 'self',
        mute: true,
        addRaster: false,
        useOnMobile: false,
        playOnlyIfVisible: true,
        anchor: 'center,center',
        showYTLogo: false,
        loop: true,
        optimizeDisplay: true,
        quality: 'hd720'
    });

    function slickInit( element,  column ){
        element.slick({
            slidesToShow: parseInt(column) || 3,
            slidesToScroll: 1,
            arrows: true,
            fade: false,
            dots: false,
            infinite: true,
            focusOnSelect: true,
            waitForAnimate: true,
            rtl: brtl,
            nextArrow : '<span class="slick-next"><i class="icofont-thin-right"></i></span>',
            prevArrow : '<span class="slick-prev"><i class="icofont-thin-left"></i></span>',
            responsive: [
                {
                    breakpoint: 900,
                    settings: {
                      slidesToShow: 3,
                      slidesToScroll: 1
                    }
                  },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
              ]

        });

        $('.cS-hidden').css('height', 'auto');
        $('.cS-hidden').css('opacity', '1');
    }

    $('.content-area.related-product-layout-slider').each(function(){
        var column = $(this).attr('related-column');
        var ele = $(this).find('.related.products ul.products');

        ele.find("li")
        .each(function(){
            $(this).replaceWith($("<div>" + this.outerHTML + "</div>"))
        });
        slickInit(ele, column);
    })
    
    $('.content-area.upsell-product-layout-slider').each(function(){
        var column = $(this).attr('upsell-column');
        var ele = $(this).find('.upsells.products ul.products');

        ele.find("li")
        .each(function(){
            $(this).replaceWith($("<div>" + this.outerHTML + "</div>"))
        });
        slickInit(ele, column);
    })


    $('.woocommerce-small-thumbnails').each(function(){
        var vertical = $(this).data('vertical');
        $(this).slick({
            vertical: vertical ? true : false,
            adaptiveHeight: true,
            slidesToShow: vertical ? 3 : 4,
            slidesToScroll: 1,
            arrows: true,
            fade: false,
            dots: false,
            infinite: true,
            focusOnSelect: true,
            waitForAnimate: true,
            nextArrow : '<span class="slick-next"><i class="icofont-thin-right"></i></span>',
            prevArrow : '<span class="slick-prev"><i class="icofont-thin-left"></i></span>',
            asNavFor: '.woocommerce-product-thumbnails',
        })
    });

    /** single product page slider override */
    $('.woocommerce-product-thumbnails:not(.gallery-layout-stacked)').each(function(){
        var that = $(this);
        var isZoomable = that.data('szoom');
        var lightbox = that.data('lightbox');

        var options = {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: false,
            infinite: true,
            rtl: brtl,
            nextArrow : '<span class="slick-next"><i class="icofont-thin-right"></i></span>',
            prevArrow : '<span class="slick-prev"><i class="icofont-thin-left"></i></span>',
            // asNavFor: '.woocommerce-small-thumbnails',
        };

        if( jQuery('.woocommerce-small-thumbnails .woocommerce-product-gallery__image').length > 3){
            options.asNavFor = '.woocommerce-small-thumbnails';
        }

        that.slick(options);


        //zoom
        var zoomele = that.find('.woocommerce-product-gallery__image img')
            .wrap('<span style="display:inline-block"></span>')
            .css('display', 'block')
            .parent();
            // .zoom();
        if( isZoomable ) {
            zoomele.zoom();
        }else{
            zoomele.trigger('zoom.destroy');
        }

        // remove thumbnail zoom
        var tzoom = $('.woocommerce-small-thumbnails .woocommerce-product-gallery__image img');
        setTimeout(function(){
            tzoom.trigger('zoom.destroy');

        }, 200)    

        //rmeove lightibox 
        setTimeout(() => {
            if( !lightbox ){
                that.parents('.woocommerce-product-gallery--with-images').find('.woocommerce-product-gallery__trigger').hide();
            }    
        }, 400);
        
    }) 


    /** accordion */
    $('.accordion-header:not(.toggle)').on('click', function(){
        if( $(this).hasClass('section')) return;

        var parent = $(this).parent();
        if( parent.hasClass('open')){
            $('.accordion-box').removeClass('open');
        }else{
            $('.accordion-box').removeClass('open');
            parent.addClass('open');
        }        
    })

    $('.accordion-header.toggle').on('click', function(){
        if( $(this).hasClass('section')) return;

        var parent = $(this).parent();
        if( parent.hasClass('open')){
            parent.removeClass('open');
        }else{
            parent.addClass('open');
        }        
    })

    /** woo category with product */
    setTimeout(function(){
        setSizes()
    }, 1000)
    
    $(window).resize(function() { setSizes(); });
    function setSizes(){
        $('.categorproducts-inner .catblockwrap figure').css("height", $('.categorproducts-inner .singlecat-product-wrap ul').innerHeight() - 12 ) ;
    }

    $('.sparkle-tab-wrap').each(function () {
        var $this = $(this);
        $this.find('.sparkle-content:first').show();
        $this.find('.sparkle-tab:first').addClass('sparkle-active');
        $this.find('.sparkle-tab').on('click', function () {
            $(this).siblings('.sparkle-tab').removeClass('sparkle-active');
            $(this).addClass('sparkle-active');
            var id = $(this).attr('id');
            id = id.split('-');
            $(this).closest('.sparkle-tab-wrap').find('.sparkle-content').hide();
            $(this).closest('.sparkle-tab-wrap').find('#sparkle-content-' + id[2]).fadeIn();
        });
    });

    /**
     * sidebar cart 
     */
    $('.close-side-widget').on('click', function(e)  {
        e.preventDefault();
        $(this).parents('.cart-widget-side').removeClass('sparkle-cart-opened');
    });

    $( document.body ).on( 'added_to_cart', function(){
        $('.cart-widget-side').addClass('sparkle-cart-opened');
    });

    /** gdpr */
    // var issetPrivacypolicy = Cookies.get('sparklestore_pro_cookies');

    // if (typeof (issetPrivacypolicy) == 'undefined') {
    //     $('.sparklestore-pro-privacy-policy').show();
    // }

    // $('#sparklestore-pro-confirm').on('click', function () {
    //     $('.sparklestore-pro-privacy-policy').fadeOut('fast');
    //     //var inFifteenMinutes = new Date(new Date().getTime() + 15 * 60 * 1000);
    //     Cookies.set('sparklestore_pro_cookies', 'yes', {
    //         expires: 1,
    //         path: '/'
    //     });
    //     return false;
    // })

    /**
     * Single Product Qty Item
    */
    $(document).on("click", ".quantity input.plus", function(){
        var parent = $(this).parent().find('input.qty');
        var max = parent.attr('max');
        var val = parseInt(parent.val() || 0 ) + 1;
        if( max === val - 1) return;
        parent.val(val);
        parent.trigger('change');
    });

    $(document).on("click", ".quantity input.minus", function(){
        var parent = $(this).parent().find('input.qty');
        var min = parent.attr('min');
        var val = parseInt(parent.val() || 0 ) -1 ;
        if( min == val + 1) return;
        parent.val(val);
        parent.trigger('change');
    });

    // setTimeout(function(){
    //     jQuery('.woocommerce-small-thumbnails .slick-list').height(jQuery('.woocommerce-product-thumbnails .slick-track').height() - 20 );
    // }, 2000)
    
    /** sidebar mobile menu */
    $('body').click(function(evt){
        
        //For descendants of menu_content being clicked, remove this check if you do not want to put constraint on descendants.
        if($(evt.target).closest('.cover-modal.active').length)
           return;             
 
       //Do processing of click event here for every element except with id menu_content
       if( $('body').hasClass('showing-menu-modal')){
            var body = document.body;
            
            $('.cover-modal.active').removeClass('active');
            body.classList.remove( 'showing-modal' );
            body.classList.add( 'hiding-modal' );
            body.classList.remove('showing-menu-modal');
            body.classList.remove('show-modal');

            document.documentElement.removeAttribute('style')
            document.body.style.removeProperty( 'padding-top' );


            // Remove the hiding class after a delay, when animations have been run.
            setTimeout( function() {
                body.classList.remove( 'hiding-modal' );
            }, 500 );
       }
       return;
    });

    /** product hover add to cart toltip */
    jQuery('.product-hover-style4 .store_products_items_info.hoverstyletwo').each(function(){
        var a = jQuery(this).find('a.button');
        var val = a.html();
        var html = jQuery('<span></span>').addClass('sparkle-tooltip-label');
        html.html(val);
        a.html(html);
    })

    /**
     * toggle search
     */
    jQuery('.toggle-searchicon').click(function(){
        var ele = jQuery('.header-control.toggle-search');
        if(ele.hasClass('active')) {
            ele.removeClass('active');
            return;
        }
        
        ele.addClass('active');
        setTimeout(function(){
            ele.find('input').focus();
        }, 400)
    })

    /**
     * ajax pagination
     */
    $(document).on('click', '.sp-woo-load-more', function(){
        $(this).addClass('loading');
        $('.woo-pagination-wrapper .nav-next a').trigger('click');
    })


    $(document).on("click",".woo-pagination-wrapper .nav-next a",function(e) {
        e.preventDefault();
        if( $('body').hasClass('ajax-page-running') ) return;

        var url = $(this).attr('href');
        sparkleLoadPage(url, true);
    });

    $('body').addClass('ajax-page-complete');
    $(window).scroll(function(){
        if( $('body').hasClass('ajax-page-complete') && $('body').hasClass('woo-pagination-autoscroll') ){
            try{
                var topOffset = parseInt(jQuery('.woo-pagination-wrapper .nav-next a').offset().top) - 800;
                
                if(  $(window).scrollTop() > topOffset ){
                    // run our call for pagination
                    $('.woo-pagination-wrapper .nav-next a').trigger('click');
                }
            }catch(e){
                // console.log(e);
            }
        }
    }); 

   function sparkleLoadPage(mUrl, append){
        $('body').removeClass('ajax-page-complete');
        $('body').addClass('ajax-page-running');
        jQuery('.woocommerce-pagination-preloader').show();
        

        $.ajax({
            url: mUrl,
            cache: true,
            success: function(data) {
                $('body').addClass('ajax-page-complete');
                $('body').removeClass('ajax-page-running');

                jQuery('.woocommerce-pagination-preloader').hide();

                $('#main .woo-pagination-wrapper').html($(data).find("#main .woo-pagination-wrapper").html());
                $("#main ul.products").append($(data).find("#main ul.products").html());
                
                if( jQuery('.woo-pagination-wrapper .nav-next a').length == 0) {
                    $('.sp-woo-load-more').text("No more page found!!");
                }

                $('.sp-woo-load-more').removeClass('loading');


            }
        });
        
   }


   /** 
    * product desction show / hide 
    */
   $('.sparklestore-more-desc-btn').click(function(e){
       e.preventDefault();
        var parent = $(this).parent('.sparklestore-more-effect');
        if( parent.hasClass('active') ){
            parent.removeClass('active');
        }else{
            parent.addClass('active');
        }
   })
   


});
