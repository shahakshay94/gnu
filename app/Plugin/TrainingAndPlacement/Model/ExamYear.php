<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');
/**
 * ExamYear Model
 *
*/
class ExamYear extends TrainingAndPlacementAppModel {

//The Associations below have been created with all possible keys, those that are not needed can be removed
/**
* belongsTo associations
*
* @var array
*/
	public $belongsTo = ['AcademicYear','Semester'];

/**
* hasMany associations
*
* @var array
*/
	public $hasMany = ['TrainingAndPlacement.ExamMaster'];
}
