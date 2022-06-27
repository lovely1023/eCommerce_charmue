<?php

/**
 * Template content
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

echo '<div class="menu-template">';
// Get ID
$get_id = $item->megamenu_template;
// Check if page is Elementor page
$elementor = get_post_meta($get_id, '_elementor_edit_mode', true);
$siteorigin = get_post_meta($get_id, 'panels_data', true);

// If Elementor
if (SPARKLE_THEMES_ELEMENTOR_ACTIVE && $elementor) {
    echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display($get_id);
}

// If Beaver Builder
else if (SPARKLE_THEMES_BEAVER_BUILDER_ACTIVE && !empty($get_id)) {
    echo do_shortcode('[fl_builder_insert_layout id="' . $get_id . '"]');
}

// If Site Origin
else if (SPARKLE_THEMES_SITEORIGIN_ACTIVE && !empty($get_id) && $siteorigin) {
    echo SiteOrigin_Panels::renderer()->render($get_id);
}else {
    // Get template content
    if (!empty($get_id)) {

        $template_id = get_post($get_id);

        if ($template_id && !is_wp_error($template_id)) {
            $content = $template_id->post_content;
        }
    }
    // Display template content
    echo apply_filters('the_content', $content);
}

echo '</div>';