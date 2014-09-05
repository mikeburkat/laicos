<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller{
	 public function __construct()
	 {
	  parent::__construct();
	  //global $site_name;
	  $this->load->helper('form');
	  $this->load->model('registration_model');
	  //$this->output->enable_profiler(TRUE);
	 }
 
 public function index($str = "null")
  {
		if ($str == "null")
		{
			echo "Invalid URL";
		}
		else
		{
			$query = mysql_unbuffered_query("SELECT invited FROM invites WHERE invitedurl = '$str'");
			$result = mysql_fetch_row($query);
			if ($result)
			{
// 				echo $result[0];
				$data['title'] = "Register for a Laicos Account";
				$this->load->view('templates/header',$data);
				$this->load->view('registration_view',$data);
				$this->load->view('templates/footer',$data);
			}
			else
				echo "Invalid URL, sorry...";

		}

 }
 
 public function thank()
 {
  $data['title']= 'Thank you';
  $this->load->view('templates/header',$data);
  echo 'thanks for registering';
  $this->load->view('templates/footer',$data);
  
 }
 public function send()
 {
  //loading validator
  $this->load->library('form_validation');
  //field name, error message, validation rules
  $this->form_validation->set_rules('displayName', 'Display Name', 'trim|required|xss_clean');
  $this->form_validation->set_rules('firstName', 'First Name', 'trim|required|xss_clean');
  $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required|xss_clean');
  $this->form_validation->set_rules('tagline', 'Tagline', 'trim|required|xss_clean');
  $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
  $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
  $this->form_validation->set_rules('cityName', 'City', 'trim|required|xss_clean');
  $this->form_validation->set_rules('province', 'Province', 'trim|required|xss_clean');
  $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
  $this->form_validation->set_rules('privacy', 'Privacy', 'trim|required|xss_clean');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
  $this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');


  
  
		//if validation fails return to login view to retry registration
		if($this->form_validation->run() == FALSE)
		{
		$this->index();
		}
		else if ($this->registration_model->verify_duplicate_email() == TRUE)
		{
		echo 'This email is already registered. Enter a different email, or login';
		$this->index(); //redirect to login with delay
   		}
		else //if registration does not fail execute scripts to insert user into table
		{	
		$this->registration_model->add_user();
		echo 'You have successfully registered! You are being redirected to login.';
		redirect('main/welcome',5);
		//echo '<a href="'.site_url().'>main login page</a>';
		//header('refresh:3;url='.$this->login()); //redirect to login with delay
		}

  
  
  
  
  
		//if ($this->registration_model->verify_duplicate_email() == TRUE)
		//{
		//echo 'This email is already registered. You will be redirected to registration.';
		//header('refresh:9000;url='.$this->index(); //redirect to login with delay
   
		//}
    
 }
 
  public function sendtest() //function used for development only does not validate registration form sends data into db.
 {
  
  
  
  //loading validator
    $this->load->library('form_validation');
  //field name, error message, validation rules
  /*
  $this->form_validation->set_rules('displayName', 'Display Name', 'trim|required|xss_clean');
  $this->form_validation->set_rules('firstName', 'First Name', 'trim|required|xss_clean');
  $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required|xss_clean');
  $this->form_validation->set_rules('tagline', 'Tagline', 'trim|required|xss_clean');
  $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
  $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
  $this->form_validation->set_rules('cityName', 'City', 'trim|required|xss_clean');
  $this->form_validation->set_rules('province', 'Province', 'trim|required|xss_clean');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
  $this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');
  */
  //if validation fails return to login view to retry registration
  
if ($this->registration_model->verify_duplicate_email() == TRUE)
   {
   echo 'This email is already registered. You will be redirected to login.';
   //header('refresh:9000;url='.$this->login()); //redirect to login with delay
   //$this->registration_model->email_validation_error();
   }
   else
   {
				//if validation fails return to login view to retry registration
			 // if($this->form_validation->run() == FALSE)
			  //{
			  // $this->index();
			  //}

			  //else //if registration does not fail execute scripts to insert user into table
			  //{
			   $this->registration_model->add_user();
			   echo 'You have successfully registered! You are being redirected to login.';
			   header('refresh:3;url='.$this->login()); //redirect to login with delay
			  
			   
			  //}
	}  



 // $this->registration_model->add_user();
  // echo 'You have successfully registered! You are being redirected to login.';
  // header('refresh:3;url='.$this->login()); //redirect to login with delay
  
  
   
  
 }
 
 public function login()
 {
	redirect('login','refresh');
 }
 
  public function goToRegistration()
 {
	redirect('registration','refresh');
 }
}
?>
