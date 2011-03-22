<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller {

	protected $auth_required = FALSE;
	protected $supported_formats = array(
		'html',
		'json',
	);
	protected $input;
	protected $user;

	public function before()
	{
		parent::before();
		
		if ( ! in_array($this->request->param('format'), $this->supported_formats))
			throw new Controller_Exception_404('File not found');
		
		$this->input = array_merge($_GET, $_POST);
		
		$this->user = ORM::factory('user', Auth::instance()->get_user());
		if ($this->auth_required AND ! $this->user->loaded())
		{
			$this->request->redirect('user/login');
		}
	}

	public function action_index()
	{
		if ( ! $this->user->loaded())
		{
			$this->request->response = View::factory($this->request->param('format').'/index/guest');
		}
		else
		{
			$this->request->response = View::factory($this->request->param('format').'/index/user')
				->bind('user', $this->user);
		}
	}

	public function after()
	{
		if ($this->request === Request::instance())
		{
			if ($this->request->param('format') == 'html')
			{
				$this->request->response = View::factory('html/template')->set(array(
					'title' => 'Moni - The personal finance manager',
					'styles' => array(
						'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/smoothness/jquery-ui.css' => 'screen',
						'media/css/default.css' => 'screen',
					),
					'scripts' => array(
						'https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js',
						'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js',
						'media/js/jquery-ui-timepicker-addon.js',
						'media/js/jquery.maskMoney.js',
						'media/js/default.js',
					),
					'content' => $this->request->response,
				));
			}
			elseif ($this->request->param('format') == 'json')
			{
				$this->request->headers['Content-Type'] = 'application/json';
			}
		}
		parent::after();
	}

}
