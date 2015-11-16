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

        $this->load->view('templates/_header', $data);
        $this->load->view('templates/_faculty_header', $data);
        $this->load->view('faculty/home');
        $this->load->view('templates/_footer');
    }

    public function profile($username){
        $data['title'] = $username;
        $data['profile'] = $this->faculty_model->getFacultyProfileByUsername($username);

        $this->load->view('templates/_header', $data);
        $this->load->view('templates/_faculty_header', $data);
        $this->load->view('faculty/profile', $data);
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

    public function deleteNotifications(){
        $data['title'] = 'Delete Notifications';

        $this->load->view('templates/_header', $data);
        $this->load->view('templates/_faculty_header', $data);
        $this->load->view('faculty/deleteNotifications');
        $this->load->view('templates/_footer');
    }

    // This function creates a notification and saves it in the database.
    public function create(){
        $title = $this->input->post('msg-title');
        $message = $this->input->post('msg-body');
        $userfile = 'msg-attachment'; //name of the file input field

        $notification_id = $this->faculty_model->createNotification($this->session->userdata('faculty_username'), $title, $message);
        if (isset($notification_id)){
            $uploadPath = 'faculty/'.$this->session->userdata('faculty_username').'/';
            do_upload_attachment($userfile, $uploadPath, $notification_id); // custom file upload function (filename input, upload directory after attachment folder)
        }else{
            $this->session->set_flashdata('error', 'There was some error in creating the notification!');
        }
        
        redirect('faculty/home');
    }

    public function uploadProfilePicture(){
        $userInputName = 'profile_picture';

        $uploadPath = 'faculty/'.$this->session->userdata('faculty_username').'/';
        do_upload_images($userInputName, $uploadPath);

        redirect('faculty/profile/'.$this->session->userdata('faculty_username'));
    }

    public function logout(){
        $this->session->unset_userdata('faculty_username');
        redirect('/');
    }
    
}