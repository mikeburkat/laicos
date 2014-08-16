<?php

class User_model extends CRUD_model {

	protected $_table = 'user';
	protected $_primary_key = 'userID';

	//-------------------------------------------------------------------------------------------------


	public function __construct() {
		parent::__construct();
		
				
	}

	function login($email, $password)
	{
		$this -> db -> select('userID, email, password, role, status, privacy');
		$this -> db -> from('user');
		$this -> db -> where('email', $email);
		$this -> db -> where('password', MD5($password));
		$this -> db -> limit(1);

		$query = $this -> db -> get();

// 		print_r($this->db->last_query());
// 		die();

		if($query -> num_rows() == 1)
		{
			
			$updateTimeStamp = $this->loginTimeStamp($email);
			return $query->result();
			
		}
		else
		{
			return false;
		}
		
	}
	
		 public function NOTUSEDloginTimeStamp()
	{
	  
	 $sql = $this->db->select("*")->from("user")->where("email", $this->session->userdata('email'))->get();

			foreach ($sql->result() as $my_info) {
			$db_id = $my_info->userID;
			}
	  
	$now = new DateTime ( NULL, new DateTimeZone("America/New_York"));
	  	  
	$formatted = $now->format('Y-m-d H:i:s');
	
	$update = $this->db->query("UPDATE user SET currentLogin='".$formatted."'WHERE userID= '".$db_id."'") or die(mysql_error());
	 
	 }
	
	
	
		 public function loginTimeStamp($email)
	{
	  		  
	$now = new DateTime ( NULL, new DateTimeZone("America/New_York"));
	  	  
	$formatted = $now->format('Y-m-d H:i:s');
	
	//$last = $this->db->query("SELECT currentLogin FROM user WHERE email = '".$email."'");
	$last = mysql_query("SELECT currentLogin FROM user WHERE email = '".$email."'");

	while($row = mysql_fetch_assoc($last))
	{
		$updateagain = $this->db->query("UPDATE user SET lastLogin='".$row['currentLogin']."'WHERE email= '".$email."'") or die(mysql_error());
	}
	$update = $this->db->query("UPDATE user SET currentLogin='".$formatted."'WHERE email= '".$email."'") or die(mysql_error());
	
	 
	}
	
		
	public function get_user_array($userID){
		if ($userID != FALSE) {
			$query = $this->db->get_where('user', array('userID' => $userID));
			return $query->row_array();
		}
		else {
			return FALSE;
		}
	}
	public function get_user_setting($userID,$column){
		$user_array = $this->User_model->get_user_array($userID);
		$column = $user_array[$column];
		return $column;
	}

	public function set_user_setting($userID,$setting,$value)
	{
		$this->load->database();
		$data = array(
		$setting => $value,
		);

		$this->db->where('userID', $userID);
		$this->db->update('user', $data);
	}

	// returns array of friend user IDs
	public function get_user_friends($userID)
	{
		if ($userID != FALSE) {
			$this->db->distinct();
			$this->db->select('userID2');
			$query = $this->db->get_where('relationship', array('userID1' => $userID));
			return $query->result_array();
		}
		else {
			return FALSE;
		}
	}

	public function get_user_role($userID)
	{
		if ($userID != FALSE) {
			$this->db->select('role');
			$query = $this->db->get_where('user', array('userID' => $userID));
			return $query->result_array();
		}
		else {
			return FALSE;
		}
	}
	
	
	public function get_all_users()
	{
			$this->db->select('userID', 'firstName');
			$this->db->from('user');
			$this->db->order_by('firstName', 'asc');
			$query = $this->db->get();
			
			$result = $query->result_array();
			
			return $result;
				
	}
	
	public function get_junior_or_senior_users()
	{
			$this->db->select('userID', 'firstName');
			$this->db->from('user');
			$this->db->where('role', 'junior');
			$this->db->or_where('role', 'senior');
			$this->db->order_by('firstName', 'asc');
			$query = $this->db->get();
			
			$result = $query->result_array();
			
			return $result;
				
	}
	
	public function get_public_users()
	{
			$this->db->select('userID', 'firstName');
			$this->db->from('user');
			$this->db->where('privacy', 'public');
			$query = $this->db->get();
			
			$result = $query->result_array();
			
			return $result;
				
	}
	
	
	public function get_user_groups($userID)
	{
		if ($userID != FALSE) {
			$this->db->select('clubID');
			$query = $this->db->get_where('membership', array('userID' => $userID));
			return $query->result_array();
		}
		else {
			return FALSE;
		}
	}

	public function get_user_posts($userID)
	{
		$query = $this->db->query ( 'SELECT PostID FROM post
		WHERE userID =' . $userID .  ' GROUP BY PostID DESC;'); //  ' GROUP_BY PostID DESC;'
		$row = $query->result_array ();
		//var_dump($row);
		return $row;
	}

	public function get_user_gifts($userID)
	{
		$this->db->select('giftGiven, senderID');
		$this->db->from('gifts');
		$this->db->where('receiverID', $userID);
		$query = $this->db->get();
		
		$result = $query->result_array();
		
		return $result;
	}
	
	public function get_my_user_pic()
	{
		$sql = $this->db->select("*")->from("user")->where("email", $this->session->userdata('email'))->get();
		foreach ($sql->result() as $my_info) {
		$db_pic = $my_info -> profilePhoto;
		}
		
		$profilePicPath = site_url().'$db_pic';
		return $profilePicPath;
	}
	
	
	

}
