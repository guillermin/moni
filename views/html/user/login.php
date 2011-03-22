<?php

if (isset($error)) print_r($error);
echo Form::open('user/login');
echo Form::label('username', 'Username');
echo Form::input('username', $username);
echo Form::label('password', 'Password');
echo Form::password('password');
echo Form::label('remember', 'Remember me');
echo Form::checkbox('remember', NULL, $remember);
echo Form::submit(NULL, 'Login');
echo Form::close();
echo HTML::anchor('auth/register', 'Register');

?>
