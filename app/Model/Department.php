<?php
App::uses('AppModel', 'Model');
/**
 * Department Model
 *
 */
class Department extends AppModel {
 
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
        public $belongsTo = ['Institution'];
 
 
/**
 * hasMany associations
 *
 * @var array
 */
        public $hasMany = ['Degree','Staff','ManageRole','SupportTicketSystem.Category'];
 
/**
 * getListByInstituion method
 * Helps to get departments according to particular id.
 *
 * @var id
 * @return array
 */
 
        public function getListByInstitution($cid = null) {
                if (empty($cid)) {
                        return array();
                }
                return $this->find('list', array('joins' => array(
           array(
              'table' => 'degrees',
              'alias' => 'Degree',
              'type'  => 'left',
              'conditions' => array(
                 'Degree.department_id = Department.id'
              )
           )
        ),
                        'conditions' => array($this->alias . '.institution_id' => $cid, 'NOT' => array( 'Degree.id' => NULL))
                ));
        }
 
}