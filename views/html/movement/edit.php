<?php
$index = 0;
if (isset($movement->errors)) print_r($movement->errors);
echo Form::open('movement/edit/'.$movement->id);
?>
<div id="info">
	<dl>
		<dt><?php echo Form::label('name', 'Name'); ?></dt>
		<dd><?php echo Form::input('name', $movement->name); ?></dd>
		<dt><?php echo Form::label('description', 'Description'); ?></dt>
		<dd><?php echo Form::textarea('description', $movement->description); ?></dd>
		<dt><?php echo Form::label('datetime', 'Datetime'); ?></dt>
		<dd><?php
			echo Form::input('datetime', date('Y/m/d H:i', $movement->timestamp));
			echo Form::hidden('timestamp', $movement->timestamp);
			?></dd>
	</dl>
</div>
<div id="origins">
	<ul>
		<?php foreach ($movement->get_transactions('incomes') as $income): ?>
			<li>
				<span id="org_<?php echo $index; ?>_type">
					<?php
					echo Form::radio('org_'.$index.'_type', 'source', TRUE, array('id' => 'org_'.$index.'_type1'));
					echo Form::label('org_'.$index.'_type1', 'Source');
					echo Form::radio('org_'.$index.'_type', 'equity', FALSE, array('id' => 'org_'.$index.'_type2'));
					echo Form::label('org_'.$index.'_type2', 'Equity');
					?>
				</span>
				<span id="org_<?php echo $index; ?>" controller="source">
					<?php
					$parent = ($income->source->parent_id == NULL) ? $income->source_id : $income->source->parent_id;
					echo Form::select('sources', $sources, $parent);
					echo Form::select(
						'incomes[o'.$index.'][source_id]',
						array($parent => 'Unspecified') + ORM::factory('source')->where('parent_id', '=', $parent)->find_all()->as_array('id', 'name'),
						$income->source_id
					);
					echo Form::input('incomes[o'.$index.'][amount]', number_format($income->amount / 100, 2));
					?>
				</span>
				<span id="org_<?php echo $index; ?>_delete">x</span>
			</li>
			<?php $index ++; ?>
		<?php endforeach; ?>
		<?php foreach ($movement->get_transactions('transfers') as $transfer): ?>
			<?php if ($transfer->amount < 0): ?>
				<li>
					<span id="org_<?php echo $index; ?>_type">
						<?php
						echo Form::radio('org_'.$index.'_type', 'source', FALSE, array('id' => 'org_'.$index.'_type1'));
						echo Form::label('org_'.$index.'_type1', 'Source');
						echo Form::radio('org_'.$index.'_type', 'equity', TRUE, array('id' => 'org_'.$index.'_type2'));
						echo Form::label('org_'.$index.'_type2', 'Equity');
						?>
					</span>
					<span id="org_<?php echo $index; ?>" controller="equity">
						<?php
						$parent = ($transfer->equity->parent_id == NULL) ? $transfer->equity_id : $transfer->equity->parent_id;
						echo Form::select('equities', $equities, $parent);
						echo Form::select(
							'transfers[o'.$index.'][equity_id]',
							array($parent => 'Unspecified') + ORM::factory('equity')->where('parent_id', '=', $parent)->find_all()->as_array('id', 'name'),
							$transfer->equity_id
						);
						echo Form::input('transfers[o'.$index.'][amount]', number_format(- ($transfer->amount / 100), 2));
						?>
					</span>
					<span id="org_<?php echo $index; ?>_delete">x</span>
				</li>
				<?php $index ++; ?>
			<?php endif; ?>
		<?php endforeach; ?>
		<li>
			<?php echo Form::button('add_origin', 'Add origin', array('onclick' => 'return false;')); ?>
		</li>
	</ul>
</div>
<?php $index = 0; ?>
<div id="destinations">
	<ul>
		<?php foreach ($movement->get_transactions('transfers') as $transfer): ?>
			<?php if ($transfer->amount > 0): ?>
				<li>
					<span id="dst_<?php echo $index; ?>_type">
						<?php
						echo Form::radio('dst_'.$index.'_type', 'equity', TRUE, array('id' => 'dst_'.$index.'_type1'));
						echo Form::label('dst_'.$index.'_type1', 'Equity');
						echo Form::radio('dst_'.$index.'_type', 'drain', FALSE, array('id' => 'dst_'.$index.'_type2'));
						echo Form::label('dst_'.$index.'_type2', 'Drain');
						?>
					</span>
					<span id="dst_<?php echo $index; ?>" controller="equity">
						<?php
						$parent = ($transfer->equity->parent_id == NULL) ? $transfer->equity_id : $transfer->equity->parent_id;
						echo Form::select('equities', $equities, $parent);
						echo Form::select(
							'transfers[d'.$index.'][equity_id]',
							array($parent => 'Unspecified') + ORM::factory('equity')->where('parent_id', '=', $parent)->find_all()->as_array('id', 'name'),
							$transfer->equity_id
						);
						echo Form::input('transfers[d'.$index.'][amount]', number_format($transfer->amount / 100, 2));
						?>
					</span>
					<span id="dst_<?php echo $index; ?>_delete">x</span>
				</li>
				<?php $index ++; ?>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php foreach ($movement->get_transactions('expenses') as $expense): ?>
			<li>
				<span id="dst_<?php echo $index; ?>_type">
					<?php
					echo Form::radio('dst_'.$index.'_type', 'equity', FALSE, array('id' => 'dst_'.$index.'_type1'));
					echo Form::label('dst_'.$index.'_type1', 'Equity');
					echo Form::radio('dst_'.$index.'_type', 'drain', TRUE, array('id' => 'dst_'.$index.'_type2'));
					echo Form::label('dst_'.$index.'_type2', 'Drain');
					?>
				</span>
				<span id="dst_<?php echo $index; ?>" controller="drain">
					<?php
					$parent = ($expense->drain->parent_id == NULL) ? $expense->source_id : $expense->drain->parent_id;
					echo Form::select('drains', $drains, $parent);
					echo Form::select(
						'expenses[d'.$index.'][drain_id]',
						array($parent => 'Unspecified') + ORM::factory('drain')->where('parent_id', '=', $parent)->find_all()->as_array('id', 'name'),
						$expense->drain_id
					);
					echo Form::input('expenses[d'.$index.'][amount]', number_format($expense->amount / 100, 2));
					?>
				</span>
				<span id="dst_<?php echo $index; ?>_delete">x</span>
			</li>
			<?php $index ++; ?>
		<?php endforeach; ?>
			<li>
				<?php echo Form::button('add_destination', 'Add destination', array('onclick' => 'return false;')); ?>
			</li>
	</ul>
</div>
<?php
echo Form::submit(NULL, 'Save changes');
echo Form::close();
?>
<div id="options">
	<div id="source">
		<?php echo Form::select('sources', $sources); ?>
	</div>
	<div id="equity">
		<?php echo Form::select('equities', $equities); ?>
	</div>
	<div id="drain">
		<?php echo Form::select('drains', $drains); ?>
	</div>
</div>
