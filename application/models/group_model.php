<?php

class Group_model extends CRUD_model {
	
	protected $_table = 'club';
	protected $_primary_key = 'clubID';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}
	
	public function get_group_array($groupID){
		if ($groupID != FALSE) {
			$query = $this->db->get_where('club', array('clubID' => $groupID));
			return $query->row_array();
		}
		else {
			return FALSE;
		}
	}
	public function get_group_setting($groupID,$column){
		$group_array = $this->Group_model->get_group_array($groupID);
		$column = $group_array[$column];
		return $column;
	}

	public function set_group_setting($groupID,$setting,$value)
	{
		$this->load->database();
		$data = array(
		$setting => $value,
		);

		$this->db->where('clubID', $groupID);
		$this->db->update('club', $data);
	}
}