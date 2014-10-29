<?php
App::uses('AppController', 'Controller');
/**
 * AcademicYears Controller
 *
 * @property AcademicYear $AcademicYear
 * @property PaginatorComponent $Paginator
 */
class AcademicYearsController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator','Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AcademicYear->recursive = 0;
		$this->set('academicYears', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AcademicYear->exists($id)) {
			throw new NotFoundException(__('Invalid academic year'));
		}
		$options = array('conditions' => array('AcademicYear.' . $this->AcademicYear->primaryKey => $id));
		$this->set('academicYear', $this->AcademicYear->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AcademicYear->create();
			if ($this->AcademicYear->save($this->request->data)) {
				$this->Session->setFlash('The academic year has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The academic year could not be saved. Please, try again.'));
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
		if (!$this->AcademicYear->exists($id)) {
			throw new NotFoundException(__('Invalid academic year'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AcademicYear->save($this->request->data)) {
				$this->Session->setFlash(__('The academic year has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The academic year could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AcademicYear.' . $this->AcademicYear->primaryKey => $id));
			$this->request->data = $this->AcademicYear->find('first', $options);
		}
	}

/**
 * list_years method
 * Method used to create json response of academic years according to id.
 *
 * @throws NotFoundException
 * @param string $id
 * @return list of academic years
 */
public function list_years() {
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        if (!$id) {
          throw new NotFoundException();
        }
	  	$this->disableCache();
		$academicyears = $this->AcademicYear->getListByInstitution($id);

        $this->set(compact('academicyears'));
        $this->set('_serialize', array('academicyears'));
    }
}
