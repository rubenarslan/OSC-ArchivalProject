<h1>Code paper</h1>
<h2><abbr title="Digital Object Identifier">DOI</abbr>: <?php  echo $this->data['Paper']['doi'] ?></h2> 

<script src="http://malsup.github.com/jquery.form.js"></script>

<script> 
    // wait for the DOM to be loaded 
 /*   $(document).ready(function() { 
        // bind 'myForm' and provide a simple callback function 
        $('#CodedpaperCodeForm').ajaxForm(function() { 
            alert("Thank you for coding!"); 
        }); 
    }); */
	$.ajax({
	    url: '../moretests',
	    success: function (result) {
	        $('#more.tests').html(result);
	    }
	});
</script>
<p>
<?php 
echo $this->Form->create("Codedpaper");
echo $this->Form->hidden("id");	
echo $this->Form->hidden("paper_id");	
echo "<div id='#moretests>'> </div>";

for($s=0; $s < count ( $this->data['Study'] ); $s++) {
	
	echo "<h3>Study Nr. $s </h3>";
	
	echo $this->Form->hidden("Study.$s.id");	
	echo $this->Form->hidden("Study.$s.codedpaper_id");	
	echo $this->Form->input("Study.$s.replication_code");	
	
	for($e=0; $e < count ( $this->data['Study'][$s]['Effect'] ); $e++) {
		echo "<h4>Effect Nr. $s.$e </h4>";
		echo $this->Form->hidden("Study.$s.Effect.$e.id");	
		echo $this->Form->hidden("Study.$s.Effect.$e.study_id");	
		echo $this->Form->input("Study.$s.Effect.$e.prior_hypothesis");	

		echo $this->element('test', array(
		    "s" => $s,
		    "e" => $e,
			"data" => $this->data
		));
		echo $this->Js->link("More",
			array('controller' => 'codedpapers', 'action' => 'moretests'),	
			array(
			'data' =>  array(
		    "s" => $s,
		    "e" => $e,
			"tstart" => 3
			),
			'update' => '#moretests'
		));
/*		for($t=0; $t < count ( $this->data['Study'][$s]['Effect'][$e]['Test'] ); $t++) {
			echo $this->Form->hidden("Study.$s.Effect.$e.Test.$t.id");	
			echo $this->Form->hidden("Study.$s.Effect.$e.Test.$t.effect_id");	
			echo "<h5>Test Nr. $s.$e.$t </h5>";
			echo $this->Form->input("Study.$s.Effect.$e.Test.$t.analytic_design_code");
			echo $this->Form->input("Study.$s.Effect.$e.Test.$t.N_used");
		}
*/
	}
}
echo $this->Js->submit('Save');
echo $this->Form->end(); ?>
</p>
<?php
debug($this);  ?>