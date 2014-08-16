<?php

class Relationship_model extends CRUD_model {
	
	protected $_table = 'relationship';
	protected $_primary_key = 'userID1';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}
	
}