<br><br>
<h1>Show coded study</h1>
<p>
	<?php 
	#Form::create($thiscodedpaper);
	var_dump($thiscodedpaper);
	echo $this->Form->create("Codedpaper");
	#echo $this->TwitterBootstrap->input("id");
	echo $this->Form->input('id');
 ?>
<?php echo $this->Form->end('Finish'); ?>
</p>