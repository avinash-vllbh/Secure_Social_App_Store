<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GroupsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $uses = array('Group','User','GroupsUser');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		//pr($this->request->params);
		//exit(1);
		//if(isset($this->request->params['pass'][0])){
			//if($this->request->params['pass'][0]){
		$headers = apache_request_headers();
		if(isset($headers['token'])) {
			$token = $headers['token'];
				$id = $this->User->find('first', array(
					'conditions' => array('User.token' => $token),
					'fields' => array('User.id'),
					'recursive' => 0));
				$groups = $this->GroupsUser->find('all', array(
					'conditions' => array('GroupsUser.user_id' => $id['User']['id'])));
				pr($groups);
				$this->set('groups', $groups);
				$this->set('_serialize', array('groups'));
		} else {
			$this->Group->recursive = -1;
			//$group = $this->Group->find('all', array('order' => array('Group.id' => 'desc')));
 			$this->set('groups', $this->Paginator->paginate());
 			//$this->set('groups', $group);
			$this->set('_serialize', array('groups'));
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
		$this->set('group', $this->Group->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$headers = apache_request_headers();
			if(isset($headers['token'])) {
				$user = $this->User->find('first', array(
					'conditions' => array('User.token' => $token),
					'recursive' => 0));
			$this->request->data['user_id'] = $id['User']['id'];
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
			// 	$this->Session->setFlash(__('The group has been saved.'));
			// 	return $this->redirect(array('action' => 'index'));
			 	$lastInsert = $this->Group->getLastInsertID();
			 	$result = $this->Group->find('first', array('conditions' => array('Group.id' => $lastInsert)));
			 	$this->set('result', $result);
				$this->set('_serialize',array('result'));
			 } } else {
				$result = "Failure";
			 	$this->set('result', $result);
				$this->set('_serialize',array('result'));
			}
		}
		return $this->redirect(array('action' => 'index.json'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$headers = apache_request_headers();
			if(isset($headers['token'])) {
				$user = $this->User->find('first', array(
					'conditions' => array('User.token' => $token),
					'recursive' => 0));
				$group = $this->Group->find('first', array('conditions' => array('Group.id' => $id)));
				//To check if admin is editing the Group info
				if($user['User']['id'] == $group['Group']['user_id']) { 
					if ($this->Group->save($this->request->data)) {
						$result = $this->request->data;
					 	$this->set('result', $result);
						$this->set('_serialize',array('result'));
			 		} else {
						$result = "Failure";
					 	$this->set('result', $result);
						$this->set('_serialize',array('result'));
					} 
			//else {
			//	$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
				} else {
					$result = "Did you really think you can do that!!!";
					$this->set('result', $result);
					$this->set('_serialize',array('result'));
				}
			}
			//$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
			//$this->request->data = $this->Group->find('first', $options);
			return $this->redirect(array('action' => 'index.json'));
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
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->onlyAllow('post', 'delete');
		$headers = apache_request_headers();
		if(isset($headers['token'])) {
			$user = $this->User->find('first', array(
				'conditions' => array('User.token' => $token),
				'recursive' => 0));
			$group = $this->Group->find('first', array('conditions' => array('Group.id' => $id)));
			//To check if admin is editing the Group info
			if($user['User']['id'] == $group['Group']['user_id']) { 
				if ($this->Group->delete()) {
					$result = "Success";
					$this->set('result', $result);
					$this->set('_serialize',array('result'));
			//$this->Session->setFlash(__('The group has been deleted.'));
				} else {
					$result = "Failed to Delete the group";
					$this->set('result', $result);
					$this->set('_serialize',array('result'));
				}
			} else {
				$result = "Did you really think you can do that!!!";
				$this->set('result', $result);
				$this->set('_serialize',array('result'));
			}
			//$this->Session->setFlash(__('The group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index.json'));
	}}
