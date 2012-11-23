<div class="papers view">
<h2><?php  echo __('Paper'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($paper['Paper']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Doi'); ?></dt>
		<dd>
			<?php echo h($paper['Paper']['doi']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Paper'), array('action' => 'edit', $paper['Paper']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Paper'), array('action' => 'delete', $paper['Paper']['id']), null, __('Are you sure you want to delete # %s?', $paper['Paper']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Papers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paper'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Codedpapers'), array('controller' => 'codedpapers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Codedpaper'), array('controller' => 'codedpapers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Codedpapers'); ?></h3>
	<?php if (!empty($paper['Codedpaper'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Paper Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($paper['Codedpaper'] as $codedpaper): ?>
		<tr>
			<td><?php echo $codedpaper['id']; ?></td>
			<td><?php echo $codedpaper['paper_id']; ?></td>
			<td><?php echo $codedpaper['user_id']; ?></td>
			<td><?php echo $codedpaper['created']; ?></td>
			<td><?php echo $codedpaper['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'codedpapers', 'action' => 'view', $codedpaper['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'codedpapers', 'action' => 'edit', $codedpaper['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'codedpapers', 'action' => 'delete', $codedpaper['id']), null, __('Are you sure you want to delete # %s?', $codedpaper['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Codedpaper'), array('controller' => 'codedpapers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
