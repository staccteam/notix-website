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

    public function getFacultyProfileByUsername($username){
        $sql = 'SELECT notix_faculties.first_name, notix_faculties.last_name, notix_faculties.email, notix_faculties.mobile, notix_faculty_profiles.about, notix_faculty_profile_pictures.image_url,
                    notix_branches.branch
                    FROM notix_faculties
                    LEFT JOIN notix_faculty_profiles
                    ON notix_faculty_profiles.username = notix_faculty_profiles.username
                    LEFT JOIN notix_faculty_profile_pictures
                    ON notix_faculties.username = notix_faculty_profile_pictures.username
                    LEFT JOIN notix_branches
                    ON notix_branches.id = notix_faculties.branch
                    WHERE notix_faculties.username = ?;';
        $query = $this->db->query($sql, [$username]);
        return $query->result_array();
    }

    public function facultyProfilePictureUpload($faculty_id, $username, $image_name, $image_url, $image_extension){
        $data = [
            'faculty_id'=>$faculty_id,
            'username'=>$username,
            'image_name'=>$image_name,
            'image_url'=>$image_url,
            'image_extension'=>$image_extension
        ];
        $query = $this->db->get_where(DB_PREFIX.'faculty_profile_pictures', ['username'=>$username]); //fetch the user's current profile picture
        $result = $query->result_array(); 
        // check if the profile picture already exists
        if (count($result) > 0){
            $this->db->where('username', $username);
            $this->db->update(DB_PREFIX.'faculty_profile_pictures', $data);
        }else{
            $this->db->insert(DB_PREFIX.'faculty_profile_pictures', $data);
        }
        
        if ($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    public function updateFacultyProfile($faculty_id, $username, $email, $mobile, $password, $about){
        if ($about !== NULL){
           $data = [
                'faculty_id'=>$faculty_id,
                'username'=>$username,
                'about'=>$about
            ];

            $this->db->insert(DB_PREFIX.'faculty_profiles', $data); 
        }
        
        $this->updateFaculty($username, $email, $mobile, $password);

        if ($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    private function updateFaculty($username, $email, $mobile, $password){
        $data = NULL;

        if ($password == NULL){
            $data = [
                'email'=>$email,
                'mobile'=>$mobile,
            ];
        }else{
            $data = [
                'email'=>$email,
                'mobile'=>$mobile,
                'password'=>$password
            ];
        }

        $this->db->where('username', $username);
        $this->db->update(DB_PREFIX.'faculties', $data);
    }

    public function getNotifications(){
        $sql = 'SELECT `notix_notifications`.*, `notix_attachments`.file_name, `notix_attachments`.file_url 
                FROM `notix_notifications` 
                LEFT JOIN `notix_attachments` 
                ON `notix_notifications`.id = `notix_attachments`.notification_id;';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getNotificationById($id){
        $query = $this->db->get_where(DB_PREFIX.'notifications', ['id'=>$id]);
        return $query->result_array();
    }

}