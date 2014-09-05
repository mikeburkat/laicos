<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registration_model extends CI_Model {
 public function __construct()
 {
  parent::__construct();
  $this->load->helper('date');
  
 }
 
 
 
 
 public function add_user()
 {
 //Create variable to store timestamp
 $now = new DateTime ( NULL, new DateTimeZone("America/New_York"));

 $data=array(
    'displayName'=>$this->input->post('displayName'),
	'firstName'=>$this->input->post('firstName'),
	'lastName'=>$this->input->post('lastName'),
	'dateOfBirth'=>$this->input->post('dateOfBirth'),
	'tagline'=>$this->input->post('tagline'),
	'email'=>$this->input->post('email'),
	'address'=>$this->input->post('address'),
	'cityName'=>$this->input->post('cityName'),
	'province'=>$this->input->post('province'),
	'country'=>$this->input->post('country'),
	'privacy'=>$this->input->post('privacy'),
	//'dateCreated'=> date('Y-m-d H:i:s'),//$this->input->post->('dateCreated'),
	'dateCreated'=> $now->format('Y-m-d H:i:s'),// this works formatted
	'currentLogin'=> $now->format('Y-m-d H:i:s'),
	'password'=>md5($this->input->post('password'))
	
  );
  $this->db->insert('user',$data);
 }
 
 
 public function verify_duplicate_email()
 {
	$user_email = $this->input->post('email');

	//$query = $this->db->get('user');	
	//$this->db->where('email', $user_email);
	
	$query = $this->db->get_where('user', array('email' => $user_email));
  
    $count_row = $query->num_rows();

    if ($count_row > 0) {
      //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
        return TRUE; // TRUE means there is duplicate
     } else {
      // doesn't return any row means database doesn't have this email
        return FALSE; // FALSE means there is no duplicate
     }
 
 
 
 
 }
 
  public function email_validation_error()
 {
	echo 'This email is already registered. You will be redirected to login.';
 }
 
 
 
 
 
 
 
 
 
}
?>