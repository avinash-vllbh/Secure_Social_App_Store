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
	public $uses = array('UserFollower','User','Notification');

	public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('add');
		$this->Auth->allow('follow','unfollow');
	}
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

/**
 * add method
 *
 * @return void
 */
	public function follow($id = null) {
		if ($this->request->is('post')) {
			$headers = apache_request_headers();
			if(isset($headers['token'])){
				$token = $headers['token'];
				$user = $this->User->find('first', array(
						'conditions' => array('User.token' => $token),
						'fields' => array('User.id'),
						'recursive' => 0));
				//pr($user);
				if(isset($user['User']['id'])) {
					if(isset($this->request->params['pass'][0])){
						$follow_user = $this->User->find('first', array('conditions' => 
								array('User.id' => $this->request->params['pass'][0]),
									'recursive' => 0));
						//Check if the id passed is valid
						if(isset($follow_user['User']['id'])) {
							$this->request->data['UserFollower']['user_id'] = $user['User']['id'];
							$this->request->data['UserFollower']['follower_user_id'] = $follow_user['User']['id'];
							$this->UserFollower->create();
							if ($this->UserFollower->save($this->request->data)) {
								//Notify the user that someone is following him
								$notify['Notification']['user_id'] = $follow_user['User']['id'];
								$notify['Notification']['description'] = $user['User']['first_name']." ".$user['User']['last_name']." is now following you";
								$notify['status'] = 0;
								if($this->Notification->save($notify)){
									$result = "Success";
								} else {
							//$this->Session->setFlash(__('The user follower could not be saved. Please, try again.'));
									$result = "Failure";
								}
							} else {
								$result = "Failure";
							}
						} else {
							$result = "Failure-Invalid user to follow";
						}
					} else {
						$result = "Failure-User ID required to follow";
					}
				} else {
					$result = "Failure-Invalid token - User unauthorized";
				}
			} else {
				$result = "Failure-User TokenID required to authorize";
			}
			$this->set('result', $result);
			$this->set('_serialize', array('result'));
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
	}

	public function unfollow($id = null) {
		if ($this->request->is('post')) {
			$headers = apache_request_headers();
			if(isset($headers['token'])){
				$token = $headers['token'];
				$user = $this->User->find('first', array(
						'conditions' => array('User.token' => $token),
						'fields' => array('User.id'),
						'recursive' => 0));
				//pr($user);
				if(isset($user['User']['id'])) {
					if(isset($this->request->params['pass'][0])){
						$follow_user = $this->User->find('first', array('conditions' => 
								array('User.id' => $this->request->params['pass'][0]),
									'recursive' => 0));
						//Check if the id passed is valid
						if(isset($follow_user['User']['id'])) {
							//Delete the record 
							if($this->UserFollower->deleteAll(array('UserFollower.user_id' => $user['User']['id'],
																'UserFollower.follower_user_id' => $follow_user['User']['id']))) {
								$result = "Success";
							} else {
							//$this->Session->setFlash(__('The user follower could not be saved. Please, try again.'));
									$result = "Failure";
							}
						} else {
							$result = "Failure-Invalid user to unfollow";
						}
					} else {
						$result = "Failure-User ID required to unfollow";
					}
				} else {
					$result = "Failure-Invalid token - User unauthorized";
				}
			} else {
				$result = "Failure-User TokenID required to authorize";
			}
			$this->set('result', $result);
			$this->set('_serialize', array('result'));
		}
	}

}

