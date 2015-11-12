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

	// This function creates a notification and saves it in the database.
	public function create(){
		$title = $this->input->post('msg-title');
		$message = $this->input->post('msg-body');
		$userfile = 'msg-attachment'; //name of the file input field

		$notification_id = $this->faculty_model->createNotification($this->session->userdata('faculty_username'), $title, $message);

		if (isset($notification_id)){
			$uploadPath = 'faculty/'.$this->session->userdata('faculty_username').'/';
			do_upload_attachment($userfile, $uploadPath, $notification_id); // custom file upload function (filename input, upload directory after attachment folder)
		}else{
			$this->session->set_flashdata('error', 'There was some error in creating the notification!');
		}
		
		redirect('faculty/home');
	}
	
}