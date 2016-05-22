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

    // render student edit page
    public function editStudentPage ($studentID) {
        $data['student'] = _getData (DB_PREFIX.'students', null, ['id'=>$studentID]);

        $this->load->view('templates/_header', $data);
        $this->load->view('templates/_faculty_header', $data);
        $this->load->view('faculty/edit-student', $data);
        $this->load->view('templates/_footer');
    }

    // update the student details
    public function updateStudent() {
        $data = $this->input->post ();
        $flag = _updateData('students', $data, ['id'=>$data['id']]);
        if ($flag)
            redirect ('facutly/home');
        else
            redirect ('faculty/editStudentPage/'.$data['id']);
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
        # global vars for the function
        $flag = null;
        $isMultiBranch = true;
        $branch_id = null;

        # form data
        $title = $this->input->post('msg-title');
        $message = $this->input->post('msg-body');
        $branchSelect = $this->input->post('branch_select[]');
        $userfile = 'msg-attachment'; //name of the file input field
        // if multiple branches are not selected
        if (! isset ($branchSelect)) {
            $isMultiBranch = false;
            $branch_id = $this->session->userdata('faculty_branch_id');
        } else {
            $branch_id = json_encode($branchSelect);
        }

        # save notification to the database and return notification ID
        $notification_id = $this->faculty_model->createNotification($this->session->userdata('faculty_username'), $title, $message, $branch_id);

        # if newly created notification ID is present
        if (isset($notification_id)){
            $uploadPath = 'faculty/'.$this->session->userdata('faculty_username').'/';
            $userfileIsPresent = do_upload_attachment($userfile, $uploadPath, $notification_id); // custom file upload function (filename input, upload directory after attachment folder)
            $facultyName = $this->session->userdata('faculty_first_name').' '.$this->session->userdata('faculty_last_name');
            // Notification Data to send to GCM Server
            $data = [
                'title' => 'New Notification',
                'message' => $facultyName.': '.$title,
                'userfile' => $userfileIsPresent,
                'style' => 'inbox',
                'content-available' => 1,
                'summaryText' => 'There are %n% notifications'                
            ];

            # Get back to it and attach file name at the end of the path
            if ($userfileIsPresent){
                $fullUploadPath = base_url().'attachments/'.$uploadPath.'/'.$userfileIsPresent['file_name'];
                $data['attachmentUrl'] = $fullUploadPath;
            }

            # if notification is to be sent to multiple branches.
            if ($isMultiBranch) {
                foreach ($branchSelect as $branchID) {
                    $flag = sendNotification ($data, $branchID);    // sends GCM notification
                }
            } else {
                $flag = sendNotification ($data, $branch_id);   // sends GCM notification
            }
               
            # if notification sent successfully
            if ($flag) {
                $this->session->set_flashdata('success', 'Notification has been sent to the required group!');
            } else {
                 $this->session->set_flashdata('success', 'Notification has been sent in message!');
            }
            
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

    // Toggle Function
    public function verifyStudent ($studentID, $action = true) {
        $flag = $this->faculty_model->verifyStudent ($studentID, $action);
        if ($flag){
            $this->session->set_flashdata ('success', 'Students has been verified');
            redirect ('faculty/students');
        } else {
            $this->session->set_flashdata ('error', 'There was some unusual error');
            redirect ('faculty/students');
        }
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