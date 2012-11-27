<?php
if($newadd = isset($estart)) {
	$this->layout = 'ajax'; # ready for insertion
	$length = $estart + 1; # if it's supposed to be added anew, tell me where to start
} else {
	$length = count ( $this->data['Study'][$s]['Effect'] ); # data gets only passed if it wasn't added anew
	$estart = 0; # start from the beginning
}
for($e= $estart; $e < $length; $e++) {

echo '<div class="row-fluid formblock"><div class="span12">';
	echo "<h4>Effect Nr. $s.$e <a href='#' class='selfdestroyer btn btn-warning btn-mini' rel='tooltip' title='Delete this effect'><i class='icon-trash'></i></a></h4>";
	
	echo $this->Form->hidden("Study.$s.Effect.$e.id");
	echo $this->Form->hidden("Study.$s.Effect.$e.study_id");	
	echo $this->Form->input("Study.$s.Effect.$e.prior_hypothesis");
	echo $this->Form->radio("Study.$s.Effect.$e.novel_effect", array('Yes','No'));
	
#	if($this->data['Study'][$s]['Effect'][$e]['novel_effect'] == 'No') 
#	echo $this->Form->input("Study.$s.replicates_study_id");
	
	echo '<div class="row-fluid"><div class="span11 offset1">';
		$options = array( "s" => $s, "e" => $e );
		if($newadd) $options["tstart"] = 0;
		else $options["data"] = $this->data;
		echo $this->element('test', $options);
	echo '</div></div>';

echo '</div></div>';
}
$addeffectid = "effect{$s}";
echo "<h4 id='$addeffectid'>";
echo  $this->Html->link("Add effect $s.$e",
	array('controller' => 'codedpapers', 'action' => 'moreeffects'), array('class' => 'btn btn-small')
	);
echo "</h4>";
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {$("#<?=$addeffectid?>").bind("click", function (event) {$.ajax( {data:"s=<?=$s?>&estart=<?=$e?>", dataType:"html", success:function (data, textStatus) {
	$("#<?=$addeffectid?>").replaceWith(data);
	}, url:"<?php echo $this->webroot; ?>codedpapers/moreeffects"});
return false;});});
//]]>;
</script>