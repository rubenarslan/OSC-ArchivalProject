<div class="papers index">
	<h2><?php echo __('Papers'); ?></h2>
	<table class="table">
	<tr>
			<th>DOI</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($codedpapers as $paper): ?>
	<tr>
		<td><?php echo h($paper['Paper']['doi']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('Continue coding'), "/codedpapers/code/". $paper['Codedpaper']['id'], array('class' => 'btn')); ?>
			<?php
			echo $this->element('get_other_codings', array('paper_id' => $paper['Paper']['id'],'user_name' => $paper['User']['username']));
			?>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</div>
<div class="actions btn-group">
	<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Actions'); ?><span class="caret"></span>
	  </a>
	<ul class="dropdown-menu">
		<li><?php echo $this->Html->link(__('Select a new paper for coding'), '/papers/index'); ?></li>
	</ul>
</div>