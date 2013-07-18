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

		
		<?php
		if(!Configure::read('debug')):
		?>
			<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
			<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet">
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
			<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
		<?php
		else:
		?>
			<script src="<?php echo $this->webroot; ?>js/vendor/jquery-1.9.1.min.js"></script>
			<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/bootstrap.min.css" />
	        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/font-awesome.min.css">
			<script src="<?php echo $this->webroot; ?>js/vendor/bootstrap.min.js"></script>
		<?php
		endif;
		?>	
		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/select2.css" />
       <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/bootstrap-responsive.min.css">
		<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo $this->webroot; ?>css/font-awesome-ie7.min.css">
		<![endif]-->
        <script src="<?php echo $this->webroot; ?>js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="<?php echo $this->webroot; ?>js/vendor/js-webshim/minified/polyfiller.js"></script>
		
		<script type="text/javascript" src="<?php echo $this->webroot; ?>js/select2.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot; ?>js/vendor/jquery.bootstrap.confirm.popover.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot; ?>js/main.js"></script>
		
		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/main.css" />
 
		<?php echo $this->Js->writeBuffer(); ?>
		
    	<?php
			echo $this->fetch('meta');
    	?>

	</head>
	<body data-spy="scroll" data-offset="100">

	    <div class="navbar-whiter navbar navbar-fixed-top">
	      <div class="navbar-inner">
	        <div class="container">
	          <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </a>
	          <?php echo $this->Html->link('<img alt="COS Archival" src="'.$this->webroot.'img/cos_archival_logo_mini.png" width="136" height="22">', '/', array('class' => 'brand','escape'=>false)); ?>
	          <div class="container nav-collapse">
	            <ul class="nav">
	                <li><?php echo $this->Html->link('About the Archival Project', '/'); ?></li>
	                <li><?php echo $this->Html->link('Getting involved', '/pages/getting_involved'); ?></li>

<?php
if(AuthComponent::user() !== NULL): ?>

	                <li><?php echo $this->Html->link('Your dashboard', '/papers/index'); ?></li>
	                <li><?php echo $this->Html->link('Contact', '/pages/feedback'); ?></li>

<?php
else:
?>
			    <li><?php echo $this->Html->link('Sign up', '/users/register', array('class'=>'')); ?></li>

<?php
endif;
?>
				
				

				
<?php
if(AuthComponent::user() === NULL): ?>
	            <li><?php echo $this->Html->link('Login', '/users/login', array('class'=>'')); ?></li>
<?php
else: ?>
				<li><?php echo $this->Html->link("Logout", '/users/logout', array('title' => 
					 "[". AuthComponent::user('Group.name').'] '.AuthComponent::user('username'))); ?></li>
<?php endif; ?>
				
<?php if(AuthComponent::user('Group.name')=='admin'): ?>
  	<li class="divider-vertical"></li>
	<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Admin'); ?><span class="caret"></span></a>
			<ul class="dropdown-menu">
                <li><?php echo $this->Html->link('List users', '/users/index'); ?></li>
                <li><?php echo $this->Html->link('Add paper', '/papers/add'); ?></li>
                <li><?php echo $this->Html->link('List my coded papers', '/codedpapers/index_mine'); ?></li>
                <li><?php echo $this->Html->link('List all coded papers', '/codedpapers/index'); ?></li>
				
                <li><?php echo $this->Html->link('Interactive tutorial', '/interactive_tutorial'); ?></li>
                <li><?php echo $this->Html->link('Export CSV', '/joinedCodedpapers/export/CSV'); ?></li>
                <li><?php echo $this->Html->link('Export TSV', '/joinedCodedpapers/export/TSV'); ?></li>
                <li><?php echo $this->Html->link('Export Excel', '/joinedCodedpapers/export/excel'); ?></li>
            </ul>
	</li>
<?php endif; ?>
				<?php echo $this->fetch('more_nav'); ?>
			</ul>
				
				<?php echo $this->fetch('sub_nav'); ?>
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

	      <footer class="offset3">
			  <p><img alt="COS" src="<?=$this->webroot?>img/cos_logo_mini.png" width="50" height="30"> &copy; Archival Project <?php echo date('Y'); ?></p>
	      </footer>

	    </div> <!-- /container -->
	</body>
</html>