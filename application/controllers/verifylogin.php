<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class VerifyLogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   //global $site_name;
   $this->load->model('User_model','',TRUE);
 }

 function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

     if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.&nbsp; User redirected to login page
	$this->load->view('templates/header');
   $this->load->view('home_view');
   $this->load->view('login_view');
   }
   else
   {
     //Go to private area user tried to access
	 if($redir = $this->session->userdata('redir')) {
		$this->session->unset_userdata('redir');
	}

     redirect($redir ? $redir : site_url());
   }

 }

 function check_database($password)
 {
   //Field validation succeeded.&nbsp; Validate against database
   $username = $this->input->post('username');

   //query the database
   $result = $this->User_model->login($username, $password);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'userID' => $row->userID,
		 
         'email' => $row->email,
       	 'status' => $row->status,
       	 'role' => $row->role,
       	 'privacy' => $row->privacy,
		 //'profile_photo' => $row->profilePhoto
       );
       $this->session->set_userdata('logged_in', $sess_array);
       $this->session->set_userdata($sess_array);
     }
	 

	
    return TRUE;
   }
   else
   {
	$this->load->view('templates/header');
     $this->form_validation->set_message('check_database', 'Invalid email or password');
     return false;
   }
 }
}
?>
