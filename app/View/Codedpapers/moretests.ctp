<?php
echo $this->element('test', array(
    "s" => $this->request->query['s'],
	"tstart" => $this->request->query['tstart'],
	"data" => $this->data
));
?>