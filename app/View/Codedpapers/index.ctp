<div class="papers index">
	<h2><?php echo __('Papers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>DOI</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($codedpapers as $paper): ?>
	<tr>
		<td><?php echo h($paper['Paper']['doi']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), "/codedpapers/view/". $paper['Codedpaper']['id']); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Select a new paper for coding'), '/papers/index'); ?></li>
	</ul>
</div>