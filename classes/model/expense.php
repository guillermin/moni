<?php defined('SYSPATH') or die('No direct script access.');

class Model_Expense extends ORM {
	
	protected $_belongs_to = array(
		'movement' => array(),
		'drain' => array(),
	);
	
}