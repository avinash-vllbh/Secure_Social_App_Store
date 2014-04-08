<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow('add');
	$this->Auth->allow('mobile_login');
	if($this->Session->check('User.id')){
		$this->Auth->allow('logout');
	}
}

public function isAuthorized($user)	{
	if(in_array($this->action, array('edit','delete'))) {
		if($user['id'] != $this->request->params['pass'][0]) {
			return false;
		}
		return true;
	}
}
public function login() {
	if($this->request->is('post')) {
		$date = date('Y/m/d H:i:s');
		if($this->Auth->login()) {
				$user = $this->Auth->user();
			//To setup the session once login is successful
				$this->Session->write('User.first_name', $user['first_name']);
				$this->Session->write('User.last_name',  $user['last_name']);
				$this->Session->write('User.id',         $user['id']);
				$this->Session->write('User.email',      $user['email']);
				//Update logged in time to users database
				$this->User->updateAll(array('User.last_login'=>"'".$date."'"),array('User.id' => $this->Session->read('User.id')));
				$this->Session->setFlash('Welcome '.$user['first_name']." ".$user['last_name']);
			$this->redirect($this->Auth->redirectUrl(array('controller' => 'users' , 'action' => 'index' )));
		} else {
			$this->Session->setFlash('Your email/password combination was incorrect');
		}
	}
}

/***
// To check user access from mobile
// Generates a UUID to the user and sends it as a response to REST 
***/
public function mobile_login() {
	if($this->request->is('post')) {
		$date = date('Y/m/d H:i:s');
		if($this->Auth->login()) {
				$user = $this->Auth->user();
				$user_uuid = String::uuid();
				$this->User->updateAll(array(
					'User.last_login'=>"'".$date."'",
					'User.token' => "'".$user_uuid."'"),array('User.id' => $user['id']));
					$this->redirect($this->Auth->redirectUrl(array(
						'controller' => 'users' , 
						'action' => 'index/token/'.$user_uuid.'.json')));		

		} else {
			$login = "Failure";
			$this->set('_serialize', array($login));
			$this->response->statusCode(401);
		}
	}
}

public function logout() {
	if($this->Session->check('User.id')) {
		$date = date('Y/m/d H:i:s');
		if($this->Auth->logout()) {
			//To setup the session once logout is successful
			$this->Session->delete('User.id');
			$this->Session->delete('User.first_name');
			$this->Session->delete('User.last_name');
			$this->Session->delete('User.email');
			$this->Session->destroy();
			$this->redirect($this->Auth->redirectUrl());
		} 
	}
}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		// if($this->request->params['pass'] != null)
		// {
		// 	pr($this->request->params);
		// 	exit(1);
		// }
		if($this->Session->read('User.id') != null || $this->request->params['pass'] != null) {
			$this->User->recursive = 1;
			if($this->Session->read('User.id') != null) {
				$id = $this->Session->read('User.id');
				if(!empty($id)) {
					$result = $this->User->find('first', array('conditions'=>array('User.id' => $id)));
					// foreach ($result['Application'] as $app) {
					// 	//pr($app['id']);
						
					// }
					//$applicationPath = $this->ApplicaitonRevision->find('first', array())
					$this->set('result', $result);
					$this->set('_serialize', array('result'));
				}
			}
			if($this->request->params['pass']!=null) {
				$token = $this->request->params['pass'][1];
				$result = $this->User->find('first', array(
					'conditions' => array(
						'User.token' => $token)));
				$this->set('result', $result);
				$this->set('_serialize',array('result'));

			}

		} else { 
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
	}
		//$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set(array(
			'user' => $this->User->find('first', $options),
			'_serialize' => $this->User->find('first', $options)
			));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$user = $this->request->data;
				if(isset($this->request->params['ext'])) {
					if($this->request->params['ext'] == 'json') {
						$user['User']['role'] = 'mobile';
						$user_uuid = String::uuid();
						$user['User']['token'] = $user_uuid;
					}
				}
			$this->User->create();
			if ($this->User->save($user)) {
				if(isset($this->request->params['ext'])){
					if($this->request->params['ext'] == 'json') {
					$this->redirect($this->Auth->redirectUrl(array(
						'controller' => 'users' , 
						'action' => 'index/token/'.$user_uuid.'.json')));
					}
				}
				else {
					$this->Session->setFlash(__('The user has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
