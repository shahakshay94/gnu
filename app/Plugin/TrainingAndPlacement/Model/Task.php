<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');
/**
 * Task Model
 *
 */
class Task extends TrainingAndPlacementAppModel {

/**
* Display field
*
* @var string
*/
    public $displayField = 'title';

/**
* Validation rules
*
* @var array
*/
	public $validate = [
		'id'          => [ 'notEmpty' => ['rule' => ['notEmpty']]],
		'title'       => [ 'notEmpty' => ['rule' => ['notEmpty'],'required' => false]],
		'dateoftask'  => [ 'notempty' => ['rule' => ['notempty'],'required' => false]],
		'done'        => [ 'boolean' => ['rule' => ['boolean']]]
	];
}
