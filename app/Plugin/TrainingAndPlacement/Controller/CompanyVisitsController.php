<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class CompanyVisitsController extends TrainingAndPlacementAppController {

	public $helpers = array('Js','Html','Form');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,'contain'=>['CompanyMaster']);	
		$this->set('companyVisits', $this->Paginator->paginate());
	}

	public function export_all() {      
  		$this->set('companyVisits', $this->CompanyVisit->find('all',[
  			'contain' => ['CompanyMaster' => ['fields' => ['id','name']]], 
			'fields' => ['CompanyVisit.company_master_id','CompanyVisit.pptdate','CompanyVisit.visitdate1','CompanyVisit.placementtype','CompanyVisit.placementvenue'] 	
  		]));
    	$this->layout = null;
   		$this->autoLayout = false;
	}
	
	public function import() {
		if ($this->request->is('post')) {
          	$filename = APP . 'uploads' . DS . 'CompanyVisit' . DS . $this->request->data['CompanyVisit']['file']['name'];
          	$file = $this->request->data['CompanyVisit']['file']['name'];
          	$length = $this->CompanyVisit->check_file_uploaded_length($file);
          	$name = $this->CompanyVisit->name($file);
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension === 'csv' && $length && $name){
        	    if (move_uploaded_file($this->request->data['CompanyVisit']['file']['tmp_name'],$filename)) {
            	$messages = $this->CompanyVisit->import($file);
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

	public function visit_date() {
		$this->loadModel('Student');
		
		$degree = $this->Student->find('list',[
			'conditions'=>['Student.id'=> $this->Auth->User('student_id')],
			'fields' => ['degree_id']
			]);
		
		$company_ids = $this->CompanyVisit->CompanyMaster->CompanyCampus->find('list',[
			'conditions'=>['CompanyCampus.degree_id' => $degree,'CompanyCampus.recstatus' => 1],
			'fields' => ['CompanyCampus.company_master_id']			
		]);

		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
            'contain'=>['CompanyMaster'=>['conditions'=>['CompanyMaster.id'=>$company_ids,'CompanyMaster.recstatus' => 1]]],
            'conditions' => ['CompanyVisit.recstatus' => 1, 'CompanyVisit.company_master_id' => $company_ids]	
            );
		$this->set('CompanyVisits', $this->Paginator->paginate());
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CompanyVisit->exists($id)) {
			throw new NotFoundException(__('Invalid company visit'));
		}
		$options = array('conditions' => array('CompanyVisit.' . $this->CompanyVisit->primaryKey => $id),'contain' => ['CompanyMaster']);
		$this->set('companyVisit', $this->CompanyVisit->find('first', $options));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CompanyVisit->create();
			if ($this->CompanyVisit->save($this->request->data)) {
				$this->Session->setFlash('The company visit has been saved & Now add Job details.');
				return $this->redirect( array('controller' => 'CompanyJobs', 'action' => 'add'));
			} else {
				$this->Session->setFlash(__('The company visit could not be saved. Please, try again.'));
			}
		}
		$companyMasters = $this->CompanyVisit->CompanyMaster->find('list');
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
		if (!$this->CompanyVisit->exists($id)) {
			throw new NotFoundException(__('Invalid company visit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['CompanyVisit']['id']=$id;
			if ($this->CompanyVisit->save($this->request->data,true,array('id','modifier_id','company_master_id','pptdate','visitdate1','visitdate2','visitdate3','lastdate','placementtype','placementvenue'))) {
				$this->Session->setFlash(__('The company visit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company visit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CompanyVisit.' . $this->CompanyVisit->primaryKey => $id));
			$this->request->data = $this->CompanyVisit->find('first', $options);
		}
		$companyMasters = $this->CompanyVisit->CompanyMaster->find('list');
		$this->set(compact('companyMasters'));
	}


	public function deactivate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyVisit->id = $id;
		if (!$this->CompanyVisit->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyVisit']['id']=$id;
		$this->request->data['CompanyVisit']['recstatus']= 0;

		if ($this->CompanyVisit->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been deactivated.'));
		} else {
			$this->Session->setFlash(__('The company could not be deactivated. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}

	public function activate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyVisit->id = $id;
		if (!$this->CompanyVisit->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyVisit']['id']=$id;
		$this->request->data['CompanyVisit']['recstatus']= 1;
		if ($this->CompanyVisit->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been activated.'));
		} else {
			$this->Session->setFlash(__('The company could not be activated. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}	
}

