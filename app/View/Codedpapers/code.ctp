<h1>Code paper</h1>
<h2><abbr title="Digital Object Identifier">DOI</abbr>: <?php  echo $this->data['Paper']['doi'] ?></h2> 

<script src="http://malsup.github.com/jquery.form.js"></script>	
<p>
<?php 
echo $this->Form->create("Codedpaper");
echo $this->Form->hidden("Paper.id");
echo $this->Form->hidden("Paper.doi");
echo $this->Form->hidden("id");	
echo $this->Form->hidden("paper_id");
	
echo $this->element('study', array(
	"data" => $this->data
));

#echo $this->Js->submit('Save');
echo $this->Form->end('Save'); 
?>
</p>
<?php
debug($this->data);  ?>