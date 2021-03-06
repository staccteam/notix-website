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

function _updateData ($table, $data, $condition) {
	$ci =& get_instance ();
	$ci->load->database();

	$ci->db->where($condition);
	$flag = $ci->db->update(DB_PREFIX.$table, $data);
	if ($flag)
		return true;
	else
		return false;
}

function getBranchNameByID($catID) {
	$ci =& get_instance ();
	$ci->load->database();

	$branch = _getData (DB_PREFIX.'branches', 'branch', ['id'=>$catID]);

	return $branch;
}

function sendNotification ($data, $branch_id) {
	$url = 'https://android.googleapis.com/gcm/send';   // GCM Server Address                                     // Server API Key
    // Registered devices to which the notification will be sent
    $registeredIDs = _getData (DB_PREFIX.'students', 'device_gcm_id', ['branch_id' => $branch_id]);
    $registeredIDsArray = [];
    foreach ($registeredIDs as $regId) {
    	array_push($registeredIDsArray, $regId['device_gcm_id']);
    } 

    echo 'Registerd Device Token Array: <br/><b>'; var_dump($registeredIDsArray);
    echo '</b><br /><br/>';
    echo 'Data Encoded in JSON format: <br/><b>';var_dump(json_encode($data));
    echo '</b><br /><br />';
    echo 'AUTHORIZATION KEY: <br/><b>';var_dump(AUTHORIZATION_KEY);
    echo '</b><br />';

    $fields = [
        'registration_ids' => $registeredIDsArray,
        'data' => json_encode($data)
    ];
    $headers = [ 
            'Authorization: key=' . AUTHORIZATION_KEY,
            'Content-Type: application/json'
        ];
    
    // var_dump($registeredIDsArray);


    // $ci =& get_instance ();
    // $ci->load->library('curl');
    // $ci->curl->create($url);
    // $ci->curl->options([
    // 	CURLOPT_POST => true,
    // 	CURLOPT_HTTPHEADER => $headers, 
    // 	CURLOPT_RETURNTRANSFER => true,
    // 	CURLOPT_POSTFIELDS => json_encode( $fields )
    // 	]
    // 	);
    // $response = $ci->curl->execute();




    // Open connection
    // $ch = curl_init();
    // // Set the url, number of POST vars, POST data
    // curl_setopt( $ch, CURLOPT_URL, $url );
    // curl_setopt( $ch, CURLOPT_POST, true );
    // curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
    // curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     
    // curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
     
    // // Execute post
    // $result = curl_exec($ch);
     
    // // Close connection
    // curl_close($ch);


    # method 3
        // Insert real GCM API key from the Google APIs Console
    // https://code.google.com/apis/console/   
    $ids = $registeredIDsArray;     
    $apiKey = AUTHORIZATION_KEY;

    // Set POST request body
    $post = array(
                    'registration_ids'  => $ids,
                    'data'              => $data,
                 );

    // Set CURL request headers 
    $headers = array( 
                        'Authorization: key=' . $apiKey,
                        'Content-Type: application/json'
                    );

    // Initialize curl handle       
    $ch = curl_init();

    // Set URL to GCM push endpoint     
    // https://android.googleapis.com/gcm/send
    // http://gcm-http.googleapis.com/gcm/send
    curl_setopt( $ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    // Set request method to POST       
    curl_setopt( $ch, CURLOPT_POST, true );

    // Set custom request headers       
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

    // Get the response back as string instead of printing it       
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

    // Set JSON post data
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $post ) );

    // Actually send the request    
    $result = curl_exec( $ch );

    // Handle errors
    if ( curl_errno( $ch ) )
    {
        echo 'GCM error: ' . curl_error( $ch );
    }

    // Close curl handle
    curl_close( $ch );

    // Debug GCM response 
    $arrayObj = json_decode($result);     
    $response = (array)$arrayObj;
    $flag = $response["success"]; 
   	if ($flag)
   		return true;
   	else 
   		return false;
}	




?>