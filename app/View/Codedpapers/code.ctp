<?php $this->start('sidebar'); ?>
<div class="well span3">
<h3>Tips</h3>
<p>You can save at any time with Ctrl+Enter (simply Enter works in single-line fields as well), <strong>use it</strong>, so you aren't interrupted by autosaves.</p>
<p>Autosaves should disturb you as little as possible, but when you're caught in the process of typing, they may be confusing. <br>
	<button type="button" id="toggle_autosave" class="btn btn-inverse" data-toggle="button">Toggle Autosave <i class="icon-refresh icon-white"></i></button></p>
<h4><?= $this->Html->link('Coding scheme', array('controller' => 'pages','action' => 'coding_scheme')); ?></h4>
<h4>Coded by others</h4>
<?php
echo $this->element('get_other_codings', array('paper_id' => $this->data['Paper']['id'],'user_name' => $this->data['User']['username']));
?>
<h4>Replication codes</h4>
<div class="accordion" id="accordion2">
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseNovel">Novel</a>
		</div>	
		<div id="collapseNovel" class="accordion-body collapse">
			<div class="accordion-inner">No replication mentioned.</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseDirect">Direct</a>
		</div>
		<div id="collapseDirect" class="accordion-body collapse">
			<div class="accordion-inner">Direct replication. The stated goal is , at least in part of the design, to exactly reproduce the hypothesis and methods of the previous study, making only those changes that are necessary to achieve the same psychological meaning among the new participant population. Example 1:  A study of stereotypes in Canada that used ice hockey players as a target group might be directly replicated in Australia by changing the target group to rugby players and pretesting for new stereotypical associations, while keeping everything else the same. Example 2: A study of lexical decision times done in Romania using Romanian words is directly replicated in Spain, with the necessary alteration of using Spanish words. Example 3: A study of psychological resilience in the aftermath of the Hurricane Katrina disaster in the US is directly replicated among those affected by the 2011 tornado outbreak, changing only references to the event.</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseConceptual">Conceptual</a>
		</div>
		<div id="collapseConceptual" class="accordion-body collapse">
			<div class="accordion-inner">Conceptual replication. The study’s stated goal is, at least in part of the design, to test the hypothesis of the previous study, using the same conceptual variables but changing their operationalization in ways that go beyond merely adapting the materials for a new population or occasion. <br>
		A conceptual replication can be done to increase internal validity (seeing if an effect replicates if the method excludes an alternate explanation), ecological validity (seeing if an effect replicates if an analogous procedure is followed using more naturalistic stimuli or setting), or external validity (seeing if the effect replicates across different conceptual incarnations of the same manipulations and measures). Note that a test of the same theory covered by previous research is not enough to warrant the “conceptual replication” label: the hypothesis (that is, a statement of relationships among variables) leading to a previous effect must be replicated.
			</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseX">+X</a>
		</div>
		<div id="collapseX" class="accordion-body collapse">
			<div class="accordion-inner">The letter X goes into the code after E, C, or D if the study also contains elements of extension that go beyond the type of replication recorded (thus, EX, CX or DX). For example, a study may replicate a previous two-condition experiment but then add on a third condition; it may measure a new construct that serves as an additional dependent variable, mediator or moderator; it may cross a new manipulation with the design of the old study, in which case the control group of the manipulation is essentially a replication of the old study. 
			</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseNr">+#</a>
		</div>
		<div id="collapseNr" class="accordion-body collapse">
			<div class="accordion-inner">After the letter code, a number code without brackets is placed to show that the study is presented as a replication/extension of an earlier study in the article itself, instead of, or in addition to, replicating another article.
			</div>
		</div>
	</div>

</div>
</div>
<?php $this->end(); ?>
<?php $this->start('sub_nav'); ?>
<ul class="nav-offset2 sub_nav nav">
  <li class="progress-nav" title="Your coding progress" class="hastooltip">
	  	<div class="progress progress-striped span4">
	      <div class="bar" style="width: 0%;" id="codingprogress"></div>
	      </div>
  </li>
	<li class="divider-vertical"></li>
  
  <li><button id="navSave" class="btn" disabled="disabled">Saved</button></li>
</ul>



<?php $this->end(); 
echo $this->Session->flash();
?>
<h1>Code paper <?php echo $this->Html->link('View <span class="icon-eye-open"></span>', 
	array('controller' => 'papers','action' => 'view', $this->data['Paper']['id']), 
	array('escape' => false, 'class' => 'btn btn-large'));?></h1>

<p class="lead span8"><?php 
	echo $this->data['Paper']['title'];
	?></p> 
<p class="span6">
	<?php  echo $this->data['Paper']['abstract']; ?>
</p>
<?php
if(
	AuthComponent::user('Group.name')!=='admin' AND 
 	isset($onlyView) AND 
	!$this->data['Codedpaper']['completed']
) 
	{
	echo $this->element('alert-info',array(
		'bold' => 'Not yet complete',
		'message'=>'This paper has not yet been marked complete, so only admins can view it.'
	));
}
else 
{
	if(
		AuthComponent::user('Group.name')==='admin' AND 
	 	isset($onlyView) AND 
		!$this->data['Codedpaper']['completed']
	) 
		{
		echo $this->element('alert-info',array(
			'bold' => 'Not yet complete',
			'message'=>'You can view this paper, because you\'re an admin, but it has not been marked as complete yet.'
		));
	}
	
	if(isset($onlyView)) 
	{
		echo $this->Form->create("Codedpaper",array(
			'inputDefaults' => array('disabled' => 'disabled'),
			));
	}
	else 
	{
		echo $this->Form->create("Codedpaper");
	}
	echo $this->Form->hidden("Paper.id");
	echo $this->Form->hidden("Paper.DOI");
	echo $this->Form->hidden("id");
	echo $this->Form->hidden("paper_id");

	echo $this->element('study', array(
		"data" => $this->data
	));

	echo '<div class="form-actions"><div class="btn-group">';
	echo $this->Form->end(array(
	    'label' => 'Save!',
	    'id' => 'CodedpaperCodeFormSubmit',
		'class' => 'btn btn-large',
		'div' => false,
	));
	?>
		<input type="hidden" id="CodedpaperCompleted_" name="data[Codedpaper][completed]" value="0">
		<label  title="Push button in to let others <br>view your coded paper" id="CodedpaperCompletedLabel" class="hastooltip btn btn-large btn-success<?=($this->data['Codedpaper']['completed']===true)?' active':''; ?>">
			<input type="checkbox" id="CodedpaperCompleted" name="data[Codedpaper][completed]" class="hidden" value="1" <?=($this->data['Codedpaper']['completed']===true)?'checked="checked"':''; ?>>
			Complete
		</label>
		</div>
	</div>
	<?php
	debug($this->validationErrors);
	?>
	<?php
}
	?>
<?php echo $this->Js->writeBuffer(); ?>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/code.js"></script>
<?php if(isset($onlyView)) {
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {
	console.log($('#CodedpaperViewForm .btn'));
	$('#CodedpaperViewForm .btn').each(function(i,elm) {
		$(elm).remove();
	});
});
//]]>
</script>
<?php } ?>