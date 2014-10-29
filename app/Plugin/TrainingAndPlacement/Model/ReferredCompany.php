<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');
/**
 * ReferredCompany Model
 *
 */
class ReferredCompany extends TrainingAndPlacementAppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'referred_companies';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = [
		'companyname' 	=> ['notEmpty' => ['rule' => ['notEmpty'],'required' => true]],
		'location' 		=> ['notEmpty' => ['rule' => ['notEmpty'],'required' => true]],
		'website' 		=> ['notEmpty' => ['rule' => ['url'],'message' => 'Your Web url is invalid','required' => true,'url' => 'url']],
		'referance' 	=> ['notEmpty' => ['rule' => ['isUnique'],'message' => 'reference is already registered','required' => true]],	
	];
/**
* belongsTo associations
*
* @var array
*/
    public $belongsTo = ['User'];
     
/**
* hasMany associations
*
* @var array
*/
    public $hasMany = [''];

}
