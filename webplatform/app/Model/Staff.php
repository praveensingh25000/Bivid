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

class Staff extends AppModel {
   
   public $name      = 'Staff';
   public $belongsTo = array('StaffGroup');
   public $actsAs    = array('Acl' => array('type' => 'requester','enabled' => false));

   public function bindNode($user) {
      return array('model' => 'StaffGroup', 'foreign_key' => $user['User']['staff_group_id']);
   }
   
   //model validations
   public $validate = array (
        'firstname' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please enter the  firstname'
            )
        ),
        'lastname' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please enter the  lastname'
            )
        ),
        'username' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please enter the  username'
            )
        ),
        'password' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please enter the  password'
            ),
            'minLength' => array(
               'rule' => array('minLength', 5),
               'message' => 'Password must be atleast 5 characters long !!'
            )
         ),
        'old_password' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please enter the  existing password'
            ),
            'minLength' => array(
               'rule' => array('minLength', 5),
               'message' => 'Password must be atleast 5 characters long !!'
            ),
            'maxLength' => array(
               'rule' => array('maxLength', 16),
               'message' => 'Password cannot be more than 16 characters long !!'
            )
        ),
        'email' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please enter the valid email'
            )
        ),
        'phone' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please enter the  phone number'
            )
        ),
        'staff_group_id' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please select the group'
            )
        ),
        'confirm_password' => array(
            'notEmpty' => array (
               'rule' => 'notEmpty',
               'message' => 'Please enter the  new password'
            ),
            'minLength' => array(
               'rule' => array('minLength', 5),
               'message' => 'Password must be atleast 5 characters long !!'
            ),
            'maxLength' => array(
               'rule' => array('maxLength', 16),
               'message' => 'Password cannot be more than 16 characters long !!'
            ),            
            'match'=>array(
               'rule' => 'validatePasswdConfirm',
               'message' => 'Passwords do not match' )
            )
   ) ;
    
   function validatePasswdConfirm($data) {
      if ($this->data['Staff']['password'] != $data['confirm_password']){
         return false;
      }
      return true;
   }
       
   public function parentNode(){
      if(!$this->id && empty($this->data)) {
         return null;
      }
      if(isset($this->data['Staff']['staff_group_id'])) {
         $groupId = $this->data['Staff']['group_id'];
      } else {
         $groupId = $this->field('staff_group_id');
      }
      if(!$groupId) {
         return null;
      } else {
         return array('StaffGroup' => array('id' => $groupId));
      }
    }
    
}
?>