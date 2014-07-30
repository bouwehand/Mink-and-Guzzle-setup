<?php
error_reporting(-1);
ini_set('display_errors', 'On');
define('ROOT', getcwd());

require_once("vendor/autoload.php");

use Guzzle\Http\Client;
use Guzzle\Parser\Cookie;
use Guzzle\Plugin\Cookie\CookiePlugin;
use Guzzle\Plugin\Cookie\CookieJar\ArrayCookieJar;
use Guzzle\Plugin\Cookie\CookieJar\FileCookieJar;

/** @var Documentation github example, works $res */
/*
$res = $client->get('https://api.github.com/user', [
        'auth' =>  ['bouwehand', 'Bouwehand01']
    ]);
echo $res->getStatusCode();           // 200
echo $res->getHeader('content-type'); // 'application/json; charset=utf8'
echo $res->getBody();                 // {"type":"User"...'
var_dump($res->json());             // Outputs the JSON decoded data
*/

/** Using the cookie plugin bug test */
$url = 'http://itsme.pimcore.local/admin/login/login';
$post_data = array(
    "username" => "admin",
    "password" => "P!mcore",
    "submit"   => 'login'
);


$cookiePlugin = new CookiePlugin(new FileCookieJar(ROOT . '/cookie.json'));   

$client = new Client(
    null,
    array(
        'request.options' => array(
            'debug' => true
        ),
        'curl.options' => array('CURLOPT_VERBOSE' => true)
    ));
$client->addSubscriber($cookiePlugin);
$client->setUserAgent('Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2049.0 Safari/537.36');

$request    = $client->post($url, null , $post_data);
$response1  = $client->send($request);

$url2 = 'http://itsme.pimcore.local/admin';
$request = $client->get($url2);
$response2  = $client->send($request);
die($response2->getBody());


