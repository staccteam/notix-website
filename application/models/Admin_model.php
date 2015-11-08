<?php

class Admin_model extends CI_Model{
     public function __construct(){
        $this->load->database();
    }

    public function login($username, $password){
    	if($this->checkUsername($username)){
    		$admin = $this->getAdminByUsername($username);
    		$isValid = check_password($password, $admin[0]['password']);
    		if ($isValid){
    			return true;
    		}else{
    			return false;
    		}
    	}
    }

    private function checkUsername($username){
    	$query = $this->db->get_where(DB_PREFIX.'admins', ['username'=>$username]);
    	$result = $query->result_array();

    	if (count($result == 1)){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function getAdminByUsername($username){
    	$query = $this->db->get_where(DB_PREFIX.'admins', ['username'=>$username]);
    	return $query->result_array();
    }

    public function createFaculty($firstName, $lastName, $email. $mobile, $username, $password, $branch, $status){
        $password = hash_password($password);
        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'mobile' => $mobile,
            'username' => $username,
            'password' => $password,
            'branch' => $branch,
            'status' => $status
        ];
        $this->db->insert(DB_PREFIX.'faculties', $data);
        $rowsAffected = $this->db->rows_affected();
        if ($rows_affected > 0){
            return true;
        }else{
            return false;
        }
    }

    public function updateFaculty($id, $firstName, $lastName, $email. $mobile, $username, $password, $branch, $status){
        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'mobile' => $mobile,
            'username' => $username,
            'password' => $password,
            'branch' => $branch,
            'status' => $status
        ];
        $this->db->where('id', $id);
        $this->db->update(DB_PREFIX.'faculties', $data);
        $rowsAffected = $this->db->rows_affected();

        if ($rowsAffected > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getFacultyById($id){
        $query = $this->db->get_where(DB_PREFIX.'faculties', ['id'=>$id]);
        return $query->result_array();
    }

    public function deleteFaculty($id){
        $this->db->where(['id'=>$id]);
        $this->db->delete(DB_PREFIX.'faculties');
        $rowsAffected = $this->db->rows_affected();

        if ($rowsAffected > 0){
            return true;
        }else{
            return false;
        }
    }


}