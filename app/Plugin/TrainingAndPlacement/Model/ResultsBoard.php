<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');

/**
 * ResultsBoard Model
 *
*/
class ResultsBoard extends TrainingAndPlacementAppModel {

//The Associations below have been created with all possible keys, those that are not needed can be removed
/**
* belongsTo associations
*
* @var array
*/
  public $belongsTo = ['Student'];

  public $hasMany = ['Institution'];
  
}
