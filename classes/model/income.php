<?php defined('SYSPATH') or die('No direct script access.');

class Model_Income extends ORM {
	
	protected $_belongs_to = array(
		'movement' => array(),
		'source' => array(),
	);
	
}
