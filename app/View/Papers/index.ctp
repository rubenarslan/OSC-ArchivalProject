<?php
$this->start('sub_nav');
?>
<ul class="nav-offset3 sub_nav nav nav-pills">
  <li class="active"><?php echo $this->Html->link(__('All papers'),'/papers/index'); ?></li>
  <li><?php echo $this->Html->link(__('Leaderboard'),'/users/leaderboard'); ?></li>
  <li><?php echo $this->Html->link('Coding scheme', '/pages/coding_scheme'); ?></li>
</ul>
<?php
$this->end();
?>

<div class="offset1 papers index span13">
	<h2><?php echo __('All articles'); ?> <?php if(AuthComponent::user('Group.name')=='admin'): ?>
		<small>
		<?php echo $this->Html->link(__('add new'), '/papers/add'); ?></li>
	</small>
	<?php endif; ?></h2>
	
	
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('DOI'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('first_author'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th><?php echo $this->Paginator->sort('journal'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	function shortensome($x) {
		if(strlen($x)>9) $x = substr($x,0,8). "…";
		return $x;
	}
	foreach ($papers as $paper): ?>
	<tr>
		<td><?php 
		echo $this->Html->link(shortensome($paper['Paper']['DOI']), $paper['Paper']['URL']); ?>&nbsp;</td>
		<td><?php echo h($paper['Paper']['title']); ?>&nbsp;</td>
		<td><?php echo h($paper['Paper']['first_author']); ?>&nbsp;</td>
		<td><?php echo h($paper['Paper']['year']); ?>&nbsp;</td>
		<td><?php echo h($paper['Paper']['journal']); ?>&nbsp;</td>
		<td class="actions span5">
			<div class="btn-toolbar">
				<div class="actions btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $paper['Paper']['id']), array('class' => 'btn')); ?>
		 			<?php if(AuthComponent::user('Group.name')=='admin'): ?>
					 <button class="btn dropdown-toggle" data-toggle="dropdown">
					    <span class="caret"></span>
					 </button>
					 
					<ul class="dropdown-menu">
						<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $paper['Paper']['id'])); ?></li>
						<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $paper['Paper']['id']), null, __('Are you sure you want to delete # %s?', $paper['Paper']['id'])); ?></li>
					</ul>
					<?php endif; ?>
				</div>
			<?php
			echo $this->element('get_multiple', array('paper_id' => $paper['Paper']['id']));
			?>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="actions btn-group">
		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Actions'); ?><span class="caret"></span>
		  </a>
		<ul class="dropdown-menu">
			<li><?php echo $this->Html->link(__('New Paper'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List Codedpapers'), array('controller' => 'codedpapers', 'action' => 'index')); ?> </li>
		</ul>
	</div>

	<div class="pagination pagination-centered">
		<ul>
	<?php
		echo "<li>";
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo "</li><li>";
		echo $this->Paginator->numbers(array('separator' => '</li><li>'));
		echo "</li><li>";
		echo $this->Paginator->next(__('next') . ' >',array(), null, array('class' => 'next disabled'));
		echo "</li><li>";
	?>
		</ul>
	</div>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
</div>

