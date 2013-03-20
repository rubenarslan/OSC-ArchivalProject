<?php
$this->assign('title', 'Forgot password');
?>
<h2>Forgot password</h2>
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
	<p><?php echo __('Did you forget your password? Please enter your email address and we will send you a link to reset it.'); ?></p>
	<?php   
	echo $this->Form->input('email', array(
		'autofocus'=>'autofocus',
		'type' => 'email',
	));
    	?>
<?php echo $this->Form->end(array(
		'label' => 'Send link',
		'class' => 'btn btn-success')); ?>
</div>