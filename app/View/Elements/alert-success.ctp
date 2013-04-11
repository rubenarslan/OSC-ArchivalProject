<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php
	if(isset($params['bold']))
		echo $params['bold'];
	else
		echo 'Success. ';
	 	?></strong>
	<?=$message;?>
</div>