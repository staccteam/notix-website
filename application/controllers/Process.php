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
}
?>