<?php defined('SYSPATH') or die('No direct script access.');

class Model_Drain extends ORM {
	
	protected $_belongs_to = array(
		'parent' => array(
			'model' => 'drain',
			'foreign_key' => 'parent_id',
		),
	);
	protected $_has_many = array(
		'children' => array(
			'model' => 'drain',
			'foreign_key' => 'parent_id',
		),
		'expenses' => array(
			'model' => 'expense'
		),
		'movements' => array(
			'model' => 'movement',
			'through' => 'expenses',
		),
	);
	
	public function cashflow($user_id, $from, $to, $children = FALSE)
	{
		$drains = DB::select('id')
			->from('drains')
			->where('id', '=', $this->pk());
		if ($children)
		{
				$drains->or_where('parent_id', '=', $this->pk());
		}
		return DB::select(array('SUM("amount")', 'amount'))
			->from('expenses')
			->join('movements')->on('movements.id', '=', 'expenses.movement_id')
			->where('drain_id', 'IN', $drains)
			->where('movements.user_id', '=', $user_id)
			->where('movements.timestamp', '>=', $from)
			->where('movements.timestamp', '<', $to)
			->execute()
			->get('amount') / 100;
	}
	
}
