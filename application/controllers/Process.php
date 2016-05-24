<?php

class Process extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->load->helper('custom');
        $this->load->model('student_model');
    }

    // returns json branch data  
    public function getBranches () {
        $branches = _getData (DB_PREFIX.'branches');
        $this->output->set_header ('Access-Control-Allow-Origin: *');
        $this->output->set_output (json_encode($branches));
    }

    // get branch name by id
    public function getBranchNameByID ($branchID) {
        $branch = getBranchNameByID($branchID);
        $branchName = ['branchName' => $branch[0]['branch']];
        $this->output->set_output (json_encode($brachName));
        die();
    }

    // return all notifications for branch
    public function getNotifications ($type, $branch = null) {
        if (empty($branch)) {
        $notifications = _getData (DB_PREFIX.'notifications');
    } else {
        $branch_id = _getData(DB_PREFIX.'branches', 'id', ['branch' => $branch]);
        $branch_id = $branch_id[0]['id'];
        $notifications = _getData (DB_PREFIX.'notifications', null, ['branch_id' => $branch_id]);    // this data will be provided from the client side for accessing the notifications related to a particular branch.
        // var_dump($notifications);
    }
    	if ($type == 'json') {
    		$this->output->set_header('Access-Control-Allow-Origin: *');
    		$this->output->set_output (json_encode($notifications));
    		return;
    	} 
    	return $notifications;
    }

    // return single notification by notification_id
    public function getSingleNotification($not_id) {
    	$notification = _getData (DB_PREFIX.'notifications', null, ['id' => $not_id]);

        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_output (json_encode($notification));
        return;
    }

    // register the user to the database
    public function registerUser () {
    	$this->load->model('student_model');
    	$userdata = $this->input->post();
    	$flag = $this->student_model->register($userdata);
    	if ($flag) {
    		echo true;
            return;
    	} else {
    		echo false;
            return
    	}
    }

    // return student ID by enrollment
    public function getStudentID ($enrollment) {
        $data = _getData (DB_PREFIX.'students', 'id', ['enrollment' => $enrollment]);
        if (! empty($data))
        {
            $response = ['response' => $data[0]['id']];
            $this->output->set_output (json_encode($response));
        }
        return;
    }

    // get meta
    public function getMeta ($metaKey) {
        $data = _getData (DB_PREFIX.'meta', null, ['meta_key' => $metaKey]);
        $jdata = json_encode(['response' => $data]);
        $this->output->set_output($jdata);
    }
}
?>