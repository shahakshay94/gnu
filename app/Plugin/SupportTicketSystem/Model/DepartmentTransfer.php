<?php
App::uses('SupportTicketSystemAppModel', 'SupportTicketSystem.Model');

/**
 * Department transfer Model
 *
 */
class DepartmentTransfer extends SupportTicketSystemAppModel {

public $actsAs = array('WhoDidIt');

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
public $belongsTo = ['SupportTicketSystem.Category', 'SupportTicketSystem.Status','Staff','SupportTicketSystem.Ticket'];

}
