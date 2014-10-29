<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class CompanyCampusesController extends TrainingAndPlacementAppController {

/**
 * Components
 *
 * @var array
 */
	public $helpers = array('Js','Csv');

	public function import() {
		if ($this->request->is('post')) {
          	$filename = APP . 'uploads' . DS . 'CompanyCampus' . DS . $this->request->data['CompanyCampus']['file']['name'];
          	$file = $this->request->data['CompanyCampus']['file']['name'];
          	$length = $this->CompanyCampus->check_file_uploaded_length($file);
          	$name = $this->CompanyCampus->name($file);
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension === 'csv' && $length && $name){
        	    if (move_uploaded_file($this->request->data['CompanyCampus']['file']['tmp_name'],$filename)) {
            	$messages = $this->CompanyCampus->import($file);
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

	public function column_company_hiring_form() {

        if ($this->request->is('post') && $this->request->data['CompanyCampus']['academic_year_id']!=0) {
            $institute = $this->request->data['CompanyCampus']['institution_id'];
            $year = $this->request->data['CompanyCampus']['academic_year_id'];
            	return $this->redirect(['action' => 'column_company_hiring',$institute,$year]);
        }
        unset($this->request->data['CompanyCampus']['institution_id']);
     	$institutions = $this->CompanyCampus->Institution->find('list');
		$academicyears = [];
		$this->set(compact('institutions', 'academicyears'));	
	   
    }

	public function column_company_hiring($institute = null, $year = null) {
     	
          $company_id = $this->CompanyCampus->find('list', [
          	'conditions' => ['CompanyCampus.institution_id' => $institute, 
          					 'CompanyCampus.academic_year_id' => $year, 
          					 'CompanyCampus.recstatus' => 1],
          	'field' => ['CompanyCampus.company_master_id']
          ]);

        $company = $this->CompanyCampus->CompanyMaster->find('list', [
        	'conditions' => ['CompanyMaster.id' => $company_id,'CompanyMaster.recstatus' =>1],
        	'fields' => ['CompanyMaster.name']
        ]);
        
        $hire['hiring'] = $this->CompanyCampus->CompanyMaster->CompanyJobEligibility->find('list', [
        	'conditions' => ['CompanyJobEligibility.company_master_id' => $company_id, 'CompanyJobEligibility.recstatus' => 1],	
        	'fields' => ['CompanyJobEligibility.hiring']
       	]);

    	$data = [];
		$counter = 0;

		foreach($hire['hiring'] as $key=>$value) {
			$data[$counter] = (int)$value;
			$counter++;
		}

		$content = [];
		$counter = 0;

		foreach ($company as $key => $value) {
			$content[$counter] = $value;
			$counter++;
		}
	
        $chartName = 'Column Chart';

        $mychart = $this->HighCharts->create( $chartName, 'column');

        $this->HighCharts->setChartParams (
                        $chartName,
                        array
                        (
                            'renderTo'                  => 'columnwrapper',  
                            'chartWidth'				=> 800,
                            'chartHeight'				=> 500,
                            'title'					    => 'Companies Vs Hiring',
                            'subtitle'                  => 'Training And Placement',
                            'xAxisLabelsEnabled' 	    => FALSE,
                            'xAxisCategories'       	=> $content,
                            'yAxisTitleText' 		    => 'Hiring',
                            'enableAutoStep' 		    => TRUE,
                            'creditsEnabled'		    => FALSE,
                            'chartTheme'                => 'highroller',

                        )
                );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Hiring')->addData($data);

        $mychart->addSeries($series);
    }

	public function pie_company_hiring_form() {

       if ($this->request->is('post') && $this->request->data['CompanyCampus']['academic_year_id']!=0) {
            $institute = $this->request->data['CompanyCampus']['institution_id'];
            $year = $this->request->data['CompanyCampus']['academic_year_id'];
            return $this->redirect(['action' => 'pie_company_hiring',$institute,$year]);
        }
        unset($this->request->data['CompanyCampus']['institution_id']);
     	$institutions = $this->CompanyCampus->Institution->find('list');
		$academicyears = [];
		$this->set(compact('institutions','academicyears'));	   
    }

	public function pie_company_hiring($institute = null, $year = null) {

        $company_id = $this->CompanyCampus->find('list', [
        	'conditions' => ['CompanyCampus.institution_id' => $institute,'CompanyCampus.academic_year_id' => $year, 'CompanyCampus.recstatus' => 1],
        	'field' => ['CompanyCampus.company_master_id']
        ]);

        $company = $this->CompanyCampus->CompanyMaster->find('list', [
        	'conditions' => ['CompanyMaster.id' => $company_id, 'CompanyMaster.recstatus' => 1],
        	'fields' => ['CompanyMaster.name']
        ]);

        $hire = $this->CompanyCampus->CompanyMaster->CompanyJobEligibility->find('list', [
        	'conditions' => ['CompanyJobEligibility.company_master_id' => $company_id, 'CompanyJobEligibility.recstatus' => 1],	
        	'fields' => ['CompanyJobEligibility.hiring']]);

		$data = [];
		$counter = 0;

		foreach($hire as $key=>$value) {
			$data[$counter] = (int)$value;
			$counter++;
		}

        $content=[];
        $counter=0;

        foreach ($company as $key => $value) {
        	$temp = [];
			array_push($temp, $value,(int)$data[$counter]);
			$content[$counter] = $temp;
			$counter++;
       	}
     
		$chartData = $content;
        $chartName = 'Pie Chart';

        $pieChart = $this->HighCharts->create( $chartName, 'pie' );

        $this->HighCharts->setChartParams(
                                            $chartName,
                                            array
                                            (
                                                'renderTo'				=> 'piewrapper',  // div to display chart inside
                                                'chartWidth'		    => 800,
                                                'chartHeight'		    => 500,
                                                'chartTheme'            => 'grid',
                                                'title'					=> 'Hiring Status of Companies',
                                                'plotOptionsShowInLegend'		=> TRUE,
                                                'creditsEnabled' 	    => FALSE
                                            )
        );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Hiring')
            ->addData($chartData);

        $pieChart->addSeries($series);

    }

    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = ['limit' => $pagination_value,'page' => 1,'contain'=>['Institution','Department','Degree','AcademicYear','CompanyMaster']];
		$this->set('CompanyCampuses', $this->Paginator->paginate());
	}

	public function company_campus() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = ['limit' => $pagination_value,'page' => 1];
		$student_id = $this->Auth->user('student_id');

		$degree = $this->CompanyCampus->Degree->Student->find('list',[
			'conditions'=>['Student.id'=> $student_id],
			'fields' => ['degree_id']
			]);
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
            'contain'=>['CompanyMaster'=>['fields'=>['CompanyMaster.id','CompanyMaster.name']],
            			'AcademicYear'=>['fields'=>['AcademicYear.id','AcademicYear.name']]],
            'conditions' => ['CompanyCampus.degree_id' => $degree,'CompanyCampus.recstatus' => 1]
            );
		$this->set('CompanyCampuses', $this->Paginator->paginate());
	}

	public function student_applied_campus() {
		$student_id = $this->Auth->user('student_id');
		$this->set('student_id',$student_id);
		
	//To get student is already appointed or not ??
		$student_check = $this->CompanyCampus->PlacementResult->find('count',[
			'conditions' => ['PlacementResult.student_id' => $student_id, 'PlacementResult.status' => 'Appointed']
			]);
		$this->set('student_check',$student_check);		

	//To get degree id	
		$degree_id = $this->CompanyCampus->Degree->Student->find('list',[
			'conditions'=>['Student.id'=> $student_id],
			'fields' => ['degree_id']
			]);
	
	//To get companies from related campus details	
		$companies = $this->CompanyCampus->find('list',[
			'conditions'=>['CompanyCampus.degree_id' => $degree_id,'CompanyCampus.recstatus' => 1],
			'fields' => ['CompanyCampus.company_master_id']
		]);

	//To get student's 10th percentage	
		$this->loadModel('ResultsBoard');
		$student_10 = $this->ResultsBoard->find('list',[
			'conditions' => ['ResultsBoard.student_id' => $student_id,'ResultsBoard.exam_type' => 'SSC'],
			'fields' => ['ResultsBoard.percentage']

		]);

	//To get student's 12th percentage	
		$student_12 = $this->ResultsBoard->find('list',[
			'conditions' => ['ResultsBoard.student_id' => $student_id,'ResultsBoard.exam_type' => 'HSC'],
			'fields' => ['ResultsBoard.percentage']

		]);

	//To get student's degree result	
		$this->loadModel('ExamMaster');
		$student_degree = $this->ExamMaster->find('list',[
			'conditions' => ['ExamMaster.student_id' => $student_id],
			'fields' => ['ExamMaster.cgpa']
		]);
		
	//To get companies eligibility for 10th	
		$company_10 = $this->CompanyCampus->CompanyMaster->CompanyJobEligibility->find('list',[
			'conditions' => ['CompanyJobEligibility.company_master_id' => $companies],
			'fields' => ['CompanyJobEligibility.min_eligible_10']
			]);

	//To get companies eligibility for 12th	
		$company_12 = $this->CompanyCampus->CompanyMaster->CompanyJobEligibility->find('list',[
			'conditions' => ['CompanyJobEligibility.company_master_id' => $companies],
			'fields' => ['CompanyJobEligibility.min_eligible_12']
			]);

	//To get companies eligibility for degree	
		$company_degree = $this->CompanyCampus->CompanyMaster->CompanyJobEligibility->find('list',[
			'conditions' => ['CompanyJobEligibility.company_master_id' => $companies],
			'fields' => ['CompanyJobEligibility.min_eligible_degree']
			]);

	//To get min_eligible_10th from companies based on student's 10th percentage	
		$min_student_10 = [];
		$counter = 0;
		foreach($company_10 as $key => $value){
			foreach ($student_10 as $key1 => $value1) {
				if($value1 >= $value){
					$min_student_10[$counter] = $value;
					$counter++;	
				}
			}
		}

	//To get min_eligible_12th from companies based on student's 12th percentage	
		$min_student_12 = [];
		$counter = 0;
		foreach($company_12 as $key => $value){
			foreach ($student_12 as $key1 => $value1) {
				if($value1 >= $value){
					$min_student_12[$counter] = $value;
					$counter++;
				}
			}
		}

	//To get min_eligible_dgree from companies based on student's CGPA	
		$min_student_degree = [];
		$counter = 0;
		foreach($company_degree as $key=>$value){
			foreach ($student_degree as $key1 => $value1) {
				if($value1 >= $value){
					$min_student_degree[$counter] = $value;
					$counter++;
				}
			}
		}
		$list = $this->CompanyCampus->CompanyMaster->CompanyJobEligibility->find('list',[
			'conditions' => ['CompanyJobEligibility.min_eligible_10' => $min_student_10, 'CompanyJobEligibility.min_eligible_12' => $min_student_12, 'CompanyJobEligibility.min_eligible_degree' => $min_student_degree],
			'fields' => ['CompanyJobEligibility.company_master_id']
			]);

		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = ['limit' => $pagination_value,'page' => 1,
            'contain'=>['CompanyMaster'=>['CompanyVisit'=>['fields'=>['lastdate']],'conditions'=>['CompanyMaster.id' => $list,'CompanyMaster.recstatus' =>1],'fields'=>['CompanyMaster.id','CompanyMaster.name']],
            			'AcademicYear'=>['fields'=>['AcademicYear.id','AcademicYear.name']]],
            'conditions' => ['CompanyCampus.degree_id' => $degree_id,'CompanyCampus.recstatus' => 1,'CompanyCampus.company_master_id' => $list]
            ];
		$this->set('CompanyCampuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CompanyCampus->exists($id)) {
			throw new NotFoundException(__('Invalid company campus'));
		}
		$options = ['conditions' => ['CompanyCampus.' . $this->CompanyCampus->primaryKey => $id]];
		$this->set('companyCampus', $this->CompanyCampus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post') && $this->request->data['CompanyCampus']['academic_year_id']!=0) {
			$this->CompanyCampus->create();			
			if ($this->CompanyCampus->save($this->request->data)) {
				$this->Session->setFlash(__('The company campus has been saved.'), 'alert', array(
    'class' => 'alert-success'
));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Session->setFlash(__('The company campus could not be saved or it is already registered.'), 'alert', array(
    'class' => 'alert-danger'
));
			}
		}
		unset($this->request->data['CompanyCampus']['institution_id']);
		$institutions = $this->CompanyCampus->Institution->find('list');
		$departments = [];
		$degrees = [];
		$academic_years = [];
		$company_masters = $this->CompanyCampus->CompanyMaster->find('list');
		$this->set(compact('institutions', 'departments', 'degrees','academic_years','company_masters'));	
	}

	public function find_company_year_form() {
	if ($this->request->is('post') && $this->request->data['CompanyCampus']['academic_year_id']!=0) {
		$institute = $this->request->data['CompanyCampus']['institution_id'];
		$departments = $this->request->data['CompanyCampus']['department_id'];
		$degrees = $this->request->data['CompanyCampus']['degree_id'];
		$years = $this->request->data['CompanyCampus']['academic_year_id'];
		$this->redirect(array('action' => 'find_company_year',$institute,$departments,$degrees,$years));
	}
		unset($this->request->data['CompanyCampus']['institution_id']);
		$institutions = $this->CompanyCampus->Institution->find('list');
		$departments = [];
		$degrees = [];
		$academic_years = [];
		$company_masters = $this->CompanyCampus->CompanyMaster->find('list');
		$this->set(compact('institutions', 'departments', 'degrees','company_masters', 'academic_years'));	
	
	}

	public function find_company_year($institute = null, $departments = null, $degrees = null, $years = null) {

		$this->set('institute',$institute);
		$this->set('departments',$departments,$degrees);
		$this->set('degrees',$degrees);
		
		$info_institute = $this->CompanyCampus->Institution->find('all',[
			'conditions' => ['Institution.id' => $institute],
			'fields' => ['Institution.name']	
			]);
		$info_branch = $this->CompanyCampus->Department->find('all',[
			'conditions' => ['Department.id' => $departments],
			'fields' => ['Department.name']	
			]);
		$info_degree = $this->CompanyCampus->Degree->find('all',[
			'conditions' => ['Degree.id' => $degrees],
			'fields' => ['Degree.name']	
			]);
		$info_academic_year = $this->CompanyCampus->AcademicYear->find('all',[
			'conditions' => ['AcademicYear.id' => $years],
			'fields' => ['AcademicYear.name']	
			]);

		$this->set('info_institute', $info_institute);
		$this->set('info_branch', $info_branch);
		$this->set('info_degree', $info_degree);
		$this->set('info_academic_year', $info_academic_year);

		$company_id = $this->CompanyCampus->find('list',[
			'conditions' => ['CompanyCampus.recstatus' => 1,'CompanyCampus.institution_id' => $institute,'CompanyCampus.department_id' => $departments,'CompanyCampus.degree_id' => $degrees,'CompanyCampus.academic_year_id' => $years],
			'field' => ['CompanyCampus.id']]);

		$companies = $this->CompanyCampus->find('list',[
			'conditions' => ['CompanyCampus.id' => $company_id],
			'fields' => ['CompanyCampus.company_master_id']
		]);

		$data = $this->CompanyCampus->find('all',[
			'contain' => [
            	'CompanyMaster' => [
                	'fields' => ['id','name']
                ],
            ],'conditions'=>['CompanyCampus.company_master_id'=>$companies]]);
        $this->set('data',$data);

		$company_names = $this->CompanyCampus->CompanyMaster->find('all',[
			'conditions' => ['CompanyMaster.id' => $companies,
			 				  'CompanyMaster.recstatus' => 1],
			'field' => ['CompanyMaster.name','CompanyMaster.id']]);

        $hiring = $this->CompanyCampus->CompanyMaster->CompanyJobEligibility->find('list',[
        		'conditions' => ['CompanyJobEligibility.company_master_id' => $companies,
        						 'CompanyJobEligibility.recstatus' => 1	],
        		'fields' => ['CompanyJobEligibility.hiring']				 
        	]);
        
      
      	$e = [];
        $p = 0;

        foreach($hiring as $key=>$value) {
        	$e[$p] = $value;
        	$p++;
        }

        $total_hiring=0;
        
        for($i = 0; $i < $p; $i++) {
            $total_hiring = $total_hiring + $e[$i];
        }
		
		$this->set('total_hiring',$total_hiring);

		$total = $this->CompanyCampus->CompanyMaster->find('count',[
			'conditions' => ['CompanyMaster.id' => $companies,
			 				  'CompanyMaster.recstatus' => 1],
			]);
		
		$campus_ids = $this->CompanyCampus->find('list',[
				'conditions' => ['CompanyCampus.company_master_id' => $companies,
								 'CompanyCampus.institution_id' => $institute,
								 'CompanyCampus.department_id' => $departments,
								 'CompanyCampus.degree_id' => $degrees,
								 'CompanyCampus.academic_year_id' => $years,
								 'CompanyCampus.recstatus' => 1	
				],'fields' => ['CompanyCampus.id']
			]);
		$stu_list = $this->CompanyCampus->PlacementResult->find('count',[
				'conditions' => ['PlacementResult.company_campus_id' => $campus_ids],

			]);
		$appointed_list = $this->CompanyCampus->PlacementResult->find('count',[
				'conditions' => ['PlacementResult.company_campus_id' => $campus_ids, 'PlacementResult.status' => 'Appointed'],

			]);
		$pending_list = $this->CompanyCampus->PlacementResult->find('count',[
				'conditions' => ['PlacementResult.company_campus_id' => $campus_ids, 'PlacementResult.status' => 'Pending'],

			]);
		$notqualified_list = $this->CompanyCampus->PlacementResult->find('count',[
				'conditions' => ['PlacementResult.company_campus_id' => $campus_ids, 'PlacementResult.status' => 'Not Qualified'],

			]);
		$this->set('notqualified_list',$notqualified_list);
		$this->set('pending_list',$pending_list);
		$this->set('appointed_list',$appointed_list);
		$this->set('stu_list',$stu_list);
		$this->set('total',$total); 
		$this->set('company_names',$company_names);

	}

	public function deactivate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyCampus->id = $id;
		if (!$this->CompanyCampus->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyCampus']['id'] = $id;
		$this->request->data['CompanyCampus']['recstatus'] = 0;

		if ($this->CompanyCampus->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been deactivated.'), 'alert', array(
    		'class' => 'alert-success'));
		} else {
			$this->Session->setFlash(__('The company could not be deactivated. Please, try again.'), 'alert', array(
    		'class' => 'alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}

	public function activate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyCampus->id = $id;
		if (!$this->CompanyCampus->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyCampus']['id']=$id;
		$this->request->data['CompanyCampus']['recstatus']= 1;
		if ($this->CompanyCampus->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been activated.'), 'alert', array(
    		'class' => 'alert-success'));
		} else {
			$this->Session->setFlash(__('The company could not be activated. Please, try again.'), 'alert', array(
    		'class' => 'alert-danger'));
		}
			return $this->redirect(array('action' => 'index'));
		}
	}	

	public function list_company() {
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        
        if (!$id) {
          throw new NotFoundException();
        }
	  	
	  	$this->disableCache();
		$company_campuses = $this->CompanyCampus->getListByDegree($id);

        $this->set(compact('company_campuses'));
        $this->set('_serialize', array('company_campuses'));
    }
	
	public function pie_company_hiring_overall() {
       
        $company = $this->CompanyCampus->CompanyMaster->find('list', array(
        'fields' => array('CompanyMaster.name')));


        $hire = $this->CompanyCampus->CompanyMaster->CompanyJobEligibility->find('list', array(
            'fields' => array('CompanyJobEligibility.hiring')));

        $data = [];
        $counter = 0;

        foreach($hire as $key => $value) {
        	$data[$counter] = (int)$value;
        	$counter++;
        }

       $content = [];
       $counter = 0;

       foreach ($company as $key => $value) {
        	$temp = [];
        	array_push($temp, $value,(int)$data[$counter]);
        	$content[$counter] = $temp;
        	$counter++;
       }
    
        $chartData = $content;
        $chartName = 'Pie Chart';

        $pieChart = $this->HighCharts->create( $chartName, 'pie' );

        $this->HighCharts->setChartParams(
                                            $chartName,
                                            array
                                            (
                                                'renderTo'              => 'piewrapper',
                                                'chartWidth'                => 800,
                                                'chartHeight'               => 500,
                                                'chartTheme'                            => 'grid',
                                                'title'                 => 'Hiring Status of Companies',
                                                'plotOptionsShowInLegend'       => TRUE,
                                                'creditsEnabled'            => FALSE
                                            )
        );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Hiring')
            ->addData($chartData);

        $pieChart->addSeries($series);

    }

     public function column_company_hiring_overall() {

        $company = $this->CompanyCampus->CompanyMaster->find('list', array(
        'fields' => array('CompanyMaster.name')));

        $hire['hiring'] = $this->CompanyCampus->CompanyMaster->CompanyJobEligibility->find('list', array(
        'fields' => array('CompanyJobEligibility.hiring')));
        
        $data = [];
        $counter = 0;
        
        foreach($hire['hiring'] as $key=>$value) {
        	$data[$counter] = (int)$value;
        	$counter++;
        }
        
        $content = [];
        $counter = 0;
        
        foreach ($company as $key => $value) {
        	$content[$counter] = $value;
        	$counter++;
      
        }
        
        $chartName = 'Column Chart';

        $mychart = $this->HighCharts->create( $chartName, 'column');

        $this->HighCharts->setChartParams (
                        $chartName,
                        array
                        (
                            'renderTo'                                  => 'columnwrapper', 
                            'chartWidth'                => 700,
                            'chartHeight'               => 500,
                            'title'                 => 'Companies Vs Hiring',
                            'subtitle'                                  => 'Training And Placement',
                            'xAxisLabelsEnabled'            => FALSE,
                            'xAxisCategories'           => $content,
                            'yAxisTitleText'        => 'Hiring',
                            'enableAutoStep'        => TRUE,
                            'creditsEnabled'        => FALSE,
                            'chartTheme'                => 'highroller',

                        )
                );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Hiring')->addData($data);

        $mychart->addSeries($series);
    }

	public function import_home() {
    }

	public function company_home() {
	}
	
	public function home() {
      
        $total = $this->CompanyCampus->CompanyMaster->find('count',array('conditions' => array('CompanyMaster.recstatus' => 1)));
        $total_training = $this->CompanyCampus->CompanyMaster->find('count',array('conditions' => array('CompanyMaster.training' => true,'CompanyMaster.recstatus' => 1)));
        $total_job = $this->CompanyCampus->CompanyMaster->find('count',array('conditions' => array('CompanyMaster.job' => true,'CompanyMaster.recstatus' => 1)));
        $companies = $this->CompanyCampus->CompanyMaster->find('all',array('conditions' =>array('CompanyMaster.recstatus' => 1),'field' => array('CompanyMaster.name')));
        $training = $this->CompanyCampus->CompanyMaster->find('all',array('conditions' => array('CompanyMaster.training' => 1,'CompanyMaster.recstatus' => 1),'field' => array('CompanyMaster.name')));
        $job = $this->CompanyCampus->CompanyMaster->find('all',array('conditions' => array('CompanyMaster.job' => 1,'CompanyMaster.recstatus' => 1),'field' => array('CompanyMaster.name')));

        $hiring = $this->CompanyCampus->CompanyMaster->CompanyJobEligibility->find('list', array(
        'conditions' => array('CompanyJobEligibility.recstatus' => 1),    
        'fields' => array('CompanyJobEligibility.hiring')));

        $data = [];
        $counter = 0;
        
        foreach($hiring as $key => $value) {
        	$data[$counter] = $value;
        	$counter++;
        }

        $total_hiring = 0;

        for($i=0; $i < $counter; $i++) {
            $total_hiring = $total_hiring + $data[$i];
        }

        $fullname = $this->Auth->user('fullname');
        $this->set(compact('companies','training','job','total','total_training','total_job','total_hiring','fullname'));
	}
}
