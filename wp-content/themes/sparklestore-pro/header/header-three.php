<header id="masthead" class="site-header headerthree" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">		
	<div class="header-container">
        <?php
            sparklestore_pro_top_header_top_notice_bar();
        ?>
        <div class="header-middle clearfix">
			<div class="container">

                <?php
					/**
					 * Responsive Header
					*/
					get_template_part('header/header', 'responsive');
				?>

				<?php $hide_mobile = get_theme_mod('sparklestore_pro_header_hide_search_on_mobile', 0); ?>
				<div class="header-middle-inner header-middle-inner-desktop hide-mobile-<?php echo intval($hide_mobile); ?>">
					
					<div class="sparklelogo sparkle-column">
						<?php do_action( 'sparklestore_pro_get_logo' ); ?>
					</div>

                    <div class="box-header-nav main-menu-wapper sparkle-column">
                        <div class="main-menu">
                            <div class="main-menu-links">
                                <?php
                                    wp_nav_menu( array(
                                            'theme_location'  => 'sparkleprimary',
                                            'menu'            => 'primary-menu',
                                            'container'       => '',
                                            'container_class' => '',
                                            'container_id'    => '',
                                            'menu_class'      => 'main-menu',
                                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                            'walker' => new SparkleTheme_Custom_Nav_Walker()
                                        )
                                    );
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php do_action('sparklestore_pro_header_icons'); ?>

                </div>
                
			</div>
		</div>
    </div>
</header>