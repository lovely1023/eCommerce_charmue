<?php
/*
 * Credit: NiceThemes<http://nicethemes.com/>
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Obtain the system status handler.
 */
$system_status = sparklestore_pro_admin_system_status();
?>

<div class="wrap system-status-wrap">

    <h1><?php _e('System Status', 'sparklestore-pro'); ?></h1>
    <div class="notice-warning notice sparklestore-pro-system-status-notice"><p><?php _e('This page shows the full system status report of your WordPress and Server. Please make sure that there is no <span style="color:#F00">red text</span> inorder for the theme and demo import to work properly.', 'sparklestore-pro'); ?></p></div>

    <div class="sparklestore-pro-system-status-report">
        <p>
            <?php esc_html_e('Click the button to generate and download a full report. Attach the file when ever you contact us for support.', 'sparklestore-pro'); ?>
        </p>
        <form method="post" action="">
            <?php wp_nonce_field('sparklestore-pro-system-status-report-download'); ?>
            <input type="hidden" name="sparklestore-pro-system-status-report-download" value="1" />
            <input type="submit" class="button-primary" value="<?php esc_attr_e('Get System Status Report', 'sparklestore-pro'); ?>" />
        </form>
    </div>


    <div class="sparklestore-pro-system-status">

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('WordPress', 'sparklestore-pro'); ?></th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td class="title"><?php esc_html_e('Home URL:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__("The URL of the site's homepage.", 'sparklestore-pro'); ?></span></td>
                    <td class="description"><?php echo esc_url($system_status->get_home_url()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Site URL:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The root URL of the site.', 'sparklestore-pro'); ?></span></td>
                    <td class="description"><?php echo esc_url($system_status->get_site_url()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Version:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i></a><span><?php echo esc_html__('The version of WordPress installed on the site.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_wp_version() < $system_status->get_required_wp_version() ) ? 'wrong' : 'right'; ?>">
                        <?php echo esc_html($system_status->get_wp_version()); ?>
                        <?php if ($system_status->get_wp_version() < $system_status->get_recommended_wp_version()) : ?>
                            <br /><?php printf(esc_html__('Recommended version: %s or higher.', 'sparklestore-pro'), esc_attr($system_status->get_recommended_wp_version())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Multisite:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('Whether or not is WordPress Multisite enabled.', 'sparklestore-pro'); ?></span></td>
                    <td class="description"><span class="choice"><?php echo $system_status->is_wp_multisite() ? '&#x2713;' : '&#x2717;'; ?></span></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Memory Limit:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The maximum amount of memory (RAM) that the site can use at one time.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_wp_memory_limit() < $system_status->get_recommended_wp_memory_limit() ) ? 'wrong' : 'right'; ?>">
                        <?php echo esc_html($system_status->get_formatted_wp_memory_limit()); ?>
                        <?php if ($system_status->get_wp_memory_limit() < $system_status->get_recommended_wp_memory_limit()) : ?>
                            <br /><?php printf(esc_html__('Recommended value: %s.', 'sparklestore-pro'), esc_attr($system_status->get_formatted_recommended_wp_memory_limit())); ?> <a href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank"><?php esc_html_e('Please increase it', 'sparklestore-pro'); ?></a>.
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Maximum Upload File Size:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The largest file size that can be uploaded to this WordPress installation.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_wp_max_upload_size() < $system_status->get_recommended_wp_max_upload_size() ) ? 'wrong' : 'right'; ?>">
                        <?php echo esc_html($system_status->get_formatted_wp_max_upload_size()); ?>
                        <?php if ($system_status->get_wp_max_upload_size() < $system_status->get_recommended_wp_max_upload_size()) : ?>
                            <br /><?php printf(esc_html__('Recommended value: %s.', 'sparklestore-pro'), esc_attr($system_status->get_formatted_recommended_wp_max_upload_size())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Allowed File Extensions:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The file extensions the current user can upload to this WordPress installation.', 'sparklestore-pro'); ?></span></td>
                    <td class="description"><?php echo esc_html(implode(', ', $system_status->get_wp_file_extensions())); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Language:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The language currently used by WordPress.', 'sparklestore-pro'); ?></span></td>
                    <td class="description"><?php echo esc_html($system_status->get_wp_locale()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Upload Directory:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('Whether or not your upload directory is writable.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo ( $system_status->is_wp_uploads_dir_writable() ? 'right' : 'wrong' ); ?>"><?php echo $system_status->is_wp_uploads_dir_writable() ? esc_html__('Writable', 'sparklestore-pro') : esc_html__('Not writable', 'sparklestore-pro'); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Debug Mode:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('Whether or not is WordPress in debug mode.', 'sparklestore-pro'); ?></span></td>
                    <td class="description"><span class="choice"><?php echo $system_status->is_wp_debug_mode() ? '&#x2713;' : '&#x2717;'; ?></span></td>
                </tr>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('Server', 'sparklestore-pro'); ?></th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td class="title"><?php esc_html_e('Server Information:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('Information about the web server that is currently hosting the site.', 'sparklestore-pro'); ?></span></td>
                    <td class="description"><?php echo esc_html($system_status->get_server_info()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Server Timezone:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The default timezone for the server. It should be UTC.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo (!$system_status->is_server_timezone_utc() ) ? 'wrong' : 'right'; ?>">
                        <?php echo esc_html($system_status->get_server_timezone()); ?>
                        <?php if (!$system_status->is_server_timezone_utc()) : ?>
                            <br /><?php esc_html_e('The default timezone should be UTC.', 'sparklestore-pro'); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Remote GET method:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('Whether or not can the GET method be used to communicate with different APIs.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo (!$system_status->is_wp_remote_get() ) ? 'wrong' : 'right'; ?>">
                        <span class="choice"><?php echo $system_status->is_wp_remote_get() ? '&#x2713;' : '&#x2717;'; ?></span>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Remote POST method:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('Whether or not can the POST method be used to communicate with different APIs.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo (!$system_status->is_wp_remote_post() ) ? 'wrong' : 'right'; ?>">
                        <span class="choice"><?php echo $system_status->is_wp_remote_post() ? '&#x2713;' : '&#x2717;'; ?></span>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('mod_security:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('Whether the mod_security extension is enabled. This extension may cause issues with file uploads.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo ( !$system_status->xdebug_enabled() ) ? 'wrong' : 'right'; ?>">
                        <?php if ($system_status->xdebug_enabled()) : ?>
                            <?php esc_html_e('Enabled', 'sparklestore-pro'); ?>
                        <?php else : ?>
                            <?php esc_html_e('Disabled', 'sparklestore-pro'); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('ZipArchive:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('Whether the ZipArchive extension is enabled. This extension may cause issues with plugins uploads.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo ( !$system_status->server_unzip_enable() ) ? 'wrong' : 'right'; ?>">
                        <?php if ($system_status->server_unzip_enable()) : ?>
                            <?php esc_html_e('Enabled', 'sparklestore-pro'); ?>
                        <?php else : ?>
                            <?php esc_html_e('Disabled', 'sparklestore-pro'); ?>
                        <?php endif; ?>
                    </td>
                </tr>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('PHP', 'sparklestore-pro'); ?></th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td class="title"><?php esc_html_e('Version:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The version of PHP installed on your server.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo $system_status->php_version_ok() ? 'right' : 'wrong'; ?>">
                        <?php if ($system_status->get_php_version()) : ?>
                            <?php echo esc_html($system_status->get_php_version()); ?>
                        <?php else : ?>
                            <?php printf(esc_html__("%s isn't available.", 'sparklestore-pro'), '<code>phpversion()</code>'); ?>
                        <?php endif; ?>
                        <?php if (!$system_status->php_version_ok()) : ?>
                            <br />
                            <?php printf(esc_html__('Recommended version: %s or higher.', 'sparklestore-pro'), esc_html($system_status->get_recommended_php_version())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Maximum Input Variables:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The maximum number of variables the server can use for a single function to avoid overloads.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_php_max_input_vars() < $system_status->get_recommended_php_max_input_vars() ) ? 'wrong' : 'right'; ?>">
                        <?php if (!is_null($system_status->get_php_max_input_vars())) : ?>
                            <?php echo esc_html($system_status->get_php_max_input_vars()); ?>
                        <?php else : ?>
                            <?php printf(esc_html__("%s isn't available.", 'sparklestore-pro'), '<code>ini_get()</code>'); ?>
                        <?php endif; ?>
                        <?php if ($system_status->get_php_max_input_vars() < $system_status->get_recommended_php_max_input_vars()) : ?>
                            <br /><?php printf(esc_html__('Recommended value: %s.', 'sparklestore-pro'), esc_html($system_status->get_recommended_php_max_input_vars())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('POST Maximum Size:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The largest file size that can be contained in one POST request.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_php_post_max_size() < $system_status->get_recommended_php_post_max_size() ) ? 'wrong' : 'right'; ?>">
                        <?php if (!is_null($system_status->get_php_post_max_size())) : ?>
                            <?php echo esc_html($system_status->get_formatted_php_post_max_size()); ?>
                        <?php else : ?>
                            <?php printf(esc_html__("%s isn't available.", 'sparklestore-pro'), '<code>ini_get()</code>'); ?>
                        <?php endif; ?>
                        <?php if ($system_status->get_php_post_max_size() < $system_status->get_recommended_php_post_max_size()) : ?>
                            <br /><?php printf(esc_html__('Recommended value: %s.', 'sparklestore-pro'), esc_html($system_status->get_formatted_recommended_php_post_max_size())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Time Limit:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The amount of time (in seconds) that the site will spend on a single operation before timing out (to avoid server lockups).', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_php_time_limit() < $system_status->get_recommended_php_time_limit() ) ? 'wrong' : 'right'; ?>">
                        <?php if (!is_null($system_status->get_php_time_limit())) : ?>
                            <?php echo esc_html($system_status->get_php_time_limit()); ?>
                        <?php else : ?>
                            <?php printf(esc_html__("%s isn't available.", 'sparklestore-pro'), '<code>ini_get()</code>'); ?>
                        <?php endif; ?>
                        <?php if ($system_status->get_php_time_limit() < $system_status->get_recommended_php_time_limit()) : ?>
                            <br /><?php printf(esc_html__('Recommended value: %s.', 'sparklestore-pro'), esc_html($system_status->get_recommended_php_time_limit())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Xdebug:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('Whether the Xdebug extension is enabled. This value should always be disabled in live sites.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo ( $system_status->xdebug_enabled() ) ? 'wrong' : 'right'; ?>">
                        <?php if ($system_status->xdebug_enabled()) : ?>
                            <?php esc_html_e('Xdebug is enabled. Please disable it if this is a live site.', 'sparklestore-pro'); ?>
                        <?php else : ?>
                            <?php esc_html_e('Disabled', 'sparklestore-pro'); ?>
                        <?php endif; ?>
                    </td>
                </tr>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('MySQL', 'sparklestore-pro'); ?></th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td class="title"><?php esc_html_e('Version:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The version of MySQL installed on your server.', 'sparklestore-pro'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_mysql_version() < $system_status->get_required_mysql_version() ) ? 'wrong' : 'right'; ?>">
                        <?php echo esc_html($system_status->get_mysql_version()); ?>
                        <?php if ($system_status->get_mysql_version() < $system_status->get_recommended_mysql_version()) : ?>
                            <br /><?php printf(esc_html__('Recommended version: %s or higher.', 'sparklestore-pro'), esc_html($system_status->get_recommended_mysql_version())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('Active Theme', 'sparklestore-pro'); ?></th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td class="title"><?php esc_html_e('Name:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The name of the currently active theme.', 'sparklestore-pro'); ?></span></td>
                    <td class="description"><?php echo esc_html($system_status->get_theme_name()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Version:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The installed version of the currently active theme.', 'sparklestore-pro'); ?></span></td>
                    <td class="description"><?php echo esc_html($system_status->get_theme_version()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e("Author's URL:", 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__("The currently active theme developer's URL.", 'sparklestore-pro'); ?></span></td>
                    <td class="description"><?php echo esc_html($system_status->get_theme_author_url()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Child Theme:', 'sparklestore-pro'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('Whether or not is the currently active theme a child theme.', 'sparklestore-pro'); ?></span></td>
                    <td class="description">
                        <span class="choice"><?php echo $system_status->is_child_theme() ? '&#x2713;' : '&#x2717;'; ?></span>
                        <?php if (!$system_status->is_child_theme()) : ?>
                            <br /><?php printf(esc_html__("If you're modifying %s, we recommend using a child theme.", 'sparklestore-pro'), esc_attr($system_status->get_sparklestore_pro_name())); ?> <a href="http://codex.wordpress.org/Child_Themes" target="_blank"><?php esc_html_e('Learn about them', 'sparklestore-pro'); ?></a>.
                        <?php endif; ?>
                    </td>
                </tr>

                <?php if ($system_status->is_child_theme()) : ?>

                    <tr>
                        <td class="title"><?php esc_html_e('Parent Theme Name:', 'sparklestore-pro'); ?></td>
                        <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The name of the parent theme.', 'sparklestore-pro'); ?></span></td>
                        <td class="description"><?php echo esc_html($system_status->get_parent_theme_name()); ?></td>
                    </tr>

                    <tr>
                        <td class="title"><?php esc_html_e('Parent Theme Version:', 'sparklestore-pro'); ?></td>
                        <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__('The installed version of the parent theme.', 'sparklestore-pro'); ?></span></td>
                        <td class="description"><?php echo esc_html($system_status->get_parent_theme_version()); ?></td>
                    </tr>

                    <tr>
                        <td class="title"><?php esc_html_e("Parent Theme Author's URL:", 'sparklestore-pro'); ?></td>
                        <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html__("The parent theme developer's URL.", 'sparklestore-pro'); ?></span></td>
                        <td class="description"><?php echo esc_html($system_status->get_parent_theme_author_url()); ?></td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('Active Plugins', 'sparklestore-pro'); ?></th>
                </tr>
            </thead>

            <tbody>

                <?php $active_plugins = $system_status->get_active_plugins(); ?>
                <?php if (!empty($active_plugins)) : ?>

                    <?php foreach ($active_plugins as $plugin) : ?>

                        <?php
                        $plugin_info = array();
                        if ($plugin['required']) {
                            $plugin_info[] = esc_html__('Required', 'sparklestore-pro');
                        } elseif ($plugin['recommended']) {
                            $plugin_info[] = esc_html__('Recommended', 'sparklestore-pro');
                        }

                        if ($plugin['must_use']) {
                            $plugin_info[] = esc_html__('Must Use', 'sparklestore-pro');
                        } elseif ($plugin['network_active']) {
                            $plugin_info[] = esc_html__('Network', 'sparklestore-pro');
                        }
                        ?>

                        <tr>
                            <td class="title">
                                <?php if ($plugin['url']) : ?>
                                    <a href="<?php echo esc_url($plugin['url']); ?>" target="_blank">
                                    <?php endif; ?>
                                    <?php echo esc_html($plugin['name']); ?>
                                    <?php if ($plugin['url']) : ?>
                                    </a>
                                <?php endif; ?>
                                <?php echo esc_html($plugin['version']); ?>
                                <?php if ($plugin['new_version']) : ?>
                                    <br />
                                    <em><?php printf(esc_html__('Update Available: %s', 'sparklestore-pro'), esc_attr($plugin['new_version'])); ?></em>
                                <?php endif; ?>
                                <?php if (!empty($plugin_info)) : ?>
                                    <br />
                                    (<?php echo esc_html(implode(', ', $plugin_info)); ?>)
                                <?php endif; ?>
                            </td>
                            <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html($plugin['description']); ?></span></td>
                            <td class="description">
                                <?php if ($plugin['author_url']) : ?>
                                    <a href="<?php echo esc_url($plugin['author_url']); ?>" target="_blank">
                                    <?php endif; ?>
                                    <?php echo esc_html($plugin['author_name']); ?>
                                    <?php if ($plugin['author_url']) : ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <tr>
                        <td colspan="3"><?php esc_html_e('Currently, no plugins are active.', 'sparklestore-pro'); ?></td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3">
                        <?php esc_html_e('Required &amp; Recommended Plugins', 'sparklestore-pro'); ?><br />
                        <em><?php esc_html__('which you should install, activate and keep updated', 'sparklestore-pro'); ?></em>
                    </th>
                </tr>
            </thead>

            <tbody>

                <?php ob_start(); ?>

                <?php $required_plugins = $system_status->get_required_plugins();
                ?>

                <?php if (!empty($required_plugins)) : ?>

                    <?php foreach ($required_plugins as $plugin_data) : ?>

                        <?php
                        $plugin = Sparklestore_Pro_Pro_TGM_Plugin::obtain($plugin_data['slug']);

                        if (!( $plugin instanceof Sparklestore_Pro_Pro_TGM_Plugin )) {
                            continue;
                        }

                        $plugin_info = array();

                        if (!$plugin->is_installed()) {
                            $plugin_info[] = __('Not Installed', 'sparklestore-pro');
                        } else {
                            if ($plugin->is_inactive()) {
                                $plugin_info[] = __('Inactive', 'sparklestore-pro');
                            }

                            if (version_compare($plugin->get_version(), $plugin->get_theme_required_version(), '<')) {
                                $plugin_info[] = __('Needs Update', 'sparklestore-pro');
                            }
                        }

                        if (empty($plugin_info)) {
                            continue;
                        }

                        if ($plugin->is_required()) {
                            array_unshift($plugin_info, esc_html__('Required', 'sparklestore-pro'));
                        }
                        ?>

                        <tr>
                            <td class="title">
                                <?php if ($plugin->get_url()) : ?>
                                    <a href="<?php echo esc_url($plugin->get_url()); ?>" target="_blank">
                                    <?php endif; ?>
                                    <?php echo esc_html($plugin->get_name()); ?>
                                    <?php if ($plugin->get_url()) : ?>
                                    </a>
                                <?php endif; ?>
                                <?php if ($plugin->get_theme_required_version()) : ?>
                                    <?php echo esc_html($plugin->get_theme_required_version()); ?>
                                <?php endif; ?>
                                <?php if ($plugin->has_update()) : ?>
                                    <br />
                                    <em><?php printf(esc_html__('Update Available: %s', 'sparklestore-pro'), esc_attr($plugin->get_new_version())); ?></em>
                                <?php endif; ?>
                                <?php if (!empty($plugin_info)) : ?>
                                    <br />
                                    <span class="wrong">(<?php echo implode(', ', $plugin_info); ?>)</span>
                                <?php endif; ?>
                            </td>
                            <td class="help">
                                <?php if ($plugin->get_description()) : ?>
                                    <i class="dashicons dashicons-editor-help"></i><span><?php echo esc_html($plugin->get_description()); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="description">
                                <?php if ($plugin->get_author_name()) : ?>
                                    <?php if ($plugin->get_author_url()) : ?>
                                        <a href="<?php echo esc_url($plugin->get_author_url()); ?>" target="_blank">
                                        <?php endif; ?>
                                        <?php echo esc_html($plugin->get_author_name()); ?>
                                        <?php if ($plugin->get_author_url()) : ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                <?php
                $required_plugins_output = trim(ob_get_contents());
                ob_end_clean();
                ?>

                <?php if (!empty($required_plugins_output)) : ?>
                    <?php echo $required_plugins_output; // WPCS: XSS Ok. ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3"><?php esc_html_e('Currently, no required or recommended plugins are missing, inactive or outdated.', 'sparklestore-pro'); ?></td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>

    </div>
</div>
