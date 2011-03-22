<dl>
	<dt>ID</dt>
	<dd><?php echo $equity->id; ?></dd>
	<dt>Name</dt>
	<dd><?php echo $equity->name; ?></dd>
	<dt>Description</dt>
	<dd><?php echo $equity->description; ?></dd>
	<dt>Balance</dt>
	<dd><?php echo number_format($equity->balance(), 2); ?></dd>
	<dt>Movements</dt>
	<dd><?php echo HTML::anchor('equity/movements/'.$equity->id.'.html', $equity->transfers->count_all()); ?></dd>
</dl>
<?php echo HTML::anchor('equity/edit/'.$equity->id.'.html', 'Edit equity'); ?>
