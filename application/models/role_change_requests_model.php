<?php

class Role_Change_Requests_model extends CRUD_model {
	
	protected $_table = 'roleChangeRequests';
	protected $_primary_key = 'userID';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}


}