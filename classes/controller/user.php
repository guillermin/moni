<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Index {

	public $auth_required = FALSE;
	
	public function before()
	{
		parent::before();
		Auth::instance()->logout();
	}

	public function action_index()
	{
		$this->request->response = 'user';
	}
	
	public function action_login()
	{
		$username = Arr::get($this->input, 'username', NULL);
		$password = Arr::get($this->input, 'password', NULL);
		$remember = isset($this->input['remember']);
		$this->request->response = View::factory($this->request->param('format').'/user/login')
			->set('username', $username)
			->set('remember', $remember)
			->bind('error', $error);
		if ($username AND $password)
		{
			if (Auth::instance()->login($username, $password, $remember))
				$this->request->redirect('');
			else
				$error = 'Login failed.  Please use a valid username and password.';
		}
	}
	
	public function action_logout()
	{
		Cookie::delete('user');
	}
	
	public function action_register()
	{
		$this->request->response = View::factory($this->request->param('format').'/user/register')
			->bind('user', $this->user);
		$this->user = ORM::factory('user');
		if ( ! empty($this->input))
		{
			$this->user->values($this->input);
			if ($this->user->check())
			{
				$this->user->add('roles', ORM::factory('role', array('name' => 'login')));
				$this->user->save();
				$this->request->response = Request::factory('user/login.'.$this->request->param('format'))
					->execute()
					->response;
			}
		}
	}
	
}
