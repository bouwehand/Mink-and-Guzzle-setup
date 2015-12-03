<?php

use Guzzle\Http\Client;
use Guzzle\Parser\Cookie;
use Guzzle\Plugin\Cookie\CookiePlugin;
use Guzzle\Plugin\Cookie\CookieJar\ArrayCookieJar;
use Guzzle\Plugin\Cookie\CookieJar\FileCookieJar;

/**
 * Created by PhpStorm.
 * User: bas
 * Date: 7/31/14
 * Time: 1:12 PM
 */
class CustomHttp
{
    /**
     * @var Client GuzzleHttp\Client
     */
    protected $_client;

    protected $_login_url = 'http://itsme.pimcore.local/admin/login/login';

    protected $_login_data = array(
        "username" =>   "admin",
        "password" =>   "P!mcore",
        "submit" =>     'login'
    );

    /**
     * set Client and cookie handling
     */
    public function __construct()
    {
        $cookiePlugin = new CookiePlugin(new FileCookieJar(ROOT . '/cookie.json'));
        $this->_client = new Client(
            null,
            array(
                'request.options' => array(
                    'debug' => true
                ),
                'curl.options' => array('CURLOPT_VERBOSE' => true)
            ));
        $this->_client->addSubscriber($cookiePlugin);
        $this->_client->setUserAgent(
            'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2049.0 Safari/537.36'
        );
    }

    /**
     * Login
     *
     * @return bool
     */
    public function doLogin()
    {
        $request = $this->_client->post($this->_login_url, null, $this->_login_data);
        $response = $this->_client->send($request);

        if ($response->getStatusCode() == '200') {
            return true;
        }
        return false;
    }
    
    public function sendGetMetaData() 
    {
        $url = 'http://itsme.pimcore.local/plugin/Assembler/index/metadata';
        $data = '{
            "some_object" : "json object"
        }';
clear()
        $request = $this->_client->post($url,array(
                'content-type' => 'application/json'
            ),array());
        $request->setBody($data); #set body!
        return $request->send();
    }

    /**
     * Serve the xml for testing
     */
    public static function getProducts()
    {
        $xml = file_get_contents(ROOT.'/tmp/GetProducts_v1.5.23.xml');
        header("Content-Type:text/xml");
        die($xml);
    }
}