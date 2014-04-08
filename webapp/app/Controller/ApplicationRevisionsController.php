<?php
App::uses('AppController', 'Controller');
/**
 * ApplicationRevisions Controller
 *
 * @property ApplicationRevision $ApplicationRevision
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ApplicationRevisionsController extends AppController {

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
		$this->ApplicationRevision->recursive = 0;
		$this->set('applicationRevisions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ApplicationRevision->exists($id)) {
			throw new NotFoundException(__('Invalid application revision'));
		}
		$options = array('conditions' => array('ApplicationRevision.' . $this->ApplicationRevision->primaryKey => $id));
		$this->set('applicationRevision', $this->ApplicationRevision->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ApplicationRevision->create();
			if ($this->ApplicationRevision->save($this->request->data)) {
				$this->Session->setFlash(__('The application revision has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The application revision could not be saved. Please, try again.'));
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
		if (!$this->ApplicationRevision->exists($id)) {
			throw new NotFoundException(__('Invalid application revision'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ApplicationRevision->save($this->request->data)) {
				$this->Session->setFlash(__('The application revision has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The application revision could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ApplicationRevision.' . $this->ApplicationRevision->primaryKey => $id));
			$this->request->data = $this->ApplicationRevision->find('first', $options);
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
		$this->ApplicationRevision->id = $id;
		if (!$this->ApplicationRevision->exists()) {
			throw new NotFoundException(__('Invalid application revision'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ApplicationRevision->delete()) {
			$this->Session->setFlash(__('The application revision has been deleted.'));
		} else {
			$this->Session->setFlash(__('The application revision could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
