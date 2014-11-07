<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
/**
 * dashboard method
 *
 * @return void
 */
	public function dashboard() {
        $fullname = $this->Auth->user('fullname');
        $modified = $this->Auth->user('modified');
        $this->set(compact('fullname','modified'));
        $staffid = $this->Auth->user('staff_id');
        $studentid = $this->Auth->user('student_id');
        if($staffid != 0)
        {
            $data = $this->User->Staff->find('first', array('fields' => array('Staff.institution_id','Staff.department_id'), 'conditions' => array('Staff.id' => $staffid)));
            $this->Session->write('institution_id',$data['Staff']['institution_id']);
            $this->Session->write('department_id',$data['Staff']['department_id']);
        } 

        elseif ($studentid != 0) {
            $data = $this->User->Student->find('first', array('fields' => array('Student.institution_id','Student.degree_id'), 'conditions' => array('Student.id' => $studentid)));
            $this->Session->write('institution_id',$data['Student']['institution_id']);
            $data1 = $this->User->Student->Degree->find('first', array('fields' => array('Degree.department_id'), 'conditions' => array('Degree.id' => $data['Student']['degree_id'])));
            $this->Session->write('department_id',$data1['Degree']['department_id']);
        }
	}



    
/**
 * add method
 *
 * @return void
 */
    public function add() {
    $this->User->Behaviors->load('Tools.Passwordable', array());
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data,true,array('username','pwd','pwd_repeat','fullname'))) {
				
                $lastid = $this->User->getLastInsertId();
                $this->request->data['UserRole']['user_id'] = $lastid;
                $this->request->data['UserRole']['role_id'] = Configure::read('user');
                if ($this->User->UserRole->save($this->request->data)) {

                    $this->Session->setFlash(__('The user has been saved.'));
				
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}}
	}

/**
 * beforeFilter method
 *
 * @return void
 */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }

/**
 * login method
 *
 * @return void
 */
	public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('recstatus') == 0) {
                    $this->Session->setFlash('User not active.');
                    $this->Auth->logout();
                    $this->redirect(array('action' => 'login'));
                } else {
                    $this->request->data['User']['id'] = $this->Auth->user('id');
                    $this->User->save($this->request->data,true,['id']);
                     $this->Session->setFlash(__('You Are Loggged In Successfully'), 'alert', array(
    'class' => 'alert-success'
));
                      return $this->redirect('/dashboard');

                }
            }
            $this->Session->setFlash(__('Invalid Username or Password.'), 'alert', array(
    'class' => 'alert-danger'));
        }
        unset($this->request->data['User']['username']);
        unset($this->request->data['User']['password']);
    }

/**
 * logout method
 *
 * @return void
 */
     public function logout() {
        $this->Session->setFlash(__('You Are Logged Out.'), 'alert', array(
    'class' => 'alert-info'
));
        return $this->redirect($this->Auth->logout());
    }

/**
 * lost_password()
 *
 * @param string $key
 * @return void
 */
    public function lost_password() {
        if (!empty($this->request->data['Form']['key'])) {

            $key = $this->request->data['Form']['key'];
            $this->redirect(array(
                'action' => 'change_password_init',
                $key
            ));
        }
        if (!empty($this->request->data['User']['email'])) {
            unset($this->User->validate['email']['isUnique']);
            $this->User->set($this->request->data);

            if ($this->User->validates(array('fieldList' => array('email')))) {
                $res = $this->User->find('first', array(
                    'fields' => array(
                        'username',
                        'id',
                        'email'
                    ),
                    'conditions' => array(
                        'User.email' => $this->request->data['User']['email']
                    )
                ));
            }

            // Valid user found to this email address
            if (!empty($res)) {
                $uid         = $res['User']['id'];
                $this->Token = ClassRegistry::init('Tools.Token');
                $code        = $this->Token->newKey('activate', null, $uid);
                if (Configure::read('debug') > 0) {
                    $debugMessage = 'DEBUG MODE: Show activation key - ' . h($res['User']['username']) . ' | ' . $code;
                    $this->Session->setFlash($debugMessage, 'info');
                }
                // Send email
                $Email = new CakeEmail('gmail');
                $Email->to($res['User']['email'], $res['User']['username']);
                $Email->from('jayeshanandani@gmail.com');
                $Email->subject(Configure::read('Config.pageName') . ' - ' . __('Password request'));
                $Email->template('lost_password');
                $Email->viewVars(compact('code'));
                if ($Email->send()) {
                    $this->Session->setFlash('An email with instructions has been send to \'%s\'.', $Email);
                    $this->Session->setFlash('In a third step you will then be able to change your password.');
                } else {
                    $this->Session->setFlash('Confirmation Email could not be sent. Please consult an admin.');
                }
                return $this->redirect(array(
                    'action' => 'lost_password'
                ));
            } else {
                $this->Session->setFlash('Not a valid account');
            }
        }
    }

/**
 * activate account method
 *
 * @return void
 */
    public function activate_account($keyToCheck = null) {
        $this->Token = ClassRegistry::init('Tools.Token');
        $token       = $this->Token->useKey('activate', $keyToCheck);

        if (!empty($token) && $token['Token']['used'] > 0) {
            // warning flash message: already activated
        } elseif (!empty($token)) {
            // continue with activation, set activate flag of this user from 0 to 1 for example
            $this->User->id = $key['Token']['user_id'];
            $this->User->saveField('active', 1);
            // success flash message, auto-login and redirect to his profile page etc
        } else {
            // error flash message: invalid key
            $this->Session->setFlash('Invalid Token');
        }
    }

/**
 * change_password_init method
 *
 * @param $keyToCheck
 * @return void
 */
    public function change_password_init($keyToCheck = null) {
        $this->autoRender = false;
        $this->Token = ClassRegistry::init('Tools.Token');
        $token       = $this->Token->useKey('activate', $keyToCheck);
        $uid         = $token['Token']['user_id'];

        if (!empty($token) && $token['Token']['used'] > 0) {
           $this->Session->setFlash('Token already used');
        } elseif (!empty($token)) {
            // continue, write to session and redirect
            $this->Session->write('Auth.Tmp.id', $uid);
            $this->redirect(array(
                'action' => 'change_password'
            ));
        } else {
            $this->Session->setFlash('Token invalid');
        }
    }

/**
 * change_password()
 *
 * @return void
 */
    public function change_password() {
        $uid = $this->Session->read('Auth.Tmp.id');
        echo $this->Session->read('Auth.Tmp.id');
        if (empty($uid)) {
            $this->Session->setFlash('You have to find your account first and click on the link in the email you receive afterwards');
            $this->redirect(array(
                'action' => 'lost_password'
            ));
        }

        if ($this->request->query('abort')) {
            if (!empty($uid)) {
                $this->Session->delete('Auth.Tmp');
            }
            $this->redirect(array(
                'action' => 'login'
            ));
        }

        $this->User->Behaviors->load('Tools.Passwordable', array());
        if ($this->request->is('post')) {
            $this->request->data['User']['id'] = $uid;
            if ($this->User->save($this->request->data, true, array(
                'id',
                'pwd',
                'pwd_repeat'
            ))) {
                debug($this->request->data);
                $this->Session->setFlash('Password saved successfully.You can login now.');
                $this->Session->delete('Auth.Tmp');
                $username = $this->User->field('username', array(
                    'id' => $uid
                ));
                $this->redirect(array(
                    'action' => 'login',
                    '?' => array(
                        'username' => $username
                    )
                ));
            }
            $this->Session->setFlash('Error');

            // Pwd should not be passed to the view again for security reasons.
            unset($this->request->data['User']['pwd']);
            unset($this->request->data['User']['pwd_repeat']);

        }
    }
}
