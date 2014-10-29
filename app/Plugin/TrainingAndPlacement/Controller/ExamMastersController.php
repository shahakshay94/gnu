<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class ExamMastersController extends TrainingAndPlacementAppController {

	public function exam_master_form(){
		if ($this->request->is('post') && $this->request->data['ExamMaster']['degree_id']!=0) {
			$institute = $this->request->data['ExamMaster']['institution_id'];
			$department = $this->request->data['ExamMaster']['department_id'];
			$degree = $this->request->data['ExamMaster']['degree_id'];
			return $this->redirect(array('action' => 'index',$institute,$department,$degree));
		}
		unset($this->request->data['ExamMaster']['institution_id']);
		$institutions = $this->ExamMaster->Student->Institution->find('list');
		$departments = array();
		$degrees = array();
		$this->set(compact('institutions', 'departments', 'degrees'));	
	}
	
	public function index($institute = null, $department = null, $degree = null) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$student_list = $this->ExamMaster->Student->find('list', [
			'conditions' => ['Student.institution_id' => $institute,'Student.degree_id' => $degree],
			'fields' => ['Student.id']
		]);
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain'=>['Student'=>['conditions'=>['Student.institution_id' => $institute,'Student.degree_id' => $degree]]],
			'conditions' => ['ExamMaster.student_id' => $student_list]
			);
		$this->set('ExamMasters', $this->Paginator->paginate());
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ExamMaster->exists($id)) {
			throw new NotFoundException(__('Invalid id'));
		}
		$exam_masters = $this->ExamMaster->find('all',['conditions' => ['ExamMaster.student_id' => $id],'contain'=>['ScheduleExam']]);
		$this->set('examMasters', $exam_masters);
	}

	public function display() {
		$exam_masters = $this->ExamMaster->find('all',['conditions' => ['ExamMaster.student_id' => $this->Auth->User('student_id')],'contain' => ['ScheduleExam']]);
		$this->set('examMasters', $exam_masters);
		$this->set('fullname',$this->Auth->user('fullname'));
	}
}
