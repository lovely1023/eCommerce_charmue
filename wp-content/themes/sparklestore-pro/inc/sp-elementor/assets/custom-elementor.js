jQuery( window ).on( 'elementor/frontend/init', function() {
    //hook name is 'frontend/element_ready/{widget-name}.{skin} - i dont know how skins work yet, so for now presume it will
    //always be 'default', so for example 'frontend/element_ready/slick-slider.default'
    //$scope is a jquery wrapped parent element

    function elementorSliderInit(element, column = false){
        
        if( column == false) column = element.data('column');
        
        element.owlCarousel({
            items:column,
            loop:true,
            margin:20,
            autoplay:true,
            autoplayTimeout:6000,
            autoplayHoverPause:false,
            nav: true,
            navText: ['<i class="icofont-thin-left"></i>','<i class="icofont-thin-right"></i>'],
            dots: false,
            responsive:{
                0:{
                    items:1,
                },
                380:{
                    items:2,
                },
                768:{
                    items:3,
                },
                900:{
                    items: column,
                }
            }
        });
    }

    /**
     * blog section
    */
    elementorFrontend.hooks.addAction( 'frontend/element_ready/sparklestore-blog.default', function($scope, $){
        var ele = $scope.find('.blogslider')
        ele.each(function(){
            var element = $(this);
            elementorSliderInit(element);
            
        })


        /**
         * Masonry Posts Layout
        */
       var grid = $scope.find('.sparklestore-masonry'), masonry;
        
       grid.each(function(){
        var element = $(this);
        if (element && typeof Masonry !== undefined && typeof imagesLoaded !== undefined ) {
            imagesLoaded( element, function( instance ) {
                masonry = new Masonry( element, {
                    itemSelector: '.hentry',
                    gutter: 15
                } );
            } );
        }
       });
       
    });


    /**
     * WooCommerce Category Collection Area 
    */
    elementorFrontend.hooks.addAction( 'frontend/element_ready/sparklestore-category.default', function($scope, $){
        var ele = $scope.find('.categoryslider');
        elementorSliderInit(ele);
    });


    /**
     * WooCommerce Category With Products 
    */
    elementorFrontend.hooks.addAction( 'frontend/element_ready/sparklestore-category-products.default', function($scope, $){
        var ele = $scope.find('.catwithproduct');
        elementorSliderInit(ele);

    });

    elementorFrontend.hooks.addAction( 'frontend/element_ready/sparklestore-woo-prodcuts.default', function($scope, $){
        var ele = $scope.find('.productarea');
        elementorSliderInit(ele);
    });
    elementorFrontend.hooks.addAction( 'frontend/element_ready/sparklestore-woo-single-hot-offer.default', function($scope, $){
        var ele = $scope.find('.storeslider');
        elementorSliderInit(ele);
    });
    elementorFrontend.hooks.addAction( 'frontend/element_ready/sparklestore-woo-hot-offer.default', function($scope, $){
        var ele = $scope.find('.storeslider');
        elementorSliderInit(ele);
    });
    
    elementorFrontend.hooks.addAction( 'frontend/element_ready/sparklestore-woo-product-list.default', function($scope, $){
        var ele = $scope.find('.storeslider');
        elementorSliderInit(ele);
    });
    
    elementorFrontend.hooks.addAction( 'frontend/element_ready/sparklestore-woo-product-type.default', function($scope, $){
        var ele = $scope.find('.storeslider');
        elementorSliderInit(ele);
    });

    elementorFrontend.hooks.addAction( 'frontend/element_ready/sparklestore-pro-fullpromo.default', function($scope, $){
        /** video player */
        $scope.find(".sp-section[data-property]").YTPlayer({
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
    });


    


    
    /**
     * woo category tabs
     */
    elementorFrontend.hooks.addAction( 'frontend/element_ready/sparklestore-woo-tab-products.default', function($scope, $){
        var ele = $scope.find('.sparkletabs');
        sparklestore_pro_ajax_cat_tabs($scope);


        /**
         * Sparkle Tabs Category Product
        */
        ele.find('.sparkletablinks').each(function(){
            $(this).find('li').first('li').addClass('active');
        })

        ele.find('.sparkletablinks a').on('click', function(e)  {
            e.preventDefault();
            var that = $(this);
            console.log('abcd');
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
                        sparklestore_pro_ajax_cat_tabs($scope);
                        preloader.hide();

                    }
            });
        });


        function sparklestore_pro_ajax_cat_tabs($scope){
            
            $scope.find('.storeslider').trigger("destroy.owl.carousel")
            elementorSliderInit($scope.find('.storeslider'));
        
        }
        
    });

 } );