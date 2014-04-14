<?php
App::uses('AppController', 'Controller');
/**
 * UserApplications Controller
 *
 * @property UserApplication $UserApplication
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserApplicationsController extends AppController {

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
		$this->UserApplication->recursive = 0;
		$this->set('userApplications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserApplication->exists($id)) {
			throw new NotFoundException(__('Invalid user application'));
		}
		$options = array('conditions' => array('UserApplication.' . $this->UserApplication->primaryKey => $id));
		$this->set('userApplication', $this->UserApplication->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserApplication->create();
			if ($this->UserApplication->save($this->request->data)) {
				$this->Session->setFlash(__('The user application has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user application could not be saved. Please, try again.'));
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
		if (!$this->UserApplication->exists($id)) {
			throw new NotFoundException(__('Invalid user application'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserApplication->save($this->request->data)) {
				$this->Session->setFlash(__('The user application has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user application could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserApplication.' . $this->UserApplication->primaryKey => $id));
			$this->request->data = $this->UserApplication->find('first', $options);
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
		$this->UserApplication->id = $id;
		if (!$this->UserApplication->exists()) {
			throw new NotFoundException(__('Invalid user application'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserApplication->delete()) {
			$this->Session->setFlash(__('The user application has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user application could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
