<div class="menu-modal cover-modal header-footer-group" data-modal-target-string=".menu-modal">
    <div class="menu-modal-inner modal-inner">
        <?php

            $icon_or_text = get_theme_mod('menu-icon-close-icon-options', 'icon');
            $icon         = get_theme_mod('menu-close-icon', 'fas fa-times');
            $text         = get_theme_mod('menu-close-text', 'Close');
            $icon_position = get_theme_mod('menu-icon-close-icon-position', 'before');

            $icontexthtml = '<button class="toggle close-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".menu-modal">';
            if( $icon_position == 'before'){
                if( $icon_or_text == 'icon' || $icon_or_text == 'both'){
                    $icontexthtml.= '<i class="'. $icon. '"></i>';
                }
            }

            if( $icon_or_text == 'text' || $icon_or_text == 'both'){
                $icontexthtml.= '<span class="toggle-text">'.esc_html($text).'</span>';
            }

            if( $icon_position == 'after'){
                if( $icon_or_text == 'icon' || $icon_or_text == 'both'){
                    $icontexthtml.= '<i class="'. $icon. '"></i>';
                }
            }
            $icontexthtml .="</button>";
        ?>
        <div class="spwp-close-btn-box">
            <?php echo force_balance_tags($icontexthtml); ?>
        </div>
        <div class="menu-wrapper section-inner">
            <div class="menu-top">
                <?php if(get_theme_mod('sparklewp_header_sidebar_enable_search', true)): ?>
                    <div class="menu-search-form widget_search">
                        <?php get_search_form(); ?>
                    </div>
                <?php endif; ?>

                <div class='sparkle-tab-wrap'>
                    <?php if(get_theme_mod('sparklewp_header_sidebar_enable_tab', true)): ?>
                        <div class="sparkle-tabs">
                            <button class="sparkle-tab" id="sparkle-tab-menu1">
                                <span><?php esc_html_e(get_theme_mod('sparklewp_header_sidebar_tab_1_text', 'Menu')); ?></span>
                            </button>
                            <button class="sparkle-tab" id="sparkle-tab-menu2">
                                <span><?php esc_html_e(get_theme_mod('sparklewp_header_sidebar_tab_2_text', 'Category')) ?></span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="sparkle-tab-content">
                        <div class="sparkle-content" id="sparkle-content-menu1">
                            <?php sparklewp_header_builder()->header_outside(); ?>
                        </div>

                        <?php if(get_theme_mod('sparklewp_header_sidebar_enable_tab', true)): ?>
                            <div class="sparkle-content" id="sparkle-content-menu2">
                                <nav class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'sparklestore-pro' ); ?>" role="navigation">
                                    <ul class="modal-menu">
                                        <?php
                                            if ( has_nav_menu( 'sparklecategory' ) ) {
                                                wp_nav_menu(
                                                    array(
                                                        'container'      => '',
                                                        'items_wrap'     => '%3$s',
                                                        'show_toggles'   => true,
                                                        'theme_location' => 'sparklecategory',
                                                    )
                                                );
                                            }
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!-- .menu-top -->
        </div><!-- .menu-wrapper -->
    </div><!-- .menu-modal-inner -->
</div><!-- .menu-modal -->