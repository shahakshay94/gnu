<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class CompanyMastersController extends TrainingAndPlacementAppController {

public $helpers = array('Js','Html','Form');

	public function import() {
		if ($this->request->is('post')) {
          	$filename = APP . 'uploads' . DS . 'CompanyMaster' . DS . $this->request->data['CompanyMaster']['file']['name'];
          	$file = $this->request->data['CompanyMaster']['file']['name'];
          	$length = $this->CompanyMaster->check_file_uploaded_length($file);
          	$name = $this->CompanyMaster->name($file);
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension === 'csv' && $length && $name){
        	    if (move_uploaded_file($this->request->data['CompanyMaster']['file']['tmp_name'],$filename)) {
            	$messages = $this->CompanyMaster->import($file);
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
 * export_all method : Export all company details(Not : visit dates,jobs,eligibility,campus) 
 *
 * @return void
 */
public function export_all() {         
 	$this->set('companyMasters', $this->CompanyMaster->find('all',[ 
		'fields' => ['CompanyMaster.name','CompanyMaster.website','CompanyMaster.location','CompanyMaster.category','CompanyMaster.email','CompanyMaster.contactno','CompanyMaster.training','CompanyMaster.job'] 	
  	]));
    $this->layout = null;
   	$this->autoLayout = false;
}

public function index() {
		
		$this->Paginator->settings = array('limit' => 5,'page' => 1);
		$this->CompanyMaster->recursive = 0;

		$this->loadModel('User');
		$creator = $this->CompanyMaster->find('list',['fields' => ['CompanyMaster.creator_id']]);
		$modifier = $this->CompanyMaster->find('list',['fields' => ['CompanyMaster.modifier_id']]);
		$creator_name = $this->User->find('all',['conditions' => ['User.id' => $creator]]);
		$modifier_name = $this->User->find('all',['conditions' => ['User.id' => $modifier]]);
		
		$this->set('creator_name',$creator_name);
		$this->set('modifier_name',$modifier_name);
		$this->set('companyMasters', $this->Paginator->paginate());	
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function view($id = null) {
		if (!$this->CompanyMaster->exists($id)) {
			throw new NotFoundException(__('Invalid company master'));
		}
		$options = array('conditions' => array('CompanyMaster.' . $this->CompanyMaster->primaryKey => $id));
		$this->set('companyMaster', $this->CompanyMaster->find('first', $options));
	}
	
	
/**
 * add method
 *
 * @return void
 */

	public function add() {
		if ($this->request->is('post')) {
			$user_id = $this->Auth->User('id');
			$this->request->data['CompanyMaster']['creator_id'] = $user_id;
			$this->request->data['CompanyMaster']['modifier_id'] = $user_id;
			$this->CompanyMaster->create();
			if ($this->CompanyMaster->save($this->request->data)) {
				$this->Session->setFlash('The company details has been saved & Now add Visit details');
				return $this->redirect( array('controller' => 'CompanyVisits', 'action' => 'add'));
			} else {
				$this->Session->setFlash(__('The company master could not be saved. Please, try again.'));
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
		$user_id = AuthComponent::user('id');
		if (!$this->CompanyMaster->exists($id)) {
			throw new NotFoundException(__('Invalid company master'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['CompanyMaster']['id']=$id;
			$this->request->data['CompanyMaster']['modifier_id'] = $user_id;
			if ($this->CompanyMaster->save($this->request->data,true,array('modifier_id','recstatus','name','profile','website','location','category','email','contactno','job','training'))) {
				$this->Session->setFlash(__('The company master has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company master could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CompanyMaster.' . $this->CompanyMaster->primaryKey => $id));
			$this->request->data = $this->CompanyMaster->find('first', $options);
		}
	}

	public function deactivate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyMaster->id = $id;
		if (!$this->CompanyMaster->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyMaster']['id']=$id;
		$this->request->data['CompanyMaster']['recstatus']= 0;

		if ($this->CompanyMaster->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been deactivated.'));
		} else {
			$this->Session->setFlash(__('The company could not be deactivated. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function activate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyMaster->id = $id;
		if (!$this->CompanyMaster->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyMaster']['id']=$id;
		$this->request->data['CompanyMaster']['recstatus']= 1;
		if ($this->CompanyMaster->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been activated.'));
		} else {
			$this->Session->setFlash(__('The company could not be activated. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}	
}
