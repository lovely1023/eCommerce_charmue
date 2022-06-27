/**
 *
 * Welcome Page Scripts
 *
 */
jQuery(document).ready(function ($) {

    "use strict";
    var isAjaxLoading = false;

    /** Ajax Plugin Installation **/
    $(document).on('click', '.plugin-action-btn .install:not(.installing)', function (e) {
        e.preventDefault();
        if (!isAjaxLoading) {
            isAjaxLoading = true;
            var el = $(this);
            el.addClass('installing');
            el.html(PluginInstallerObject.installing_btn);
            var slug = el.attr('data-slug');
            var source = el.attr('data-source');
            var path = el.attr('data-path');
            var ajaxurl = PluginInstallerObject.ajaxurl;
            if (source) {
                var data = {
                    action: 'plugin_offline_installer',
                    slug: slug,
                    path: path,
                    nonce: PluginInstallerObject.admin_nonce,
                    source: source
                };
            } else {
                var data = {
                    action: 'plugin_installer',
                    slug: slug,
                    path: path,
                    nonce: PluginInstallerObject.admin_nonce
                };
            }

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                success: function (response) {
                    if (response.success) {
                        el.attr('class', 'installed button');
                        el.html(PluginInstallerObject.installed_btn);
                        el.closest('.recommended-plugin').prepend('<div class="item-ribbon active"> <i class="dashicons dashicons-yes"></i></div>');
                    } else {
                        if (response.message) {
                            alert(response.message);
                        }
                    }

                    el.removeClass('installing');
                    isAjaxLoading = false;
                },
                error: function (xhr, status, error) {
                    el.removeClass('installing');
                    el.html(PluginInstallerObject.install_btn);
                    alert(PluginInstallerObject.error_message);
                    isAjaxLoading = false;
                }
            });
        } else {
            alert(PluginInstallerObject.wait_message);
        }
    });
    
    /** Ajax Plugin Activation **/
    $(document).on('click', '.plugin-action-btn .activate', function (e) {
        e.preventDefault();
        if (!isAjaxLoading) {
            isAjaxLoading = true;
            var el = $(this);
            el.addClass('installing');
            el.html(PluginInstallerObject.activating_btn);
            var slug = $(el).attr('data-slug');
            var path = el.attr('data-path');
            var ajaxurl = PluginInstallerObject.ajaxurl;
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'plugin_activation',
                    slug: slug,
                    path: path,
                    nonce: PluginInstallerObject.activate_nonce
                },
                success: function (response) {
                    el.removeClass('installing');
                    if (response.success) {
                        el.attr('class', 'installed button');
                        el.html(PluginInstallerObject.installed_btn);
                        el.closest('.recommended-plugin').prepend('<div class="item-ribbon active"> <i class="dashicons dashicons-yes"></i></div>');
                    } else {
                        if (response.message) {
                            alert(response.message);
                        }
                    }
                    isAjaxLoading = false;
                }
            });
        } else {
            alert(PluginInstallerObject.wait_message);
        }
    });
    
    $(document).on('click', '.installed, .installing', function (e) {
        e.preventDefault();
    });
});