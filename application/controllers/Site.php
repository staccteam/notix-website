<?php

class Site extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Home';

		// $this->load->view('templates/_header');
		$this->load->view('site/home', $data);
		$this->load->view('templates/_footer');
	}

	public function about(){
		$data['title'] = 'About';
		
		$this->load->view('templates/_header');
		$this->load->view('site/about');
		$this->load->view('templates/_footer');
	}
}