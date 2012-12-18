<div class="joinedCodedpapers index">
	<h2><?php echo __('Joined Codedpapers'); ?></h2>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('DOI'); ?></th>
			<th><?php echo $this->Paginator->sort('APA'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('first_author'); ?></th>
			<th><?php echo $this->Paginator->sort('journal'); ?></th>
			<th><?php echo $this->Paginator->sort('volume'); ?></th>
			<th><?php echo $this->Paginator->sort('issue'); ?></th>
			<th><?php echo $this->Paginator->sort('publisher'); ?></th>
			<th><?php echo $this->Paginator->sort('URL'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th><?php echo $this->Paginator->sort('page'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('abstract'); ?></th>
			<th><?php echo $this->Paginator->sort('readers'); ?></th>
			<th><?php echo $this->Paginator->sort('paper_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('completed'); ?></th>
			<th><?php echo $this->Paginator->sort('group_id'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('affiliated_institution'); ?></th>
			<th><?php echo $this->Paginator->sort('occupation'); ?></th>
			<th><?php echo $this->Paginator->sort('your_expertise'); ?></th>
			<th><?php echo $this->Paginator->sort('codedpaper_id'); ?></th>
			<th><?php echo $this->Paginator->sort('study_name'); ?></th>
			<th><?php echo $this->Paginator->sort('replication_code'); ?></th>
			<th><?php echo $this->Paginator->sort('replicates_study_id'); ?></th>
			<th><?php echo $this->Paginator->sort('study_id'); ?></th>
			<th><?php echo $this->Paginator->sort('test_name'); ?></th>
			<th><?php echo $this->Paginator->sort('analytic_design_code'); ?></th>
			<th><?php echo $this->Paginator->sort('methodology_codes'); ?></th>
			<th><?php echo $this->Paginator->sort('independent_variables'); ?></th>
			<th><?php echo $this->Paginator->sort('dependent_variables'); ?></th>
			<th><?php echo $this->Paginator->sort('other_variables'); ?></th>
			<th><?php echo $this->Paginator->sort('hypothesized'); ?></th>
			<th><?php echo $this->Paginator->sort('prior_hypothesis'); ?></th>
			<th><?php echo $this->Paginator->sort('data_points_excluded'); ?></th>
			<th><?php echo $this->Paginator->sort('reasons_for_exclusions'); ?></th>
			<th><?php echo $this->Paginator->sort('type_of_statistical_test_used'); ?></th>
			<th><?php echo $this->Paginator->sort('N_used_in_analysis'); ?></th>
			<th><?php echo $this->Paginator->sort('inferential_test_statistic'); ?></th>
			<th><?php echo $this->Paginator->sort('inferential_test_statistic_value'); ?></th>
			<th><?php echo $this->Paginator->sort('degrees_of_freedom'); ?></th>
			<th><?php echo $this->Paginator->sort('reported_significance_of_test'); ?></th>
			<th><?php echo $this->Paginator->sort('computed_significance_of_test'); ?></th>
			<th><?php echo $this->Paginator->sort('hypothesis_supported'); ?></th>
			<th><?php echo $this->Paginator->sort('reported_effect_size_statistic'); ?></th>
			<th><?php echo $this->Paginator->sort('reported_effect_size_statistic_value'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($joinedCodedpapers as $joinedCodedpaper): ?>
	<tr>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['DOI']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['APA']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['title']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['first_author']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['journal']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['volume']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['issue']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['publisher']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['URL']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['year']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['page']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['type']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['abstract']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['readers']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['paper_id']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['created']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['modified']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['completed']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['group_id']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['username']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['email']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['affiliated_institution']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['occupation']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['your_expertise']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['codedpaper_id']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['study_name']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['replication_code']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['replicates_study_id']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['study_id']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['test_name']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['analytic_design_code']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['methodology_codes']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['independent_variables']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['dependent_variables']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['other_variables']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['hypothesized']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['prior_hypothesis']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['data_points_excluded']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['reasons_for_exclusions']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['type_of_statistical_test_used']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['N_used_in_analysis']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['inferential_test_statistic']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['inferential_test_statistic_value']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['degrees_of_freedom']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['reported_significance_of_test']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['computed_significance_of_test']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['hypothesis_supported']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['reported_effect_size_statistic']); ?>&nbsp;</td>
		<td><?php echo h($joinedCodedpaper['JoinedCodedpaper']['reported_effect_size_statistic_value']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $joinedCodedpaper['JoinedCodedpaper']['study_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $joinedCodedpaper['JoinedCodedpaper']['study_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $joinedCodedpaper['JoinedCodedpaper']['study_id']), null, __('Are you sure you want to delete # %s?', $joinedCodedpaper['JoinedCodedpaper']['study_id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Joined Codedpaper'), array('action' => 'add')); ?></li>
	</ul>
</div>
