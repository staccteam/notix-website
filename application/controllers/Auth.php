<?php

/*
	This file contains the functions related to the authentication of the website
*/

class Auth extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('custom');
		$this->load->model('student_model');
		$this->load->model('faculty_model');
		$this->load->model('admin_model');
	}

	public function salt($value){
		var_dump(hash_password($value));
	}

	// This function will take the values from the form and register the user into the database
	public function regStudent(){
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$mobile = $this->input->post('mobile');
		$enrollment = $this->input->post('enrollment');
		$branch = $this->input->post('branch');
		$verify = FALSE;
		$active = TRUE;

		// Server Side Form Validation
		$this->form_validation->set_rules('firstName', 'First Name', 'required');
		$this->form_validation->set_rules('lastName', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[notix_students.email]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('enrollment', 'Enrollment', 'required|is_unique[notix_students.enrollment]');
		$this->form_validation->set_rules('branch', 'Branch', 'required');

		$password = hash_password($password);

		// Check if the student is already registered
		$isPresent = $this->student_model->checkRepetition($enrollment);

		if(! $isPresent){
			$this->student_model->register($firstName, $lastName, $email, $password, $mobile, $enrollment, $branch, $active, $verify);
			if ($this->input->is_ajax_request()){
				$response = ['response'=>true];
				$this->output->set_header('Access-Control-Allow-Origin: *');
				$this->output->set_output(json_encode($response));
			}
			redirect('site/login');
		}
	}

	public function loginStudent(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$isValid = $this->student_model->login($email);

		if ($isValid){
			if (check_password($password, $isValid[0]['password'])){
				$student = $this->student_model->get_student_details_by_email($email);

				foreach ($student as $stud){
					$this->session->set_userdata('stud_id', $stud['id']);
					$this->session->set_userdata('stud_email', $stud['email']);
					$this->session->set_userdata('stud_mobile', $stud['mobile']);
					$this->session->set_userdata('stud_enrollment', $stud['enrollment']);
				}

				if ($this->input->is_ajax_request()){
					$response = ['response'=>true];
					$this->output->set_header('Access-Control-Allow-Origin: *');
					$this->output->set_output(json_encode($response));
				}
				redirect('student/index');
			}
		}else{
			return false;
		}
	}

	// Performs the authentication for the admin
	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$isValid = $this->admin_model->login($username, $password);

		if ($isValid){
			$this->session->set_userdata('admin_username', $username);
			redirect('admin/home');
		}else{
			$this->session->set_flashdata('error', 'The user is invalid!');
			redirect('admin');
		}
	}

	public function loginFaculty(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$isValid = $this->faculty_model->login($username, $password);

		if ($isValid){
			$faculty = $this->faculty_model->getFacultyByUsername($username);
			$this->session->set_userdata('faculty_username', $username);
			$this->session->set_userdata('faculty_id', $faculty[0]['id']);
			$this->session->set_userdata('faculty_first_name', $faculty[0]['first_name']);
			$this->session->set_userdata('faculty_last_name', $faculty[0]['last_name']);
			$this->session->set_userdata('faculty_email', $faculty[0]['email']);
			$this->session->set_userdata('faculty_mobile', $faculty[0]['mobile']);
			$this->session->set_userdata('faculty_branch_id', $faculty[0]['branch_id']);
			redirect('faculty/home');
		}else{
			$this->session->set_flashdata('error', 'Invalid Credentials');
			redirect('/');
		}
	}
}