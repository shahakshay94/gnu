<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class CompanyJobsController extends TrainingAndPlacementAppController {

	public $helpers = array('Js');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1, 'contain' => ['CompanyMaster']);
		$this->set('companyJobs', $this->Paginator->paginate());
	}

	public function import() {
		if ($this->request->is('post')) {
          	$filename = APP . 'uploads' . DS . 'CompanyJobs' . DS . $this->request->data['CompanyJobs']['file']['name'];
          	$file = $this->request->data['CompanyJobs']['file']['name'];
          	$length = $this->CompanyJobs->check_file_uploaded_length($file);
          	$name = $this->CompanyJobs->name($file);
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension === 'csv' && $length && $name){
        	    if (move_uploaded_file($this->request->data['CompanyJobs']['file']['tmp_name'],$filename)) {
            	$messages = $this->CompanyJobs->import($file);
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

	public function export_all() {     
  		$this->set('companyJobs', $this->CompanyJob->find('all',[ 
			'fields' => ['CompanyJob.company_master_id','CompanyJob.name','CompanyJob.probationperiod','CompanyJob.salary'] 	
  		]));
    	$this->layout = null;
   		$this->autoLayout = false;
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CompanyJob->exists($id)) {
			throw new NotFoundException(__('Invalid company job'));
		}
		$options = array('conditions' => array('CompanyJob.' . $this->CompanyJob->primaryKey => $id), 'contain' => ['CompanyMaster']);
		$this->set('companyJob', $this->CompanyJob->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CompanyJob->create();
			if ($this->CompanyJob->save($this->request->data)) {
				$this->Session->setFlash('The company job has been saved & Now add Eligibility for previous given JOB.');
				return $this->redirect( array('controller' => 'CompanyJobEligibilities', 'action' => 'add'));
			} else {
				$this->Session->setFlash(__('The company job could not be saved. Please, try again.'));
			}
		}
		$companyMasters = $this->CompanyJob->CompanyMaster->find('list');
		$this->set(compact('companyMasters'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CompanyJob->exists($id)) {
			throw new NotFoundException(__('Invalid company job'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$user_id = $this->Auth->User('id');
			$this->request->data['CompanyJob']['id']=$id;
			$this->request->data['CompanyJob']['modifier_id']= $user_id;	
			if ($this->CompanyJob->save($this->request->data, true, ['modifier_id', 'recstatus', 'company_master_id', 'name', 'probationperiod', 'salary'])) {
				$this->Session->setFlash(__('The company job has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company job could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CompanyJob.' . $this->CompanyJob->primaryKey => $id));
			$this->request->data = $this->CompanyJob->find('first', $options);
		}
		$companyMasters = $this->CompanyJob->CompanyMaster->find('list');
		$this->set(compact('companyMasters'));
	}

	public function deactivate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyJob->id = $id;
		if (!$this->CompanyJob->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyJob']['id']=$id;
		$this->request->data['CompanyJob']['recstatus']= 0;

		if ($this->CompanyJob->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been deactivated.'));
		} else {
			$this->Session->setFlash(__('The company could not be deactivated. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function activate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyJob->id = $id;
		if (!$this->CompanyJob->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyJob']['id']=$id;
		$this->request->data['CompanyJob']['recstatus']= 1;
		if ($this->CompanyJob->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been activated.'));
		} else {
			$this->Session->setFlash(__('The company could not be activated. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}	
	
	public function list_jobs() {
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');

        if (!$id) {
          throw new NotFoundException();
        }

	  	$this->disableCache();
		$companyJobs = $this->CompanyJob->getListByCompany($id);
        
        $this->set(compact('companyJobs'));
        $this->set('_serialize', array('companyJobs'));
    }
}
