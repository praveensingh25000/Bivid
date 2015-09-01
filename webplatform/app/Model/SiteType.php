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
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppModel', 'Model');

class SiteType extends AppModel{
    
    public $name = 'SiteType';
    
    public $validate = array(
        'name'=>array(
	   'notEmpty' => array(
		'rule' => 'notEmpty',
		'message' => 'Please enter the name',
	    ),
            'minLength' => array(
		'rule' => array('minLength', 2),
		'message' => 'Name must be atleast 2 characters long !!'
	    ),
	    'maxLength' => array(
		'rule' => array('maxLength', 100),
		'message' => 'Name cannot be more than 100 characters long !!'
	    )
	)
    );
}