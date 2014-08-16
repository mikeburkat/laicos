<?php

class Tag_model extends CRUD_model {
	
	protected $_table = 'tag';
	protected $_primary_key = 'tagID';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}
	
}