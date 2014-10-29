<?php
App::uses('AppController', 'Controller');

class StudentsController extends AppController {

public $helpers = array('Js');
/**
 * index method
 *
 * @return void
 */
	public function index() {
	
		$this->set('students', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Student->exists($id)) {
			throw new NotFoundException(__('Invalid student'));
		}
		$options = array('conditions' => array('Student.' . $this->Student->primaryKey => $id));
		$this->set('student', $this->Student->find('first', $options));
	
		$this->loadModel('Department');
		$this->loadModel('User');
	
		$institute_id = $this->Student->find('list', ['fields' => ['Student.institution_id']]);
		$institutions = $this->Student->Institution->find('list', ['conditions' => ['Institution.id' => $institute_id]]);
		$this->set('institutions', $institutions);
	
		$email = $this->User->find('list',[
			'conditions' => ['User.student_id' => $id],
			'fields' => ['User.email']
			]);
		$this->set('email', $email);
	
		$degree_id = $this->Student->find('list', [
			'conditions' => ['Student.id' => $id],
			'fields' => ['Student.degree_id']
		]);
		$degrees = $this->Student->Degree->find('list', ['conditions' => ['Degree.id' => $degree_id]]);
		$this->set('degrees', $degrees);

		$department = $this->Student->Degree->find('list',[
			'conditions' => ['Degree.id' => $degree_id],
			'fields' => ['Degree.department_id']
		]);
		$department_name = $this->Department->find('list',[
			'conditions' => ['Department.id' => $department],
			'fields' => ['Department.name']
		]);
		$this->set('department_name', $department_name);
		
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Student->create();
			if ($this->Student->save($this->request->data)) {
				$this->Session->setFlash('The student has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The student could not be saved. Please, try again.'));
			}
		}
	}

	public function chained_dropdowns() {
        $institutions = $this->Controller->Istitution->getList();
        $departments = array();
        foreach ($institutions as $key => $value) {
            $departments = $this->Controller->departments->getListByInstitution($key);
            break;
        }
        $this->set(compact('institutions', 'departments'));
    }

	public function country_provinces_ajax() {
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        if (!$id) {
            throw new NotFoundException();
        }
        $this->viewClass = 'Tools.Ajax';
        $this->loadModel('Data.Deparment');
        $departments = $this->departments->getListByInstitution($id);
        $this->set(compact('institutions'));
    }
}
