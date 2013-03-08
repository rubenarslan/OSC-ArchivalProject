<?php
if($newadd = isset($tstart)) {
	$this->layout = 'ajax'; # ready for insertion
	$length = $tstart + 1; # if it's supposed to be added anew, tell me where to start
} else {
	if(isset($this->data['Study'][$s]['Test']))
		$length = count ( $this->data['Study'][$s]['Test'] ); # data gets only passed if it wasn't added anew
	else $length = 0;
	$tstart = 0; # start from the beginning
}
$study_id = Set::classicExtract($this->data,"Study.$s.id"); # we need to give this to the add-button
$addtestid = "test{$s}";

for($t=$tstart; $t < $length; $t++) {
echo '<div class="row-fluid formblock"><div class="span12">';
	
	$destroylink = $this->webroot.'tests/delete/'.Set::classicExtract($this->data,"Study.$s.Test.$t.id");
	echo "<h5><a href='$destroylink' tabindex='-1' class='selfdestroyer btn btn-warning btn-mini' rel='tooltip' title='Delete this test'><i class='icon-trash'></i></a> ";
	echo "Test Nr. ".($s+1).'.'.($t+1).' ';
	echo $this->Form->input("Study.$s.Test.$t.name",array(
		'class' => 'boxless-nameinput', 'label'=> false,'div'=>false, 'placeholder' => 'Test description (optional)')
	);
	echo "</h5>";
	?>
	<p>You can add more tests <a href="#<?=$addtestid;?>"> to this study below</a>.</p>
	<?php
	

	echo $this->Form->hidden("Study.$s.Test.$t.id");	
	echo $this->Form->hidden("Study.$s.Test.$t.effect_id");
	
	
	echo '<div class="row-fluid">';
		echo '<div class="span3">Prior hypothesis:<br>';
		echo $this->Form->input("Study.$s.Test.$t.hypothesized", array(
			'options' => array(
				'Yes, directional' => 'Yes, directional', 
				'Yes, nondirectional' => 'Yes, nondirectional', 
				'No, no hypothesis' => 'No, no hypothesis'
			),
			'type' => 'radio',
			'legend'=> false, 
			'separator' => '<br>',
			));
	echo '</div>';
	
	echo $this->Form->input("Study.$s.Test.$t.prior_hypothesis",array(
		'label' => false,
		'placeholder' => 'Copy-paste the prior hypothesis with its page number.',
		'class' => 'span12 hidden', 
		'rows' => '4', 
		'div'=> array('class'=> "span4")));
#	echo '<div class="span4 offset1"><br>Write down the prior hypothesis, if any, and its page number.</div>';
	echo '</div>';
	
		
	echo '<div class="row-fluid">';
		echo $this->Form->input("Study.$s.Test.$t.analytic_design_code",array(
			'options' => array(
				'' => '',
				'C' => 'C: correlational/multivariate analysis without manipulation',
				'IA' => 'IA: correlational/multivariate internal analysis of manipulation check',
				'X' => 'X: experimental analysis of manipulation effect',
				'RM' => 'RM: experimental analysis of repeated-measures effect',
				'RMX' => 'RMX: combined experimental and repeated-measures effect',
				'Q' => 'Q: quasi-experimental analysis of manipulation effect',
				'O' => 'O: Other, describe in comments'),
			'class' => 'span12 select2analytic_design_code select2no-margin', 
			'placeholder' => 'Choose one',
			'div'=> array('class'=>"span4"))
		);
		

	echo $this->Form->input("Study.$s.Test.$t.methodology_codes", array(
		'class' => "span12 select2no-margin select2methodology_codes", 
		'div'=> array('class'=>"span4"),
		)
	);
	echo '</div>';

	echo '<div class="row-fluid">';
		echo $this->Form->input("Study.$s.Test.$t.independent_variables",array(
			'class' => 'span12 select2variables select2no-margin', 'div'=> array('class'=>"span4"), 'rows' => 2, 'placeholder' => 'comma-separated IVs')
		);
		echo $this->Form->input("Study.$s.Test.$t.dependent_variables",array(
			'class' => 'span12 select2variables select2no-margin', 'div'=> array('class'=>"span4"), 'rows' => 2, 'placeholder' => 'comma-separated DVs')
		);
	echo '</div>';
	echo '<div class="row-fluid">';
		echo $this->Form->input("Study.$s.Test.$t.other_variables",array(
			'class' => 'span12 select2variables select2no-margin', 'div'=> array('class'=>"span8"), 'rows' => 1, 'placeholder' => 'comma-separated covariates etc.')
		);
	echo '</div>';

	echo '<div class="row-fluid sampleinfo">';
		echo $this->Form->input("Study.$s.Test.$t.data_points_excluded",array(
			'class' => 'span8', 'div'=> array('class'=>"span2"), 'label' => 'N excluded')
		);
		echo $this->Form->input("Study.$s.Test.$t.N_used_in_analysis",array(
				'class' => 'span8', 'div'=> array('class'=>"span2"), 'label' => 'N used')
		);
		echo $this->Form->input("Study.$s.Test.$t.reasons_for_exclusions",array(
			'class' => 'span12', 'div'=> array('class'=> array("span4",'hidden')), 'rows' => '2')
		);
		echo '<div class="span2 offset1">You can <a href="#" class="copysample">copy</a> this information from the test before.</div>';
	echo '</div>';

	echo '<div class="row-fluid">';
		echo $this->Form->input("Study.$s.Test.$t.type_of_statistical_test_used",
				array(
			'class' => 'span12', 
			'div'=> array('class'=>"span4"), 
			'label' => 'Type of statistical test',
			'placeholder' => 'e.g. ANOVA, SEM, regression',
			)
		);
	echo '</div>';
	
	echo '<div class="row-fluid">';
		echo $this->Form->input("Study.$s.Test.$t.reported_effect_size_statistic",array(
			'options' => array(
				'' => '',
				'r' => 'r',
				'partial.r' => 'partial r',
				'r.squared' => 'R²',
				'delta.r.squared' => 'ΔR²',
				'regression.b' => 'B (regression coefficient)',
				'regression.beta' => 'b* (standardized regression coefficient)',
				'cohens.d' => 'Cohen\'s d\' (t-test)', 
				'anova.d' => 'd (ANOVA)', 
				'f.squared' => 'f²', 
				'eta.squared' => 'η²', 
				'partial.eta.squared' => 'partial η²', 
				'omega.squared' => 'ω²', 
				'odds.ratio' => 'Odds Ratio', 
				'spearmans.rho' => 'Spearman\'s rho (rank order correlation)', 
				'phi.coefficient' => 'Phi coefficient', 
				'cramers.v' => 'Cramer\'s v', 
				),
			'class' => 'select2effect_size_statistic span12', 'div'=> array('class'=> "span3 select2no-margin"), 
			'label' => 'Effect size statistic',
			'placeholder' => 'Choose one',
			)
		);
		echo $this->Form->input("Study.$s.Test.$t.reported_effect_size_statistic_value",array(
			'class' => 'span8', 'div'=> array('class'=>"span3"), 'label' => 'Reported effect size')
		);
		echo '<div class="span4 coding-hint">Look in the menus for test and effect size statistics for this effect test. Both, or only one may be reported.</div>';
		
	echo '</div>';
	
	echo '<div class="row-fluid">';
		echo $this->Form->input("Study.$s.Test.$t.inferential_test_statistic",array(
			'options' => array(
				'' => '',
				'chi.square' => 'χ²', 
				't' => 't', 
				'z' => 'z', 
				'F' => 'F'),
			'class' => 'select2inferential_test_statistic span12 select2no-margin', 
			'div'=> array('class'=> "span2"), 
			'label' => 'Test stat.',
			'placeholder' => 'Choose one',

			)
		);
		echo $this->Form->input("Study.$s.Test.$t.degrees_of_freedom",array(
			'class' => 'span12', 'div'=> array('class'=>"span1"), 'label' => 'df')
		);
		echo $this->Form->input("Study.$s.Test.$t.inferential_test_statistic_value",array(
			'class' => 'span9', 'div'=> array('class'=>"span2"), 'label' => 'value')
		);
		echo '<div class="span4 offset1 coding-hint">Enter the name and value of the test statistic and its associated degrees of freedom.</div>';
	echo '</div>';
	
	echo '<div class="row-fluid">';
		echo $this->Form->input("Study.$s.Test.$t.reported_significance_of_test",array(
			'class' => 'select2pvalue span11',
			'div'=> array('class'=> "span3"), 
			'label' => 'Significance (reported)', 
			'placeholder' => 'p-value (0.00 - 1)')
		);
		echo $this->Form->input("Study.$s.Test.$t.computed_significance_of_test",array(
			'class' => 'span9', 'div'=> array('class'=>"span3"), 'label' => '(exactly computed)')
		);
	echo '</div>';
	
	echo '<div class="row-fluid">';
	echo '<div class="span4">Was the hypothesis supported?</div>';
		echo $this->Form->input("Study.$s.Test.$t.hypothesis_supported",array(
			'options' => array('Yes' => 'Yes','No' => 'No','Reverse' => 'Reverse','Complex' => 'Complex'),
			'type' => 'radio',
			'legend'=> false,
			'class' => '', 'div'=> array('class'=>"span4")
			)
		);
	echo '</div>';
	
	
	echo '<div class="row-fluid">';
	echo '<div class="span12">How certain are you that you correctly identified the test\'s:</div>';
	echo '<div class="span4">… hypothesis</div>';
		echo $this->Form->input("Study.$s.Test.$t.certainty_hypothesis",array(
			'options' => array('0' => 'not at all','1' => 'somewhat','2' => 'very'),
			'type' => 'radio',
			'legend'=> false,
			'class' => '', 'div'=> array('class'=>"span4")
			)
		);
		echo '<div class="span4">… methodology and variables</div>';
			echo $this->Form->input("Study.$s.Test.$t.certainty_meth_var",array(
				'options' => array('0' => 'not at all','1' => 'somewhat','2' => 'very'),
				'type' => 'radio',
				'legend'=> false,
				'class' => '', 'div'=> array('class'=>"span4")
				)
			);
		echo '<div class="span4">… statistics</div>';
			echo $this->Form->input("Study.$s.Test.$t.certainty_statistics",array(
				'options' => array('0' => 'not at all','1' => 'somewhat','2' => 'very'),
				'type' => 'radio',
				'legend'=> false,
				'class' => '', 'div'=> array('class'=>"span4")
				)
			);
		echo '<div class="span4">… support for hypothesis</div>';
			echo $this->Form->input("Study.$s.Test.$t.certainty_hypothesis_supported",array(
				'options' => array('0' => 'not at all','1' => 'somewhat','2' => 'very'),
				'type' => 'radio',
				'legend'=> false,
				'class' => '', 'div'=> array('class'=>"span4")
				)
			);
	echo '</div>';

	echo '<div class="row-fluid">';
		echo $this->Form->input("Study.$s.Test.$t.comment",array(
			'class' => 'span12', 
			'div'=> array('class'=>"span6"), 
			'rows' => 2, 
			'placeholder' => 'Enter any comments (coding format did not apply to the effect test, difficulties or uncertainties during coding)…')
		);
	echo '</div>';


echo '</div></div>';
	
}

echo "<h5 id='$addtestid'>";
echo  $this->Html->link("Add effect test ".($s+1).'.'.($t+1),
	array('controller' => 'codedpapers', 'action' => 'moretests'), array('class' => 'btn btn-mini'));
echo "</h5>";
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {
	$('.copysample').each(function(i,elm) { // copy the sample information from the preceding test if it exists
		$(elm).off('click','*');
		$(elm).on('click', function(evnt) {
			currenttestinputs = $(evnt.target).closest('.sampleinfo').find('input,textarea');
			prevtestinputs = $(evnt.target).closest('.formblock').prev('.formblock').find('.sampleinfo input,.sampleinfo textarea');
			for(i=0; i < prevtestinputs.length; i++) { // only if a previous test exists
				currenttestinputs[i].value = prevtestinputs[i].value;
				$(currenttestinputs[i]).trigger('change'); // so the textarea may be shown
			}
			return false;
		});
	});
	$("#<?=$addtestid?> a.btn").bind("click", function (event) {
		$.ajax( {
			data:"s=<?=$s?>&tstart=<?=$t?>&study_id=<?=$study_id;?>", 
			dataType:"html", 
			success:function (data, textStatus) {
				$("#<?=$addtestid?>").replaceWith(data);
			}, 
			url:"<?php echo $this->webroot; ?>codedpapers/moretests"
			});
		return false;
	});
	$("[rel=tooltip]").tooltip();
	
<?php if($newadd) echo	"activateinputs(); // new inputs need the JS love too
"; ?>
});
//]]>;
</script>