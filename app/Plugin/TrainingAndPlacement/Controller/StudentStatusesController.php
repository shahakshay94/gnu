<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class StudentStatusesController extends TrainingAndPlacementAppController {

	public function import() {
		if ($this->request->is('post')) {
          	$filename = APP . 'uploads' . DS . 'StudentStatus' . DS . $this->request->data['StudentStatus']['file']['name'];
          	$file = $this->request->data['StudentStatus']['file']['name'];
          	$length = $this->StudentStatus->check_file_uploaded_length($file);
          	$name = $this->StudentStatus->name($file);
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension === 'csv' && $length && $name){
        	    if (move_uploaded_file($this->request->data['StudentStatus']['file']['tmp_name'],$filename)) {
            	$messages = $this->StudentStatus->import($file);
            	/* save message to session */
            	$this->Session->setFlash('File uploaded successfuly.');
            	/* redirect */
            	$this->redirect(array('action' => 'index'));
        	} else {
            	/* save message to session */
            	$this->Session->setFlash('There was a problem uploading file. Please try again.', 'alert', array(
   										 'class' => 'alert-danger'));
        	}
     	} else{
     			$this->Session->setFlash("Extension error", 'alert', array(
    									'class' => 'alert-danger'));
     		}
     	}
    }
	/**
	 * Student_status_form method
	 * Get values from Form and passing for processing to get result
	 * @return void
	*/
	public function student_status_form() {
		
		if ($this->request->is('post') && $this->request->data['StudentStatus']['academic_year_id']!=0) {
			$institute	= $this->request->data['StudentStatus']['institution_id'];
			$department = $this->request->data['StudentStatus']['department_id'];
			$degree 	= $this->request->data['StudentStatus']['degree_id'];
			return $this->redirect(['action' => 'index', $institute, $department,$degree]);
		}
		unset($this->request->data['StudentStatus']['institution_id']);

		$institutions	= $this->StudentStatus->Student->Institution->find('list');
		$departments	= [];
		$degrees		= [];
		$academic_years = [];
		$this->set(compact('institutions', 'departments', 'degrees','academic_years'));	

	}
		
	/**
	 * index method
	 *
	 * @return void
	*/
	public function index($institute = null, $department = null, $degree = null) {

		$student_list = $this->StudentStatus->Student->find('list', [
			'conditions'	=> ['Student.institution_id' => $institute,'Student.degree_id' => $degree],
			'fields'		=> ['Student.id']
		]);
		$this->loadModel('Setting');
		$data				= $this->Setting->find('first');
		$pagination_value 	= $data['Setting']['pagination_value'];
		$this->Paginator->settings = [
			'limit'			=> $pagination_value,'page' => 1,
			'contain'		=> ['Student' => ['conditions' => ['Student.id' => $student_list]]],
			'conditions'	=> ['StudentStatus.student_id' => $student_list]
		];
		$this->set('studentStatuses', $this->Paginator->paginate());
	}

	public function display($student_id = null) {
		$student_id		= $this->Auth->user('student_id');
		$student_status = $this->StudentStatus->find('all',['conditions' => ['StudentStatus.student_id' => $student_id]]);
		if($student_status == null)
		{
			return $this->redirect(['action' => 'add']);
		}
		$this->set('studentStatuses',$student_status);			
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->StudentStatus->exists($id)) {
			throw new NotFoundException(__('Invalid company master'));
		}
		$options = array('conditions' => array('StudentStatus.' . $this->StudentStatus->primaryKey => $id));
		$this->set('StudentStatus', $this->StudentStatus->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	*/
	public function add() {
		if ($this->request->is('post')) {
			$this->StudentStatus->create();
			$student_id = $this->Auth->user('student_id');
			$this->request->data['StudentStatus']['flag'] = 1;
			$this->request->data['StudentStatus']['student_id'] = $student_id;
			if ($this->StudentStatus->save($this->request->data)) {
				$this->Session->setFlash('The Training/Job Status has been saved.');
				return $this->redirect(['action' => 'display']);
			} else {
				$this->Session->setFlash(__('The Training/Job Status could not be saved. Please, try again.'));
			}
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	*/
	public function edit($id = null) {
		if (!$this->StudentStatus->exists($id)) {
			throw new NotFoundException(__('Invalid Training/Job Status'));
		}
		if ($this->request->is(['post', 'put'])) {
			$this->request->data['StudentStatus']['id'] = $id;
			if ($this->StudentStatus->save($this->request->data,true, ['id','modifier_id','student_id','trainingAt','companyname','project_title','project','training','job','post','salary'])) {
				$this->Session->setFlash(__('The Training/Job Status has been saved.'));
				return $this->redirect(['action' => 'display']);
			} else {
				$this->Session->setFlash(__('The Training/Job Status could not be saved. Please, try again.'));
			}
		} else {
			$options = ['conditions' => ['StudentStatus.' . $this->StudentStatus->primaryKey => $id]];
			$this->request->data = $this->StudentStatus->find('first', $options);
		}
	}
}
