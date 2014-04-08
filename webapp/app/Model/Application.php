<?php
App::uses('AppModel', 'Model');
/**
 * Application Model
 *
 */
class Application extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'application';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Your application needs a name',
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Too late...that one is taken!',
			),
			'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Alphabets and numbers only'
            ),
            'between' => array(
                'rule'    => array('between', 5, 15),
                'message' => 'Between 5 to 15 characters'
            )
		),
		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'count_rating' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rating' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

//Relationships
public $belongsTo = 'User';
var $hasMany = array(
	'ApplicationRevision' => array(
		'className' => 'ApplicationRevision',
		'foreignKey' => 'app_id',
		//'conditions' => array('approved' = 1)
		'order' => 'id DESC'
		),
	'comment' => array(
		'className' => 'Comment',
		'foreignKey' => 'app_id',
		//'conditions' => array('status' => 'approved'),
		'order' => 'id DESC'
		),
	);
}
