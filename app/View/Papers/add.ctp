<div class="papers form">
	<h1><?php echo __('Add Paper'); ?></h1>
<?php echo $this->Form->create('Paper', array('class' => 'form-horizontal')); ?>
	<div class="control-group">
	<?php
		echo $this->Form->input('DOI', 
			array('class' => 'span4', 
			'after' => '<span class="help-inline">Please enter the <abbr class="initialism" title="Document Object Identifier">DOI</abbr>. <a href="http://www.crossref.org/guestquery/">Don\'t know it?</a></span></div>', 'label' => array('text' => '<abbr class="initialism" title="Document Object Identifier">DOI</abbr>','class' => 'control-label', 'escape' => false), 'between'=> '<div class="controls">'));
	?>	
	</div>
	<div class="control-group">
		<?php
		echo $this->Form->input('APA', array('class' => 'span6','rows'=>'3', 'after' => '<span class="help-inline">We\'ll try to automatically retrieve the APA formatted reference and other metadata using <a href="http://dx.doi.org">http://dx.doi.org</a>.</span></div>', 'label' => array('text'=>'<abbr title="American Psychological Association" class="initialism">APA</abbr> formatted reference','class' => 'control-label'), 'between'=> '<div class="controls">'));
		    ?>
		</div>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions btn-group">
	<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Actions'); ?><span class="caret"></span>
	  </a>
	<ul class="dropdown-menu">

		<li><?php echo $this->Html->link(__('List Papers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Codedpapers'), array('controller' => 'codedpapers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Codedpaper'), array('controller' => 'codedpapers', 'action' => 'add')); ?> </li>
	</ul>
</div>
