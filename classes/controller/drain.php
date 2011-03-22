<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Drain extends Controller_Index {

	public $auth_required = FALSE;
	protected $drain;

	public function action_index()
	{
		$this->request->response = 'drain';
	}
	
	public function action_view()
	{
		$this->drain = ORM::factory('drain', $this->request->param('id'));
		$this->request->response = View::factory($this->request->param('format').'/drain/view')
			->bind('drain', $this->drain);
	}
	
}
