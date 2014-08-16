<?php

class CRUD_model extends CI_Model {
	
	protected $_table = null;
	protected $_primary_key = null;
	
	//-------------------------------------------------------------------------------------------------
	
	public function __construct() {
		parent::__construct();
	}
	
	//-------------------------------------------------------------------------------------------------
	
	public function get($id = null, $join = null, $order_by = null, $select = null, $like = null) {
		if ($id == null) {
			$q = $this->db->get($this->_table);
			return $q->result_array();
		}
		
		elseif (is_numeric($id)) {
			$this->db->where($this->_primary_key, $id);
		} 
		
		elseif (is_array($id)) {
			foreach ($id as $_key => $_value) {
				$this->db->where($_key, $_value);
			}
		}
		
		if ($select) {
			$this->db->select($select);
		}
		
		$this->db->from($this->_table);
		
		if (is_array($join)) {
			foreach ($join as $_key => $_value) {
				$this->db->join($_key, $_value);
			}
		}
		
		if ($order_by) {
			foreach ($order_by as $_key => $_value) {
				$this->db->order_by($_key, $_value);
			}
		}
		
		if ($like) {
			foreach ($like as $_key => $_value) {
				$this->db->like($_key, $_value);
			}
		}
		
		$q = $this->db->get();
		return $q->result_array();
	}
	
	//-------------------------------------------------------------------------------------------------
	
	public function insert($data) {
		$this->db->trans_start();
		$this->db->insert($this->_table, $data);
		$id = $this->db->insert_id();
		if (!$id) {
			$id = $this->db->affected_rows();
		}
		$this->db->trans_complete();
		return $id;
	}
	
	//-------------------------------------------------------------------------------------------------
	
	public function update($new_data, $where) {
	
// 		$this->db->where(['user_id' => $user_id]);
// 		$this->db->update('user', $data);
		
		if (is_numeric($where)) {
			$this->db->where($this->_primary_key, $where);
		} elseif (is_array($where)) {
			foreach ($where as $_key => $_value) {
				$this->db->where($_key, $_value);
			}
		} else {
			die('You must pass a second parameter to the UPDATE() method.');
		}
		
		
		$this->db->update($this->_table, $new_data);
		
		return $this->db->affected_rows();
	
	}
	
	//-------------------------------------------------------------------------------------------------
	
	public function delete($id) {
		
		if (is_numeric($id)) {
			$this->db->where($this->_primary_key, $id);
		} elseif (is_array($id)) {
			foreach ($id as $_key => $_value) {
				$this->db->where($_key, $_value);
			}
		} else {
			die('You must pass a parameter to the DELETE() method.');
		}
		$this->db->delete($this->_table);
	
		return $this->db->affected_rows();
	}
	
	
	//-------------------------------------------------------------------------------------------------
	// inserts or updates if present
	public function insertUpdate($data, $id) {
		
		if (!$id) {
			die('You must pass a second parameter to the INSERTUPDATE() method.');
		}
		
		$this->db->select($this->_primary_key);
		$this->db->where($this->_primary_key, $id);
		$q = $this->db->get($this->_table);
		$result = $q->num_rows();
		
		if ($result == 1) {
			return $this->update($data, $id);
		} else {
			return $this->insert($data);
		}
		
		return $result;
	}
	
}