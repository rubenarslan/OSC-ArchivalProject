<h2>Login</h2>
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
        <p><?php echo __('Please enter your username and password'); ?></p>
				<p><?=$this->Html->link(__('Forgot your password?'),'/users/forgotPassword'); ?></p>

    <?php   
		echo $this->Form->input('username', array('autofocus'=>'autofocus'));
        echo $this->Form->input('password');
    ?>
<?php echo $this->Form->end(array(
		'label' => 'Login',
		'class' => 'btn btn-success')); ?>
</div>