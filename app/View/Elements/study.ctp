<?php
if($newadd = isset($sstart)) {
	$this->layout = 'ajax'; # ready for insertion
	$length = $sstart + 1; # if it's supposed to be added anew, tell me where to start
} else {
	$length = count ( $this->data['Study'] ); # data gets only passed if it wasn't added anew
	$sstart = 0; # start from the beginning
}
for($s= $sstart; $s < $length; $s++) {
	
echo '<div class="row-fluid formblock"><div class="span12">';
	echo "<h3>Study Nr. $s <a href='#' class='selfdestroyer'>" . $this->TB->icon("trash", "black") . "</a></h3>";
	
	echo $this->Form->hidden("Study.$s.id");	
	echo $this->Form->hidden("Study.$s.codedpaper_id");	
	echo $this->Form->input("Study.$s.replication_code");
	#	debug($replicable_studies);
	echo $this->Form->select("Study.$s.replicates_study_id", $replicable_studies);
	
	echo '<div class="row-fluid"><div class="span12">';
		$options = array( "s" => $s );
		if($newadd) $options["estart"] = 0;
		else $options["data"] = $this->data;
		echo $this->element('effect', $options);
	echo '</div></div>';
echo '</div></div>';
}

$addstudyid = "study_adder";
echo "<h4 id='$addstudyid'>";
echo  $this->Html->link("Add Study $s",
	array('controller' => 'codedpapers', 'action' => 'morestudies')
	);
echo "</h4>";
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {$("#<?=$addstudyid?>").bind("click", function (event) {$.ajax( {data:"sstart=<?=$s?>", dataType:"html", success:function (data, textStatus) {
	$("#<?=$addstudyid?>").replaceWith(data);
	}, url:"<?php echo $this->webroot; ?>codedpapers/morestudies"});
return false;});});
//]]>;
</script>