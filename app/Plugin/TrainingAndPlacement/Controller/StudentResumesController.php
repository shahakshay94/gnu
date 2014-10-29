<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class StudentResumesController extends AppController {

	public function import() {
		if ($this->request->is('post')) {
          	$filename = APP . 'uploads' . DS . 'StudentResume' . DS . $this->request->data['StudentResume']['file']['name'];
          	$file = $this->request->data['StudentResume']['file']['name'];
          	$length = $this->StudentResume->check_file_uploaded_length($file);
          	$name = $this->StudentResume->name($file);
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension === 'csv' && $length && $name){
        	    if (move_uploaded_file($this->request->data['StudentResume']['file']['tmp_name'],$filename)) {
            	$messages = $this->StudentResume->import($file);
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
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
	public function view($id = null) {
		if (!$this->StudentResume->Student->exists($id)) {
			throw new NotFoundException(__('Invalid id'));
		}
		
		$student_id = $id;
		$email = $this->StudentResume->Student->User->find('all',['conditions' => ['User.student_id' => $student_id],'fields' => ['User.email']]);
		$this->set('email',$email);

		$institution_id = $this->StudentResume->Student->find('list',[
			'conditions'	=> ['Student.id' => $student_id],
			'fields'		=> ['Student.institution_id']
		]);
		$degree_id = $this->StudentResume->Student->find('list',[
			'conditions'	=> ['Student.id' => $student_id],
			'fields'		=> ['Student.degree_id']
		]);
		$institute = $this->StudentResume->Student->Institution->find('all',[
			'conditions'	=> ['Institution.id' => $institution_id],
			'fields'		=> ['Institution.name']
		]);
		$degree = $this->StudentResume->Student->Degree->find('all',[
			'conditions'	=> ['Degree.id' => $degree_id],
			'fields'		=> ['Degree.name']
		]);
		$department_id = $this->StudentResume->Student->Degree->find('list',[
			'conditions'	=> ['Degree.id' => $degree_id],
			'fields'		=> ['Degree.department_id']
		]);
		$department = $this->StudentResume->Student->Degree->Department->find('all',[
			'conditions'	=> ['Department.id' => $department_id],
			'fields'		=> ['Department.name']
		]);

		$this->set('institute',$institute);
		$this->set('department',$department);
		$this->set('degree',$degree);

		$student_details = $this->StudentResume->Student->find('all',[
			'conditions'	=> ['Student.id' => $student_id],
			'fields'		=> ['Student.firstname','Student.lastname','Student.institution_id','Student.degree_id']
			]);

		//To get 10th n 12th results
		debug(get_class($this->StudentResume->Student->ResultsBoard));exit;
		$resultsBoards = $this->StudentResume->Student->ResultsBoard->find('all',['conditions' => ['ResultsBoard.student_id' => $student_id]]);
		$this->set('resultsBoards', $resultsBoards);

		//To get degree results semester via	
		$sem_ids = $this->StudentResume->Student->ExamMaster->find('list',[
			'conditions'	=> ['ExamMaster.student_id' => $student_id], 
			'fields'		=> ['ExamMaster.schedule_exam_id']]);
		$semesters = $this->StudentResume->Student->Degree->ScheduleExam->find('all',[
			'conditions'	=> ['ScheduleExam.id' => $sem_ids],
			'fields'		=> ['ScheduleExam.session_no']
			]);
		$sgpas = $this->StudentResume->Student->ExamMaster->find('all',[
			'conditions'	=> ['ExamMaster.student_id' => $student_id, 'ExamMaster.schedule_exam_id' => $sem_ids], 
			'fields'		=> ['ExamMaster.sgpa']]);
		
		$this->set('semesters',$semesters);
		$this->set('sgpas',$sgpas);

		//To get display student's resume	
		$student_resumes = $this->StudentResume->find('all',[
			'conditions'	=> ['StudentResume.student_id' => $student_id],'contain'=>['Student']	
			]);
		$this->set('student_resumes', $student_resumes);
		$this->set('student_details', $student_details);			
		
		$this->pdfConfig = array(
            'orientation'	=> 'portrait',
            'filename'		=> 'Resume_' . $id
        );
	}

	/**
	 * add method
	 *
	 * @return void
	*/
	public function add() {
		if ($this->request->is('post')) {
			$this->StudentResume->create();
			$this->request->data['StudentResume']['student_id']= $this->Auth->user('student_id');
			if ($this->StudentResume->save($this->request->data)) {
				$this->Session->setFlash('The Resume has been saved.');
				return $this->redirect(array('action' => 'view',$this->Auth->user('student_id')));
			} else {
				$this->Session->setFlash(__('The Resume could not be saved or already saved before'));
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
		if (!$this->StudentResume->exists($id)) {
			throw new NotFoundException(__('Invalid student resume'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['StudentResume']['id'] = $id;
			if ($this->StudentResume->save($this->request->data,true,array('id','modifier_id','student_id','careerobjective','hobbies','strengths','os','techlanguages','db','webtechnologies','sw_prog_tools','interestedin','activities','projectname'))) {
				$this->Session->setFlash(__('The Resume has been saved.'));
				return $this->redirect(array('action' => 'view',$this->Auth->user('student_id')));
			} else {
				$this->Session->setFlash(__('The Resume could not be saved. Please, try again.'));
			}
		}
		else {
			$options = array('conditions' => array('StudentResume.' . $this->StudentResume->primaryKey => $id));
			$this->request->data = $this->StudentResume->find('first', $options);
		}
	}
}
