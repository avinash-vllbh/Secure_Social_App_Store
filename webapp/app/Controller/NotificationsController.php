<?php
App::uses('AppController', 'Controller');
/**
 * Notifications Controller
 *
 * @property Notification $Notification
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class NotificationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $uses = array('User');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$headers = apache_request_headers();
		if(isset($headers['token'])){
			$token = $headers['token'];
			$user = $this->User->find('first', array(
					'conditions' => array('User.token' => $token),
					'fields' => array('User.id'),
					'recursive' => 0));
			$notifications = $this->Notification->find('all', array(
								'conditions' => array('Notification.user_id' => $user['User']['id'],
								'Notification.status' => 1)));
				//To set the notifications as read for next login
			$this->Notification->updateAll(
				array('Notification.status' => 0),
				array('Notification.user_id' => $user['User']['id'])
				);
			$this->set('notifications', $notifications);
			$this->set('_serialize', array('notifications'));
		} else {
			$notifications = "You have no notifications";
			$this->set('notifications', $notifications);
			$this->set('_serialize', array('notifications'));
		}
	}

// /**
//  * view method
//  *
//  * @throws NotFoundException
//  * @param string $id
//  * @return void
//  */
// 	public function view($id = null) {
// 		if (!$this->Notification->exists($id)) {
// 			throw new NotFoundException(__('Invalid notification'));
// 		}
// 		$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
// 		$this->set('notification', $this->Notification->find('first', $options));
// 	}

// /**
//  * add method
//  *
//  * @return void
//  */
// 	public function add() {
// 		if ($this->request->is('post')) {
// 			$this->Notification->create();
// 			if ($this->Notification->save($this->request->data)) {
// 				$this->Session->setFlash(__('The notification has been saved.'));
// 				return $this->redirect(array('action' => 'index'));
// 			} else {
// 				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'));
// 			}
// 		}
// 	}

// /**
//  * edit method
//  *
//  * @throws NotFoundException
//  * @param string $id
//  * @return void
//  */
// 	public function edit($id = null) {
// 		if (!$this->Notification->exists($id)) {
// 			throw new NotFoundException(__('Invalid notification'));
// 		}
// 		if ($this->request->is(array('post', 'put'))) {
// 			if ($this->Notification->save($this->request->data)) {
// 				$this->Session->setFlash(__('The notification has been saved.'));
// 				return $this->redirect(array('action' => 'index'));
// 			} else {
// 				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'));
// 			}
// 		} else {
// 			$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
// 			$this->request->data = $this->Notification->find('first', $options);
// 		}
// 	}

// /**
//  * delete method
//  *
//  * @throws NotFoundException
//  * @param string $id
//  * @return void
//  */
// 	public function delete($id = null) {
// 		$this->Notification->id = $id;
// 		if (!$this->Notification->exists()) {
// 			throw new NotFoundException(__('Invalid notification'));
// 		}
// 		$this->request->onlyAllow('post', 'delete');
// 		if ($this->Notification->delete()) {
// 			$this->Session->setFlash(__('The notification has been deleted.'));
// 		} else {
// 			$this->Session->setFlash(__('The notification could not be deleted. Please, try again.'));
// 		}
// 		return $this->redirect(array('action' => 'index'));
// 	}}
