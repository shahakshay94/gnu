<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class ResultsBoardsController extends TrainingAndPlacementAppController {

	public function result_board_form() {
		if ($this->request->is('post') && $this->request->data['ResultsBoard']['degree_id']!=0) {
			$institute	= $this->request->data['ResultsBoard']['institution_id'];
			$department = $this->request->data['ResultsBoard']['department_id'];
			$degree 	= $this->request->data['ResultsBoard']['degree_id'];
			return $this->redirect(['action' => 'index', $institute, $department, $degree]);
		}
		unset($this->request->data['ResultsBoard']['institution_id']);
		$institutions	= $this->ResultsBoard->Student->Institution->find('list');
		$departments	= [];
		$degrees		= [];
		$this->set(compact('institutions', 'departments', 'degrees'));	
	}

	public function profile_form()
	{
		if ($this->request->is('post') && $this->request->data['Student']['degree_id']!=0) {		
			$institute = $this->request->data['Student']['institution_id'];
			$department = $this->request->data['Student']['department_id'];
			$degree = $this->request->data['Student']['degree_id'];
			return $this->redirect(['action' => 'profile_home', $institute, $department, $degree]);
		}

		unset($this->request->data['Student']['institution_id']);
		$institutions = $this->ResultsBoard->Student->Institution->find('list');
		$departments = array();
		$degrees = array();
		$this->set(compact('institutions', 'departments', 'degrees'));				
	}
	public function profile_home($institute = null, $department = null, $degree = null) {
 		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1);
		$data = $this->Paginator->paginate('Student',array('Student.institution_id' => $institute,'Student.degree_id' => $degree));
		$this->set('Students', $data);
	}

	/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {

		if (!$this->ResultsBoard->Student->exists($id)) {
			throw new NotFoundException(__('Invalid student'));
		}
		$options = array('conditions' => array('Student.' . $this->ResultsBoard->Student->primaryKey => $id));
		$this->set('student', $this->ResultsBoard->Student->find('first', $options));
	
		$institute_id = $this->ResultsBoard->Student->find('list', ['fields' => ['Student.institution_id']]);
		$institutions = $this->ResultsBoard->Student->Institution->find('list', ['conditions' => ['Institution.id' => $institute_id]]);
		$this->set('institutions', $institutions);
	
		$email = $this->ResultsBoard->Student->User->find('list',[
			'conditions' => ['User.student_id' => $id],
			'fields' => ['User.email']
			]);
		$this->set('email', $email);
	
		$degree_id = $this->ResultsBoard->Student->find('list', [
			'conditions' => ['Student.id' => $id],
			'fields' => ['Student.degree_id']
		]);
		$degrees = $this->ResultsBoard->Student->Degree->find('list', ['conditions' => ['Degree.id' => $degree_id]]);
		$this->set('degrees', $degrees);

		$department = $this->ResultsBoard->Student->Degree->find('list',[
			'conditions' => ['Degree.id' => $degree_id],
			'fields' => ['Degree.department_id']
		]);
		$department_name = $this->ResultsBoard->Student->Institution->Department->find('list',[
			'conditions' => ['Department.id' => $department],
			'fields' => ['Department.name']
		]);
		$this->set('department_name', $department_name);
		
	}


	public function index($institute = null, $department = null, $degree = null) {
		$this->loadModel('Setting');
		$data				= $this->Setting->find('first');
		$pagination_value 	= $data['Setting']['pagination_value'];
		$student_list		= $this->ResultsBoard->Student->find('list',array('conditions' => array('Student.institution_id' => $institute,'Student.degree_id' => $degree)));
		$this->Paginator->settings = ['limit' => $pagination_value,'page' => 1,
			'contain'		=> ['Student' => ['conditions' => ['Student.id' => $student_list]]],
			'conditions'	=> ['ResultsBoard.student_id' => $student_list]
		];
		$this->set('ResultsBoards', $this->Paginator->paginate());
	}

	public function display() {
		$resultsBoards = $this->ResultsBoard->find('all',['conditions' => ['ResultsBoard.student_id' => $this->Auth->user('student_id')]]);
		$this->set('resultsBoards', $resultsBoards);
	}

}
