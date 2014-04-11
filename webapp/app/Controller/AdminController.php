<?php
App::uses('AppController', 'Controller');
/**
 * Applications Controller
 *
 * @property Application $Application
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AdminController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $uses = array('User','Application','ApplicationRevision');

/**
 * index method
 *
 * @return void
 */
public function index() {
	$dev_users = $this->User->find('all', array(
		'conditions' => array('User.role' => 'developer')));
	$mobile_users = $this->User->find('all', array(
		'conditions' => array('User.role' => 'mobile')));
	$groups = $this->Group->find('all')
}