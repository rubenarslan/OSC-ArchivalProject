<div class="scoot papers span10 form">
	<h1><?php echo __('Add Paper'); ?></h1>
<?php echo $this->Form->create('Paper', array('class' => 'form-horizontal')); ?>
	<p class="span10">
		If you <strong>enter a free-form citation</strong> (e.g. APA formatted from the reference section of an article), we'll try to get the DOI from Crossref, this can lead to false positives, so you should check the results and possibly correct them.<br>
		If you <strong>enter the DOI</strong> (more reliable, but sometimes harder to find) or we found it via Crossref, we'll try to automatically retrieve the APA formatted reference and other metadata using <a href="http://dx.doi.org">http://dx.doi.org</a>, Crossref and Pubmed. This should seldom fail and should not lead to false positives.<br>
		To find DOIs when our free-form citation retrieval fails, try <a href="http://www.crossref.org/guestquery/">the Crossref Guest Query</a>, Google Scholar or something similar.
	</p>
	<div class="control-group">
		
	<?php
		echo $this->Form->input('DOI', 
			array(
				'class' => 'span6',
				'between'=> '<div class="controls">', 
				'after' => '<span class="help-inline">Please enter the <abbr class="initialism" title="Document Object Identifier">DOI</abbr>.</span></div>', 
				'label' => array('text' => '<abbr class="initialism" title="Document Object Identifier">DOI</abbr>',
					'class' => 'control-label', 
					'escape' => false), 
			));
	?>	
	</div>
	<div class="control-group">
		<?php
		echo $this->Form->input('APA', array(
			'between'=> '<div class="controls">',
			'class' => 'span6',
			'rows'=>'3', 
			'after' => '<span class="help-inline">E.g. copied from the reference section.</span></div>', 
			'label' => array('text'=>'Formatted reference','class' => 'control-label'), 
		));
		    ?>
		</div>
<?php echo $this->Form->end(array(
	    'label' => 'Add new paper and try to auto-retrieve metadata!',
		'class' => 'offset1 btn btn-large btn-success',
		'div' => false,
	)); ?>
</div>
