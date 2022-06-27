<?php

function elementor_widget_list() {
    $avaliable_widgets = array();
    foreach (glob(get_template_directory() . '/inc/elementor/includes/addons/*.php') as $file) {
        $data = get_file_data($file, array('class' => 'Class', 'name' => 'Name', 'slug' => 'Slug'));

        $slug = basename($file, '.php');
        $avaliable_widgets[$slug] = $data['name'];
    }
    return $avaliable_widgets;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */
function optionsframework_options() {

    $widget_list = sparklestore_pro_widget_list();
    $elementor_widget_list = elementor_widget_list();
    $std_widget_list = $std_elementor_widget_list = array();

    foreach ($widget_list as $key => $widget) {
        $std_widget_list[$key] = '1';
    }

    foreach ($elementor_widget_list as $key => $widget) {
        $std_elementor_widget_list[$key] = '1';
    }

    $options = array();

    $options[] = array(
        'name' => __('Customizer Settings', 'sparklestore-pro'),
        'type' => 'heading');

    $options[] = array(
        'name' => __('Choose Icon Sets', 'sparklestore-pro'),
        'desc' => sprintf(__('These icon set will appear in the %s. Choose the set of icons that you want to use. Choosing all the icon set may slow down the customizer panel.', 'sparklestore-pro'), '<a target="_blank" href="' . admin_url('customize.php?autofocus[panel]=sparklestore_pro_home_panel') . '">' . esc_html__('Home Page Sections', 'sparklestore-pro') . '</a>'),
        'id' => 'customizer_icon_sets',
        'std' => array(
            'ico_font' => '1',
            'font_awesome' => '1'
        ),
        'type' => 'multicheck',
        'options' => array(
            'ico_font' => sprintf( 'Icon Font - %1$s', '<a href=" ' . esc_url('https://icofont.com/icons') . ' " rel="designer" target="_blank">'.esc_html__('View Here','sparklestore-pro').'</a>' ),
            'font_awesome' => sprintf( 'Font Awesome - %1$s', '<a href=" ' . esc_url('https://fontawesome.com/icons?m=free') . ' " rel="designer" target="_blank">'.esc_html__('View Here','sparklestore-pro').'</a>' ),
        )
    );

    $options[] = array(
        'type' => 'break'
    );

    $options[] = array(
        'name' => __('Maintenance Mode Panel', 'sparklestore-pro'),
        'label' => __('Enable/Disable', 'sparklestore-pro'),
        'desc' => sprintf(__('If you are not using %s then disabling can increase the loading speed of customizer panel.', 'sparklestore-pro'), '<a target="_blank" href="' . admin_url('customize.php?autofocus[section]=sparklestore_pro_maintenance_section') . '">' . esc_html__('Maintenance Screen', 'sparklestore-pro') . '</a>'),
        'id' => 'customizer_maintenance_mode',
        'std' => '1',
        'type' => 'checkbox'
    );

    $options[] = array(
        'type' => 'break'
    );

    $options[] = array(
        'name' => __('GDPR Settings Panel', 'sparklestore-pro'),
        'label' => __('Enable/Disable', 'sparklestore-pro'),
        'desc' => sprintf(__('If you are not using %s then disabling can increase the loading speed of customizer panel.', 'sparklestore-pro'), '<a target="_blank" href="' . admin_url('customize.php?autofocus[section]=sparklestore_pro_gdpr_section') . '">' . esc_html__('GDPR Option', 'sparklestore-pro') . '</a>'),
        'id' => 'customizer_gdpr_settings',
        'std' => '1',
        'type' => 'checkbox'
    );

    $options[] = array(
        'type' => 'break'
    );

    $options[] = array(
        'name' => __('Widget Settings', 'sparklestore-pro'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('Widgets', 'sparklestore-pro'),
        'desc' => sprintf(__('Enable/Disable the Widgets. This widgets will show in %1$s and SiteOrigin Page Builder if you have installed and activated %2$s', 'sparklestore-pro'), '<a target="_blank" href="' . admin_url('/widgets.php') . '">' . esc_html__('Widget Page', 'sparklestore-pro') . '</a>', '<a target="_blank" href="https://wordpress.org/plugins/siteorigin-panels/">' . esc_html__('SiteOrigin Page Builder', 'sparklestore-pro') . '</a>'),
        'id' => 'enabled_widgets',
        'std' => $std_widget_list,
        'type' => 'multicheck',
        'class' => 'three-col-multicheck',
        'options' => $widget_list
    );

    $options[] = array(
        'name' => __('Elementor Widget Settings', 'sparklestore-pro'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('Available Elementor Widgets', 'sparklestore-pro'),
        'desc' => __('List of widgets that will be available when editing the page with Elementor.', 'sparklestore-pro'),
        'id' => 'avaliable_widgets',
        'std' => $std_elementor_widget_list,
        'type' => 'multicheck',
        'class' => 'three-col-multicheck',
        'options' => elementor_widget_list()
    );

    $options[] = array(
        'type' => 'break'
    );

    $options[] = array(
        'name' => __('NOTE', 'sparklestore-pro'),
        'desc' => sprintf(__('These settings will work only if you have installed and activated the %1$s Plugin. You can install Elementor Plugin %2$s.', 'sparklestore-pro'), '<a target="_blank" href="https://wordpress.org/plugins/elementor/">Elementor</a>', '<a href="' . admin_url('/admin.php?page=sparklestore-pro-install-plugins') . '">' . esc_html__('here', 'sparklestore-pro') . '</a>'),
        'type' => 'info',
        'class' => 'boxed-note'
    );

    // $options[] = array(
    //     'name' => __('API Keys', 'sparklestore-pro'),
    //     'type' => 'heading'
    // );

    // $options[] = array(
    //     'name' => __('Google Map API Key', 'sparklestore-pro'),
    //     'desc' => sprintf(__('Create own API key. %s', 'sparklestore-pro'), '<a target="_blank" href="https://sparklewpthemes.com/articles/creating-a-google-maps-api-key/">' . esc_html__('Guide on creating Google Maps API Key', 'sparklestore-pro') . '</a>'),
    //     'id' => 'api_key',
    //     'type' => 'text'
    // );

    // $options[] = array(
    //     'type' => 'break'
    // );

    // $options[] = array(
    //     'name' => __('Instagram Access Token:', 'sparklestore-pro'),
    //     'desc' => sprintf(__('Read more about how to get Instagram Access Token %1$s or %2$s', 'sparklestore-pro'), '<a target="_blank" href="https://elfsight.com/blog/2016/05/how-to-get-instagram-access-token/">' . esc_html__('here', 'sparklestore-pro') . '</a>', '<a target="_blank" href="https://docs.oceanwp.org/article/487-how-to-get-instagram-access-token">' . esc_html__('here', 'sparklestore-pro') . '</a>'),
    //     'id' => 'insta_access_token',
    //     'type' => 'text'
    // );

    return $options;
}
