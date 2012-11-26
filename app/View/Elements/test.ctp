<?php
if($newadd = isset($tstart)) {
	$this->layout = 'ajax'; # ready for insertion
	$length = $tstart + 1; # if it's supposed to be added anew, tell me where to start
} else {
	$length = count ( $data['Study'][$s]['Effect'][$e]['Test'] ); # data gets only passed if it wasn't added anew
	$tstart = 0; # start from the beginning
}
for($t=$tstart; $t < $length; $t++) {
	echo $this->Form->hidden("Study.$s.Effect.$e.Test.$t.id");	
	echo $this->Form->hidden("Study.$s.Effect.$e.Test.$t.effect_id");
	
	echo "<h5>Test Nr. $s.$e.$t </h5>";
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.analytic_design_code");
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.methodology_codes");
	
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.independent_variables");
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.dependent_variables");
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.other_variables");
	
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.data_points_excluded");
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.reasons_for_exclusions"); # TODO: conditional
	
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.type_statistical_test");
	
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.N_used");
	
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.inferential_test_statistic");
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.inferential_test_statistic_value");
	
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.degrees_of_freedom");
	
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.reported_significance_of_test");
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.computed_significance_of_test");
	
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.main_result_of_test");
	
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.reported_effect_size");
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.computed_effect_size");
	
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.reported_statistical_power");
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.computed_statistical_power");
}

$addtestid = "test{$s}_{$e}";
echo "<h5>";
echo  $this->Html->link("Add test $s.$e.$t",
	array('controller' => 'codedpapers', 'action' => 'moretests'),
	array('id' => $addtestid));
echo "</h5>";
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {
	$("#<?=$addtestid?>").bind("click", function (event) {
		$.ajax( {
			data:"e=<?=$e?>&s=<?=$s?>&tstart=<?=$t?>", 
			dataType:"html", 
			success:function (data, textStatus) {
				$("#<?=$addtestid?>").replaceWith(data);
			}, 
			url:"\/ArchivalProject\/codedpapers\/moretests"
			});
		return false;
		});
<?php if($newadd) echo	"addonblurtoallinputs(); // new inputs need the JS love too
"; ?>
	});
//]]>;
</script>