<?php
App::uses('AppModel', 'Model');
/**
 * JoinedCodedpaper Model
 *
 */
class JoinedCodedpaper extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'study_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'CONCAT(APA, " ––– ", study_name, "(",study_id,")") AS study_identifier';

}
