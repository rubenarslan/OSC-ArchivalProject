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
		<?php echo $this->Html->link(__('Left'), "/codedpapers/view/". $c1['Study.0.codedpaper_id']); ?>
	</li>
	<li class="btn">
		<?php echo $this->Html->link(__('Right'), "/codedpapers/view/". $c2['Study.0.codedpaper_id']); ?>
	</li>
</ul>
</div>
<?php $this->end(); ?>
<div class="span9">
<h1>Compare coded papers</h1>

<table class="table">
<?php

function inc($matches) {
    return ++$matches[1];
}
asort($keys);
$missing = 'missingmissingmissingmissingmissingmissingmissingmissingmissingmissingmissingmissingmissing';
foreach($keys as $key):
	if(array_key_exists($key,$c1)) $val = $c1[$key];
	else $val = $missing;
	if(array_key_exists($key,$c2)) $val2 = $c2[$key];
	else $val2 = $missing;
	
	$isid = substr($key,-3);
	if($isid != '_id' AND $isid!='.id'):
		$key1 =  preg_replace_callback( "|(\d+)|", "inc", $key);
		$key1 = Inflector::humanize(str_replace("."," ",$key1));
		
		$dist = levenshtein($val,$val2);
		$longest = max(array(strlen($val),strlen($val2)));
		if($dist===-1 AND $val!==$val2):
			$perc = 0;
		elseif($longest===0): 
			$perc = null;
		else: 
			$perc = 1-$dist/$longest;
		endif;
		$hsl = $perc * 120;
		if($perc!==null):
			$color = "hsl($hsl,50%,50%)";
		else:
			$color = 'gray';
		endif;
		
		if($val===$missing): 
			$val = '<i>missing</i>';
		endif;
		if($val2===$missing):
			$val2 = '<i>missing</i>';
		endif;
		
	?>
	<tr>
		<th><?=$key1?></th>
		<td style="border-right:10px solid <?=$color?>"><?=$val?></td>
		<td><?=$val2 ?></td>
	</tr>
<?php
	endif;
endforeach;
?>
</table>
</div>