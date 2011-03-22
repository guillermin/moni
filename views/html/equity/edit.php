<?php if (isset($equity->errors)) print_r($equity->errors); ?>
<?php echo Form::open('equity/edit/'.$equity->id); ?>
<dl>
	<dt><?php echo Form::label('parent_id', 'Parent'); ?></dt>
	<dd><?php echo Form::select('parent_id', array('None') + $equities, $equity->parent_id); ?></dd>
	<dt><?php echo Form::label('name', 'Name'); ?></dt>
	<dd><?php echo Form::input('name', $equity->name); ?></dd>
	<dt><?php echo Form::label('description', 'Description'); ?></dt>
	<dd><?php echo Form::textarea('description', $equity->description); ?></dd>
</dl>
<?php
echo Form::submit(NULL, 'Save changes');
echo Form::close();
?>
