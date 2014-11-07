<?php
App::uses('SupportTicketSystemAppController', 'SupportTicketSystem.Controller');
/**
 * Department Transfer Controller
 *
 * @property Department Transfer $Transfer
 * @property PaginatorComponent $Paginator
 */
class DepartmentTransfersController extends SupportTicketSystemAppController {
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public

function transfer($id = NULL)
{
	if (!$this->DepartmentTransfer->Ticket->exists($id)) {
		throw new NotFoundException(__('Invalid ticket'));
	}

	if ($this->request->is('post')) {
		$this->DepartmentTransfer->create();
		$this->loadModel('Staff');
		$this->request->data['DepartmentTransfer']['ticket_id'] = $id;
		$categoryid = $this->request->data['DepartmentTransfer']['category_id'];
		$staff = $this->DepartmentTransfer->Ticket->Category->TicketManage->find('first', ['conditions' => ['TicketManage.category_id' => $categoryid, 'TicketManage.recstatus' => 1]]);
		$this->request->data['DepartmentTransfer']['staff_id'] = $staff['TicketManage']['staff_id'];
		$this->request->data['DepartmentTransfer']['status_id'] = Configure::read('Transferred');
		if ($this->DepartmentTransfer->save($this->request->data, true, array('ticket_id','department_id','category_id','staff_id',	'status_id','reasons_for_transfer'))) {
			$this->request->data['Ticket']['id']=$id;
			$this->request->data['Ticket']['status_id'] = Configure::read('Transferred');
			$this->request->data['Ticket']['recstatus'] = 0;
			if ($this->DepartmentTransfer->Ticket->save($this->request->data)){
			$this->Session->setFlash(__('Transferred.') , 'alert', array(
				'class' => 'alert-success'
			));
			return $this->redirect(array(
				'controller'=>'tickets',
				'action' => 'manage_tickets'
			));
		}
		else {
			$this->Session->setFlash(__(' Please, try again.'));
		}
	}
	}

	unset($this->request->data);
	$this->loadModel('Staff');
	$userid = $this->Auth->user('staff_id');
	$instid = $this->Staff->find('first', array('fields' => ['Staff.institution_id'],'conditions' => array('Staff.id' => $userid)));
	$departments = $this->DepartmentTransfer->Category->Department->find('list',
	 array('conditions' => array('Department.institution_id' => $instid['Staff']['institution_id'])));
	$categories = [];
	$this->set(compact('departments', 'categories'));
	}

	public function manage_transferred_tickets() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,'contain'=>['Staff','Category','Status','Ticket'=>['User']],
																					'conditions'=>['DepartmentTransfer.staff_id'=>$this->Auth->user('staff_id')]);
		$this->set('transfers', $this->Paginator->paginate());
	}

public function change_status($id = null) {
		if (!$this->DepartmentTransfer->exists($id)) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['DepartmentTransfer']['id'] = $id;
			if ($this->DepartmentTransfer->save($this->request->data)) {
				$this->Session->setFlash(__('The status has been saved.'), 'alert', array(
				'class' => 'alert-success'
			));
				return $this->redirect(array('action' => 'manage_transferred_tickets'));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please, try again.'));
			}
		}
		unset($this->request->data);
		$statuses = $this->DepartmentTransfer->Status->find('list',['conditions'=>[
																		'Status.id'=>[1,2]]]);
		$this->set(compact('statuses'));
		
	}
	public function view($id = null)
		{
			if (!$this->DepartmentTransfer->exists($id)) {
				throw new NotFoundException(__('Invalid Ticket'));
			}

			$options = array(
				'recursive' => -1,
				'contain' => ['Staff','Category','Status','Ticket'=>['User','Staff'=>['Department']]],
				'conditions' => array('DepartmentTransfer.' . $this->DepartmentTransfer->primaryKey => $id
				)
			);
			$this->set('transfer', $this->DepartmentTransfer->find('first', $options));
		}
	public function revoke($id = null)
	{
			if (!$this->DepartmentTransfer->exists($id)) {
				throw new NotFoundException(__('Invalid Ticket'));
			}
			else
			{
				$this->request->data['DepartmentTransfer']['id'] = $id;
				$this->request->data['DepartmentTransfer']['recstatus'] = 0;
				$ticketid = $this->DepartmentTransfer->find('first',[
														'fields'=>['DepartmentTransfer.ticket_id'],
														'conditions'=>['DepartmentTransfer.id' => $id]]);
				//debug($ticketid);				
				$this->request->data['Ticket']['id'] = $ticketid['DepartmentTransfer']['ticket_id'];
				$this->request->data['Ticket']['recstatus'] = 1;
				$this->request->data['Ticket']['status_id'] = 1;
				//debug($this->request->data); exit;
				$this->DepartmentTransfer->save($this->request->data);
				if($this->DepartmentTransfer->Ticket->save($this->request->data,true,array('recstatus'))){
										$this->Session->setFlash(__('Revoked It!') , 'alert', array(
				'class' => 'alert-success'
			));
				return $this->redirect(array('action' => 'manage_transferred_tickets'));
				}
			}	
	}
}
