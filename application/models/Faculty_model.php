<?php

class Faculty_model extends CI_Model{
     public function __construct(){
        $this->load->database();
    }

    public function login($username, $password){
    	if ($this->checkUsername($username)){
    		$faculty = $this->getFacultyByUsername($username);

    		if (check_password($password, $faculty[0]['password'])){
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
}