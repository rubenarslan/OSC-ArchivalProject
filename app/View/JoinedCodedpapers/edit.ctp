<div class="joinedCodedpapers form">
<?php echo $this->Form->create('JoinedCodedpaper'); ?>
	<fieldset>
		<legend><?php echo __('Edit Joined Codedpaper'); ?></legend>
	<?php
		echo $this->Form->input('DOI');
		echo $this->Form->input('APA');
		echo $this->Form->input('title');
		echo $this->Form->input('first_author');
		echo $this->Form->input('journal');
		echo $this->Form->input('volume');
		echo $this->Form->input('issue');
		echo $this->Form->input('publisher');
		echo $this->Form->input('URL');
		echo $this->Form->input('year');
		echo $this->Form->input('page');
		echo $this->Form->input('type');
		echo $this->Form->input('abstract');
		echo $this->Form->input('readers');
		echo $this->Form->input('paper_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('completed');
		echo $this->Form->input('group_id');
		echo $this->Form->input('username');
		echo $this->Form->input('email');
		echo $this->Form->input('affiliated_institution');
		echo $this->Form->input('occupation');
		echo $this->Form->input('your_expertise');
		echo $this->Form->input('codedpaper_id');
		echo $this->Form->input('name');
		echo $this->Form->input('replication_code');
		echo $this->Form->input('replicates_study_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('JoinedCodedpaper.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('JoinedCodedpaper.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Joined Codedpapers'), array('action' => 'index')); ?></li>
	</ul>
</div>
