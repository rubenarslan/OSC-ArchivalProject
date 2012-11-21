<?php
echo $this->element('test', array(
    "s" => $this->request->query['s'],
    "e" => $this->request->query['e'],
	"tstart" => $this->request->query['tstart']
));
?>