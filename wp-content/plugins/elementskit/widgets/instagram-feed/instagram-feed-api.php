<?php

namespace ElementsKit\Widgets\Instagram_Feed;

use ElementsKit_Lite\Core\Handler_Api;
use Elementor\ElementsKit_Widget_Instagram_Feed_Handler;
use ElementsKit\Libs\Framework\Attr;
use Wpmet\Instagram;

defined('ABSPATH') || exit;

class Instagram_Feed_Api extends Handler_Api
{
    public function config()
    {
        $this->prefix = 'widget/instagram-feed';
    }
    
    public function post_save_access_token()
    {
        
        require_once 'instagram.php';
        $data = Attr::instance()->utils->get_option('user_data', []);
        $client_id = (isset($data['instragram']) && !empty($data['instragram']['client_id'])) ? $data['instragram']['client_id'] : '';
        $client_secret = (isset($data['instragram']) && !empty($data['instragram']['client_secret'])) ? $data['instragram']['client_secret'] : '';


        if (isset($_GET['code'])) {

            if (!empty($client_id) && !empty($client_secret)) {

                $redirect_url = get_site_url() . '/wp-json/elementskit/v1/widget/instagram-feed/token';
                $instagram = new Instagram($client_id, $client_secret, $redirect_url);
                $access_token = $instagram->get_access_token($_GET['code']);
                update_option('ekit_instagram_access_token', $access_token);
                $settings_url = get_site_url() . '/wp-admin/admin.php?page=elementskit';
                header('Location: '.$settings_url);
            }

        }

        return;
    }
}
