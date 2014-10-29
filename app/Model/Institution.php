<?php
App::uses('AppModel', 'Model');
/**
 * Institution Model
 *
 */
class Institution extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = ['Department','Staff','Student','ManageRole','SupportTicketSystem.Category'];

}