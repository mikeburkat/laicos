<?php

class Has_Tag_model extends CRUD_model {
	
	protected $_table = 'has_tag';
	protected $_primary_key = 'tagID';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}
	
}