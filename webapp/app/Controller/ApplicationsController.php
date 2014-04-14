<?php
App::uses('AppController', 'Controller');
/**
 * Applications Controller
 *
 * @property Application $Application
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ApplicationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $uses = array('Application', 'ApplicationRevision', 'UserApplication', 'User');

	public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('add');
		$this->Auth->allow('download_app');
}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Application->recursive = 0;
		$headers = apache_request_headers();
		if(isset($headers['token'])) {
			//Return token --> users list of applications
			$token = $headers['token'];
				$user = $this->User->find('first', array(
					'conditions' => array('User.token' => $token),
					'fields' => array('User.id'),
					'recursive' => 0));
				if(isset($user['User']['id'])) {
					//Check if params is set -- List of apps for passed UserID
					if(isset($this->request->params['pass'][0])) {
						$conditions = array('User.id' => $this->request->params['pass'][0]);
						if($this->User->hasAny($conditions)) {
							$result = $this->UserApplication->find('all', array(
										'conditions' => array('UserApplication.user_id' => $this->request->params['pass'][0]),
										'recursive' => 2));
							//pr($result);
							$this->set('result',$result);
							$this->set('_serialize', array('result'));
						} else {
							$result = "Invalid User ID";
							$this->set('result',$result);
							$this->set('_serialize', array('result'));
						}
					} else { 
						$result = $this->UserApplication->find('all', array(
						'conditions' => array('UserApplication.user_id' => $user['User']['id']),
						'recursive' => 2));
						$this->set('result',$result);
						$this->set('_serialize', array('result'));
					}
				} else {
					//Invalid token
					$result = "Invalid token id";
					$this->set('_serialize', array($result));
				}

		} else {
			//return generic list of apps

			$this->set('applications', $this->Paginator->paginate());
			$this->set('result', $this->Paginator->paginate());
			$this->set('_serialize', array('result'));
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
		if (!$this->Application->exists($id)) {
			throw new NotFoundException(__('Invalid application'));
		}
		$options = array('conditions' => array('Application.' . $this->Application->primaryKey => $id));
		$this->set('application', $this->Application->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
			if ($this->request->is('post')) {
				//Save the uploaded file under webroot
				$upload_file_array = $this->request->data['Application']['file'];
				if((isset($upload_file_array['error']) && $upload_file_array['error'] == 0)
					|| (!empty( $upload_file_array['tmp_name']) && $upload_file_array['tmp_name'] != 'none')) {
				$now  = date('Y-m-d-His');
				$name = str_replace(' ', '_', $upload_file_array['name']);
				$dest_file_path  = "".$now.$name."_"."1.0";
				$did_move_succeed = move_uploaded_file( $upload_file_array['tmp_name'], APP."webroot/uploads/".$dest_file_path);
				if($did_move_succeed !== 0) {
					$this->Session->setFlash(__('file upload failed.. Please, try again.'));
				}

				//pr($dest_file_path);

				//Save the parameters in application table
				$this->request->data['Application']['user_id'] = $this->Session->read('User.id');
				$this->request->data['Application']['path'] = APP."webroot/uploads/".$dest_file_path;
				if ($this->Application->save($this->request->data)) {
					$application_revision = array(
						'ApplicationRevision' => array(
							'app_id' => $this->Application->getLastInsertId(),
							'revision_number' => "1.0.0",
							'path' => $dest_file_path,
							'size' => $upload_file_array['size'],
							'filename' => $upload_file_array['name'],
							)
						);
					//pr($application_revision);
					if($this->ApplicationRevision->save($application_revision))
					{
						$this->Session->setFlash(__('Your application has been saved.'));
						$this->redirect(array('controller' => 'users', 'action' => 'index'));
					}
					else{
						$this->Session->setFlash(__('The application could not be saved. Please, try again.'));
					}
				} else {
					$this->Session->setFlash(__('The application could not be saved. Please, try again.'));
				}
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
		if (!$this->Application->exists($id)) {
			throw new NotFoundException(__('Invalid application'));
			$this->Session->setFlash("Invalid application");
			$this->redirect(array('controller'=>'users','action'=>'index'));
		}
		//Check if it's a post
		if ($this->request->is(array('post', 'put'))) {

				$upload_file_array = $this->request->data['Application']['file'];
				if((isset($upload_file_array['error']) && $upload_file_array['error'] == 0)
					|| (!empty( $upload_file_array['tmp_name']) && $upload_file_array['tmp_name'] != 'none')) {
				$now  = date('Y-m-d-His');
				$name = str_replace(' ', '_', $upload_file_array['name']);
				$dest_file_path  = "".$now.$name."_"."1.0";
				$did_move_succeed = move_uploaded_file( $upload_file_array['tmp_name'], APP."webroot/uploads/".$dest_file_path);
				if($did_move_succeed !== 0) {
					$this->Session->setFlash(__('file upload failed.. Please, try again.'));
				}

				$rev_num = $this->request->data['Application']['revision_number'];
				unset($this->request->data['Application']['revision_number']);
				$this->request->data['Application']['path'] = APP."webroot/uploads/".$dest_file_path;
				if ($this->Application->save($this->request->data)) {
					$application_revision = array(
						'ApplicationRevision' => array(
							'app_id' => $this->request->data['Application']['id'],
							'revision_number' => $rev_num,
							'path' => $dest_file_path,
							'size' => $upload_file_array['size'],
							'filename' => $upload_file_array['name'],
							)
						);
					//pr($application_revision);
					if($this->ApplicationRevision->save($application_revision))
					{
						$this->Session->setFlash(__('Your application has been saved.'));
						$this->redirect(array('controller' => 'users', 'action' => 'index'));
					}
					else{
						$this->Session->setFlash(__('The application could not be saved. Please, try again.'));
					}
				} else {
					$this->Session->setFlash(__('The application could not be saved. Please, try again.'));
				}
			}
			else
			{
				unset($this->request->data['Application']['revision_number']);
				if ($this->Application->save($this->request->data)) {
					$this->Session->setFlash(__('Your application has been saved.'));
					$this->redirect(array('controller' => 'users', 'action' => 'index'));
				}
				else {
					$this->Session->setFlash(__('The application could not be saved. Please, try again.'));
				}	
			}
		} 
		//Pass the application parameters that need to be edited
		else {
			$options = array('conditions' => array('Application.' . $this->Application->primaryKey => $id));
			$this->request->data = $this->Application->find('first', $options);
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
		$this->Application->id = $id;
		if (!$this->Application->exists()) {
			throw new NotFoundException(__('Invalid application'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Application->delete()) {
			$this->Session->setFlash(__('The application has been deleted.'));
		} else {
			$this->Session->setFlash(__('The application could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
* Method to download the file
*/

	public function download_app($id = null) {
		$this->Application->recursive = -1;
		if($id != null) {
			$headers = apache_request_headers();
			if(isset($headers['token'])) {
				// if($this->request->params['ext'] == "json") {
					$token = $headers['token'];
					$user = $this->User->find('first', array(
					'conditions' => array('User.token' => $token),
					'fields' => array('User.id'),
					'recursive' => 0));
					if(isset($user['User']['id'])) {
						$app = $this->Application->find('first', array('conditions'=>array('Application.id' => $id)));
						$name = $this->ApplicationRevision->find('first', 
											array('conditions' => array('ApplicationRevision.app_id' => $id),
													'order' => array('ApplicationRevision.id' => 'desc')));
						//pr($name);
						//apache_response_headers('Content-Type') = 'application/vnd.android.package-archive'; 
						$this->response->file($app['Application']['path'], array(
							'download' => true, 'name' => $name['ApplicationRevision']['filename']));

						//Record the download against the user
						$user_app = array();
						$user_app['user_id'] = $user['User']['id'];
						$user_app['application_id'] = $app['Application']['id'];
						$user_app['downloaded_on'] = date('Y-m-d H:i:s');
						$record = $this->UserApplication->find('first', array(
							'conditions' => array('UserApplication.user_id' => $user_app['user_id'],
												'UserApplication.application_id' => $user_app['application_id'])));
						if(isset($record['UserApplication']['id'])) {
							//Do not save
						} else {
							$this->UserApplication->create();
							$this->UserApplication->save($user_app);
						}
						 return $this->response;
					} else {
						$result = "Invalid Token";
						$this->set('_serialize',array($result));
					}
				// }
			} else {
				//Check if the user is logged in 
				if($this->Session->check('User.id')){
				//If there is a session set
					$app = $this->Application->find('first', array('conditions'=>array('Application.id' => $id)));
					$name = $this->ApplicationRevision->find('first', 
											array('conditions' => array('ApplicationRevision.app_id' => $id),
													'order' => array('ApplicationRevision.id' => 'desc')));
					$this->response->file($app['Application']['path'], array('download' => true, 'name' => $name['ApplicationRevision']['filename']));
					return $this->response;
				} else {
					$this->Session->setFlash("You need to login to download the applicaiton");
					$this->redirect($this->Auth->redirectUrl(array('controller' => 'users' , 'action' => 'login' )));
				}
			}
		}
	}
}






