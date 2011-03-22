<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Movement extends Controller_Index {

	public $auth_required = TRUE;
	protected $movement;

	public function action_index()
	{
		$this->request->response = 'movement';
	}
	
	public function action_add()
	{
		$this->request->response = View::factory($this->request->param('format').'/movement/add')
			->bind('movement', $this->movement)
			->set('sources', ORM::factory('source')->where('parent_id', 'IS', NULL)->find_all()->as_array('id', 'name'))
			->set('equities', $this->user->equities->where('parent_id', 'IS', NULL)->find_all()->as_array('id', 'name'))
			->set('drains', ORM::factory('drain')->where('parent_id', 'IS', NULL)->find_all()->as_array('id', 'name'));
		$this->movement = ORM::factory('movement')->values(array(
			'user_id' => $this->user->id,
			'timestamp' => time(),
		));
		if ( ! empty($this->input))
		{
			$this->movement->values($this->input);
			$transactions = Arr::extract($this->input, array('incomes', 'transfers', 'expenses'), array());
			foreach ($transactions as $type => $transaction_array)
			{
				foreach ($transaction_array as $transaction)
				{
					$this->movement->add_transaction(ORM::factory(rtrim($type, 's'))->values($transaction));
				}
			}
			if ($this->movement->check())
			{
				$this->movement->save();
				$this->request->redirect('movement/view/'.$this->movement->id.'.'.$this->request->param('format'));
			}
		}
	}
	
	public function action_edit()
	{
		$this->request->response = View::factory($this->request->param('format').'/movement/edit')
			->bind('movement', $this->movement)
			->set('sources', ORM::factory('source')->where('parent_id', 'IS', NULL)->find_all()->as_array('id', 'name'))
			->set('equities', $this->user->equities->where('parent_id', 'IS', NULL)->find_all()->as_array('id', 'name'))
			->set('drains', ORM::factory('drain')->where('parent_id', 'IS', NULL)->find_all()->as_array('id', 'name'));
		$this->movement = ORM::factory('movement', $this->request->param('id'));
		if (isset($this->input['name']))
		{
			$this->movement->values($this->input);
			$transactions = Arr::extract($this->input, array('incomes', 'transfers', 'expenses'), array());
			foreach ($transactions as $type => $transaction_array)
			{
				foreach ($transaction_array as $transaction)
				{
					$this->movement->add_transaction(ORM::factory(rtrim($type, 's'))->values($transaction));
				}
			}
			if ($this->movement->check())
			{
				$this->movement->save();
				$this->request->redirect('movement/view/'.$this->movement->id.'.'.$this->request->param('format'));
			}
		}
		else
		{
			foreach ($this->movement->incomes->find_all() as $income)
			{
				$this->movement->add_transaction($income);
			}
			foreach ($this->movement->transfers->find_all() as $transfer)
			{
				$this->movement->add_transaction($transfer);
			}
			foreach ($this->movement->expenses->find_all() as $expense)
			{
				$this->movement->add_transaction($expense);
			}
		}
	}
	
	public function action_cashflow()
	{
		$this->request->response = View::factory($this->request->param('format').'/movement/cashflow')
			->set('user_id', $this->user->id)
			->set('sources', ORM::factory('source')
				->where('parent_id', 'IS', NULL)
				->where('name', '!=', 'Opening balance')
				->find_all())
			->set('drains', ORM::factory('drain')->where('parent_id', 'IS', NULL)->find_all())
			->bind('intervals', $intervals);
		$intervals = array(
			array(
				'name' => 'January',
				'start' => mktime(0,0,0,1,1),
				'end' => mktime(0,0,0,2,1),
			),
			array(
				'name' => 'February',
				'start' => mktime(0,0,0,2,1),
				'end' => mktime(0,0,0,3,1),
			),
			array(
				'name' => 'March',
				'start' => mktime(0,0,0,3,1),
				'end' => mktime(0,0,0,4,1),
			),
			array(
				'name' => 'April',
				'start' => mktime(0,0,0,4,1),
				'end' => mktime(0,0,0,5,1),
			),
			array(
				'name' => 'May',
				'start' => mktime(0,0,0,5,1),
				'end' => mktime(0,0,0,6,1),
			),
			array(
				'name' => 'June',
				'start' => mktime(0,0,0,6,1),
				'end' => mktime(0,0,0,7,1),
			),
			array(
				'name' => 'July',
				'start' => mktime(0,0,0,7,1),
				'end' => mktime(0,0,0,8,1),
			),
			array(
				'name' => 'August',
				'start' => mktime(0,0,0,8,1),
				'end' => mktime(0,0,0,9,1),
			),
			array(
				'name' => 'September',
				'start' => mktime(0,0,0,9,1),
				'end' => mktime(0,0,0,10,1),
			),
			array(
				'name' => 'October',
				'start' => mktime(0,0,0,10,1),
				'end' => mktime(0,0,0,11,1),
			),
			array(
				'name' => 'November',
				'start' => mktime(0,0,0,11,1),
				'end' => mktime(0,0,0,12,1),
			),
			array(
				'name' => 'December',
				'start' => mktime(0,0,0,12,1),
				'end' => mktime(0,0,0,1,1,date("Y")+1),
			),
		);
	}
	
	public function action_view()
	{
		$this->request->response = View::factory($this->request->param('format').'/movement/view')
			->bind('movement', $this->movement);
		$this->movement = ORM::factory('movement', $this->request->param('id'));
	}
	
	public function action_find()
	{
		$this->request->response = View::factory($this->request->param('format').'/movement/find')
			->bind('movements', $movements);
		$movements = $this->user->movements->find_all();
	}
	
	public function action_delete()
	{
		$this->movement = ORM::factory('movement', $this->request->param('id'));
		$this->movement->delete();
		$this->request->redirect('');
	}
	
}
