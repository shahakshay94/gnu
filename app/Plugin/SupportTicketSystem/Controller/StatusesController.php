<?php
App::uses('SupportTicketSystemAppController', 'SupportTicketSystem.Controller');
/**
 * Statuses Controller
 *
 * @property Status $Status
 * @property PaginatorComponent $Paginator
 */
class StatusesController extends SupportTicketSystemAppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1);
		$this->set('statuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Status->exists($id)) {
			throw new NotFoundException(__('Invalid status'));
		}
		$options = ['conditions' => ['Status.' . $this->Status->primaryKey => $id],'contain'=>['Ticket'=>['Category','Staff','User']]];
		$this->set('status', $this->Status->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Status->create();
      		$this->request->data['Status']['name'] = ucfirst(strtolower($this->request->data['Status']['name']));
			if ($this->Status->save($this->request->data)) {
				$this->Session->setFlash(__('The status has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please, try again.'));
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
		if (!$this->Status->exists($id)) {
			throw new NotFoundException(__('Invalid status'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Status->save($this->request->data)) {
				$this->Session->setFlash(__('The status has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Status.' . $this->Status->primaryKey => $id));
			$this->request->data = $this->Status->find('first', $options);
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
            $this->Status->id = $id;
            if (!$this->Status->exists()) {
                throw new NotFoundException(__('Invalid Status'));
            }
            $this->request->data['Status']['id'] = $id;
            $this->request->data['Status']['recstatus'] = 0;
            if ($this->Status->save($this->request->data,true,array('id','recstatus'))) {
                $this->Session->setFlash(__('The Status has been deactivated.'));
            } else {
                $this->Session->setFlash(__('The Status cannot be deactivated. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
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
            $this->Status->id = $id;
            if (!$this->Status->exists()) {
                throw new NotFoundException(__('Invalid Status'));
            }
            $this->request->data['Status']['id'] = $id;
            $this->request->data['Status']['recstatus'] = 1;
            if ($this->Status->save($this->request->data,true,array('id','recstatus'))) {
                $this->Session->setFlash(__('The Status has been activated.'));
            } else {
                $this->Session->setFlash(__('The Status cannot be activated. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
        }
    }
}
