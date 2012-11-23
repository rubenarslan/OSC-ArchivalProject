<div class="papers form">
<?php echo $this->Form->create('Paper'); ?>
	<fieldset>
		<legend><?php echo __('Add Paper'); ?></legend>
	<?php
		echo $this->Form->input('doi');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Papers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Codedpapers'), array('controller' => 'codedpapers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Codedpaper'), array('controller' => 'codedpapers', 'action' => 'add')); ?> </li>
	</ul>
</div>
