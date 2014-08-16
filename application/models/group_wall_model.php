<?php

class Group_Wall_model extends CRUD_model {
	
	protected $_table = 'clubWall';
	protected $_primary_key = 'clubID';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}


}