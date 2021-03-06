<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends CI_Controller{

		var $data = null;

		 public function __construct()
		 {
		  parent::__construct();
		  //global $site_name;
		  $this->load->database();
		  $this->load->library('form_validation');
		  $this->load->library('upload');
		  $this->load->model('settings_model');
		  $this->load->model('user_model');		
		  
		 }
 
		 public function index()
		  {
				$data['projectName'] = site_name;
				$data['title'] = "Update your user settings";
				//$this->load->view('templates/header',$data);
				//$this->load->view('settings_view',$data);
				//$this->load->view('templates/footer',$data);
					
			
		 }
	 
		 public function change_password(){ //changes password after verifying with the form validator
		 
				$this->load->library('form_validation');
				$this->form_validation->set_rules('opassword','Old Password','required|trim|xss_clean|callback_change');
				$this->form_validation->set_rules('npassword','New Password','required|trim');
				$this->form_validation->set_rules('cpassword','Confirm Password','required|trim|matches[npassword]');

				if($this->form_validation->run() == FALSE)
				{
				//$this->load->view('settings_view');
				$this->index();
				}
				else //if registration does not fail execute scripts to insert user into table
				  {
				   $this->settings_model->change_password();
				   //echo 'You have successfully changed your password! You are being redirected to home.';
				  redirect('main/welcome','refresh');	 
				//header('refresh:3000;url='.$this->go_home()); //redirect to home with delay
				  
				   
				}
		}

		public function change_privacy(){
		 
				// change privacy between public and private profiles.
				$this->settings_model->change_privacy();
				//echo 'You have successfully changed your privacy! You are being redirected to home.';
				redirect('main/welcome','refresh');				
				//$this->go_home());
				//header('refresh:3000;url='.$this->go_home()); //redirect to home with delay
					 		

			
		}
		
		public function change_profile_photo(){
 
			// change privacy between public and private profiles.
			$this->settings_model->change_profile_photo();
			//echo 'you have successfully changed your profile photo!';
			//header('refresh:90000;url='.$this->go_home()); //redirect to home with delay
			redirect('main/welcome','refresh');			
		}
		public function change_address(){
	 
				// change privacy between public and private profiles.
				$this->settings_model->change_address();
				//echo 'You have successfully changed your address! You are being redirected to home.';
				//header('refresh:3000;url='.$this->go_home()); //redirect to home with delay
 				redirect('main/welcome','refresh');	
		
		}
		
		public function change_tagline(){

				// change privacy between public and private profiles.
				$this->settings_model->change_tagline();
				//echo 'You have successfully changed your tagline! You are being redirected to home.';
				//header('refresh:3000;url='.$this->go_home()); //redirect to home with delay
				redirect('main/welcome','refresh');	

		}
		
		
		public function change_display_name(){

				// change privacy between public and private profiles.
				$this->settings_model->change_display_name();
				//echo 'You have successfully changed your display name! You are being redirected to home.';
				//header('refresh:3000;url='.$this->go_home()); //redirect to home with delay
				redirect('main/welcome','refresh');	

		}
		
		
		public function change_user_role_status(){

				// change user role to admin or senior, and status to inactive or suspended
				$this->settings_model->update_role_status();	

				//echo 'You have successfully changed a users role and status! You are being redirected to home.';
				//header('refresh:3000;url='.$this->go_home()); //redirect to home with delay
				redirect('main/welcome','refresh');	

		}
		
		public function change_user_profile()
		{
			
		}
				
		public function go_home()
		 {
			redirect('main/welcome','refresh');
		 }
	

	}
?>
