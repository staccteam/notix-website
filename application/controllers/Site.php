<?php

/**
 * Site.php
 *
 * This Controller is responsible for all the websites routes and views
 *
 * @package	Notix-website
 * @author	Varun 
 */

class Site extends CI_Controller{
	 public function __construct(){
        parent::__construct();
    }

    public function index(){
    	$data['helloworld'] = "Hello World!";
    	$this->load->view('site/index', $data);
    }

}