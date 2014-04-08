<?php
App::uses('AppController', 'Controller');
/**
 * GroupUsers Controller
 *
 * @property GroupUser $GroupUser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GroupUsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GroupUser->recursive = 0;
		$this->set('groupUsers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->GroupUser->exists($id)) {
			throw new NotFoundException(__('Invalid group user'));
		}
		$options = array('conditions' => array('GroupUser.' . $this->GroupUser->primaryKey => $id));
		$this->set('groupUser', $this->GroupUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GroupUser->create();
			if ($this->GroupUser->save($this->request->data)) {
				$this->Session->setFlash(__('The group user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group user could not be saved. Please, try again.'));
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
		if (!$this->GroupUser->exists($id)) {
			throw new NotFoundException(__('Invalid group user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GroupUser->save($this->request->data)) {
				$this->Session->setFlash(__('The group user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupUser.' . $this->GroupUser->primaryKey => $id));
			$this->request->data = $this->GroupUser->find('first', $options);
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
		$this->GroupUser->id = $id;
		if (!$this->GroupUser->exists()) {
			throw new NotFoundException(__('Invalid group user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupUser->delete()) {
			$this->Session->setFlash(__('The group user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
