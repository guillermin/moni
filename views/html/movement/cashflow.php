<?php $col_incomes = $col_expenses = array_fill_keys(array_keys($intervals), 0); ?>
<table>
	<tr class="tblheader">
		<th>Incomes</th>
		<?php foreach ($intervals as $interval): ?>
			<th><?php echo $interval['name']; ?></th>
		<?php endforeach; ?>
		<th><?php echo 'YEAR'; ?></th>
	</tr>
	<?php foreach ($sources as $row => $source): ?>
		<tr class="toplevel">
			<th><?php echo $source->name; ?></th>
			<?php foreach ($intervals as $col => $interval): ?>
				<?php $amount = $source->cashflow($user_id, $interval['start'], $interval['end'], TRUE); ?>
				<?php $col_incomes[$col] += $amount; ?>
				<td><?php echo number_format($amount, 2); ?></td>
			<?php endforeach; ?>
		</tr>
		<tr class="subgroup">
			<th>Unspecified</th>
			<?php foreach ($intervals as $col => $interval): ?>
				<?php $amount = $source->cashflow($user_id, $interval['start'], $interval['end']); ?>
				<td><?php echo number_format($amount, 2); ?></td>
			<?php endforeach; ?>
		</tr>
		<?php foreach ($source->children->find_all() as $child): ?>
			<tr class="subgroup">
				<th><?php echo $child->name; ?></th>
				<?php foreach ($intervals as $col => $interval): ?>
					<?php $amount = $child->cashflow($user_id, $interval['start'], $interval['end']); ?>
					<td><?php echo number_format($amount, 2); ?></td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
	<tr>
		<th>TOTAL INCOME</th>
		<?php foreach ($col_incomes as $total): ?>
			<td><?php echo number_format($total, 2); ?></td>
		<?php endforeach; ?>
	</tr>
	<tr></tr>
	<tr class="tblheader">
		<th>Expenses</th>
		<?php foreach ($intervals as $interval): ?>
			<th><?php echo $interval['name']; ?></th>
		<?php endforeach; ?>
		<th><?php echo 'YEAR'; ?></th>
	</tr>
	<?php foreach ($drains as $row => $drain): ?>
		<tr class="toplevel">
			<th><?php echo $drain->name; ?></th>
			<?php foreach ($intervals as $col => $interval): ?>
				<?php $amount = $drain->cashflow($user_id, $interval['start'], $interval['end'], TRUE); ?>
				<?php $col_expenses[$col] += $amount; ?>
				<td><?php echo number_format($amount, 2); ?></td>
			<?php endforeach; ?>
		</tr>
		<tr class="subgroup">
			<th>Unspecified</th>
			<?php foreach ($intervals as $col => $interval): ?>
				<?php $amount = $drain->cashflow($user_id, $interval['start'], $interval['end']); ?>
				<td><?php echo number_format($amount, 2); ?></td>
			<?php endforeach; ?>
		</tr>
		<?php foreach ($drain->children->find_all() as $child): ?>
			<tr class="subgroup">
				<th><?php echo $child->name; ?></th>
				<?php foreach ($intervals as $col => $interval): ?>
					<?php $amount = $child->cashflow($user_id, $interval['start'], $interval['end']); ?>
					<td><?php echo number_format($amount, 2); ?></td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
	<tr>
		<th>TOTAL EXPENSE</th>
		<?php foreach ($col_expenses as $total): ?>
			<td><?php echo number_format($total, 2); ?></td>
		<?php endforeach; ?>
	</tr>
	<tr>
		<th>CASHFLOW</th>
		<?php foreach ($intervals as $id => $interval): ?>
			<td><?php echo number_format($col_incomes[$id]-$col_expenses[$id], 2); ?></td>
		<?php endforeach; ?>
	</tr>
</table>
