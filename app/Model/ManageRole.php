<?php
App::uses('AppModel', 'Model');
/**
 * ManageRole Model
 *
 * 
 */
class ManageRole extends AppModel {

	public $validate = array(

    'staff_id' => array(

        'unique' => array('rule' => array('checkUnique',array('staff_id','role_id','recstatus')),
                                           'message' => 'For this Staff , another Role exists! Please select another staff!'
                         ),
       				 )       
				);


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