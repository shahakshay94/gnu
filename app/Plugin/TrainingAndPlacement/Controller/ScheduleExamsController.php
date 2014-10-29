<?php
App::uses('AppController', 'Controller');

/**
 * ScheduleExams Controller
 *
 */
class ScheduleExamsController extends AppController {

/**
* Components
*
* @var array
*/
	public $components = ['Paginator'];

/**
* index method
*
* @return void
*/
	public function index() {
		$this->set('scheduleExams', $this->Paginator->paginate());
	}

}
