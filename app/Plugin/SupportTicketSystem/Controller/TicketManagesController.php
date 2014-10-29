<?php
App::uses('SupportTicketSystemAppController', 'SupportTicketSystem.Controller');
/**
 * TicketManages Controller
 *
 * @property TicketManage $TicketManage
 * @property PaginatorComponent $Paginator
 */
class TicketManagesController extends SupportTicketSystemAppController {

/**
 * index method
 *
 * @return void
 */
	public function index_developer() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first', array('recursive' => - 1));
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array(
			'limit' => $pagination_value,
			'page' => 1, 
			'contain' => ['Category','Staff'=>['Institution','Department']]);
		$this->set('ticketManages', $this->Paginator->paginate());
	}
	public function index() {
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
			'contain' => ['Category','Staff'=>['Department']],
			'conditions'=> array('Category.institution_id'=>$data2));
		$this->set('ticketManages', $this->Paginator->paginate());
	}
	public function index_deptcoord() {
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
			'contain' => ['Category','Staff'],
			'conditions'=> array('Category.institution_id'=>$data2));
		$this->set('ticketManages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TicketManage->exists($id)) {
			throw new NotFoundException(__('Invalid ticket manage'));
		}
		$options = array('conditions' => array('TicketManage.' . $this->TicketManage->primaryKey => $id));
		$this->set('ticketManage', $this->TicketManage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add_developer() {
		if ($this->request->is('post') && $this->request->data['TicketManage']['staff_id'] != 0) {
			$this->TicketManage->create();
			if ($this->TicketManage->save($this->request->data,true,array('category_id','staff_id','creator_id'))) {
				$this->request->data['Category']['id'] = $this->request->data['TicketManage']['category_id'];
			    $this->request->data['Category']['flag'] = 1;
			    if($this->TicketManage->Category->save($this->request->data,true,['id','flag','modifier_id'])) {
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$staffid = $this->request->data['TicketManage']['staff_id'];
			    	$data = $this->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]);
			    	$this->request->data['UserRole']['user_id'] = $data['User']['id'];
			    	$this->request->data['UserRole']['role_id'] = Configure::read('stcoordinator');
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The ticket coordinator has been saved.'));
						return $this->redirect(array('action' => 'index_developer'));
					}	
				}
			} else {
				$this->Session->setFlash(__('The ticket coordinator could not be saved. Please, try again.'));
			}

		}
        unset($this->request->data);
		$institutions = $this->TicketManage->Staff->Institution->find('list');
		$categories = [];
		$departments = [];
		$staffs = [];
		$this->set(compact('institutions', 'departments', 'staffs','categories'));

	}

	public function add() {
		if ($this->request->is('post') && $this->request->data['TicketManage']['staff_id'] != 0) {
			$this->TicketManage->create();
			if ($this->TicketManage->save($this->request->data,true,array('category_id','staff_id','creator_id'))) {
				$this->request->data['Category']['id'] = $this->request->data['TicketManage']['category_id'];
			    $this->request->data['Category']['flag'] = 1;
			    if($this->TicketManage->Category->save($this->request->data,true,['id','flag','modifier_id'])) {
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$staffid = $this->request->data['TicketManage']['staff_id'];
			    	$data = $this->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]);
			    	$this->request->data['UserRole']['user_id'] = $data['User']['id'];
			    	$this->request->data['UserRole']['role_id'] = Configure::read('stcoordinator');
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The ticket coordinator has been saved.'));
						return $this->redirect(array('action' => 'index'));
					}	
				}
			} else {
				$this->Session->setFlash(__('The ticket coordinator could not be saved. Please, try again.'));
			}

		}
        unset($this->request->data);
		$this->loadModel('Staff');
		$userid = $this->Auth->user('staff_id');
		$instid = $this->Staff->find('first', array('fields' => ['Staff.institution_id'], 'conditions' => array('Staff.id' => $userid)));
		$departments = $this->TicketManage->Category->Department->find('list', array(
		      			'conditions' => array('Department.institution_id' => $instid['Staff']['institution_id'])));
		$categories = [];
		$staffs = [];
		$this->set(compact('departments', 'staffs','categories'));

	}



public function add_deptcoord() {
		if ($this->request->is('post') && $this->request->data['TicketManage']['staff_id'] != 0) {
			$this->TicketManage->create();
			if ($this->TicketManage->save($this->request->data,true,array('category_id','staff_id','creator_id'))) {
				$this->request->data['Category']['id'] = $this->request->data['TicketManage']['category_id'];
			    $this->request->data['Category']['flag'] = 1;
			    if($this->TicketManage->Category->save($this->request->data,true,['id','flag','modifier_id'])) {
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$staffid = $this->request->data['TicketManage']['staff_id'];
			    	$data = $this->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]);
			    	$this->request->data['UserRole']['user_id'] = $data['User']['id'];
			    	$this->request->data['UserRole']['role_id'] = Configure::read('deptcoordinator');
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The ticket coordinator has been saved.'));
						return $this->redirect(array('action' => 'index'));
					}	
				}
			} else {
				$this->Session->setFlash(__('The ticket coordinator could not be saved. Please, try again.'));
			}

		}
        unset($this->request->data);
		$this->loadModel('Staff');
		$userid = $this->Auth->user('staff_id');
		$instid = $this->Staff->find('first', array('fields' => ['Staff.department_id'], 'conditions' => array('Staff.id' => $userid)));
		$staffs = $this->Staff->find('list', array(
		      			'conditions' => array('Staff.department_id' => $instid['Staff']['department_id'])));
		$categories = $this->TicketManage->Category->find('list',['conditions' => ['Category.recstatus' => 1,
				'Category.flag' => 0, 'Category.department_id' => $instid['Staff']['department_id'] ]]);
		
		$this->set(compact( 'staffs','categories'));

	}


/**
 * deactivate method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function deactivate($id = null) {
        if ($this->request->is(['post', 'put'])) {
            $this->TicketManage->id = $id;
            if (!$this->TicketManage->exists()) {
                throw new NotFoundException(__('Invalid TicketManage'));
            }
            $this->request->data['TicketManage']['id'] = $id;
            $this->request->data['TicketManage']['recstatus'] = 0;
            if ($this->TicketManage->save($this->request->data,true,['id','recstatus','modifier_id'])) {
            	$data = $this->TicketManage->find('first',['conditions'=>['TicketManage.id'=>$id]]);
            	$category_id = $data['TicketManage']['category_id'];
            	$this->request->data['Category']['id'] = $category_id;
			    $this->request->data['Category']['flag'] = 0;
			    if($this->TicketManage->Category->save($this->request->data,true,['id','flag','modifier_id'])){
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$staffid = $data['TicketManage']['staff_id'];
			    	$data = $this->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]);
			    	$this->request->data['UserRole']['user_id'] = $data['User']['id'];
			    	$data1 = $this->UserRole->find('first',['conditions'=>['UserRole.user_id'=>$data['User']['id'],
			    														  'UserRole.recstatus'=>1]]);
			    	$this->request->data['UserRole']['id'] = $data1['UserRole']['id'];
			    	$this->request->data['UserRole']['recstatus'] = 0;
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The Manager has been deactivated.'));
						return $this->redirect(array('action' => 'index'));
					}	
            	}
            } else {
                $this->Session->setFlash(__('The Manager cannot be deactivated. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
    }

/**
 * activate method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function activate($id = null) {
        if ($this->request->is(['post', 'put'])) {
            $this->TicketManage->id = $id;
            if (!$this->TicketManage->exists()) {
                throw new NotFoundException(__('Invalid TicketManage'));
            }
           
            $this->request->data['TicketManage']['id'] = $id;
            $this->request->data['TicketManage']['recstatus'] = 1;
            if ($this->TicketManage->save($this->request->data,['id','recstatus','modifier_id'])) {
                $this->Session->setFlash(__('The Manager has been activated.'));
            } else {
                $this->Session->setFlash(__('The Manager cannot be activated. Please, try again.'));
            }
           return $this->redirect(['action' => 'index']);
        }
    }

}