<?php

class Admin extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('custom');
		$this->load->model('admin_model');

		admin_isLoggedOut();
	}

	// This will render the home page from the admin/home view
 	public function home(){
		$this->load->view('admin/home');
	}

	public function addFaculty(){
		$this->load->view('admin/add');
	}

	public function editFaculty($id){
		$data['title'] = 'Edit Faculty';
		// Fetch the faculty details with its id
		$data['faculty'] = $this->admin_model->getFacultyById($id);
		// Pass the faculty data to the view
		$this->load->view('admin/edit', $data);
	}

	public function logout(){
		$this->session->unset_userdata('admin_username');
	}

	public function create(){
		$firstName = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$branch = $this->input->post('branch');
		$status = true;

		$isSuccessful = $this->admin_model->createFaculty($firstName, $lastName, $email. $mobile, $username, $password, $branch, $status);

		if ($isSuccessful){
			if ($this->input->is_ajax_request()){
				$this->output->set_header('Allow Control Allow Origin: *');
				$this->output->set_output(true);
			}
			redirect('admin/home');
		}else{
			$this->session->set_flashdata('error', 'There was some error while adding the entry into the database.');
			redirect('admin/addFaculty');
		}
	}

	public function update(){
		$id = $this->input->post('id');
		$firstName = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$branch = $this->input->post('branch');
		$status = true;

		$isSuccessful = $this->admin_model->updateFaculty($id, $firstName, $lastName, $email. $mobile, $username, $password, $branch, $status);

		if ($isSuccessful){
			if ($this->input->is_ajax_request()){
				$this->output->set_header('Allow Control Allow Origin: *');
				$this->output->set_output(true);
			}
			redirect('admin/home');
		}else{
			$this->session->set_flashdata('error', 'There was some error while updating the entry into the database.');
			redirect('admin/editFaculty/'.$id);
		}
	}
	
	public function deleteFaculty($id){
		$isDeleted = $this->admin_model->deleteFaculty($id);
		if ($isDeleted){
			redirect('admin/home');
		}else{
			$this->session->set_flashdata('error', 'Entry in the database could not be deleted');
			redirect('admin/home');
		}
	}
}