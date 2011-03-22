<?php $total = 0; ?>
<table>
	<tr class="tblheader">
		<th>Equity</th>
		<th>Balance</th>
	</tr>
	<?php foreach ($equities as $equity): ?>
		<?php $amount = $equity->balance(TRUE); ?>
		<?php $total += $amount; ?>
		<tr class="toplevel">
			<th><?php echo $equity->name; ?></th>
			<td><?php echo number_format($amount, 2); ?></td>
		</tr>
		<tr class="subgroup">
			<td><?php echo HTML::anchor('equity/view/'.$equity->id.'.html', 'Unspecified'); ?></td>
			<td><?php echo HTML::anchor('equity/movements/'.$equity->id.'.html', number_format($equity->balance(), 2)); ?></td>
		</tr>
		<?php foreach ($equity->children->find_all() as $child): ?>
			<tr class="subgroup">
				<td><?php echo HTML::anchor('equity/view/'.$child->id.'.html', $child->name); ?></td>
				<td><?php echo HTML::anchor('equity/movements/'.$child->id.'.html', number_format($child->balance(), 2)); ?></td>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
	<tr>
		<th>TOTAL EQUITY</th>
		<td><?php echo number_format($total, 2); ?></td>
	</tr>
</table>
