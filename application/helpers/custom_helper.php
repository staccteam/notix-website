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

function do_upload_images($userInputName, $uploadPath){
	$ci =& get_instance();
	$prePath = './images/';
	$uploadpath = $prePath.$uploadPath;
	if (!is_dir($uploadpath)) {
    	mkdir($uploadpath, 0777, TRUE);
	}

	$config['upload_path'] = $uploadpath;
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']	= '2000';
	$config['max_width']  = '0';
	$config['max_height']  = '0';

	$ci->load->library('upload', $config);

	if ( ! $ci->upload->do_upload($userInputName))
	{
		$error = array('error' => $ci->upload->display_errors());
		$ci->session->set_flashdata('error', $error);
		return false;
	}
	else
	{
		$uploadPath = $prePath.$uploadPath;
		$image = $ci->upload->data();

		$data = array('upload_data' => $ci->upload->data());

		$ci->session->set_flashdata('success', "The file has been uploaded successfully!");
		return $image;
	
	}
}


// get datetime
function getDatetimeArray () {
	$date = date ('Y-m-d');
	$time = date ('H:i:s');
	$datetime = [
		'date' => $date,
		'time' => $time
	];
	return $datetime;
}

function getDateTime () {
	$datetime = getDatetimeArray ();
	return $datetime['date'].' '.$datetime['time'];
}

// common get data
function _getData ($table, $select = null, array $condition = null) {
	$ci =& get_instance();
	$ci->load->database();
	
	if (empty($condition) && !empty($select)) {
		$ci->db->select ([$select]);
		$query = $ci->db->get ($table);
	} else if (empty($select) && !empty($condition)) {
		$query = $ci->db->get_where ($table, $condition);
	} else if (!empty($select) && !empty($condition)) {
		$ci->db->select([$select]);
		$query = $ci->db->get_where ($table, $condition);
	} else {
		$query = $ci->db->get ($table);
	}
	return $query->result_array();
}

function _insertData ($data, $table) {
	$ci =& get_instance ();
	$ci->load->database();

	$ci->db->insert ($table, $data);
	$affectedRow = $ci->db->affected_rows();
	if ($affectedRow == 1) {
		return true;
	} else {
		return false;
	}
}

function sendNotification ($data, $branch_id) {
	$url = 'https://android.googleapis.com/gcm/send';   // GCM Server Address                                     // Server API Key
    // Registered devices to which the notification will be sent
    $registeredIDs = _getData (DB_PREFIX.'students', 'device_gcm_id', ['branch_id' => $branch_id]);
    $registeredIDsArray = null;
    foreach ($registeredIDs as $regId) {
    	array_push($registeredIDs, $regId['device_gcm_id']);
    } 

    $fields = [
        'registration_ids' => $registeredIDsArray,
        'data' => $data
    ];
    $headers = [ 
            'Authorization: key=' . AUTHORIZATION_KEY,
            'Content-Type: application/json'
        ];
    
    // Open connection
    $ch = curl_init();
    // Set the url, number of POST vars, POST data
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
     
    // Execute post
    $result = curl_exec($ch);
     
    // Close connection
    curl_close($ch);
    
    var_dump($result);
    echo $result;

}




?>