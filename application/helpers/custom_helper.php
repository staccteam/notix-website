<?php

// function hashValue($value){
// 	$ci =& get_instance();
// 	$ci->load->helper('phpass');

// 	$hasher = new PasswordHash(PASSWORD_HASH_STRENGTH, PASSWORD_HASH_PORTABLE);
// 	$hashedValue = $hasher->HashPassword($value);	
// 	return $hashedValue;
// }

function hash_password($value){
	$ci =& get_instance();
	$ci->load->helper('password');

	$hashed = password_hash($value, PASSWORD_BCRYPT);
	return $hashed;
}

function check_password($value, $hashed){
	$ci =& get_instance();
	$ci->load->helper('password');

	$isValid = password_verify($value, $hashed);
	return $isValid;
}

// function checkPassword($password, $hashedPassword){
// 	$ci =& get_instance();
// 	$ci->load->helper('phpass');

// 	$hasher = new PasswordHash(PASSWORD_HASH_STRENGTH, PASSWORD_HASH_PORTABLE);
// 	$isValid = $hasher->CheckPassword($password, $hashedPassword);

// 	if ($isValid)
// 		return true;
// 	else
// 		return false;

// }

function admin_isLoggedOut(){
	$ci =& get_instance();
	if (! $ci->session->userdata('admin_username')){
		redirect('admin');
	}
}

function admin_isLoggedIn(){
	$ci =& get_instance();
	if ($ci->session->userdata('admin_username')){
		redirect('admin/home');
	}
}

// Faculty Login Authenticate
function faculty_isLoggedIn(){
	$ci =& get_instance();
	if ($ci->session->userdata('faculty_username')){
		redirect('faculty/home');
	}
}

function faculty_isLoggedOut(){
	$ci =& get_instance();
	if (! $ci->session->userdata('faculty_username')){
		redirect('/');
	}
}

// This function serves the purpose for file upload
function do_upload_attachment($userfile, $uploadPath, $notification_id){
	$ci =& get_instance();

	$uploadpath = './attachments/'.$uploadPath;
	if (!is_dir($uploadpath)) {
    	mkdir($uploadpath, 0777, TRUE);
	}

	$config['upload_path'] = $uploadpath;
	$config['allowed_types'] = 'gif|jpg|png|pdf|docx|ppt|mp4';
	$config['max_size']	= '2000';
	$config['max_width']  = '0';
	$config['max_height']  = '0';

	$ci->load->library('upload', $config);

	if ( ! $ci->upload->do_upload($userfile))
	{
		$error = array('error' => $ci->upload->display_errors());
		$ci->session->set_flashdata('error', $error);
		return false;
	}
	else
	{
		$uploadPath = 'attachments/'.$uploadPath;
		$file = $ci->upload->data();
		$file_name = $file['file_name'];
		$file_url = base_url().$uploadPath.$file_name;
		$file_path = $file['full_path'];
		$file_extension = $file['file_ext'];
		$username = $ci->session->userdata('faculty_username');

		$isSuccess = $ci->faculty_model->fileUpload($notification_id, $username, $file_name, $file_url, $file_extension);

		if ($isSuccess){
			$data = array('upload_data' => $ci->upload->data());

			$ci->session->set_flashdata('success', "The file has been uploaded successfully!");
			return true;
		}
		
	}
}












?>