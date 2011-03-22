<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Equity extends Controller_Index {

	public $auth_required = TRUE;
	protected $equity;
	
	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		$this->request->response = View::factory($this->request->param('format').'/equity/index')
			->bind('equities', $equities);
		$equities = $this->user->equities->where('parent_id', 'IS', NULL)->find_all();
	}
	
	public function action_add()
	{
		$this->equity = ORM::factory('equity')
			->values($this->input);
		if ($this->equity->parent_id == 0) $this->equity->parent_id = NULL;
		$this->equity->user_id = $this->user->id;
		$this->request->response = View::factory($this->request->param('format').'/equity/add')
			->bind('equity', $this->equity)
			->set('equities', ORM::factory('equity')->where('parent_id', 'IS', NULL)->find_all()->as_array('id', 'name'));
		if ($this->equity->check())
		{
			$this->equity->save();
			if ($this->equity->balance)
			{
				$movement = ORM::factory('movement')->values(array(
					'user_id' => $this->user->id,
					'timestamp' => ($this->input['timestamp']) ? $this->input['timestamp'] : time(),
					'name' => 'Opening balance',
					'description' => 'Opening balance for '.$this->equity->name,
				))->save();
				$movement->add('sources', ORM::factory('source', array('name' => 'Opening balance')), array(
					'amount' => $this->equity->balance
				));
				$movement->add('equities', $this->equity, array(
					'amount' => $this->equity->balance
				));
			}
			$this->request->redirect('equity/view/'.$this->equity->id.'.'.$this->request->param('format'));
		}
	}
	
	public function action_edit()
	{
		$this->request->response = View::factory($this->request->param('format').'/equity/edit')
			->bind('equity', $this->equity)
			->set('equities', ORM::factory('equity')->where('parent_id', 'IS', NULL)->find_all()->as_array('id', 'name'));
		$this->equity = ORM::factory('equity', $this->request->param('id'));
		if (isset($this->input['name']))
		{
			$this->equity->values($this->input);
			if ($this->equity->parent_id == 0)
				$this->equity->parent_id = NULL;
			if ($this->equity->check())
			{
				$this->equity->save();
				$this->request->redirect('equity/view/'.$this->equity->id.'.'.$this->request->param('format'));
			}
		}
	}
	
	public function action_view()
	{
		$this->request->response = View::factory($this->request->param('format').'/equity/view')
			->bind('equity', $this->equity);
		$this->equity = ORM::factory('equity', $this->request->param('id'));
	}
	
	public function action_find()
	{
		$this->request->response = View::factory($this->request->param('format').'/equity/find')
			->bind('equities', $equities);
		$equities = $this->user->equities->find_all();
	}
	
	public function action_movements()
	{
		$this->request->response = View::factory($this->request->param('format').'/equity/movements')
			->bind('equity', $this->equity);
		$this->equity = ORM::factory('equity', $this->request->param('id'));
	}

}
