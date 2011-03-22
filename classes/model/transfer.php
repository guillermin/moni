<?php defined('SYSPATH') or die('No direct script access.');

class Model_Transfer extends ORM {
	
	protected $_belongs_to = array(
		'movement' => array(),
		'equity' => array(),
	);
	
}
