<?php
$this->assign('title', 'Reset password');
?>
<h2>Reset password</h2>
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
	<p><?php echo __('Please enter your new password here. You can then login with your user name and new password.'); ?></p>
	<?php   
	echo $this->Form->input('password', array(
		'type' => 'password',
	));
    	?>
<?php echo $this->Form->end(array(
		'label' => 'Change password',
		'class' => 'btn')); ?>
</div>