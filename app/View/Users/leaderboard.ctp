<?php
$this->start('sub_nav');
?>
<ul class="nav-offset3 sub_nav nav nav-pills">
  <li><?php echo $this->Html->link(__('All papers'),'/papers/index'); ?></li>
  <li class="active"><?php echo $this->Html->link(__('Leaderboard'),'/users/leaderboard'); ?></li>
  <li><?php echo $this->Html->link('Coding scheme', '/pages/coding_scheme'); ?></li>
</ul>
<?php
$this->end();
?>
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