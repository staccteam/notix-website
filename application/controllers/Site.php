<?php

class Site extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('custom');
        $this->load->model('admin_model');
    }

    public function index(){
        faculty_isLoggedIn();
        $data['title'] = 'Home';

        $this->load->view('templates/_header');
        $this->load->view('site/home', $data);
        $this->load->view('templates/_footer');
    }

    public function about(){
        $data['title'] = 'About';
        
        $this->load->view('templates/_header');
        $this->load->view('site/about');
        $this->load->view('templates/_footer');
    }

    public function login(){
        $data['title'] = 'Login';
        
        $this->load->view('templates/_header');
        $this->load->view('site/login');
        $this->load->view('templates/_footer');
    }

    public function admin(){
        admin_isLoggedIn();
        $data['title'] = 'Admin Login';
        $data['sess'] = $this->session->userdata('admin_username');

        $this->load->view('templates/_header');
        $this->load->view('site/admin', $data);
        $this->load->view('templates/_footer');
    }

    public function addAdmin($username, $password){
        $this->admin_model->addAdmin($username, $password);

    }
}