<?php
error_reporting(-1);
ini_set('display_errors', 'On');
define('ROOT', getcwd());

require_once("vendor/autoload.php");
require_once(ROOT . "/Lib/CustomHttp.php");
require_once(ROOT . "/Lib/CustomMink.php");

if($_GET['call']=='getproducts') {
   CustomHttp::getProducts();
} else {
    $customHttp = new CustomHttp();
    $customHttp->doLogin();
    $response = $customHttp->sendGetMetaData();
    die($response->getBody());  
}

//$CustomMink = new CustomMink();
//$CustomMink->visitAdmin();
