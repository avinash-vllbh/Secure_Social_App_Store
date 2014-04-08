<?php
App::uses('AppController', 'Controller');
/**
 * UserFriends Controller
 *
 * @property UserFriend $UserFriend
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserFriendsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $uses = array('Notification');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserFriend->recursive = 0;
		$this->set('userFriends', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserFriend->exists($id)) {
			throw new NotFoundException(__('Invalid user friend'));
		}
		$options = array('conditions' => array('UserFriend.' . $this->UserFriend->primaryKey => $id));
		$this->set('userFriend', $this->UserFriend->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserFriend->create();
			if ($this->UserFriend->save($this->request->data)) {
				$this->Session->setFlash(__('The user friend has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user friend could not be saved. Please, try again.'));
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
		if (!$this->UserFriend->exists($id)) {
			throw new NotFoundException(__('Invalid user friend'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserFriend->save($this->request->data)) {
				$this->Session->setFlash(__('The user friend has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user friend could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserFriend.' . $this->UserFriend->primaryKey => $id));
			$this->request->data = $this->UserFriend->find('first', $options);
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
		$this->UserFriend->id = $id;
		if (!$this->UserFriend->exists()) {
			throw new NotFoundException(__('Invalid user friend'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserFriend->delete()) {
			$this->Session->setFlash(__('The user friend has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user friend could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
