<?php
class SitesController extends AppController {

	var $helpers = array('Form', 'Html', 'Session', 'Time');
	var $components = array('Session');
	var $uses = array('Application');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}

	function index() {
		$this->Application->recursive = -1;
		$applications = $this->Application->find('all', array('limit' => 10, 'order' => 'id desc'));
		$this->set('title_for_layout', 'Social App Store');
		$this->set('applications', $applications);
	}
}
?>
