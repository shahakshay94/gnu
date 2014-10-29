<?php
App::uses('AppController', 'Controller');
/**
 * Staffs Controller
 *
 * @property Staff $Staff
 * @property PaginatorComponent $Paginator
 */
class StaffsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('staffs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Staff->exists($id)) {
			throw new NotFoundException(__('Invalid staff'));
		}
		$options = array('conditions' => array('Staff.' . $this->Staff->primaryKey => $id),'recursive'=>-1,'contain'=>['Institution','Department']);
		$this->set('staff', $this->Staff->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Staff->create();
			if ($this->Staff->save($this->request->data)) {
				$this->Session->setFlash(__('The staff has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The staff could not be saved. Please, try again.'));
			}
		}
		$institutions = $this->Staff->Institution->find('list');
		$departments = $this->Staff->Department->find('list');
		$this->set(compact('institutions', 'departments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Staff->exists($id)) {
			throw new NotFoundException(__('Invalid staff'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Staff->save($this->request->data)) {
				$this->Session->setFlash(__('The staff has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The staff could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Staff.' . $this->Staff->primaryKey => $id));
			$this->request->data = $this->Staff->find('first', $options);
		}
		$institutions = $this->Staff->Institution->find('list');
		$departments = $this->Staff->Department->find('list');
		$this->set(compact('institutions', 'departments'));
	}

public function list_staff() {
		$this->request->onlyAllow('ajax');
		$id = $this->request->query('id');
		if (!$id) {
			throw new NotFoundException();
		}

		$this->disableCache();
		$staffs = $this->Staff->getListByDepartment($id);
		$this->set(compact('staffs'));
		$this->set('_serialize', array('staffs'));
	}
}
