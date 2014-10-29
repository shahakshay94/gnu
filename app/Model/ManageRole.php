<?php
App::uses('AppModel', 'Model');
/**
 * ManageRole Model
 *
 * 
 */
class ManageRole extends AppModel {

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
	public $belongsTo = ['Institution','Department','Staff','Role'];
}