<?php

class Admin_model extends CI_Model{
     public function __construct(){
        $this->load->database();
    }

    public function addAdmin($username, $password){
        $data = [
            'username' => $username,
            'password' => hash_password($password),
            'created_at' => getDateTime (),
            'updated_at' => getDateTime ()
        ];
        $this->db->insert(DB_PREFIX.'admins', $data);
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

    public function createFaculty($firstName, $lastName, $email, $mobile, $username, $password, $branch, $status){
        $password = hash_password($password);
        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'mobile' => $mobile,
            'username' => $username,
            'password' => $password,
            'branch' => $branch,
            'status' => $status,
            'created_at' => getDateTime (),
            'updated_at' => getDateTime ()
        ];
        $this->db->insert(DB_PREFIX.'faculties', $data);
        $rowsAffected = $this->db->affected_rows();
        if ($rows_affected > 0){
            return true;
        }else{
            return false;
        }
    }

    public function updateFaculty($id, $firstName, $lastName, $email, $mobile, $username, $password=NULL, $branch, $status){
        if ($password == NULL){
            $data = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'mobile' => $mobile,
                'username' => $username,
                'branch' => $branch,
                'status' => $status,
                'updated_at' => getDateTime ()
            ];
        }else{
            $password = hash_password($password);
            $data = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'mobile' => $mobile,
                'username' => $username,
                'password' => $password,
                'branch' => $branch,
                'status' => $status,
                'updated_at' => getDateTime ()
            ];
        }
        
        $this->db->where('id', $id);
        $this->db->update(DB_PREFIX.'faculties', $data);
        $rowsAffected = $this->db->affected_rows();

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

    public function getAllFacultiesUsername(){
        $this->db->select('id, username');
        $query = $this->db->get(DB_PREFIX.'faculties');
        return $query->result_array();
    }

    public function getFaculties(){
        $sql = 'select `'.DB_PREFIX.'faculties`.*, `'.DB_PREFIX.'branches`.branch as branch_name from `'.DB_PREFIX.'faculties`
                    left join `'.DB_PREFIX.'branches`
                    on `'.DB_PREFIX.'faculties`.branch = `'.DB_PREFIX.'branches`.id;';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function deleteFaculty($id){
        $this->db->where(['id'=>$id]);
        $this->db->delete(DB_PREFIX.'faculties');
        $rowsAffected = $this->db->affected_rows();

        if ($rowsAffected > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getBranches(){
        $query = $this->db->get(DB_PREFIX.'branches');
        return $query->result_array();
    }


}