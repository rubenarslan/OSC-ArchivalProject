<?php
if($newadd = isset($sstart)) {
	$this->layout = 'ajax'; # ready for insertion
	$length = $sstart + 1; # if it's supposed to be added anew, tell me where to start
} else {
	if(isset($this->data['Study']))
		$length = count ( $this->data['Study'] ); # data gets only passed if it wasn't added anew
	else $length = 0;
	$sstart = 0; # start from the beginning
}

$codedpaper_id = Set::classicExtract($this->data,"Codedpaper.id"); # we need to give this to the add-button
if(!$codedpaper_id)
	$codedpaper_id = Set::classicExtract($this->data,"Study.$sstart.codedpaper_id"); # we need to give this to the add-button	

$addstudyid = "study_adder";

for($s= $sstart; $s < $length; $s++) {

echo '<div class="row-fluid formblock"><div class="span12">';
	
	$destroylink = $this->webroot.'studies/delete/'.Set::classicExtract($this->data,"Study.$s.id");
	echo "<h3><a href='$destroylink' tabindex='-1' class='selfdestroyer btn btn-warning btn-mini' title='Delete whole study'><i class='icon-trash hastooltip'></i></a> ";
	echo "Study ";
	echo $this->Form->input("Study.$s.name",array(
		'class' => 'boxless-nameinput', 
		'label'=> false,
		'div'=>false, 
		'placeholder' => ($s+1).' Study number and name',
		'title' => "Try to number and name this study, so that other coders will know which one you mean."
		)
	);
	echo "</h3>";
	?>
	<p>If this study was previously coded, follow the previous coder’s study &amp; test names and numbering, as long as you agree with their scheme.
<br>
You can add more studies <a href="#<?=$addstudyid;?>">below</a>.</p>
	<?php
		
	echo $this->Form->hidden("Study.$s.id");
	echo $this->Form->hidden("Study.$s.codedpaper_id");	
	
	echo '<div class="row-fluid">
		<span class="span1" title="The meaning of each replication code is available on the left">Replication: </span>';
		echo '<div class="span3">';
			echo $this->Form->input("Study.$s.replication", array(
				'options' => array('' => '', 
					'Novel' => 'Novel', 
					'Replication' => 'Replication of some sort',
					),
				'label' => false,
				'class' => 'span12 select2replication',
				'div' => false
			));
			echo '<div class="replication_optional">';
				echo $this->Form->input("Study.$s.replication_code", array(
					'options' => array('' => '', 
						'Direct' => 'Direct', 
						'Direct+X' => 'Direct+X', 
						'Conceptual' => 'Conceptual', 
						'Conceptual+X' => 'Conceptual+X', 
						'E' => 'E'
						),
					'placeholder' => 'Replication Code',
					'label' => false,
					'class' => 'span12 select2replication_code',
					'div' => false
				));
			echo '</div>';
		echo '</div>';

		echo '<div class="span6 replication_optional">';
	
			echo $this->Form->input("Study.$s.replicates_study_id", array(
					'options' => $replicatesStudyId,
					'class' => 'span12 select2studies',
					'label' => false,
					'div' => array('class' => 'span12' ),
				));
			echo $this->Form->input("Study.$s.replication_freetext", array(
					'class' => 'study-freetext span12',
					'label' => false,
					'rows' => 2,
					'placeholder' => "… or paste a free-form reference.",
					'div' => array('class' => 'span8 no-left-margin' ),
				));
			echo $this->Form->input("Study.$s.replication_freetext_study", array(
					'class' => 'study-freetext span12',
					'label' => false,
					'type' => 'text',
					'placeholder' => "(identify study)",
					'title' => 'If you\'re referring to a multi-study paper, please identify which study in it you mean',
					'div' => array('class' => 'span4' ),
				));
		echo '</div>';
	echo '</div>';
		
	?>
	<p>Read the article's abstract, looking for statements of key effects. Each effect will have one or more statistical tests supporting it. Tests may or may not have a prior hypothesis stated in the article.</p>
	<?php
	echo '<div class="row-fluid"><div class="span11 offset1">';
		$options = array( "s" => $s);
		if($newadd) $options["tstart"] = 0;
		$options["data"] = $this->data;
		echo $this->element('test', $options);
	echo '</div></div>';
	
	echo '<div class="row-fluid">';
	echo '<div class="span12">How certain are you that you correctly identified the study\'s:</div>';
	echo '<div class="span4">… key effect test(s)</div>';
		echo $this->Form->input("Study.$s.certainty_key_effect_tests",array(
			'options' => array('0' => 'not at all','1' => 'somewhat','2' => 'very'),
			'type' => 'radio',
			'legend'=> false,
			'class' => '', 'div'=> array('class'=>"span4")
			)
		);
		echo '<div class="span4">… status as a replication</div>';
			echo $this->Form->input("Study.$s.certainty_replication_status",array(
				'options' => array('0' => 'not at all','1' => 'somewhat','2' => 'very'),
				'type' => 'radio',
				'legend'=> false,
				'class' => '', 'div'=> array('class'=>"span4")
				)
			);
	echo '</div>';
	echo '<div class="row-fluid">';
		echo $this->Form->input("Study.$s.study_comment",array(
			'class' => 'span12', 
			'div'=> array('class'=>"span6"), 
			'rows' => 2, 
			'placeholder' => 'Enter any comments on this study…')
		);
	echo '</div>';
	
echo '</div></div>';

}

echo "<h4 id='$addstudyid' class='adder_elm'>";
echo  $this->Html->link("Add Study ".($s+1),
	array('controller' => 'codedpapers', 'action' => 'morestudies','?' => array(
		'sstart' => $s,
		'codedpaper_id' => $codedpaper_id,
		)), array('class' => 'btn adder')
	);
echo "</h4>";
?>