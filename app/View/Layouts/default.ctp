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
		<script src="<?php echo $this->webroot; ?>js/twitter/bootstrap/jquery-1.8.3.js"></script>

		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/twitter/bootstrap/bootstrap.css" />
		<script type="text/javascript" src="<?php echo $this->webroot; ?>js/twitter/bootstrap/bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot; ?>js/twitter/bootstrap/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot; ?>js/twitter/bootstrap/jquery.bootstrap.confirm.popover.js"></script>
		
    	<?php
			echo $this->fetch('meta');
    	?>

	</head>
	<body>

	    <div class="navbar navbar-fixed-top">
	      <div class="navbar-inner">
	        <div class="container">
	          <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </a>
	          <?php echo $this->Html->link('Archival Project', '/', array('class' => 'brand')); ?>
	          <div class="container nav-collapse">
	            <ul class="nav">	
		<?php
		if(AuthComponent::user() === NULL) { ?>
	                <li><?php echo $this->Html->link('Login', '/users/login'); ?></li>
				    <li><?php echo $this->Html->link('Sign up', '/users/register'); ?></li>
		<?php }
		else {?>
					<li><?php echo $this->Html->link("Logout [". AuthComponent::user('Group.name').'] '.AuthComponent::user('username'), '/users/logout'); ?></li>
		<?php }?>
				<li>
					<div class="actions btn-group">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Coding'); ?><span class="caret"></span></a>
						<ul class="dropdown-menu">
			                <li><?php echo $this->Html->link('Code a new paper', '/papers/index'); ?></li>
			                <li><?php echo $this->Html->link('List my coded papers', '/codedpapers/index_mine'); ?></li>
			                <li><?php echo $this->Html->link('List all coded papers', '/codedpapers/index'); ?></li>
			            </ul>
					</div>
				</li>
				<?php echo $this->fetch('more_nav'); ?>
				</ul>
	          </div><!--/.nav-collapse -->
	        </div>
	      </div>
	    </div>

	  <div class="container-fluid">
	                <div class="row-fluid">
	                    <div class="span3">
	                      <div class="well sidebar-nav">
	                        <?php echo $this->fetch('sidebar'); ?>
	                      </div><!--/.well -->
	                    </div><!--/span-->

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
<?php echo $this->Js->writeBuffer(); ?>
	</body>
</html>