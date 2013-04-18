<div class="papers view">
<h2><?php  echo __('Paper'); ?></h2>
<p>We cannot supply you with this manuscript, but your library will likely have access to this article. Please see your project coordinator if you cannot access this manuscript.</p>
<p class="lead"><?php echo h($paper['Paper']['APA']); ?></p>

<blockquote><?php echo h($paper['Paper']['abstract']); ?>
</blockquote>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($paper['Paper']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DOI'); ?></dt>
		<dd>
			<?php 
			if(isset($paper['Paper']['URL']) AND $paper['Paper']['URL']!='')
				echo $this->Html->link("Go to ".$paper['Paper']['DOI'], $paper['Paper']['URL']) ;
			else
				echo h($paper['Paper']['DOI']);
			echo "<br>";
			echo $this->Html->link("Cited By (Google Scholar)","http://scholar.google.com/scholar?cites={$paper['Paper']['URL']}"); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($paper['Paper']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Author'); ?></dt>
		<dd>
			<?php echo h($paper['Paper']['first_author']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($paper['Paper']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Journal'); ?></dt>
		<dd>
			<?php echo h($paper['Paper']['journal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volume (Issue)'); ?></dt>
		<dd>
			<?php echo h($paper['Paper']['volume']. "({$paper['Paper']['volume']})"); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Citation Count (on Pubmed)'); ?></dt>
		<dd>
			<?php echo h($paper['Paper']['pubmed_nr_of_citations']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pubmed ID'); ?></dt>
		<dd>
			<?php echo h($paper['Paper']['pubmed_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Readers (on Mendeley)'); ?></dt>
		<dd>
			<?php echo h($paper['Paper']['readers']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>

	<div class="actions btn-group">
		<?php echo $this->Html->link('Edit', array('action' => 'edit', $paper['Paper']['id']), array('class' => "btn", 'escape' => false)); ?>
		<button class="btn dropdown-toggle" data-toggle="dropdown">
		    <span class="caret"></span>
		 </button>

		<ul class="dropdown-menu">
			<li> </li>
			<li><?php echo $this->Form->postLink(__('Delete Paper'), array('action' => 'delete', $paper['Paper']['id']), null, __('Are you sure you want to delete # %s?', $paper['Paper']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List Papers'), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Paper'), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Codedpapers'), array('controller' => 'codedpapers', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Codedpaper'), array('controller' => 'codedpapers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
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

<div class="actions btn-group">
	<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Actions'); ?><span class="caret"></span>
	  </a>
	<ul class="dropdown-menu">
			<li><?php echo $this->Html->link(__('New Codedpaper'), array('controller' => 'codedpapers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
