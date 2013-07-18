<?php
$Paper = ClassRegistry::init('Paper');
$multipleCodings = $Paper->getMultipleCodings($paper_id);
$coded_this = $Paper->hasUserCoded($paper_id,AuthComponent::user('id'));
?>
<div class="actions btn-group">
	<?php 
	if($coded_this===null):
		$buttonclass = '';
		
	  	echo $this->Html->link(__('Code for the ').$this->Ordinal->addSuffix(count($multipleCodings)+1,true). ' time', "/codedpapers/add/". $paper_id, array('class' => 'btn'.$buttonclass,'escape' => false)); 
	elseif($coded_this===false):
		 $buttonclass = ' btn-info';
		echo $this->Html->link(__('Continue coding'), "/codedpapers/add/". $paper_id, array('class' => 'btn'.$buttonclass,'escape' => false, 'title' => "You've started coding this article" )); 
  	else:
		 $buttonclass = ' btn-primary';
		
		echo $this->Html->link(__('Review (%s complete)',count($multipleCodings)), "/codedpapers/add/". $paper_id, array('class' => 'btn'.$buttonclass,'escape' => false, 'title' => "You've completed coding this article" )); 
   endif;
   
   $own_coding = ($coded_this!==null) ? 1:0;
   
	
	if($multipleCodings AND count($multipleCodings)>$own_coding) {
		$ids = array_keys($multipleCodings);
		$users = array_values($multipleCodings);
		if(in_array(AuthComponent::user('id'),$ids)) $coded_this = true;
		
	?>
	 <button class="btn<?=$buttonclass?> dropdown-toggle" data-toggle="dropdown">
	    <span class="caret"></span>
	 </button>
	<ul class="dropdown-menu">
		<?php foreach($multipleCodings AS $id => $user) { ?>
		<li><?php echo $this->Html->link('View '.$user."'s coding", "/codedpapers/view/$id"); ?></li>
		<?php } ?>
	</ul>
	<?php }  ?>
</div>
<?php
if(count($multipleCodings)>$own_coding) {
?>
<div class="actions btn-group">
  	<a class="btn <?=$buttonclass?> dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Compare…'); ?>
		<span class="caret"></span></a>
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