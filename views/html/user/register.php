<?php

print_r($user->validate()->errors());
echo Form::open('user/register');
echo Form::label('email', 'E-mail');
echo Form::input('email', $user->email);
echo Form::label('username', 'Username');
echo Form::input('username', $user->username);
echo Form::label('password', 'Password');
echo Form::password('password');
echo Form::label('password_confirm', 'Confirm password');
echo Form::password('password_confirm');
echo Form::submit(NULL, 'Register');
echo Form::close();

?>
