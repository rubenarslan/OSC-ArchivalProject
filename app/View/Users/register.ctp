<h1><?php echo __('Register'); ?></h1>
<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
<div class="control-group">
<?php   echo $this->Form->input('username', array('class' => 'span4','autofocus'=>'autofocus', 'label' => array('class' => 'control-label'), 'between'=> '<div class="controls">', 'after' => '</div>'));
?>
</div>
<div class="control-group">
<?php		echo $this->Form->input('email', array('class' => 'span12','style' => 'width:190px','between'=> '<div class="controls"><span class="add-on"><i class="icon-envelope"></i></span>', 'after' => '</div>', 'div' => array('class' => 'input-prepend'), 'label' => array('class' => 'control-label')));
?>
</div>
<div class="control-group">
<?php
echo $this->Form->input('password', array('class' => 'span4', 'after' => '<span class="help-inline">Please choose a safe, memorable passphrase.</span></div>', 'label' => array('class' => 'control-label'), 'between'=> '<div class="controls">'));
    ?>
<br></div>

<div class="control-group">
<?php
echo $this->Form->input('affiliated_institution', array('class' => 'span4', 'after' => '<span class="help-inline">Which, if any, institution are you affiliated with?</span></div>', 'label' => array('class' => 'control-label'), 'between'=> '<div class="controls">'));
    ?>
</div>

<div class="control-group">
<?php
echo $this->Form->input('occupation', array('class' => 'span4', 'after' => '<span class="help-inline">What is your occupation?</span></div>', 'label' => array('class' => 'control-label'), 'between'=> '<div class="controls">'));
    ?>
</div>

<div class="control-group">
<?php
echo $this->Form->input('your_expertise', array('options' => 
	array('Very low (no statistics classes taken)', 
	'Low (undergraduate statistics training)',
	'Average (undergraduate statistics training, some interest in statistics)', 
	'High (graduate statistics training)', 
	'Very high (taught statistics classes, PhD in psychological methods, etc.)'),
	
	'class' => 'span4', 'after' => '<span class="help-inline">Where do you see yourself in terms of the statistical expertise needed for this meta-analysis?</span></div>', 'label' => array('class' => 'control-label'), 'between'=> '<div class="controls">'));
    ?>
</div>

<?php echo $this->Form->end(array(
	'label' => 'Register',
	'class' => 'btn btn-success btn-large offset3')); ?>