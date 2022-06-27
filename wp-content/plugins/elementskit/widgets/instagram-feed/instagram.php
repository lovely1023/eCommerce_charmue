<?php

namespace Wpmet;

class Instagram
{
    private $app_id;
    private $app_secret;
    private $redirect_url;
    private $access_token;
    private $code;

    public function __construct($app_id, $app_secret, $redirect_url, $access_token = null)
    {
        $this->app_id       = $app_id;
        $this->app_secret   = $app_secret;
        $this->redirect_url = $redirect_url;
        $this->access_token = $access_token;
    }

    public function get_login_url()
    {
        $client_id    = $this->app_id;
        $redirect_url = $this->redirect_url;
        $scope        = 'user_profile,user_media';
        $url          = 'https://api.instagram.com/oauth/authorize?client_id=' . $client_id . '&redirect_uri=' . $redirect_url . '&scope=' . $scope . '&response_type=code';

        return $url;
    }


    public function get_access_token($code = null)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://api.instagram.com/oauth/access_token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => array(

                'client_id'     => $this->app_id,
                'client_secret' => $this->app_secret,
                'grant_type'    => 'authorization_code',
                'redirect_uri'  => $this->redirect_url,
                'code'          => $code
            ),

        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response);

        if (property_exists($result, 'error_type')) {
            return $result->error_message;
        }

        $this->access_token = $result->access_token;
        return $this->access_token;
    }

    public function get_media_url($access_token)
    {
        if ($access_token == null) {
            return 'access token missing';
        }

        $data = 'https://graph.instagram.com/me/media?fields=id,media_type,media_url,username,timestamp&access_token=' . $access_token;
        return $data;
    }
}
