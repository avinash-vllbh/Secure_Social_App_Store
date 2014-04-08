<?php
App::uses('AppController', 'Controller');
/**
 * UserFollowers Controller
 *
 * @property UserFollower $UserFollower
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserFollowersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 * To view the lsit of Followers
 * @return void
 */
	public function index() {
		$this->UserFollower->recursive = 0;
		$this->set('userFollowers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	// public function view($id = null) {
	// 	if (!$this->UserFollower->exists($id)) {
	// 		throw new NotFoundException(__('Invalid user follower'));
	// 	}
	// 	$options = array('conditions' => array('UserFollower.' . $this->UserFollower->primaryKey => $id));
	// 	$this->set('userFollower', $this->UserFollower->find('first', $options));
	// }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if(isset($this->request->params['pass'][0])){
				if($this->request->params['pass'][0]){
					$user = $this->User->find('first', array('conditions' => 
								array('User.token' => $this->request->params['pass'][0]),
									'recursive' => 0));
					$data['UserFollower']['user_id'] = $user['User']['id'];
					$data['UserFollower']['follower_user_id'] = isset($this->request->params['pass'][0];
					$this->UserFollower->create();
					if ($this->UserFollower->save($this->request->data)) {
						$notify['Notification']['user_id'] = isset($this->request->params['pass'][0];
						$notify['Notification']['description'] = $user['User']['first_name']." ".$user['User']['last_name']." is now following you";
						$notify['status'] = 1;
						if($this->Notification->save($notify)){
							$result = "Success";
							$this->set('result', $result);
							$this->set('_serialize', array('result'));
						} else {
							//$this->Session->setFlash(__('The user follower could not be saved. Please, try again.'));
							$result = "Failure";
							$this->set('result', $result);
							$this->set('_serialize', array('result'));
						}
					} else {
						//$this->Session->setFlash(__('The user follower could not be saved. Please, try again.'));
						$result = "Failure";
						$this->set('result', $result);
						$this->set('_serialize', array('result'));
					}

				// $this->Session->setFlash(__('The user follower has been saved.'));
				// return $this->redirect(array('action' => 'index'));
			} } else {
				//$this->Session->setFlash(__('The user follower could not be saved. Please, try again.'));
				$result = "Failure";
				$this->set('result', $result);
				$this->set('_serialize', array('result'));
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
	// public function edit($id = null) {
	// 	if (!$this->UserFollower->exists($id)) {
	// 		throw new NotFoundException(__('Invalid user follower'));
	// 	}
	// 	if ($this->request->is(array('post', 'put'))) {
	// 		if ($this->UserFollower->save($this->request->data)) {
	// 			$this->Session->setFlash(__('The user follower has been saved.'));
	// 			return $this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Session->setFlash(__('The user follower could not be saved. Please, try again.'));
	// 		}
	// 	} else {
	// 		$options = array('conditions' => array('UserFollower.' . $this->UserFollower->primaryKey => $id));
	// 		$this->request->data = $this->UserFollower->find('first', $options);
	// 	}
	// }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserFollower->id = $id;
		if (!$this->UserFollower->exists()) {
			throw new NotFoundException(__('Invalid user follower'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserFollower->delete()) {
			$this->Session->setFlash(__('The user follower has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user follower could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
