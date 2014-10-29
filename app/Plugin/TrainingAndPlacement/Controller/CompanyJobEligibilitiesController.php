<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class CompanyJobEligibilitiesController extends TrainingAndPlacementAppController {
	
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
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1, 'contain' => ['CompanyMaster','CompanyJob']);
		$this->set('companyJobEligibilities', $this->Paginator->paginate());
	}

	public function import() {
		if ($this->request->is('post')) {
          	$filename = APP . 'uploads' . DS . 'CompanyJobEligibilities' . DS . $this->request->data['CompanyJobEligibilities']['file']['name'];
          	$file = $this->request->data['CompanyJobEligibilities']['file']['name'];
          	$length = $this->CompanyJobEligibilities->check_file_uploaded_length($file);
          	$name = $this->CompanyJobEligibilities->name($file);
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension === 'csv' && $length && $name){
        	    if (move_uploaded_file($this->request->data['CompanyJobEligibilities']['file']['tmp_name'],$filename)) {
            	$messages = $this->CompanyJobEligibilities->import($file);
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
  		$this->set('companyJobEligibilities', $this->CompanyJobEligibility->find('all',[ 
			'fields' => ['CompanyJobEligibility.company_master_id','CompanyJobEligibility.company_job_id','CompanyJobEligibility.min_eligible_10','CompanyJobEligibility.min_eligible_12','CompanyJobEligibility.min_eligible_degree','CompanyJobEligibility.interestedin','CompanyJobEligibility.hiring','CompanyJobEligibility.verbal','CompanyJobEligibility.aptitude','CompanyJobEligibility.interview','CompanyJobEligibility.gd','CompanyJobEligibility.gd','CompanyJobEligibility.hr'] 	
  		]));
    	$this->layout = null;
   		$this->autoLayout = false;
	}

	public function company_list() {

		$this->loadModel('Student');
		$degree = $this->Student->find('list',[
			'conditions'=>['Student.id'=> $this->Auth->user('student_id')],
			'fields' => ['degree_id']
			]);

		$company_ids = $this->CompanyJobEligibility->CompanyMaster->CompanyCampus->find('list',[
			'conditions'=>['CompanyCampus.degree_id' => $degree,'CompanyCampus.recstatus' => 1],
			'fields' => ['CompanyCampus.company_master_id']			
		]);
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
            'contain'=>['CompanyMaster'=>['conditions'=>['CompanyMaster.id'=>$company_ids]],
            			'CompanyJob'=>['fields' => ['CompanyJob.name','CompanyJob.id']]],
            'conditions' => ['CompanyJobEligibility.company_master_id' => $company_ids,'CompanyJobEligibility.recstatus' => 1]
            );
		$this->set('CompanyJobEligibilities', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CompanyJobEligibility->exists($id)) {
			throw new NotFoundException(__('Invalid company job eligibility'));
		}
		$options = array('conditions' => array('CompanyJobEligibility.' . $this->CompanyJobEligibility->primaryKey => $id),'contain' => ['CompanyMaster','CompanyJob']);
		$this->set('companyJobEligibility', $this->CompanyJobEligibility->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')&& $this->request->data['CompanyJobEligibility']['company_job_id']!=0) {
			$this->CompanyJobEligibility->create();
			if ($this->CompanyJobEligibility->save($this->request->data)) {
				$this->Session->setFlash('The company job eligibility has been saved.');
				return $this->redirect( array('controller' => 'CompanyCampuses', 'action' => 'add'));
			} else {
				$this->Session->setFlash(__('The company job eligibility could not be saved. Please, try again.'));
			}
		}
		unset($this->request->data['CompanyJobEligibility']['company_master_id']);
		$company_masters = $this->CompanyJobEligibility->CompanyMaster->find('list');
		$company_jobs = array();
		$this->set(compact('company_masters', 'company_jobs'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CompanyJobEligibility->exists($id)) {
			throw new NotFoundException(__('Invalid company job eligibility'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$user_id = $this->Auth->User('id');
			$this->request->data['CompanyJobEligibility']['id']=$id;
			$this->request->data['CompanyJobEligibility']['modifier_id'] = $user_id;
			if ($this->CompanyJobEligibility->save($this->request->data, true,['modifier_id', 'recstatus', 'company_master_id', 'company_job_id', 'min_eligible_10', 'min_eligible_12', 'min_eligible_degree', 'interestedin', 'hiring', 'verbal', 'aptitude', 'interview', 'gd', 'hr'])) {
				$this->Session->setFlash(__('The company job eligibility has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company job eligibility could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CompanyJobEligibility.' . $this->CompanyJobEligibility->primaryKey => $id));
			$this->request->data = $this->CompanyJobEligibility->find('first', $options);
		}
		$companyMasters = $this->CompanyJobEligibility->CompanyMaster->find('list');
		$companyJobs = $this->CompanyJobEligibility->CompanyJob->find('list');
		$this->set(compact('companyMasters', 'companyJobs'));
	}


	public function deactivate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyJobEligibility->id = $id;
		if (!$this->CompanyJobEligibility->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyJobEligibility']['id']=$id;
		$this->request->data['CompanyJobEligibility']['recstatus']= 0;
		if ($this->CompanyJobEligibility->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been deactivated.'));
		} else {
			$this->Session->setFlash(__('The company could not be deactivated. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function activate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyJobEligibility->id = $id;
		if (!$this->CompanyJobEligibility->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyJobEligibility']['id']=$id;
		$this->request->data['CompanyJobEligibility']['recstatus']= 1;
		if ($this->CompanyJobEligibility->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been activated.'));
		} else {
			$this->Session->setFlash(__('The company could not be activated. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}	
}
