<?php defined('SYSPATH') or die('No direct script access.');

class Model_Source extends ORM {
	
	protected $_belongs_to = array(
		'parent' => array(
			'model' => 'source',
			'foreign_key' => 'parent_id',
		),
	);
	protected $_has_many = array(
		'children' => array(
			'model' => 'source',
			'foreign_key' => 'parent_id',
		),
		'incomes' => array(
			'model' => 'income'
		),
		'movements' => array(
			'model' => 'movement',
			'through' => 'incomes',
		),
	);
	
	public function cashflow($user_id, $from, $to, $children = FALSE)
	{
		$sources = DB::select('id')
			->from('sources')
			->where('id', '=', $this->pk());
		if ($children)
		{
				$sources->or_where('parent_id', '=', $this->pk());
		}
		return DB::select(array('SUM("amount")', 'amount'))
			->from('incomes')
			->join('movements')->on('movements.id', '=', 'incomes.movement_id')
			->where('source_id', 'IN', $sources)
			->where('movements.user_id', '=', $user_id)
			->where('movements.timestamp', '>=', $from)
			->where('movements.timestamp', '<', $to)
			->execute()
			->get('amount') / 100;
	}
	
}
