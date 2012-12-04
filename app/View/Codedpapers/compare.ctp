<?php $this->start('sidebar'); ?>
<div class="well span3">
<h3>Comparison</h3>
<p>Here you'll see a side-by-side comparison of two codings of the same paper.<br>
	Please try to resolve all differences.
	<ol>
		<li>If you see that the other coder is correct, please change your own coding accordingly.</li>
		<li>If you think the other one is incorrect, please (politely) tell him or her so via email.</li>
		<li>If you're both unsure, who's right, alert an administrator.</li>
	</ol>
<?php 
# todo: list admins?
 ?></p>
<h4>View the two papers individually.</h4>
<ul class="btn-group">
	<li class="btn">
		<?php echo $this->Html->link(__('Left'), "/codedpapers/code/". $c1['Study.0.codedpaper_id']); ?>
	</li>
	<li class="btn">
		<?php echo $this->Html->link(__('Right'), "/codedpapers/code/". $c2['Study.0.codedpaper_id']); ?>
	</li>
</ul>
</div>
<?php $this->end(); ?>
<h1>Compare coded papers</h1>

<table class="table">
<?php

function inc($matches) {
    return ++$matches[1];
}

foreach($c1 as $key => $val) {
	$isid = substr($key,-3);
	if($isid != '_id' AND $isid!='.id') {
		$key1 =  preg_replace_callback( "|(\d+)|", "inc", $key);
	?>
	<tr>
		<th><?=$key1?></th>
		<td><?=$val?></td>
		<td><?=$c2[$key] ?></td>
	</tr>
<?php
	}
}
?>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<script type="text/javascript">
//<![CDATA[

//]]>
</script>