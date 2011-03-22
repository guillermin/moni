<?php $balance = 0; ?>
<table>
	<tr>
		<th>Date</th>
		<th>Name</th>
		<th>Amount</th>
		<th>Balance</th>
	</tr>
	<?php foreach ($equity->transfers->with('movement')->order_by('movement.timestamp', 'asc')->find_all() as $transfer): ?>
		<?php $balance += $transfer->amount; ?>
		<tr>
			<td><?php echo date('d/m/Y H:i', $transfer->movement->timestamp); ?></td>
			<td><?php echo HTML::anchor('movement/view/'.$transfer->movement_id.'.html', $transfer->movement->name); ?></td>
			<td><?php echo number_format($transfer->amount / 100, 2); ?></td>
			<td><?php echo number_format($balance / 100, 2); ?></td>
		</tr>
	<?php endforeach; ?>
</table>
