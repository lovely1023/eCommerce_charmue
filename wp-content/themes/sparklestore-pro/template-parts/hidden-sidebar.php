<div class="menu-modal sidebar-modal cover-modal header-footer-group" data-modal-target-string=".sidebar-modal" data-modal-target-show="relative">
    <div class="menu-modal-inner modal-inner">
        <div class="menu-wrapper section-inner">
            <div class="menu-top">

                <span class="toggle close-nav-toggle" data-toggle-target=".sidebar-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".sidebar-modal">
                    <span class="toggle-text"><?php esc_html_e( 'Close Menu', 'sparklethemes' ); ?></span>
                    <i class="fas fa-times"></i>
                </span><!-- .nav-toggle -->

                <div class='sparkle-tab-wrap'>
                    <div class="tab-content">
                        <?php get_sidebar('rightsidebar'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>