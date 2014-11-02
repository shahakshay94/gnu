<?php
App::uses('SupportTicketSystemAppController', 'SupportTicketSystem.Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends SupportTicketSystemAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


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
			'contain' => ['Institution','Department']);
		$this->set('categories', $this->Paginator->paginate());
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
			'contain' => ['Institution','Department'],
			'conditions'=> array('Category.institution_id'=>$data2));
		$this->set('categories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		
		$options = ['conditions' => ['Category.' . $this->Category->primaryKey => $id],'contain'=>['Ticket'=>['Status','Staff','User']]];
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
		public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			$this->loadModel('Staff');
      		$this->request->data['Category']['name'] = ucfirst(strtolower($this->request->data['Category']['name']));
      		$userid = $this->Auth->user('staff_id');
			$data = $this->Staff->find('first',['conditions'=>['Staff.id'=>$userid]]);
	    	$this->request->data['Category']['institution_id'] = $data['Staff']['institution_id'];
			if ($this->Category->save($this->request->data,true,array('name','institution_id','department_id'))) {
				$this->Session->setFlash(__('The category has been saved.') , 'alert', array(
				'class' => 'alert-success'
			));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}

		unset($this->request->data);
		$this->loadModel('Staff');
					$userid = $this->Auth->user('staff_id');
					$instid = $this->Staff->find('first', array('fields' => ['Staff.institution_id'], 'conditions' => array('Staff.id' => $userid)));

		      		$departments = $this->Category->Department->find('list', array(
		      			'conditions' => array('Department.institution_id' => $instid['Staff']['institution_id'])));
		      		$this->set(compact('departments'));
	}
	
	public function add_developer() {
		if ($this->request->is('post') && $this->request->data['Category']['institution_id'] != 0
			&& $this->request->data['Category']['department_id'] != 0){
			$this->Category->create();
			$this->request->data['Category']['name'] = ucfirst(strtolower($this->request->data['Category']['name']));
			if ($this->Category->save($this->request->data,true,array('name','institution_id','department_id'))) {
				$this->Session->setFlash(__('The category has been saved.') , 'alert', array(
				'class' => 'alert-success'
			));
				return $this->redirect(array('action' => 'index_developer'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}

		}
		else
		{
			$this->Session->setFlash(__('Select appropriate value . Please, try again.') , 'alert', array(
				'class' => 'alert-success'
			));
		}

		unset($this->request->data);
		      		$institutions = $this->Category->Institution->find('list');
		      		$departments = [];
         			$this->set(compact('institutions','departments'));
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param int $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data,true,array('id','name'))) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
	}

/**
 * deactivate method
 *
 * @param int $id
 * @return void
 */
	public function deactivate($id = null) {
        if ($this->request->is(array('post', 'put'))) {
            $this->Category->id = $id;
            
            if (!$this->Category->exists()) {
                throw new NotFoundException(__('Invalid Category'));
            }

            $this->request->data['Category']['id'] = $id;
            $this->request->data['Category']['recstatus'] = 0;
            
            if ($this->Category->save($this->request->data,true,array('id','recstatus'))) {
                $this->Session->setFlash(__('The category has been deactivated.'), 'alert', array(
				'class' => 'alert-success'
			));
            } else {
                $this->Session->setFlash(__('The category cannot be deactivated. Please, try again.'));
            }
            
            return $this->redirect(['plugin'=>'support_ticket_system',
           										'controller' => 'pages',
           										'action' => 'dashboard']);
        }
    }
    
/**
 * activate method
 *
 * @param int $id
 * @return void
 */
    public function activate($id = null) {
        if ($this->request->is(array('post', 'put'))) {
            $this->Category->id = $id;
            
            if (!$this->Category->exists()) {
                throw new NotFoundException(__('Invalid category'));
            }

            $this->request->data['Category']['id'] = $id;
            $this->request->data['Category']['recstatus'] = 1;
            
            if ($this->Category->save($this->request->data,true,array('id','recstatus'))) {
                $this->Session->setFlash(__('The category has been activated.'), 'alert', array(
				'class' => 'alert-success'
			));
            } else {
                $this->Session->setFlash(__('The category cannot be activated. Please, try again.'));
            }
            return $this->redirect(['plugin'=>'support_ticket_system',
           										'controller' => 'pages',
           										'action' => 'dashboard']);
        }
    }
    
     public function list_category(){
    		$this->request->onlyAllow('ajax');
			$id = $this->request->query('id');
			if (!$id) {
				throw new NotFoundException();
			}

			$this->disableCache();
			$categories = $this->Category->getListByDepartment($id);
			$this->set(compact('categories'));
			$this->set('_serialize', array('categories'));
	}
	
	public function list_categories(){
    		$this->request->onlyAllow('ajax');
			$id = $this->request->query('id');
			if (!$id) {
				throw new NotFoundException();
			}

			$this->disableCache();
			$categories = $this->Category->getListByDepartments($id);
			$this->set(compact('categories'));
			$this->set('_serialize', array('categories'));
	}
}
