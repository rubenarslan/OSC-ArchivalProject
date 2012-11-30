<?php
echo $this->element('study', array(
	"sstart" => $this->request->query['sstart'],
	"data" => $this->data
));
?>