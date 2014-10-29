<?php
App::uses('AppModel', 'Model');
/**
 * Staff Model
 *
 */

class Staff extends AppModel {


public $virtualFields = array(
    'name' => "CONCAT(firstname, ' ', lastname)"
);
public $displayField = 'name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = [];

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
   public $belongsTo = ['Institution','Department'];

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = ['User','ManageRole'];
	

		public function getListByDepartment($cid = null) {
		if (empty($cid)) {
			return array();
		}
		/*return $this->find('list', array('joins' => array(
           array(
              'table' => 'staffs',
              'alias' => 'Staffs',
              'type'  => 'left',
              'conditions' => array(
                 'staffs.department_id = Department.id'
              )
           )
        ),
			'conditions' => array($this->alias . '.institution_id' => $cid, 'NOT' => array( 'Degree.id' => NULL)),
			//'order' => array($this->alias.'.name'=>'ASC')
		));*/
return $this->find('list', array(
			'conditions' => array($this->alias . '.department_id' => $cid),
			//'order' => array($this->alias.'.name'=>'ASC')
		));
	}

}
