<?php defined('SYSPATH') or die('No direct script access.');

class Model_Equity extends ORM {
	
	protected $_belongs_to = array(
		'parent' => array(
			'model' => 'equity',
			'foreign_key' => 'parent_id',
		),
		'user' => array(),
	);
	protected $_has_many = array(
		'children' => array(
			'model' => 'equity',
			'foreign_key' => 'parent_id',
		),
		'transfers' => array(
			'model' => 'transfer'
		),
		'movements' => array(
			'model' => 'movement',
			'through' => 'transfers',
		),
	);
	
	protected $_ignored_columns = array('balance');
	
	protected $_rules = array(
		'name' => array(
			'not_empty'  => NULL,
			'min_length' => array(3),
			'max_length' => array(150),
		),
		'description' => array(
			'max_length' => array(500),
		),
		'balance' => array(
			'digit' => NULL,
		),
	);
	
	public function balance($children = FALSE)
	{
		$balance = DB::select(array('SUM("amount")', 'balance'))
			->from('transfers')
			->where('equity_id', '=', $this->pk())
			->limit(1)
			->execute()
			->get('balance');
		if ($children)
		{
			foreach ($this->children->find_all() as $equity)
			{
				$balance += DB::select(array('SUM("amount")', 'balance'))
					->from('transfers')
					->where('equity_id', '=', $equity->pk())
					->limit(1)
					->execute()
					->get('balance');
			}
		}
		return $balance / 100;
	}
	
}
