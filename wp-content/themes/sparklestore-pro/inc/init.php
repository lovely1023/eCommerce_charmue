<?php
/**
 * Main Custom admin functions area
 *
 * @since Sparkle Themes
 *
 * @param SparkleStore Pro
 *
 */
 
/**
 * load multiple fonts icons
 */
require get_theme_file_path('inc/font-icons.php');
require get_theme_file_path('inc/aricolor.php');

/**
 * Theme Settings
 */
require get_template_directory() . '/inc/sparklethemes/welcome.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Customizer Custom Controller.
 */
require get_template_directory() . '/inc/customizer/custom-controller.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Customizer Sanitization.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

/**
 * Customizer Active Call Back .
 */
require get_template_directory() . '/inc/customizer/callback.php';

/**
 * Elementor Elements
 */
if (defined('ELEMENTOR_VERSION')) {
    require get_template_directory() . '/inc/elementor/jet-elements.php';
    require get_template_directory() . '/inc/sp-elementor/init.php';
}

/**
 * MetaBox
 */
if (!class_exists('RWMB_Loader')) {
    require get_template_directory() . '/inc/assets/meta-box/meta-box.php';
}
if (!class_exists('MB_Columns_Row')) {
    require get_template_directory() . '/inc/assets/meta-box-columns/meta-box-columns.php';
}
if (!class_exists('MB_Tabs')) {
    require get_template_directory() . '/inc/assets/meta-box-tabs/meta-box-tabs.php';
}
if (!class_exists('MB_Conditional_Logic')) {
    require get_template_directory() . '/inc/assets/meta-box-conditional-logic/meta-box-conditional-logic.php';
}
if (!class_exists('RWMB_Group')) {
    require get_template_directory() . '/inc/assets/meta-box-group/meta-box-group.php';
}

/**
 * MetaBox additions.
 */
require get_template_directory() . '/inc/sparkle-metabox.php';

/** mobile menu */
require get_template_directory() . '/inc/mobile-menu/init.php';


/**
 * Menu Walker
 */
require get_template_directory().'/inc/walker/init.php';
require get_template_directory().'/inc/walker/menu-walker.php';

/**
 * Menu Icons
 */
if (!class_exists('Menu_Icons')) {
    require get_template_directory() . '/inc/walker/menu-icons/menu-icons.php';
}


/*opitons*/
require get_template_directory() .'/inc/options.php';

/**
 * custom controllers
 */
require get_template_directory() .'/inc/custom-controller/init.php';
/*Customizer Builder*/
require get_template_directory() .'/inc/library/customizer-builder/class-customizer-builder.php';

/*Header Builder*/
require get_template_directory() .'/inc/customizer/header-options/header-builder.php';
