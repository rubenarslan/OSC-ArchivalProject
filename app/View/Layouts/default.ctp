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
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>

    	<?php
    		//Load Bootstrap:
    		echo $this->Bootstrap->load('dev'); # use dev while still working on it
    		#echo $this->Bootstrap->load(); 


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
	            	<li><?php echo $this->Html->link('Sign up', '/users/register'); ?></li>
	                <li><?php echo $this->Html->link('Code a new paper', '/papers/code'); ?></li>
	                <li><?php echo $this->Html->link('List my coded papers', '/codedpapers/index'); ?></li>
	            </ul>
	          </div><!--/.nav-collapse -->
	        </div>
	      </div>
	    </div>

	    <div class="container-fluid">
	        <div class="row-fluid">
	            <div class="span3">
	              <div class="well sidebar-nav">
	                <h3>Sidebar</h3>
	                <ul class="nav nav-list">
	                  <li class="nav-header">Sidebar</li>
	                  <li><?php echo $this->Html->link('Login', '/users/login'); ?></li>
	                </ul>
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
