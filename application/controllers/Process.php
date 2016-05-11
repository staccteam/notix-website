<?php

class Process extends CI_Controller{
    public function __construct(){
        parent::__construct();

        $this->load->helper('custom');
        $this->load->model('student_model');
    }

    public function getNotifications ($type, $branch) {
    	$notifications = _getData (DB_PREFIX.'notifications', null, ['branch_id' => $branch]);    // this data will be provided from the client side for accessing the notifications related to a particular branch.
    	if ($type == 'json') {
    		$this->output->set_header('Access-Control-Allow-Origin: *');
    		$this->output->set_output (json_encode($notifications));
    		exit;
    	} 
    	return $notifications;
    }

    public function getSingleNotification($not_id) {
    	$notification = _getData (DB_PREFIX.'notifications', null, ['']);
    }

    public function registerUser () {
    	$this->load->model('student_model');
    	$userdata = $this->input->post();
    	$flag = $this->student_model->register($userdata);
    	if ($flag) {
    		$this->output->set_header('Access-Control-Allow-Origin: *');
    		$this->output->set_output(true);
    	} else {
    		return false;
    	}
    }
}
?>