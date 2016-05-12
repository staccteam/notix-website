<?php 

class Student_model extends CI_Model{
     public function __construct(){
        $this->load->database();
    }

    public function register($userdata){
    	$data = [
    		'first_name'=>$userdata['first_name'],
    		'last_name'=>$userdata['last_name'],
    		'email'=>$userdata['email'],
            'password'=>$userdata['password'],
    		'mobile'=>$userdata['mobile'],
    		'enrollment'=>$userdata['enrollment'],
    		'branch'=>$userdata['branch'],
    		'active'=>true,
    		'verified'=>false,
            'device_gcm_id' => $userdata['device_gcm_id'],
            'created_at' => getDateTime (),
            'updated_at' => getDateTime ()
    	];

    	$isExecuted = $this->db->insert(DB_PREFIX.'students', $data);
    	if ($isExecuted){ 
    		if ($this->db->affected_rows() > 0){ 
    			return true;
    		}else{
    			return false;
    		}
    	}
    }

    public function login($email){
        $isPresent = $this->checkEmail($email);

        // if user is present, fetch the user and send it back to the controller
        if ($isPresent){
            $query = $this->db->get_where(DB_PREFIX.'students', ['email'=>$email]);
            return $query->result_array();
        }else{
            return false;
        }
        
    }

    // Check if the user with required email is present in the database
    private function checkEmail($email){
        $query = $this->db->get_where(DB_PREFIX.'students', ['email'=>$email]);
        $result = $query->result_array();

        if (count($result) == 1){
            $query = $this->db->get(DB_PREFIX.'students', ['email'=>$email]);
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_student_details_by_email($email){
        $query = $this->db->get(DB_PREFIX.'students', ['email'=>$email]);
        return $query->result_array();
    }

    public function checkRepetition($enrollment){
    	$query = $this->db->get_where(DB_PREFIX.'students', ['enrollment'=>$enrollment]);
    	$result = $query->result_array();
    	if (count($result) > 0){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function getBranches(){
        $query = $this->db->get(DB_PREFIX.'branches');
        return $query->result_array();
    }

    public function getNotifications(){
        $sql = 'SELECT `notix_notifications`.*, `notix_attachments`.file_name, `notix_attachments`.file_url 
                FROM `notix_notifications` 
                LEFT JOIN `notix_attachments` 
                ON `notix_notifications`.id = `notix_attachments`.notification_id;';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}