
<div class="sparkle-welcome-sidebar">

    <div class="sparkle-support-box">
        <h5><span class="dashicons dashicons-download"></span><?php echo esc_html('One Click Demo Import', 'sparklestore-pro'); ?></h5>
        <div class="sparkle-support-content">
            <p><?php echo esc_html('Sparkle Themes allows you to easily create unique looking sites with just one click. Click on the button below to go to the demo importer page and import the desired demo.', 'sparklestore-pro'); ?></p>
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/PJMDFKG52C4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <a class="button button-primary" href="<?php echo admin_url('/admin.php?page=sparkle-theme-demo-importer'); ?>"><?php echo esc_html('Import Demo', 'sparklestore-pro') ?></a>
        </div>
    </div>

    <div class="sparkle-support-box">
        <h5><span class="dashicons dashicons-welcome-write-blog"></span><?php echo esc_html('Documentation', 'sparklestore-pro'); ?></h5>
        <div class="sparkle-support-content">
            <p><?php printf( __( 'Please check our full documentation for detailed information on how to use the theme. You need to be <a target="_blank" href="%1$s">logged in</a> to our website with your purchase account to access the documentation.', 'sparklestore-pro' ), esc_url( 'https://sparklewpthemes.com/login/' ) ); ?></p>
            <a class="button button-primary" href="http://docs.sparklewpthemes.com/sparklestorepro/" target="_blank"><?php echo esc_html('View Documentation', 'sparklestore-pro') ?></a>
        </div>
    </div>

    <div class="sparkle-support-box">
        <h5><span class="dashicons dashicons-book"></span><?php echo esc_html('Knowledge Base (Articles)', 'sparklestore-pro'); ?></h5>
        <div class="sparkle-support-content">
            <p><?php echo esc_html('You can find additional information that are not in the documentation. It can be from general topics to specific aspects of the WordPress and themes.', 'sparklestore-pro'); ?></p>
            <a class="button button-primary" href="<?php echo esc_url('https://www.sparklewpthemes.com/blogs/'); ?>" target="_blank"><?php echo esc_html('View Articles', 'sparklestore-pro') ?></a>
        </div>
    </div>

    <div class="sparkle-support-box">
        <h5><span class="dashicons dashicons-sos"></span><?php echo esc_html('Support Forums', 'sparklestore-pro'); ?></h5>
        <div class="sparkle-support-content">
            <p><?php printf( __( 'Through the forums we offer top notch support. Before asking a questions it\'s highly recommended to search on forums, but if you can\'t find the solution feel free to create a new topic. You need to be <a target="_blank" href="%1$s">logged in</a> to our website with your purchase account to access the support page.', 'sparklestore-pro' ), esc_url( 'https://sparklewpthemes.com/login/' ) ); ?></p>    
            <a class="button button-primary" href="https://www.sparklewpthemes.com/contact-us/" target="_blank"><?php echo esc_html('Visit Support Forum', 'sparklestore-pro') ?></a>
        </div>
    </div>

</div>