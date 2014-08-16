<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class settings_model extends CI_Model {


    	var $data = null;

	 public function __construct()
	 {
	  parent::__construct();
	  
	  
	  
	 }
 
	 public function timeStamp()
	{
	  
	 $sql = $this->db->select("*")->from("user")->where("email", $this->session->userdata('email'))->get();

			foreach ($sql->result() as $my_info) {
			$db_id = $my_info->userID;
			}
	 }
 
 
  	public function targetUserTimeStamp($userID)
	{
	  
	$now = new DateTime ( NULL, new DateTimeZone("America/New_York"));
	  	  
	$formatted = $now->format('Y-m-d H:i:s');
	
	$update = $this->db->query("UPDATE user SET dateModified='".$formatted."'WHERE userID= '".$userID."'") or die(mysql_error());
	 
	 }
 
 
 
 
 
 
	 public function change_password() //changes password of user logged in current session
		{
				$sql = $this->db->select("*")->from("user")->where("email", $this->session->userdata('email'))->get();

				foreach ($sql->result() as $my_info) {
				$db_password = $my_info->password;
				$db_id = $my_info->userID;
				}

				if(md5($this->input->post('opassword')) == $db_password){
				$fixed_pw = mysql_real_escape_string(md5($this->input->post('npassword')));
				$update = $this->db->query("UPDATE user SET password='".$fixed_pw."'WHERE userID= '".$db_id."'") or die(mysql_error());
				
				$updateTimeStamp = $this->timeStamp();								
				
				$this->form_validation->set_message('change','Password Updated');

				
				return true;
				}else{
				$this->form_validation->set_message('change', 'Wrong Old Password!');
				
				return false;

				}
		}
		
	
	 public function change_privacy() // updates table with user privacy: private / public
	{
			$sql = $this->db->select("*")->from("user")->where("email", $this->session->userdata('email'))->get();

			foreach ($sql->result() as $my_info) {
			$db_old_privacy = $my_info->privacy;
			$db_id = $my_info->userID;
			}

			$new_privacy = mysql_real_escape_string($this->input->post('privacy'));
			
			$update = $this->db->query("UPDATE user SET privacy='".$new_privacy."'WHERE userID= '".$db_id."'");
			
			$updateTimeStamp = $this->timeStamp();

			//$this->form_validation->set_message('change','Privacy Updated');
					
	
	
	
	}
	
	
	public function change_address() // updates address in user table
	{
			$sql = $this->db->select("*")->from("user")->where("email", $this->session->userdata('email'))->get();

			foreach ($sql->result() as $my_info) {
			$db_old_address = $my_info->address;
			$db_old_city = $my_info->cityName;
			$db_old_province = $my_info->province;
			$db_old_country = $my_info->country;
			$db_id = $my_info->userID;
			}
		
			$new_address = mysql_real_escape_string($this->input->post('address'));
			$new_city = mysql_real_escape_string($this->input->post('city'));
			$new_province = mysql_real_escape_string($this->input->post('province'));
			$new_country = mysql_real_escape_string($this->input->post('country'));

			if ($new_address == $db_old_address OR $new_address == '')
			{
				$new_address = $db_old_address;
			}
			
			if ($new_city == $db_old_city OR $new_city == '')
			{ 
				 $new_city = $db_old_city;
			}
			
			if ($new_province == $db_old_province OR $new_province == '')
			{
				$new_province = $db_old_province;				
			}
			
			if ($new_country == $db_old_country OR $new_country == '')
			{
				$new_province = $db_old_country;					
			}						
			
			$update = $this->db->query("UPDATE user SET address='1234', cityName='1234', province='1234', country='1234' WHERE userID= '".$db_id."'") or die(mysql_error());
									
	
			$update = $this->db->query("UPDATE user SET address='".$new_address."', cityName='".$new_city."', province='".$new_province."', country='".$new_country."'WHERE userID= '".$db_id."'") or die(mysql_error());
			//$update = $this->db->query("UPDATE user SET address='".$new_address."'WHERE userID= '".$db_id."'") or die(mysql_error());
			//$update = $this->db->query("UPDATE user SET cityName'".$new_city."'WHERE userID= '".$db_id."'") or die(mysql_error());
			//$update = $this->db->query("UPDATE user SET address='".$new_province."'WHERE userID= '".$db_id."'") or die(mysql_error());
			//$update = $this->db->query("UPDATE user SET address='".$new_country."'WHERE userID= '".$db_id."'") or die(mysql_error());
			
			$updateTimeStamp = $this->timeStamp();
						
	}
	
	 public function change_tagline() // updates tagline in user table
	{
			$sql = $this->db->select("*")->from("user")->where("email", $this->session->userdata('email'))->get();

			foreach ($sql->result() as $my_info) {
			$db_old_tagline = $my_info->tagline;
			$db_id = $my_info->userID;
			}

			$new_tagline = mysql_real_escape_string($this->input->post('tagline'));
			
			$update = $this->db->query("UPDATE user SET tagline='".$new_tagline."'WHERE userID= '".$db_id."'") or die(mysql_error());
			
			$updateTimeStamp = $this->timeStamp();
			
			$this->form_validation->set_message('change','Tagline Updated');
					
	}
	
	public function change_display_name() // updates display name in user table
	{
			$sql = $this->db->select("*")->from("user")->where("email", $this->session->userdata('email'))->get();

			foreach ($sql->result() as $my_info) {
			$db_old_display_name = $my_info->displayName;
			$db_id = $my_info->userID;
			}

			$new_display_name = mysql_real_escape_string($this->input->post('displayName'));
			
			$update = $this->db->query("UPDATE user SET displayName='".$new_display_name."'WHERE userID= '".$db_id."'") or die(mysql_error());
			
			$updateTimeStamp = $this->timeStamp();
					
					
	}
	
	
	
	
	
	public function update_role_status() // updates display name in user table selecting the user from the dropdown menu in the settings_view
	{
			
	
			$new_role = mysql_real_escape_string($this->input->post('role'));
			$new_status = mysql_real_escape_string($this->input->post('status'));
			$target_userID = mysql_real_escape_string($this->input->post('targetUser'));
			
			
			
			$update = $this->db->query("UPDATE user 
										SET role='".$new_role."', status='".$new_status."'
										WHERE userID= '".$target_userID."'") 
										or die(mysql_error());

			
			$updateTimeStamp = $this->targetUserTimeStamp($target_userID);
			
			
	}
	
	public function change_profile_photo()
	{
		
		$userID = $this->session->userdata('userID');
		
		if($this->upload->do_upload())
		{
			//echo $this->upload->data()['full_path'];
			
			$file_name = $this->upload->data()['file_name'];
			//var_dump($file_name);
			$update = $this->db->query("UPDATE user 
										SET profilePhoto='".$file_name."'
										WHERE userID= '".$userID."'") 
										or die(mysql_error());
			
		}
		else
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view ( 'post_error_view', $error );
		}
		
		$this->form_validation->set_message('change','Profile photo change completed');
	}
	
}
?>
