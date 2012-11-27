<div class="papers index">
	<h2><?php echo __('Papers'); ?></h2>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('doi'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($papers as $paper): ?>
	<tr>
		<td><?php echo h($paper['Paper']['id']); ?>&nbsp;</td>
		<td><?php echo h($paper['Paper']['doi']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Code'), "/codedpapers/add/". $paper['Paper']['id']); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $paper['Paper']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $paper['Paper']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $paper['Paper']['id']), null, __('Are you sure you want to delete # %s?', $paper['Paper']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions btn-group">
	<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Actions'); ?><span class="caret"></span>
	  </a>
	<ul class="dropdown-menu">
		<li><?php echo $this->Html->link(__('New Paper'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Codedpapers'), array('controller' => 'codedpapers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Codedpaper'), array('controller' => 'codedpapers', 'action' => 'add')); ?> </li>
	</ul>
</div>
