<?php

class Faculty extends CI_Controller{
    public function __construct(){
        parent::__construct();

        $this->load->helper('custom');
        $this->load->model('faculty_model');

        faculty_isLoggedOut();
    }

    public function home(){
        $data['title'] = 'Home';
        $data['faculty'] = $this->faculty_model->getFacultyByUsername($this->session->userdata('faculty_username'));

        $this->load->view('templates/_header', $data);
        $this->load->view('templates/_faculty_header', $data);
        $this->load->view('faculty/home', $data);
        $this->load->view('templates/_footer');
    }

    // public function profile($username){
    //     $data['title'] = "Edit Profile";
    //     $data['faculty'] = $this->faculty_model->getFacultyProfileByUsername($username);

    //     $this->load->view('templates/_header', $data);
    //     $this->load->view('templates/_faculty_header', $data);
    //     $this->load->view('faculty/profile', $data);
    //     $this->load->view('templates/_footer');
    // }

    public function students () {
        $data['students'] = _getData (DB_PREFIX.'students');

        $this->load->view('templates/_header', $data);
        $this->load->view('templates/_faculty_header', $data);
        $this->load->view('faculty/students', $data);
        $this->load->view('templates/_footer');
    }

    public function updateProfileInfo(){
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $password = $this->input->post('password');
        $about = $this->input->post('about');

        if (empty($about))
            $about == NULL;

        if (empty($password))
            $password = NULL;
        else
            $password = hash_password($password);

        if ($password == NULL)
            $this->faculty_model->insertFacultyProfile($this->session->userdata('faculty_id'), $this->session->userdata('facutly_username'), $email, $mobile, $password, $about);
    }

    public function createNotification(){
        $data['title'] = 'Create Notification';

        $this->load->view('templates/_header', $data);
        $this->load->view('templates/_faculty_header', $data);
        $this->load->view('faculty/createNotification');
        $this->load->view('templates/_footer');
    }

    public function notifications(){
        $data['title'] = 'Delete Notifications';
        $data['notifications'] = _getData (DB_PREFIX.'notifications', null, ['username'=> $this->session->userdata('faculty_username')]);

        $this->load->view('templates/_header', $data);
        $this->load->view('templates/_faculty_header', $data);
        $this->load->view('faculty/notifications', $data);
        $this->load->view('templates/_footer');
    }

    // This function creates a notification and saves it in the database.
    public function create(){
        $title = $this->input->post('msg-title');
        $message = $this->input->post('msg-body');
        $branch_id = $this->input->post('branch');
        $userfile = 'msg-attachment'; //name of the file input field

        $notification_id = $this->faculty_model->createNotification($this->session->userdata('faculty_username'), $title, $message, $branch_id);
        if (isset($notification_id)){
            $uploadPath = 'faculty/'.$this->session->userdata('faculty_username').'/';
            do_upload_attachment($userfile, $uploadPath, $notification_id); // custom file upload function (filename input, upload directory after attachment folder)
            # send post request to GCM server
            // $url = 'http://server.com/path';
            // $data = array('key1' => 'value1', 'key2' => 'value2');
            // // use key 'http' even if you send the request to https://...
            // $options = array(
            //     'http' => array(
            //         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            //         'method'  => 'POST',
            //         'content' => http_build_query($data)
            //     )
            // );
            // $context  = stream_context_create($options);
            // $result = file_get_contents($url, false, $context);
            // if ($result === FALSE) { /* Handle error */ }
            // var_dump($result);
        }else{
            $this->session->set_flashdata('error', 'There was some error in creating the notification!');
        }
        
        redirect('faculty/home');
    }

    public function uploadProfilePicture(){
        $userInputName = 'profile-picture';

        $pre = 'images/'; // name of the main folder
        $uploadPath = 'faculty/'.$this->session->userdata('faculty_username').'/'; // upload path inside the main folder
        $image = do_upload_images($userInputName, $uploadPath); 
        $image_url = base_url().$pre.$uploadPath.$image['file_name']; // full image url

        if (isset($image)){
            $this->faculty_model->facultyProfilePictureUpload($this->session->userdata('faculty_id'), 
                $this->session->userdata('faculty_username'),
                 $image['file_name'], $image_url, 
                  $image['file_ext']);
        }
        

        redirect('faculty/profile/'.$this->session->userdata('faculty_username'));
    }

    public function getNotificationById($id){
       $notification = $this->faculty_model->getNotificationById($id);

       $this->output->set_output(json_encode($notification));
    }

    public function logout(){
        $this->session->unset_userdata('faculty_username');
        redirect('/');
    }
    
}