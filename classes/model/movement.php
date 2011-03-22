<?php defined('SYSPATH') or die('No direct script access.');

class Model_Movement extends ORM {
	
	protected $_transactions = array(
		'incomes' => array(),
		'transfers' => array(),
		'expenses' => array(),
	);
	
	protected $_belongs_to = array(
		'user' => array(),
	);
	protected $_has_many = array(
		'incomes' => array('model' => 'income'),
		'transfers' => array('model' => 'transfer'),
		'expenses' => array('model' => 'expense'),
		'sources' => array(
			'model' => 'source',
			'through' => 'incomes',
		),
		'equities' => array(
			'model' => 'equity',
			'through' => 'transfers',
		),
		'drains' => array(
			'model' => 'drain',
			'through' => 'expenses',
		),
	);
	
	protected $_rules = array(
		'name' => array(
			'not_empty'  => NULL,
			'min_length' => array(3),
			'max_length' => array(150),
		),
		'description' => array(
			'max_length' => array(500),
		),
		'timestamp' => array(
			'digit' => NULL,
		),
	);
	
	protected $_sorting = array(
		'timestamp' => 'desc',
	);
	
	public function add_transaction(ORM $model)
	{
		$this->_transactions[$model->_object_plural][] = $model;
		return $this;
	}
	
	public function get_transactions($type = NULL)
	{
		if ($type !== NULL)
		{
			return $this->_transactions[$type];
		}
		return $this->_transactions;
	}
	
	public function check()
	{
		if ( ! parent::check())
		{
			return FALSE;
		}
		if (count($this->_transactions['incomes']) == 0 AND count($this->_transactions['transfers']) == 0 AND count($this->_transactions['expenses']) == 0)
		{
			$this->_validate->error('balance', 'No transactions');
			return FALSE;
		}
		$balance = 0;
		foreach ($this->_transactions as $type => $transactions)
		{
			switch ($type)
			{
				case 'incomes':
					foreach ($transactions as $transaction)
					{
						$balance += $transaction->amount;
					}
					break;
				default:
					foreach ($transactions as $transaction)
					{
						$balance -= $transaction->amount;
					}
			}
		}
		if ($balance != 0)
		{
			$this->_validate->error('balance', 'Not zero');
			return FALSE;
		}
		return TRUE;
	}
	
	public function save()
	{
		parent::save();
		$this->incomes->delete_all();
		$this->transfers->delete_all();
		$this->expenses->delete_all();
		foreach ($this->_transactions as $type => $transactions)
		{
			foreach ($transactions as $transaction)
			{
				$transaction->movement_id = $this->pk();
				$transaction->save();
			}
		}
		return $this;
	}
	
	public function date_range()
	{
		return DB::select(array('MIN("timestamp")', 'min'), array('MAX("timestamp")', 'max'))
			->from($this->_table_name)
			->where('user_id', '=', $this->user_id)
			->limit(1)
			->execute()
			->current();
	}
	
	public function cashflow($user_id, $from = 0, $to = NULL)
	{
		if ( ! $to) $to = time();
		$incomes = DB::select('source_id', array('SUM("incomes"."amount")', 'sum'))
			->from('incomes')
			->join('movements')->on('movements.id', '=', 'incomes.movement_id')
			->where('movements.user_id', '=', $user_id)
			->where('movements.timestamp', '>=', $from)
			->where('movements.timestamp', '<=', $to)
			->group_by('source_id')
			->execute()
			->as_array('source_id', 'sum');
		$expenses = DB::select('drain_id', array('SUM("amount")', 'sum'))
			->from('expenses')
			->join('movements')->on('movements.id', '=', 'expenses.movement_id')
			->where('movements.user_id', '=', $user_id)
			->where('movements.timestamp', '>=', $from)
			->where('movements.timestamp', '<=', $to)
			->group_by('drain_id')
			->execute()
			->as_array('drain_id', 'sum');
		return array(
			'incomes' => $incomes,
			'expenses' => $expenses,
		);
	}
	
}
