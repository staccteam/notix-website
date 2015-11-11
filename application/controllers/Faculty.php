<?php

class Faculty extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('custom');
		$this->load->model('faculty_model');

		faculty_isLoggedOut();
	}

	public function home(){
		$data['title'] = 'Home';

        $this->load->view('templates/_header', $data);
        $this->load->view('faculty/home');
		$this->load->view('templates/_footer');
	}

	public function logout(){
		$this->session->unset_userdata('faculty_username');
		redirect('/');
	}
	
}