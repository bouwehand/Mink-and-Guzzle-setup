<?php
/**
 * Created by PhpStorm.
 * User: bas
 * Date: 7/31/14
 * Time: 1:54 PM
 */ 
class CustomMink 
{
    protected $_session;
    
    public function __construct() 
    {
        $driver = new \Behat\Mink\Driver\SahiDriver('firefox');
        $this->_session = new \Behat\Mink\Session($driver);
        $this->_session->start();
    }
    
    public function visitAdmin()
    {
        $url = 'http://itsme.pimcore.local/admin';
        $this->_session->visit($url);
        $page = $this->_session->getPage();
        $page->fillField('username', 'admin');
        $page->fillField('password', 'P!mcore');
        $submitButton = $page->find('named', array('button',  'submit'));
        $submitButton->click();
        echo $page->getContent();
        $this->_session->stop();
        die();
    }
}