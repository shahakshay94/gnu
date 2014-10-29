<?php
App::uses('AppModel', 'Model');
/**
 * AcademicYear Model
 *
 */
class AcademicYear extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 * @var array
 */	
	public $belongsTo = ['Institution'];

/**
 * getListByInstituion method
 * Helps to get academic year according to particular id.
 *
 * @var id
 * @return array
 */	
	public function getListByInstitution($cid = null) {
		if (empty($cid)) {
			return array();
		}
		return $this->find('list', array(
			'conditions' => array($this->alias . '.institution_id' => $cid)
		));
	}
}
