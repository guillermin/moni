<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Source extends Controller_Index {

	public $auth_required = FALSE;
	protected $source;

	public function action_index()
	{
		$this->request->response = 'source';
	}
	
	public function action_view()
	{
		$this->source = ORM::factory('source', $this->request->param('id'));
		$this->request->response = View::factory($this->request->param('format').'/source/view')
			->bind('source', $this->source);
	}
	
}
