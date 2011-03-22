<?php if (isset($equity->errors)) print_r($equity->errors); ?>
<?php echo Form::open('equity/add'); ?>
<dl>
	<dt><?php echo Form::label('parent_id', 'Parent'); ?></dt>
	<dd><?php echo Form::select('parent_id', array('None') + $equities, 0); ?></dd>
	<dt><?php echo Form::label('name', 'Name'); ?></dt>
	<dd><?php echo Form::input('name', $equity->name); ?></dd>
	<dt><?php echo Form::label('description', 'Description'); ?></dt>
	<dd><?php echo Form::textarea('description', $equity->description); ?></dd>
</dl>
<fieldset>
	<legend>Opening balance</legend>
	<dl>
		<dt><?php echo Form::label('balance', 'Opening balance'); ?></dt>
		<dd><?php echo Form::input('balance'); ?></dd>
		<dt><?php echo Form::label('datetime', 'Datetime'); ?></dt>
		<dd>
			<?php echo Form::input('datetime', date('Y/m/d H:i')); ?>
			<?php echo Form::hidden('timestamp'); ?>
		</dd>
	</dl>
</fieldset>
<?php echo Form::submit(NULL, 'Add'); ?>
<?php echo Form::close(); ?>
