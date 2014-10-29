<?php
App::uses('SupportTicketSystemAppModel', 'SupportTicketSystem.Model');

/**
 * Category Model
 *
 */
class Category extends SupportTicketSystemAppModel {

/**
 * Display field
 *
 * @var string
 */
public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
public $validate = array(

    'name' => array(
        'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'You must enter a category.'
        ),
        /*'unique' => array(
            'rule'    => 'isUnique',
            'message' => 'This category already exists'
        ),*/
    ),
);
	//The Associations below have been created with all possible keys, those that are not needed can be removed


/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = ['SupportTicketSystem.Ticket','SupportTicketSystem.TicketManage','SupportTicketSystem.DepartmentTransfer'];
    public $belongsTo = ['Institution','Department'];

    public function getListByDepartment($cid = null) {
        if (empty($cid)) {
            return array();
        }
        
        return $this->find('list', array(
            'conditions' =>  array($this->alias . '.department_id' => $cid ,'Category.recstatus' => 1,
                 'Category.flag' => 0)
            
        ));
    }

    public function getListByDepartments($cid = null) {
        if (empty($cid)) {
            return array();
        }
        
        return $this->find('list', array(
            'conditions' =>  array($this->alias . '.department_id' => $cid ,'Category.recstatus' => 1,
                 'Category.flag' => 1)
            
        ));
    }

}
