<div class="joinedCodedpapers view">
<h2><?php  echo __('Joined Codedpaper'); ?></h2>
	<dl>
		<dt><?php echo __('DOI'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['DOI']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('APA'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['APA']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Author'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['first_author']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Journal'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['journal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volume'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['volume']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issue'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['issue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publisher'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['publisher']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('URL'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['URL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['page']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Abstract'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['abstract']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Readers'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['readers']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paper Id'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['paper_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Completed'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['completed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Id'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['group_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Affiliated Institution'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['affiliated_institution']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Occupation'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['occupation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Your Expertise'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['your_expertise']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Codedpaper Id'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['codedpaper_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Replication Code'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['replication_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Replicates Study Id'); ?></dt>
		<dd>
			<?php echo h($joinedCodedpaper['JoinedCodedpaper']['replicates_study_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Joined Codedpaper'), array('action' => 'edit', $joinedCodedpaper['JoinedCodedpaper']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Joined Codedpaper'), array('action' => 'delete', $joinedCodedpaper['JoinedCodedpaper']['id']), null, __('Are you sure you want to delete # %s?', $joinedCodedpaper['JoinedCodedpaper']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Joined Codedpapers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Joined Codedpaper'), array('action' => 'add')); ?> </li>
	</ul>
</div>
