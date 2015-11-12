<?php

class Faculty_model extends CI_Model{
     public function __construct(){
        $this->load->database();
    }

    public function login($username, $password){
    	if ($this->checkUsername($username)){
    		$faculty = $this->getFacultyByUsername($username);
            $isValid = check_password($password, $faculty[0]['password']);

    		if ($isValid){
                return true;
    		}else{
    			return false;
    		}
    	}
    }

    private function checkUsername($username){
    	$query = $this->db->get_where(DB_PREFIX.'faculties', ['username'=>$username]);
    	$result = $query->result_array();

    	if (count($result) == 1){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function getFacultyByUsername($username){
    	$query = $this->db->get_where(DB_PREFIX.'faculties', ['username'=>$username]);
    	return $query->result_array();
    }

    public function createNotification($username, $title, $message){
        $data = [
            'username'=>$username,
            'title'=>$title,
            'message'=>$message
        ];

        $this->db->trans_start(); //transaction start
        $this->db->insert(DB_PREFIX.'notifications', $data);
        $id = $this->db->insert_id();
        $this->db->trans_complete(); // transaction complete

        return $id;
    }

    public function fileUpload($notification_id, $username, $file_name, $file_url, $file_extension){
        $data = [
            'notification_id'=>$notification_id,
            'username'=>$username,
            'file_name'=>$file_name,
            'file_url'=>$file_url,
            'file_extension'=>$file_extension
        ];

        $this->db->insert(DB_PREFIX.'attachments', $data);

        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

}