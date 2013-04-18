<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $title_for_layout; ?></title>

		<!--[if lt IE 9]>
      		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
    	<![endif]-->

		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/twitter/bootstrap/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/select2.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/main.css" />
		
		
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo $this->webroot; ?>js/vendor/jquery-1.9.1.js"><\/script>')</script>

        <script src="<?php echo $this->webroot; ?>js/vendor/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot; ?>js/select2.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot; ?>js/vendor/jquery.bootstrap.confirm.popover.js"></script>
		
        <script src="<?php echo $this->webroot; ?>js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="<?php echo $this->webroot; ?>js/vendor/js-webshim/minified/polyfiller.js"></script>
		
		<?php echo $this->Js->writeBuffer(); ?>
		
    	<?php
			echo $this->fetch('meta');
    	?>

	</head>
	<body data-spy="scroll" data-offset="70">

	    <div class="navbar navbar-fixed-top">
	      <div class="navbar-inner">
	        <div class="container">
	          <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </a>
	          <?php echo $this->Html->link('OSC-Archival', '/', array('class' => 'brand')); ?>
	          <div class="container nav-collapse">
	            <ul class="nav">
		<?php
		if(AuthComponent::user() === NULL): ?>
	                <li><?php echo $this->Html->link('Login', '/users/login', array('class'=>'')); ?></li>
				    <li><?php echo $this->Html->link('Sign up', '/users/register', array('class'=>'')); ?></li>
		<?php
		else: ?>
					<li><?php echo $this->Html->link("Logout [". AuthComponent::user('Group.name').'] '.AuthComponent::user('username'), '/users/logout'); ?></li>
				<li class="divider-vertical"></li>
				<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Coding'); ?><span class="caret"></span></a>
						<ul class="dropdown-menu">
			                <li><?php echo $this->Html->link('List available papers', '/papers/index'); ?></li>
			                <li><?php echo $this->Html->link('List my coded papers', '/codedpapers/index_mine'); ?></li>
			                <li><?php echo $this->Html->link('List all coded papers', '/codedpapers/index'); ?></li>
			                <li><?php echo $this->Html->link('Coding scheme', '/pages/coding_scheme'); ?></li>
			                <li><?php echo $this->Html->link('Leaderboard', '/users/leaderboard'); ?></li>
			                <li><?php echo $this->Html->link('Send feedback', '/pages/feedback'); ?></li>
			            </ul>
				</li>
				<?php
			endif;
				?>
			<?php if(AuthComponent::user('Group.name')=='admin'): ?>
			  	<li class="divider-vertical"></li>
				<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Admin'); ?><span class="caret"></span></a>
						<ul class="dropdown-menu">
			                <li><?php echo $this->Html->link('List users', '/users/index'); ?></li>
			                <li><?php echo $this->Html->link('Add paper', '/papers/add'); ?></li>
			                <li><?php echo $this->Html->link('Export CSV', '/joinedCodedpapers/export/CSV'); ?></li>
			                <li><?php echo $this->Html->link('Export TSV', '/joinedCodedpapers/export/TSV'); ?></li>
			                <li><?php echo $this->Html->link('Export Excel', '/joinedCodedpapers/export/excel'); ?></li>
			            </ul>
				</li>
			<?php endif; ?>
				<?php echo $this->fetch('more_nav'); ?>
				</ul>
	          </div><!--/.nav-collapse -->
	        </div>
	      </div>
	    </div>

	  <div class="container-fluid">
	                <div class="row-fluid">
	                        <?php echo $this->fetch('sidebar'); ?>

	           	<div id="main-content" class="span9">

					<?php
					    echo $this->Session->flash();
					    echo $this->Session->flash('auth');
					?>

					<?php echo $this->fetch('content'); ?>

	            </div><!--/span-->

	        </div><!--/row-->

	      <footer>
	        <p>&copy; Archival Project <?php echo date('Y'); ?></p>
	      </footer>

	    </div> <!-- /container -->
	</body>
</html>