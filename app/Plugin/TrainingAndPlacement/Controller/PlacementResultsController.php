<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class PlacementResultsController extends TrainingAndPlacementAppController {

	public $helpers = array('Js');


	public function import() {
		if ($this->request->is('post')) {
          	$filename = APP . 'uploads' . DS . 'PlacementResult' . DS . $this->request->data['PlacementResult']['file']['name'];
          	$file = $this->request->data['PlacementResult']['file']['name'];
          	$length = $this->PlacementResult->check_file_uploaded_length($file);
          	$name = $this->PlacementResult->name($file);
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension === 'csv' && $length && $name){
        	    if (move_uploaded_file($this->request->data['PlacementResult']['file']['tmp_name'],$filename)) {
            	$messages = $this->PlacementResult->import($file);
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
	
	public function form1() {
		if ($this->request->is('post')  && $this->request->data['PlacementResult']['degree_id']!=0) {
			$institute 		= $this->request->data['PlacementResult']['institution_id'];
			$department 	= $this->request->data['PlacementResult']['department_id'];
			$degree 		= $this->request->data['PlacementResult']['degree_id'];
			$company 		= $this->request->data['PlacementResult']['company_master_id'];
			return $this->redirect(['action' => 'index',$institute,$department,$degree,$company]);
		}
		unset($this->request->data['PlacementResult']['institution_id']);

		$institutions 		= $this->PlacementResult->CompanyCampus->Institution->find('list');
		$departments 		= [];
		$degrees 			= [];
		
		$companyMasters 	= $this->PlacementResult->CompanyCampus->CompanyMaster->find('list');
		$this->set(compact('institutions', 'departments', 'degrees', 'companyMasters'));	
	}

	public function selected_students($institute = null,$department = null,$degree = null,$company = null) {
		$data = $this->PlacementResult->find('all', [
    		'contain'	=> ['Student' => [
        	'fields'	=> ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]]      
        	],'conditions' => ['PlacementResult.company_campus_id' => $company, 'PlacementResult.status' => 'Appointed']
    	]);

    	$campus_ids = $this->PlacementResult->find('list', [
    		'conditions' 	=> ['PlacementResult.status' => 'Appointed'],
    		'fields' 		=> ['PlacementResult.company_campus_id']
    	]);

    	$company_ids = $this->PlacementResult->CompanyCampus->find('list', [
    		'conditions' 	=> ['CompanyCampus.id' => $campus_ids],
    		'fields' 		=> ['CompanyCampus.company_master_id']
    	]);
    	
    	$company = $this->PlacementResult->CompanyCampus->CompanyMaster->find('all', [
    		'conditions' 	=> ['CompanyMaster.id' => $company_ids],
    		'fields' 		=> ['CompanyMaster.name']
    	]);

    	$this->set('data',$data);
    	$this->set('company',$company);
    	$this->set($this->Paginator->paginate());	
	}

	public function index($institute = null, $department = null, $degree = null, $company = null) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain' => [
        		'Student' => [
        		'fields' => ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]
        		]	      
        	],'conditions' => ['PlacementResult.company_campus_id' => $company]
		);
		$this->set('PlacementResults', $this->Paginator->paginate());
		
		$company_institute		= $this->PlacementResult->CompanyCampus->Institution->find('all', array('conditions' => array('Institution.id' => $institute), 'field' => array('Institution.name')));
		$company_department		= $this->PlacementResult->CompanyCampus->Department->find('all', array('conditions' => array('Department.id' => $department), 'field' => array('Department.name')));	
		$company_degree			= $this->PlacementResult->CompanyCampus->Degree->find('all', array('conditions' => array('Degree.id' => $degree), 'field' => array('Degree.name')));	
		$company_name			= $this->PlacementResult->CompanyCampus->CompanyMaster->find('all',['conditions'=>['CompanyMaster.id'=>$company],'fields'=>['CompanyMaster.name']]);
		
		$this->set('company_name',$company_name);
 		$this->set('company_department',$company_department);
		$this->set('company_institute',$company_institute);
		$this->set('company_degree',$company_degree);

		$this->set('company',$company);
 		$this->set('department',$department);
		$this->set('institute',$institute);
		$this->set('degree',$degree);

	}
public function student_list($institute = null,$department = null,$degree = null,$company = null) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,'contain'	=> ['Student' => [
        	'fields'	=> ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]]],
        	'conditions' => ['PlacementResult.company_campus_id' => $company]
		);
		$this->set('PlacementResults', $this->Paginator->paginate());

		$institute 		= $this->PlacementResult->CompanyCampus->Institution->find('all', array('conditions' => array('Institution.id' => $institute), 'field' => array('Institution.name')));
		$branch 		= $this->PlacementResult->CompanyCampus->Department->find('all', array('conditions' => array('Department.id' => $department), 'field' => array('Department.name')));	
		$degree 		= $this->PlacementResult->CompanyCampus->Degree->find('all', array('conditions' => array('Degree.id' => $degree), 'field' => array('Degree.name')));	
		$company_name 	= $this->PlacementResult->CompanyCampus->CompanyMaster->find('all',['conditions'=>['CompanyMaster.id'=>$company],'fields'=>['CompanyMaster.name']]);
		
		$this->set('company_name',$company_name);
		$this->set('branch',$branch);
		$this->set('institute',$institute);
		$this->set('department',$department);
		$this->set('degree',$degree);
		$this->set($this->Paginator->paginate());
	}

	public function appointed_status($institute = null,$department = null,$degree = null,$company = null) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain' => [
        		'Student' => [
        			'fields' => ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]
        		]      
        	],'conditions' => ['PlacementResult.company_campus_id' => $company,'PlacementResult.status' => 'Appointed']
		);
		$this->set('PlacementResults', $this->Paginator->paginate());

		$institute = $this->PlacementResult->CompanyCampus->Institution->find('all', array('conditions' => array('Institution.id' => $institute), 'field' => array('Institution.name')));
		$branch = $this->PlacementResult->CompanyCampus->Department->find('all', array('conditions' => array('Department.id' => $department), 'field' => array('Department.name')));	
		$degree = $this->PlacementResult->CompanyCampus->Degree->find('all', array('conditions' => array('Degree.id' => $degree), 'field' => array('Degree.name')));	
		$company_name = $this->PlacementResult->CompanyCampus->CompanyMaster->find('all',['conditions'=>['CompanyMaster.id'=>$company],'fields'=>['CompanyMaster.name']]);
		
		$this->set('company_name',$company_name);
		$this->set('branch',$branch);
		$this->set('institute',$institute);
		$this->set('department',$department);
		$this->set('degree',$degree);
	}

	public function notqualified_status($institute = null, $department = null, $degree = null, $company = null) {
		
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain' => [
        		'Student' => [
        			'fields' => ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]
        		]      
        	],'conditions' => ['PlacementResult.company_campus_id' => $company,'PlacementResult.status' => 'Not Qualified']
		);
		$this->set('PlacementResults', $this->Paginator->paginate());

		$institute = $this->PlacementResult->CompanyCampus->Institution->find('all', array('conditions' => array('Institution.id' => $institute), 'field' => array('Institution.name')));
		$branch = $this->PlacementResult->CompanyCampus->Department->find('all', array('conditions' => array('Department.id' => $department), 'field' => array('Department.name')));	
		$degree = $this->PlacementResult->CompanyCampus->Degree->find('all', array('conditions' => array('Degree.id' => $degree), 'field' => array('Degree.name')));	
		$company_name = $this->PlacementResult->CompanyCampus->CompanyMaster->find('all',['conditions'=>['CompanyMaster.id'=>$company],'fields'=>['CompanyMaster.name']]);
		
		$this->set('company_name',$company_name);
		$this->set('branch',$branch);
		$this->set('institute',$institute);
		$this->set('department',$department);
		$this->set('degree',$degree);
	}

	public function pending_status($institute = null, $department = null, $degree = null, $company = null) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain' => [
        		'Student' => [
        			'fields' => ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]
        	]      
        ],'conditions' => ['PlacementResult.company_campus_id' => $company,'PlacementResult.status' => 'Pending']);
		
		$this->set('PlacementResults', $this->Paginator->paginate());

	$institute = $this->PlacementResult->CompanyCampus->Institution->find('all', array('conditions' => array('Institution.id' => $institute), 'field' => array('Institution.name')));
	$branch = $this->PlacementResult->CompanyCampus->Department->find('all', array('conditions' => array('Department.id' => $department), 'field' => array('Department.name')));	
	$degree = $this->PlacementResult->CompanyCampus->Degree->find('all', array('conditions' => array('Degree.id' => $degree), 'field' => array('Degree.name')));	
	$company_name = $this->PlacementResult->CompanyCampus->CompanyMaster->find('all',['conditions'=>['CompanyMaster.id'=>$company],'fields'=>['CompanyMaster.name']]);

	$this->set('institute',$institute);
	$this->set('branch',$branch);
	$this->set('degree',$degree);
	$this->set('company_name',$company_name);
	
}

public function display() {
	$student_id = $this->Auth->user('student_id');
	$this->loadModel('Setting');
	$data = $this->Setting->find('first');
	$pagination_value = $data['Setting']['pagination_value'];
	
	$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
        'contain' => [
        	'CompanyCampus' => [ 
        		'fields' => ['id','company_master_id'],
            	'CompanyMaster' => [
                	'fields' => ['id','name']
            	]
         	],
        	'Student' => [
        		'fields' => ['id','firstname','lastname']
        	]      
        ],'conditions'=>['PlacementResult.student_id'=>$student_id]);

		$this->set('PlacementResults', $this->Paginator->paginate());
	
}

public function student_home() {
	$student_id = $this->Auth->user('student_id');
	$degree_id = $this->PlacementResult->Student->find('list',[
		'conditions' => ['Student.id' => $student_id],
		'fields' => ['Student.degree_id']
	]);

	$data = $this->PlacementResult->find('all', [
    	'contain' => [
        	'CompanyCampus' => [ 
        		'fields' => ['id','company_master_id'],
            	'CompanyMaster' => [
                	'fields' => ['id','name']
            	]
        	],
        	'Student' => [
        		'fields' => ['id','firstname','lastname']
        	]      
    	],'conditions'=>['PlacementResult.student_id'=> $student_id ]]
	);
	
	$company_id = $this->PlacementResult->CompanyCampus->find('list',[
		'fields' => ['CompanyCampus.company_master_id'],
		'conditions'=>['CompanyCampus.degree_id' => $degree_id,'CompanyCampus.recstatus' => 1]
	]);
		
	$companies = $this->PlacementResult->CompanyCampus->CompanyMaster->find('all',['conditions' => ['CompanyMaster.id' => $company_id,'CompanyMaster.recstatus' => 1],'field' => ['CompanyMaster.name']]);
	$training = $this->PlacementResult->CompanyCampus->CompanyMaster->find('all',['conditions' => ['CompanyMaster.id' => $company_id,'CompanyMaster.recstatus' => 1,'CompanyMaster.training' => 1],'field' => ['CompanyMaster.name']]);
	$job = $this->PlacementResult->CompanyCampus->CompanyMaster->find('all',['conditions' => ['CompanyMaster.id' => $company_id,'CompanyMaster.recstatus' => 1,'CompanyMaster.job' => 1],'field' => ['CompanyMaster.name']]);

	$this->set('data',$data);
	$this->set('companies',$companies);
	$this->set('training',$training);
	$this->set('job',$job);
	$this->set('fullname', $this->Auth->user('fullname'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PlacementResult->exists($id)) {
			throw new NotFoundException(__('Invalid placement result'));
		}
		$options = array('conditions' => array('PlacementResult.' . $this->PlacementResult->primaryKey => $id));
		$this->set('placementResult', $this->PlacementResult->find('first', $options));
	}

	public function apply_company($company_campus_id, $student_id) {
		$user_id = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$this->PlacementResult->create();
			$this->request->data['PlacementResult']['student_id'] = $student_id;
			$this->request->data['PlacementResult']['status'] = 'Not Qualified';
			$this->request->data['PlacementResult']['company_campus_id'] = $company_campus_id;
			$this->request->data['PlacementResult']['stu_campus'] = $company_campus_id.''.$student_id;
			if ($this->PlacementResult->save($this->request->data)) {
					$this->Session->setFlash('You are successfully applied for Company.');
				} else {
					$this->Session->setFlash(__('You are already applied for this company'));
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
	public function edit($id = null, $institute = null, $department = null, $degree = null, $company = null) {
		$user_id = AuthComponent::user('id');	
		if (!$this->PlacementResult->exists($id)) {
			throw new NotFoundException(__('Invalid placement result'));
		}
		if ($this->request->is(array('post', 'put'))) {
					
			$this->request->data['PlacementResult']['id']=$id;
			
			if ($this->PlacementResult->save($this->request->data,true,array('modifier_id','company_master_id','verbal','aptitude','interview','gd','hr','status'))) {
				$this->Session->setFlash(__('The placement result has been saved.'));
				return $this->redirect(array('action' => 'index',$institute,$department,$degree,$company));
			} else {
				$this->Session->setFlash(__('The placement result could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PlacementResult.' . $this->PlacementResult->primaryKey => $id));
			$this->request->data = $this->PlacementResult->find('first', $options);
		}
		
	}
}
