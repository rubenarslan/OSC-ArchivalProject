<?php
if($this->request->is('ajax')) {
	$this->layout = 'ajax';
	$length = $tstart + 1;
	
} else {
	$length = count ( $data['Study'][$s]['Effect'][$e]['Test'] );
	$tstart = 0;
}
for($t=$tstart; $t < $length; $t++) {
	echo $this->Form->hidden("Study.$s.Effect.$e.Test.$t.id");	
	echo $this->Form->hidden("Study.$s.Effect.$e.Test.$t.effect_id");	
	echo "<h5>Test Nr. $s.$e.$t </h5>";
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.analytic_design_code");
	echo $this->Form->input("Study.$s.Effect.$e.Test.$t.N_used");
}
?>