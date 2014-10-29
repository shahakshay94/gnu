<?php
App::uses('AppModel', 'Model');
/**
 * Semester Model
 *
 */
class Semester extends AppModel {
 
/**
 * Use table
 *
 * @var mixed False or table name
 */
        public $useTable = 'semesters';
 
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
        public $belongsTo = ['AcademicYear','Degree'];
 
/**
 * getListByDegree method
 * Helps to get semester according to particular id.
 *
 * @var id
 * @return array
 */
 
        public function getListByDegree($cid = null) {
                if (empty($cid)) {
                        return array();
                }
                return $this->find('list', array(
                        'conditions' => array($this->alias . '.degree_id' => $cid)
                ));
        }
       
 
       
}