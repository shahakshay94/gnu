<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class ReferredCompaniesController extends TrainingAndPlacementAppController {

	public $helpers = array('Js');

	public function index() {
		$this->loadModel('Setting');
		$data				= $this->Setting->find('first');
		$pagination_value	= $data['Setting']['pagination_value'];
		$this->Paginator->settings = ['limit' => $pagination_value,'page' => 1];	

		$creator 		= $this->ReferredCompany->find('list',['fields' => ['ReferredCompany.creator_id']]);
		$modifier 		= $this->ReferredCompany->find('list',['fields' => ['ReferredCompany.modifier_id']]);
		$user_id 		= $this->ReferredCompany->find('list',['fields' => ['ReferredCompany.user_id']]);
		$user 			= $this->ReferredCompany->User->find('all',['conditions' => ['User.id' => $user_id]]);
		$creator_name 	= $this->ReferredCompany->User->find('all',['conditions' => ['User.id' => $creator]]);
		$modifier_name 	= $this->ReferredCompany->User->find('all',['conditions' => ['User.id' => $modifier]]);
		
		$this->set('user',$user);
		$this->set('creator_name',$creator_name);
		$this->set('modifier_name',$modifier_name);
		$this->set('referredCompanies', $this->Paginator->paginate());
	}
	public function display() {
		$this->loadModel('Setting');
		$data				= $this->Setting->find('first');
		$pagination_value	= $data['Setting']['pagination_value'];
		$this->Paginator->settings = [
			'limit'			=> $pagination_value,'page' => 1,
            'conditions'	=> ['ReferredCompany.user_id' => $this->Auth->user('id')]	
        ];

		$this->set('ReferredCompanies', $this->Paginator->paginate());	
	}
	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	*/
	public function view($id = null) {
		if (!$this->ReferredCompany->exists($id)) {
			throw new NotFoundException(__('Invalid referred company'));
		}
		$options = ['conditions' => ['ReferredCompany.' . $this->ReferredCompany->primaryKey => $id]];
		$this->set('referredCompany', $this->ReferredCompany->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ReferredCompany->create();
			$this->request->data['ReferredCompany']['user_id']= $this->Auth->user('id');
			debug($this->request->data);
			if ($this->ReferredCompany->save($this->request->data)) {
				$this->Session->setFlash('The referred company has been saved.');
				return $this->redirect(array('action' => 'display', $this->Auth->user('id')));
			} else {
				$this->Session->setFlash(__('The referred company could not be saved. Please, try again.'));
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
		if (!$this->ReferredCompany->exists($id)) {
			throw new NotFoundException(__('Invalid referred company'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['ReferredCompany']['id']=$id;
			$this->request->data['ReferredCompany']['flag'] = 0;
			if ($this->ReferredCompany->save($this->request->data,true,array('modifier_id','forTraining','forJob','companyname','location','website','companycontact','referance','flag'))) {
				$this->Session->setFlash(__('The referred company has been saved.'));
			} else {
				$this->Session->setFlash(__('The referred company could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ReferredCompany.' . $this->ReferredCompany->primaryKey => $id));
			$this->request->data = $this->ReferredCompany->find('first', $options);
		}
	}
	
public function save($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->ReferredCompany->id = $id;
		if (!$this->ReferredCompany->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['ReferredCompany']['id']=$id;
		$this->request->data['ReferredCompany']['flag']= 1;
		if ($this->ReferredCompany->save($this->request->data,true,array('id','flag'))) {
			$this->Session->setFlash(__('The referred company has been save.'));
		} else {
			$this->Session->setFlash(__('Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}

public function unsave($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->ReferredCompany->id = $id;
		if (!$this->ReferredCompany->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['ReferredCompany']['id']=$id;
		$this->request->data['ReferredCompany']['flag']= 0;
		if ($this->ReferredCompany->save($this->request->data,true,array('id','flag'))) {
			$this->Session->setFlash(__('The referred company has been unsave.'));
		} else {
			$this->Session->setFlash(__('Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}
}
