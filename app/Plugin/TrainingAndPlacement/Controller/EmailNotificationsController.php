<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');
App::uses('CakeEmail', 'Network/Email');

class EmailNotificationsController extends TrainingAndPlacementAppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('emailNotifications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EmailNotification->exists($id)) {
			throw new NotFoundException(__('Invalid email notification'));
		}
		$options = array('conditions' => array('EmailNotification.' . $this->EmailNotification->primaryKey => $id));
		$this->set('emailNotification', $this->EmailNotification->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
			$this->EmailNotification->create();
			$Email = new CakeEmail('gmail');
               	$Email->to($this->request->data['EmailNotification']['to']);
                $Email->from('yashce04@gmail.com');
                $Email->subject($this->request->data['EmailNotification']['subject']);
                $Email->template('company_notify');
                $this->request->data['EmailNotification']['flag'] = 1;
    
                if ($Email->send() && $this->EmailNotification->save($this->request->data)) {
                	return $this->redirect(array('action' => 'index'));
                    $this->Session->setFlash('An email with instructions has been send to \'%s\'.', $Email);
                    $this->Session->setFlash('In a third step you will then be able to change your password.');
                } else {
                    $this->Session->setFlash('Confirmation Email could not be sent. Please consult an admin.');
                }
                return $this->Session->setFlash('Email Sent');
		}
	}
}
