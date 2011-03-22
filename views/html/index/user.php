<h3>Hello <?php echo $user->username; ?></h3>
<div id="equities">
	<p>You have <?php echo $user->equities->count_all(); ?> equities:</p>
	<?php echo Request::factory('equity.html')->execute()->response; ?>
</div>
<div id="movements">
	<?php echo HTML::anchor('movement/add.html', 'Add a new movement'); ?>
</div>
