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
	
	echo '<div class="row-fluid">';
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.analytic_design_code",array(
		'class' => 'span12', 'div'=> array('class'=>"span3"))
	);
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.methodology_codes",array(
		'class' => 'span12', 'div'=> array('class'=>"span3"))
	);
	echo '</div>';
	
	echo '<div class="row-fluid">';
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.independent_variables",array(
		'class' => 'span12', 'div'=> array('class'=>"span4"), 'rows' => 2, 'placeholder' => 'comma-separated IVs')
	);
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.dependent_variables",array(
		'class' => 'span12', 'div'=> array('class'=>"span4"), 'rows' => 2, 'placeholder' => 'comma-separated DVs')
	);
	echo '<div class="row-fluid">';
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.other_variables",array(
		'class' => 'span12', 'div'=> array('class'=>"span8"), 'rows' => 1, 'placeholder' => 'comma-separated covariates etc.')
	);
	echo '</div>';
	
	echo '<div class="row-fluid">';
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.data_points_excluded",array(
		'class' => 'span8', 'div'=> array('class'=>"span2"), 'label' => 'N excluded')
	);
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.N_used",array(
			'class' => 'span8', 'div'=> array('class'=>"span2"), 'label' => 'N used')
	);
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.reasons_for_exclusions",array(
		'class' => 'span12', 'div'=> array('class'=> array("span4",'hidden')), 'rows' => '2')
	); # TODO: conditional
	
	echo '<div class="span2 offset1">You can <a href="#" class="copysample">copy</a> the sample size from the test before.</div>';
	echo '</div>';
	
	echo '<div class="row-fluid">';
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.type_statistical_test",array(
		'class' => 'span12', 'div'=> array('class'=>"span4"), 'label' => 'Type of statistical test')
	);
	echo '</div>';
	
	echo '<div class="row-fluid">';
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.inferential_test_statistic",array(
		'class' => 'span12', 'div'=> array('class'=>"span2"), 'label' => 'Test stat.')
	);
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.degrees_of_freedom",array(
		'class' => 'span12', 'div'=> array('class'=>"span1"), 'label' => 'df')
	);
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.inferential_test_statistic_value",array(
		'class' => 'span9', 'div'=> array('class'=>"span2"), 'label' => 'value')
	);
	echo '<div class="span4 offset1">Enter the name and value of the test statistic and its associated degrees of freedom.</div>';
	
	echo '</div>';
	
	echo '<div class="row-fluid">';
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.reported_significance_of_test",array(
		'class' => 'span8', 'div'=> array('class'=>"span3"), 'label' => 'Significance (reported)', 'placeholder' => 'p-value (0.00 - 1)')
	);
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.computed_significance_of_test",array(
		'class' => 'span12', 'div'=> array('class'=>"span2"), 'label' => '(computed)')
	);
	echo '</div>';
	
	echo '<div class="row-fluid">';
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.main_result_of_test",array(
		'class' => 'span12', 'div'=> array('class'=>"span6"))
	);
	echo '<div class="span4"><br>Summarise the main result.</div>';
	echo '</div>';
	
	echo '<div class="row-fluid">';
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.reported_effect_size",array(
		'class' => 'span8', 'div'=> array('class'=>"span3"), 'label' => 'Effect size (reported)')
	);
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.computed_effect_size",array(
		'class' => 'span12', 'div'=> array('class'=>"span2"), 'label' => '(computed)')
	);
	echo '</div>';
	
	echo '<div class="row-fluid">';
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.reported_statistical_power",array(
		'class' => 'span8', 'div'=> array('class'=>"span3"), 'label' => 'Power (reported)', 'placeholder' => '0.00 - 1')
	);
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.computed_statistical_power",array(
		'class' => 'span12', 'div'=> array('class'=>"span2"), 'label' => '(computed)')
	);
	
	echo '<div class="span4 offset1"><br>You can use G*Power to calculate the power.</div>';

	echo '</div>';
	
}

$addtestid = "test{$s}_{$e}";
echo "<h5 id='$addtestid'>";
echo  $this->Html->link("Add test $s.$e.$t",
	array('controller' => 'codedpapers', 'action' => 'moretests'));
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
<?php if($newadd) echo	"activateinputs(); // new inputs need the JS love too
"; ?>
	});
//]]>;
</script>