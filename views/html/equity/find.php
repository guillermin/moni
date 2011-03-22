<table>
	<tr>
		<th>Parent</th>
		<th>Name</th>
		<th>Description</th>
		<th>Balance</th>
	</tr>
	<?php foreach ($equities as $equity): ?>
		<tr>
			<td><?php echo $equity->parent->name; ?></td>
			<td><?php echo HTML::anchor('equity/view/'.$equity->id.'.html', $equity->name); ?></td>
			<td><?php echo $equity->description; ?></td>
			<td><?php echo number_format($equity->balance(), 2); ?></td>
		</tr>
	<?php endforeach; ?>
</table>
