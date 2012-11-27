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
	echo "<h3>Study Nr. $s <a href='#' class='selfdestroyer btn btn-warning btn-mini' rel='tooltip'  data-dismiss='alert' title='Delete whole study'><i class='icon-trash'></i></a></h3>";
	
	echo $this->Form->hidden("Study.$s.id");	
	echo $this->Form->hidden("Study.$s.codedpaper_id");	
	echo $this->Form->input("Study.$s.replication_code", array(
		'data-provide' => 'typeahead',
		'data-source' => '["E","Direct","Conceptual","Direct+X","Conceptual+X","Novel"]', 
		'data-min-length' => '3',
		));
/*		<li><a href="#" class="btn btn-info btn-small" rel="tooltip" data-content="
				Novel: No replication mentioned.
				Direct: Direct replication. The stated goal is, at least in part of the design, to exactly reproduce the hypothesis and methods of the previous study, making only those changes that are necessary to achieve the same psychological meaning among the new participant population.
				Conceptual: Conceptual replication. The study’s stated goal is, at least in part of the design, to test the hypothesis of the previous study, using the same conceptual variables but changing their operationalization in ways that go beyond merely adapting the materials for a new population or occasion.
				+X: The +X goes into the code if the study also contains elements of extension that go beyond the type of replication recorded.
				+#: After the letter code, a number code without brackets is placed to show that the study is presented as a replication/extension of an earlier study in the article itself, instead of, or in addition to, replicating another article." data-original-title="Replication codes">Explain codes</a></li>*/
	
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
	array('controller' => 'codedpapers', 'action' => 'morestudies'), array('class' => 'btn')
	);
echo "</h4>";
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {$("#<?=$addstudyid?>").bind("click", function (event) {$.ajax( {data:"sstart=<?=$s?>", dataType:"html", success:function (data, textStatus) {
	$("#<?=$addstudyid?>").replaceWith(data);
	}, url:"<?php echo $this->webroot; ?>codedpapers/morestudies"});
return false;});
$("[rel=popover]").popover();


});
//]]>;
</script>