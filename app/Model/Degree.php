<?php
App::uses('AppModel', 'Model');
/**
 * Degree Model
 *
 */
class Degree extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = ['Department'];
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = ['Student'];

/**
 * getListByDepartment method
 * Helps to get degree according to particular id.
 *
 * @var id
 * @return array
 */
	public function getListByDepartment($cid = null) {
		if (empty($cid)) {
			return array();
		}
		return $this->find('list', array(
			'conditions' => array($this->alias . '.department_id' => $cid)
		));
	}
}