<?php
App::uses('AppModel', 'Model');
/**
 * Role Model
 *
 */
class Role extends AppModel {

  public $validate = [

        'role' => [
            'required' => [
                'rule' => ['notEmpty'],
                'message' => 'You must enter a Role.'
            ],
            'unique' => [
                'rule'    => 'isUnique',
                'message' => 'This Role has already been taken.'
            ],
        ],
      ];

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 * @var array
 */ 
  public $hasMany = [
    'UserRole' => [
      'className' => 'UserRole',
      'foreignKey' => 'role_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ],'ManageRole'
  ];

}
