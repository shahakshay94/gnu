<?php
App::uses('AppModel', 'Model');
/**
 * UserRole Model
 *
 * @property User $User
 * @property Role $Role
 */
class UserRole extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'role_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = [
		'User' => [
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		],
		'Role' => [
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		]
	];

}
