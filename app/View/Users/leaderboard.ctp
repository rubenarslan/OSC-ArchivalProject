<div class="users index">
	<h2><?php echo __('Leaderboard'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th>User name</th>
			<th>Completed</th>
			<th>Incomplete</th>
			<th>Institution</th>
	</tr>
	<?php
	arsort($complete);
	foreach ($complete AS $id => $completed): ?>
	<tr>
		<td>
			<?php echo $users[$id]['username']; ?>
		</td>
		<td><?php echo $completed; ?>&nbsp;</td>
		<td><?php echo $incomplete[$id]; ?>&nbsp;</td>
		<td><?php echo $users[$id]['affiliated_institution']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>