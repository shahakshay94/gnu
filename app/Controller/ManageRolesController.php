<?php
App::uses('AppController', 'Controller');
/**
 * Manage Roles Controller
 *
 * @property ManageRoles $Manageroles
 * @property PaginatorComponent $Paginator
 */
class ManageRolesController extends AppController {

public $components = array('Paginator');

/**
*
* View , Index , Deactivate and Add Function Of SuperAdmin Starts From Here.
*
**/
public function view_superadmin($id = null)
{
	if (!$this->ManageRole->exists($id)) {
		throw new NotFoundException(__('Invalid Role'));
	}

	$options = array(
		'recursive' => - 1,
		'contain' => ['Staff','Institution','Department','Role'],
		'conditions' => array('ManageRole.' . $this->ManageRole->primaryKey => $id
		)
	);
	$this->set('superadmin', $this->ManageRole->find('first', $options));
}

public function index_superadmin()
{
	$this->loadModel('Setting');
	$data = $this->Setting->find('first', array(
		'recursive' => - 1
	));
	$pagination_value = $data['Setting']['pagination_value'];
	$this->Paginator->settings = array(
		'limit' => $pagination_value,
		'page' => 1,
		'contain' => ['Staff','Institution','Department','Role'],
		'conditions'=>['ManageRole.role_id'=> array(Configure::read('superadmin'))]);
	$this->set('superadmins', $this->Paginator->paginate());
}

public function deactivate_superadmin($id = null)
{
	if ($this->request->is(array('post','put'))) {
		$this->ManageRole->id = $id;
		if (!$this->ManageRole->exists()) {
			throw new NotFoundException(__('Invalid Role'));
		}

		$this->request->data['ManageRole']['id'] = $id;
		$this->request->data['ManageRole']['recstatus'] = 0;
		if ($this->ManageRole->save($this->request->data, true, array('id','recstatus')))
		 {
			$this->Session->setFlash(__('It has been deactivated.') , 'alert', array(
				'class' => 'alert-success'
			));
		}
		else {
			$this->Session->setFlash(__('It cannot be deactivated. Please, try again.') , 'alert', array(
				'class' => 'alert-success'
			));
		}

		return $this->redirect(array('Controller' => 'manageroles','action' => 'index_superadmin'));
	}
}
public function add_superadmin()
{
	if($this->request->is('post') && $this->request->data['ManageRole']['staff_id'] != 0){
 			$this->ManageRole->create();
                        $this->request->data['ManageRole']['role_id'] = Configure::read('superadmin'); ; // role is 1 as it is superadmin MANUALLy set
 			if ($this->ManageRole->save($this->request->data)){	//saves the data is managerole table
 				$staff_id = $this->request->data['ManageRole']['staff_id']; //staff which we have selected itz id is stored in variable staffid
 			    $data = $this->ManageRole->Role->UserRole->User->find('first',['conditions'=>['User.staff_id'=>$staff_id]]); // finding that id in USER table
 			    $this->request->data['UserRole']['user_id'] = $data['User']['id']; // appending the user id after findind itz User
			    $this->request->data['UserRole']['role_id'] = Configure::read('superadmin'); // 1 super admin manually set
 			   if($this->ManageRole->Role->UserRole->save($this->request->data)){ // save data in USERROLE table
 				
 						$this->Session->setFlash(__('The Super Admin has been saved.'), 'alert', array(
     'class' => 'alert-success'
 ));				
 			}
 		}
 			else  {
 			     $this->Session->setFlash(__('The Super Admin could not be saved. Please, try again.'), 'alert', array(
     'class' => 'alert-success'
 ));
 		        }
 		}
 				    unset($this->request->data);	
                     $institutions = $this->ManageRole->Institution->find('list');
                     $departments = [];
            			$staffs = [];
          			$this->set(compact('institutions', 'departments', 'staffs'));
 
}

/**
*
* View, Index, Deactivate and Add Function Of Admin Starts From Here.
*
**/
public function view_admin($id = null)
{
	if (!$this->ManageRole->exists($id)) {
		throw new NotFoundException(__('Invalid Role'));
	}

	$options = array(
		'recursive' => - 1,
		'contain' => ['Staff','Institution','Department','Role'],
		'conditions' => array('ManageRole.' . $this->ManageRole->primaryKey => $id
		)
	);
	$this->set('admin', $this->ManageRole->find('first', $options));
}

public function index_admin_developer()
{
	$this->loadModel('Setting');
	$data = $this->Setting->find('first', array('recursive' => - 1));
	$pagination_value = $data['Setting']['pagination_value'];
	$this->Paginator->settings = array(
		'limit' => $pagination_value,
		'page' => 1,
		'contain' => ['Staff','Institution','Department','Role'],
		'conditions'=>['ManageRole.role_id'=> array(Configure::read('stadmin'),Configure::read('tpadmin'),Configure::read('fbadmin'))]);
	$this->set('admins', $this->Paginator->paginate());
}

public function index_admin()
{
	$this->loadModel('Setting');
	$this->loadModel('Staff');
	$data = $this->Setting->find('first', array('recursive' => - 1));
	$staffid = $this->Auth->user('staff_id');
	$data1=$this->Staff->find('first',['conditions'=>['Staff.id'=>$staffid]]);
	$data2 = $data1['Staff']['institution_id'];
	$pagination_value = $data['Setting']['pagination_value'];
	$this->Paginator->settings = array(
		'limit' => $pagination_value,
		'page' => 1,
		'contain' => ['Staff','Institution','Department','Role'],
		'conditions'=> array('ManageRole.role_id'=> array(Configure::read('stadmin'),Configure::read('tpadmin'),Configure::read('fbadmin')), 'ManageRole.institution_id'=>$data2));
	$this->set('admins', $this->Paginator->paginate());
}

public function deactivate_admin_developer($id = null)
{
	if ($this->request->is(array('post','put'))) {
		$this->ManageRole->id = $id;
		if (!$this->ManageRole->exists()) {
			throw new NotFoundException(__('Invalid Role'));
		}

		$this->request->data['ManageRole']['id'] = $id;
		$this->request->data['ManageRole']['recstatus'] = 0;
		if ($this->ManageRole->save($this->request->data, true, array('id','recstatus')))
		 {
			$this->Session->setFlash(__('It has been deactivated.') , 'alert', array(
				'class' => 'alert-success'
			));
		}
		else {
			$this->Session->setFlash(__('It cannot be deactivated. Please, try again.') , 'alert', array(
				'class' => 'alert-success'
			));
		}

		return $this->redirect(array('Controller' => 'manageroles','action' => 'index_admin_developer'));
	}
}

public function deactivate_admin($id = null)
{
	if ($this->request->is(array('post','put'))) {
		$this->ManageRole->id = $id;
		if (!$this->ManageRole->exists()) {
			throw new NotFoundException(__('Invalid Role'));
		}

		$this->request->data['ManageRole']['id'] = $id;
		$this->request->data['ManageRole']['recstatus'] = 0;
		if ($this->ManageRole->save($this->request->data, true, array('id','recstatus')))
		 {
			$this->Session->setFlash(__('It has been deactivated.') , 'alert', array(
				'class' => 'alert-success'
			));
		}
		else {
			$this->Session->setFlash(__('It cannot be deactivated. Please, try again.') , 'alert', array(
				'class' => 'alert-success'
			));
		}

		return $this->redirect(array('Controller' => 'manageroles','action' => 'index_admin'));
	}
}
/**
* This Function is called when developer login and Institution DropDown is Shown.
**/
public function add_developer_admin()
{
	if($this->request->is('post') && $this->request->data['ManageRole']['staff_id'] != 0){
 			$this->ManageRole->create();
 			if ($this->ManageRole->save($this->request->data)){	
 				$staffid = $this->request->data['ManageRole']['staff_id']; //staff which we have selected itz id is stored in variable staffid
 			    $data = $this->ManageRole->Role->UserRole->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]); // finding that id in USER table
 			    $this->request->data['UserRole']['user_id'] = $data['User']['id']; // appending the user id after findind itz User
 			    $this->request->data['UserRole']['role_id'] = $this->request->data['ManageRole']['role_id'];//copy role_id value from managerole to userrole table
 			    if($this->ManageRole->Role->UserRole->save($this->request->data)){ // save data in USERROLE table			
 
 						$this->Session->setFlash(__('The  Admin has been saved.'), 'alert', array(
     'class' => 'alert-success'
     ));				
 			}
 		}
 
 			else  {
 			     $this->Session->setFlash(__('The  Admin could not be saved. Please, try again.'), 'alert', array(
     'class' => 'alert-success'
 ));
 		        }
 		}
 				unset($this->request->data);
                                 $institutions = $this->ManageRole->Institution->find('list');
                                 $departments = [];
            			    	 $staffs = [];
            					 $roles = $this->ManageRole->Role->find('list',array(
           					     'conditions'=>array('Role.id'=>array(Configure::read('stadmin'),Configure::read('tpadmin'),Configure::read('fbadmin')))));
          						 $this->set(compact('institutions', 'departments', 'staffs','roles'));
 
}
/**
* This function fetches Institution_id from Sessions and generate dropdown accordingly.
**/
public function add_admin()
{
	if($this->request->is('post') && $this->request->data['ManageRole']['staff_id'] != 0){
 			$this->ManageRole->create();
 			$this->loadModel('Staff');
 			$userid = $this->Auth->user('staff_id');
			$data = $this->Staff->find('first',['conditions'=>['Staff.id'=>$userid]]);
	   		$this->request->data['ManageRole']['institution_id'] = $data['Staff']['institution_id'];
 			if ($this->ManageRole->save($this->request->data,true,array('institution_id','department_id','role_id','staff_id'))){	
 				$staffid = $this->request->data['ManageRole']['staff_id']; //staff which we have selected itz id is stored in variable staffid
 			    $data = $this->ManageRole->Role->UserRole->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]); // finding that id in USER table
 			    $this->request->data['UserRole']['user_id'] = $data['User']['id']; // appending the user id after findind itz User
 			    $this->request->data['UserRole']['role_id'] = $this->request->data['ManageRole']['role_id'];//copy role_id value from managerole to userrole table
 			    if($this->ManageRole->Role->UserRole->save($this->request->data)){ // save data in USERROLE table			
 
 						$this->Session->setFlash(__('The  Admin has been saved.'), 'alert', array(
     'class' => 'alert-success'
     ));				
 			}
 		}
 
 			else  {
 			     $this->Session->setFlash(__('The  Admin could not be saved. Please, try again.'), 'alert', array(
     'class' => 'alert-success'
 ));
 		        }
 
 
 
 		}
 				unset($this->request->data);
 		      					$userid = $this->Auth->user('staff_id');
 		      					$instid = $this->ManageRole->Staff->find('first', array('fields' => array('Staff.institution_id'), 'conditions' => array('Staff.id' => $userid)));
 		      					$departments = $this->ManageRole->Department->find('list',array('conditions'=>array('Department.institution_id'=>$instid['Staff']['institution_id'])));
            						$staffs = [];
            						$roles = $this->ManageRole->Role->find('list',array(
          							'conditions'=>array('Role.id'=>array(Configure::read('stadmin'),Configure::read('tpadmin'),Configure::read('fbadmin')))));
          			$this->set(compact( 'departments', 'staffs','roles'));
}

/**
*
* View, Index, Deactivate and Add Function Of Department Coordinator Starts From Here.
*
**/
public function view_deptcoord($id = null)
{
	if (!$this->ManageRole->exists($id)) {
		throw new NotFoundException(__('Invalid Role'));
	}

	$options = array(
		'recursive' => - 1,
		'contain' => ['Staff','Institution','Department','Role'],
		'conditions' => array('ManageRole.' . $this->ManageRole->primaryKey => $id
		)
	);
	$this->set('coordinator', $this->ManageRole->find('first', $options));
}

public function index_deptcoord()
{
	$this->loadModel('Setting');
	$data = $this->Setting->find('first', array('recursive' => - 1));
	$pagination_value = $data['Setting']['pagination_value'];
	$this->Paginator->settings = array(
		'limit' => $pagination_value,
		'page' => 1,
		'contain' => ['Staff','Institution','Department','Role'],
		'conditions'=>['ManageRole.role_id'=> array(Configure::read('deptcoordinator'))]);
	$this->set('coordinators', $this->Paginator->paginate());
}

public function deactivate_deptcoord($id = null)
{
	if ($this->request->is(array('post','put'))) {
		$this->ManageRole->id = $id;
		if (!$this->ManageRole->exists()) {
			throw new NotFoundException(__('Invalid Role'));
		}

		$this->request->data['ManageRole']['id'] = $id;
		$this->request->data['ManageRole']['recstatus'] = 0;
		if ($this->ManageRole->save($this->request->data, true, array('id','recstatus')))
		 {
			$this->Session->setFlash(__('It has been deactivated.') , 'alert', array(
				'class' => 'alert-success'
			));
		}
		else {
			$this->Session->setFlash(__('It cannot be deactivated. Please, try again.') , 'alert', array(
				'class' => 'alert-success'
			));
		}

		return $this->redirect(array('Controller' => 'manageroles','action' => 'index_deptcoord'));
	}
}

public function deactivate_developer_deptcoord($id = null)
{
	if ($this->request->is(array('post','put'))) {
		$this->ManageRole->id = $id;
		if (!$this->ManageRole->exists()) {
			throw new NotFoundException(__('Invalid Role'));
		}

		$this->request->data['ManageRole']['id'] = $id;
		$this->request->data['ManageRole']['recstatus'] = 0;
		if ($this->ManageRole->save($this->request->data, true, array('id','recstatus')))
		 {
			$this->Session->setFlash(__('It has been deactivated.') , 'alert', array(
				'class' => 'alert-success'
			));
		}
		else {
			$this->Session->setFlash(__('It cannot be deactivated. Please, try again.') , 'alert', array(
				'class' => 'alert-success'
			));
		}

		return $this->redirect(array('Controller' => 'manageroles','action' => 'index_deptcoord'));
	}
}

public function add_developer_deptcoord(){
		if($this->request->is('post') && $this->request->data['ManageRole']['staff_id'] != 0){
 			$this->ManageRole->create();
                         
 			if ($this->ManageRole->save($this->request->data)){	
 			    		 $staffid = $this->request->data['ManageRole']['staff_id']; //staff which we have selected itz id is stored in variable staffid
 			   			 $data = $this->ManageRole->Role->UserRole->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]); // finding that id in USER table
 			    		 $this->request->data['UserRole']['user_id'] = $data['User']['id']; // appending the user id after findind itz User
 			   			 $this->request->data['UserRole']['role_id'] = $this->request->data['ManageRole']['role_id'];//copy role_id value from managerole to userrole table
 			   			 if($this->ManageRole->Role->UserRole->save($this->request->data)){ // save data in USERROLE table		
 							$this->Session->setFlash(__('The Co-ordinator has been saved.') , 'alert', array(
				'class' => 'alert-success'
			));
 				}
 			}
 			else  {
 			    		 $this->Session->setFlash(__('The Co-ordinator could not be saved. Please, try again.') , 'alert', array(
				'class' => 'alert-success'
			));
 		          }
 		
 	}	
 				unset($this->request->data);
                    $institutions = $this->ManageRole->Institution->find('list');
                    $departments = [];
            		$staffs = [];
            		$roles = $this->ManageRole->Role->find('list',array( 'conditions'=>array('Role.id'=>array('6'))));
          			$this->set(compact('institutions', 'departments', 'staffs','roles'));
 
    }

    public function add_deptcoord(){
		if($this->request->is('post') && $this->request->data['ManageRole']['staff_id'] != 0){
 			$this->ManageRole->create();
            $userid = $this->Auth->user('staff_id');
			$data = $this->ManageRole->Staff->find('first',['conditions'=>['Staff.id'=>$userid]]);
	   		$this->request->data['ManageRole']['institution_id'] = $data['Staff']['institution_id'];             
 			if ($this->ManageRole->save($this->request->data)){	
 			    		
 			    		 $staffid = $this->request->data['ManageRole']['staff_id']; //staff which we have selected itz id is stored in variable staffid
 			   			 $data = $this->ManageRole->Role->UserRole->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]); // finding that id in USER table
 			    		 $this->request->data['UserRole']['user_id'] = $data['User']['id']; // appending the user id after findind itz User
 			   			 $this->request->data['UserRole']['role_id'] = $this->request->data['ManageRole']['role_id'];//copy role_id value from managerole to userrole table
 			   			 $userid = $this->Auth->user('staff_id');
						 $data = $this->ManageRole->Staff->find('first',['conditions'=>['Staff.id'=>$userid]]);
	    				 $this->request->data['ManageRole']['institution_id'] = $data['Staff']['institution_id'];
 			   			 if($this->ManageRole->Role->UserRole->save($this->request->data)){ // save data in USERROLE table		
 							$this->Session->setFlash(__('The Co-ordinator has been saved.') , 'alert', array(
				'class' => 'alert-success'
			));
 						
 				}
 			}
 			else  {
 			    		 $this->Session->setFlash(__('The Co-ordinator could not be saved. Please, try again.') , 'alert', array(
				'class' => 'alert-success'
			));
 		          }
 		
 	}	
 
 	
 				unset($this->request->data);
                     $userid = $this->Auth->user('staff_id');
 		      		$instid = $this->ManageRole->Staff->find('first', array('fields' => array('Staff.institution_id'), 'conditions' => array('Staff.id' => $userid)));
 		  			$departments = $this->ManageRole->Department->find('list',array('conditions'=>array('Department.institution_id'=>$instid['Staff']['institution_id'])));
            			$staffs = [];
            			$roles = $this->ManageRole->Role->find('list',array( 'conditions'=>array('Role.id'=>array('6'))));
          			$this->set(compact('departments', 'staffs','roles'));
 
}
}