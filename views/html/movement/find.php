<table>
	<tr>
		<th>Date</th>
		<th>Name</th>
		<th>Transactions</th>
	</tr>
	<?php foreach ($movements as $movement): ?>
		<tr>
			<td><?php echo date('d/m/Y H:i', $movement->timestamp); ?></td>
			<td><?php echo HTML::anchor('movement/view/'.$movement->id.'.html', $movement->name); ?></td>
			<td>
				<ul>
					<?php foreach ($movement->incomes->find_all() as $income): ?>
						<li><?php echo $income->source->name.' '.number_format(($income->amount / 100), 2).' €'; ?></li>
					<?php endforeach; ?>
					<?php foreach ($movement->transfers->find_all() as $transfer): ?>
						<li><?php echo $transfer->equity->name.' '.number_format(($transfer->amount / 100), 2).' €'; ?></li>
					<?php endforeach; ?>
					<?php foreach ($movement->expenses->find_all() as $expense): ?>
						<li><?php echo $expense->drain->name.' '.number_format(($expense->amount / 100), 2).' €'; ?></li>
					<?php endforeach; ?>
				</ul>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
