<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppModel', 'Model');

class Post extends AppModel {
    
    public $name    = 'Post';
    var $primaryKey = 'postID';
    public $actsAs  = array('Containable');
    
    public $validate = array(
	'description' => array(
	    'notEmpty' => array(
		 'rule' => 'notEmpty',
		 'message' => 'Please enter the post description',
	     )
	),
        'postImage'=>array(
            'rule' => array('extension',array('jpeg','jpg','png','gif')),
            'required' => false,
            'allowEmpty' => true,
            'message' => 'Please select a valid jpeg, png and gif image'
        ),
        'post_csv_file'=>array(
            'rule' => array('extension',array('csv')),
            'required' => false,
            'allowEmpty' => false,
            'message' => 'Please select a valid csv file'
        )
    );
    public $hasMany = array(
       'PostCount' => array(
          'className' => 'PostviewCount',
          'foreignKey' => 'postID'
        ),
        'Like' => array(
          'className' => 'Like',
          'foreignKey' => 'userID'
        ),
        'Comment' => array(
          'className' => 'Comment',
          'foreignKey' => 'postID'
        )
        
    ); 
   
    public $belongsTo = array(
          'User' => array(
          'className' => 'User',
          'foreignKey' => 'userID'
        ),
    );
    
    public function __construct($id = false, $table = null, $ds = null){
        parent::__construct($id, $table, $ds) ;
        
        $this->virtualFields['postLifeHour'] = sprintf(
            "timestampdiff(HOUR,NOW(),%s.postLife)", $this->alias, $this->alias
        );
        $this->virtualFields['postLifeMin'] = sprintf(
            "timestampdiff(MINUTE,NOW(),%s.postLife)", $this->alias, $this->alias
        );
        $this->virtualFields['postLifeSec'] = sprintf(
            "timestampdiff(SECOND,NOW(),%s.postLife)", $this->alias, $this->alias
        );        
        $this->virtualFields['postDateHour'] = sprintf(
            "HOUR(%s.postDate)", $this->alias, $this->alias
        );
        $this->virtualFields['postDateMin'] = sprintf(
            "MINUTE(%s.postDate)", $this->alias, $this->alias
        );
        $this->virtualFields['postDateSec'] = sprintf(
            "SECOND(%s.postDate)", $this->alias, $this->alias
        );          
    }
   
}
?>