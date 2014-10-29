<?php
App::uses('SupportTicketSystemAppModel', 'SupportTicketSystem.Model');
/**
 * TicketManage Model
 *
 * @property Category $Category
 * @property Staff $Staff
 */
class TicketManage extends SupportTicketSystemAppModel {

/**
 * Validation rules
 *
 * @var array
 */
public $validate = array(
     'category_id' => array(
        'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'You have to select category'
        ),
    ),
);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = ['SupportTicketSystem.Category','Staff'];

}
