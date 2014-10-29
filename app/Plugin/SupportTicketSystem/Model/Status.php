<?php
App::uses('SupportTicketSystemAppModel', 'SupportTicketSystem.Model');

/**
 * Status Model
 *
 * @property Ticket $Ticket
 */

class Status extends SupportTicketSystemAppModel {

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
        'unique' => array(
            'rule'    => 'isUnique',
            'message' => 'This category already exists'
        ),
    ),
);


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
 public $hasMany = ['SupportTicketSystem.Ticket','SupportTicketSystem.DepartmentTransfer'];

}
