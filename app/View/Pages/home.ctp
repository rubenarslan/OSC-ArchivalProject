<?php
$this->start('sub_nav');
?>
<ul class="nav-offset1 sub_nav nav nav-pills">
  <li><a href="#goals">Goals</a></li>
  <li><a href="#other_osc_projects">Other COS Projects</a></li>
</ul>
<?php
$this->end();
?>
<div class="offset2">

<h4><big><strong>COS-Archival</strong></big> is an online project coding psychology research articles, spread across many teams and locations. <br><br></h4>

<p><img src="<?=$this->webroot?>/img/cos_logo.png" width="150"><br><br></p>

<p><?=$this->Html->link('Sign up here!','/users/register',array('class' => 'btn btn-large btn-info'))?><br><br></p>

<h3 id="goals">Goals</h3>
<p>
	The COS-Archival project is designed to code articles from the first three months of three 2008 psychology journals. Our aim is to objectively assess research and replication practices and, from there, seek to improve them across disciplines. <br><br>
</p>


<h3 id="other_osc_projects">Other COS Projects</h3>
<p>
	The Open Science Collaboration (COS) is an international, online collaboration funded through the Center for Open Science that aims to investigate and improve research practices through a variety of large projects:</p>

<p>	The Reproducibility Project is another multi-research team effort to replicate studies and examine the results from the same three 2008 psychology journals. </p>

<p>	The Open Science Framework is software developed by COS designed to facilitate research and promote scientific values.
</p>

</div>