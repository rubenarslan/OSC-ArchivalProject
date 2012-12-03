<?php
$Paper = ClassRegistry::init('Paper');
$multipleCodings = $Paper->getMultipleCodings($paper_id);
$ids = array_keys($multipleCodings);
$users = array_values($multipleCodings);
?>
<div class="actions btn-group">
	<?php echo $this->Html->link(__('Code this paper for the ').$this->Ordinal->addSuffix(count($multipleCodings)+1,true). ' time', "/codedpapers/add/". $paper_id, array('class' => 'btn btn-primary','escape' => false)); ?>
	 <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
	    <span class="caret"></span>
	 </button>
	<ul class="dropdown-menu">
		<?php foreach($multipleCodings AS $id => $user) { ?>
		<li><?php echo $this->Html->link('View '.$user."'s coding", "/codedpapers/view/$id"); ?></li>
		<?php } ?>
	</ul>
</div>
<?php
if(count($users)!==0) {
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
				if($user != $user2) { ?>
		<li><?php echo $this->Html->link($user." <-> ".$user2, "/codedpapers/compare/$id/$id2"); ?></li>
		<?php }
			}
		} ?>
	</ul>
</div>
<?php } ?>