<?php
App::uses('SupportTicketSystemAppModel', 'SupportTicketSystem.Model');

/**
 * Ticket Model
 *
 */
class Ticket extends SupportTicketSystemAppModel {

public $actsAs = array('WhoDidIt');

/**
 * Validation rules
 *
 * @var array
 */
public $validate = array(

    'subject' => array(
        'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'You must enter the subject'
        ),
    ),
     'category_id' => array(
        'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'You must select a category'
        ),
    ),
    'complain' => array(
        'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'You must enter complain.'
        ),
    ),
);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
public $belongsTo = ['SupportTicketSystem.Category', 'SupportTicketSystem.Status','SupportTicketSystem.Staff','User'];
public $hasMany = ['SupportTicketSystem.DepartmentTransfer'];

}
