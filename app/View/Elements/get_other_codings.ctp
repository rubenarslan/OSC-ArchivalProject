<?php
$Paper = ClassRegistry::init('Paper');
$multipleCodings = $Paper->getMultipleCodings($paper_id);
$ids = array_keys($multipleCodings);
$users = array_values($multipleCodings);
if(count($users)>1) {
?>
<div class="actions btn-group">
	<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Compare…'); ?><span class="caret"></span>
	  </a>
	<ul class="dropdown-menu">
		<?php 
		for($i=0;$i < count($users);$i++) {
			for($j = $i; $j < count($users); $j++) {
				$id = $ids[$i];
				$id2 = $ids[$j];
				$user = $users[$i];
				$user2 = $users[$j];
				if($user != $user2 AND ($user == $user_name OR $user2 == $user_name)) { ?>
		<li><?php echo $this->Html->link($user." <-> ".$user2, "/codedpapers/compare/$id/$id2"); ?></li>
		<?php }
			}
		} ?>
	</ul>
</div>
<?php }
else {
	?>
	<p>Not yet.</p>
<?php } ?>