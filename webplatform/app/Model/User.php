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

App::Uses ( 'AppModel', 'Model' ) ;

class User extends AppModel {
    
   public $name = 'User';
   var $primaryKey="userID";

   public $hasMany = array(
        'Follow' => array(
            'className' => 'Follow',
            'foreignKey' => 'userID'
        ),
        'Following' => array(
            'className' => 'Follow',
            'foreignKey' => 'followingID'
        ),
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'userID'
        ),
        'Like' => array(
            'className' => 'Like',
            'foreignKey' => 'userID'
        )
     );
   
   //model validations
   public $validate = array (
        'username' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please Enter the  Username'
            )
        ),
        'password' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please Enter the  Password'
            ),
            'minLength' => array(
               'rule' => array('minLength', 5),
               'message' => 'Password must be atleast 5 characters long !!'
            )
        ),
        'user_type_id' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please Select the User Type'
            )
        ),
        'userDescription' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please Enter the  description'
            )
        ),
        'email' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please Enter the valid Email'
            )
        ),
        'phone' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please Enter the  Phone Number'
            )
       ),
        'userAvatar'=>array(
            'rule1'=>array(
                'rule' => array('extension',array('jpeg','jpg','png','gif')),
                 'allowEmpty' => true,
                 'message' => 'Please select a valid user image',
                'on' => 'create',
               ),
            'rule2'=>array(
                'rule' => array('extension',array('jpeg','jpg','png','gif')),
                'message' => 'Please select a valid user image',
                'on' => 'update',
            )
        ),
         'user_csv_file'=>array(
            'rule' => array('extension',array('csv')),
            'required' => false,
            'allowEmpty' => false,
            'message' => 'Please select a valid csv file'
        )
    ) ;
}