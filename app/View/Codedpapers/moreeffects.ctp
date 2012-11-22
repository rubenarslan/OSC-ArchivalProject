<?php
echo $this->element('effect', array(
    "s" => $this->request->query['s'],
	"estart" => $this->request->query['estart']
));
?>