<div id="info">
	<dl>
		<dt>ID</dt>
		<dd><?php echo $movement->id; ?></dd>
		<dt>Name</dt>
		<dd><?php echo $movement->name; ?></dd>
		<dt>Description</dt>
		<dd><?php echo $movement->description; ?></dd>
		<dt>Datetime</dt>
		<dd><?php echo date('d/m/Y H:i', $movement->timestamp); ?></dd>
	</dl>
</div>
<div id="incomes">
	<?php foreach ($movement->incomes->find_all() as $income): ?>
		<dl>
			<dt>ID</dt>
			<dd><?php echo $income->id ?></dd>
			<dt>Source</dt>
			<dd><?php echo $income->source->name ?></dd>
			<dt>Amount</dt>
			<dd><?php echo number_format(($income->amount / 100), 2) ?></dd>
		</dl>
	<?php endforeach; ?>
</div>
<div id="transfers">
	<?php foreach ($movement->transfers->find_all() as $transfer): ?>
		<dl>
			<dt>ID</dt>
			<dd><?php echo $transfer->id ?></dd>
			<dt>Equity</dt>
			<dd><?php echo $transfer->equity->name ?></dd>
			<dt>Amount</dt>
			<dd><?php echo number_format(($transfer->amount / 100), 2) ?></dd>
		</dl>
	<?php endforeach; ?>
</div>
<div id="expenses">
	<?php foreach ($movement->expenses->find_all() as $expense): ?>
		<dl>
			<dt>ID</dt>
			<dd><?php echo $expense->id ?></dd>
			<dt>Drain</dt>
			<dd><?php echo $expense->drain->name ?></dd>
			<dt>Amount</dt>
			<dd><?php echo number_format(($expense->amount / 100), 2) ?></dd>
		</dl>
	<?php endforeach; ?>
</div>
<?php echo HTML::anchor('movement/edit/'.$movement->id.'.html', 'Edit movement'); ?>
<br />
<?php echo HTML::anchor('movement/delete/'.$movement->id.'.html', 'Delete movement'); ?>
