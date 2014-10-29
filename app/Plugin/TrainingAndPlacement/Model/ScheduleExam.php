<?php
App::uses('AppModel', 'Model');
/**
 * ScheduleExam Model
 *
 */
class ScheduleExam extends AppModel {


//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
* belongsTo associations
*
* @var array
*/
	public $belongsTo = ['AcademicYear','Degree'];

/**
* hasMany associations
*
* @var array
*/
	public $hasMany = ['TrainingAndPlacement.ExamMaster'];

}
