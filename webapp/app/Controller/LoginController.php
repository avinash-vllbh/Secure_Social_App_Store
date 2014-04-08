<?php
class LoginController extends AppController {

	var $name    = 'Login';
	var $helpers = array('Form', 'Html', 'Session', 'Time');
	var $components = array('Session');
	var $uses = array('User');

	function beforeFilter() {
		$this->response->disableCache();
	}

function verify() {
		$date = date('Y/m/d H:i:s');
		if($this->Session->check('User.id')) {
			// if the user is already logged in then just forward them on to their home page
			$this->User->updateAll(array('User.last_login'=>"'".$date."'"),array('User.id' => $this->Session->read('User.id')));
			$this->redirect('/myConnect/');

		}
		if(!empty($this->request->data) && isset($this->request->data['User']['password']) && isset($this->request->data['User']['email']) ) {
			// its safe to do a lookup
			$user = $this->User->find('first', array('conditions' => array('password' => Security::hash($this->User->salt.$this->request->data['User']['password']), 'username' => $this->request->data['User']['email'])));
			if(isset($user['User']['id'])) {
				// we have a successful login!
				$this->Session->write('User.first_name', $user['User']['first_name']);
				$this->Session->write('User.last_name',  $user['User']['last_name']);
				$this->Session->write('User.id',         $user['User']['id']);
				$this->Session->write('User.admin',      $user['User']['site_admin']);
				$this->Session->write('User.email',      $user['User']['email']);
				//Update logged in time to users database
				$this->User->updateAll(array('User.last_login'=>"'".$date."'"),array('User.id' => $this->Session->read('User.id')));
				$this->Session->setFlash('Welcome '.$user['User']['first_name']." ".$user['User']['last_name']);
				$this->redirect(array('action' => 'index', 'controller' => 'Site'));
			} else {
				// we have a failure!!!
				$this->Session->setFlash('Incorrect login');
			}
		}
		$this->set("server_name", $_SERVER['SERVER_NAME']);
	}
}
?>
