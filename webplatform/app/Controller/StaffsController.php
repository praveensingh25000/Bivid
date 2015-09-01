<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */


App::import('Controller', 'AppController');
App::uses('Sanitize', 'Utility') ;

class StaffsController extends AppController{

    public $name = 'Staffs' ;

    public function beforeFilter(){
        parent::beforeFilter() ;
        $this->Auth->allow('admin_forgot_password','admin_login', 'admin_logout','admin_secure_check') ;
    }
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_index
     * @description   staff listing
     * @param         Null
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    
    function admin_index () {
     //check for auth session
        $userSession = $this->Session->read('Auth.User') ;

        /* search functionality */
        $value = "" ;
        $value1 = "" ;
        $show = "" ;
        $conditions = array('Staff.admin_id !='=>0) ;

        if(!empty($this->params)){
            if(!empty($this->params->query['keyword'])){
                $keyword = $this->params->query['keyword'] ;
                $value = $keyword ;
                $conditions = array('OR'=>array('Staff.firstname LIKE'=>"%$keyword%", 'Staff.lastname LIKE'=>"%$keyword%", 'Staff.username LIKE'=>"%$keyword%", 'Staff.email LIKE'=>"%$keyword%"), 'Staff.admin_id !='=>0) ;
            }
        }

        //read pagination limit
        $limit = Configure::read('Settings.paginationLimit') ;

        //search and paginate
        $this->paginate = array(
            'limit'=>$limit,
            'fields'=>array(),
            'conditions'=>$conditions,
            'order'=>array('Staff.id'=>'desc')
        );

        $getData = $this->paginate('Staff') ;

        /* Active/Inactive/Delete functionality */


        if(isset($this->request->data["Staff"]["setStatus"])){
            // echo 'here';die;
            if(!empty($this->request->data['Staff']['status'])){
                $status = $this->request->data['Staff']['status'] ;
            }else{
                $this->Session->setFlash("Please select the action.", 'default', array('class'=>'alert alert-danger')) ;
                $this->redirect(array('action'=>'admin_index')) ;
            }
            if(!empty($this->request->data['checkboxes'])){
            $CheckedList = $this->request->data['checkboxes'] ;
            
            $model = 'Staff' ;
            $controller = $this->params['controller'] ;
            $action = $this->params['action'] ;
            parent::setStatus($status, $CheckedList, $model, $controller, $action) ;
            }
        }

        //set layout
        $this->layout = ($this->request->is('ajax')) ? 'ajax' : 'admin' ;
        //set model 
        $this->set('models', Inflector::singularize($this->name)) ;
        //set breadcrumb
        $this->set('breadcrumb', 'Users/All list') ;
        //set pagination limit
        $this->set('limit', $limit) ;
        //set variables for search
        $this->set('keyword', $value) ;
        $this->set('show', $show) ;
        $this->set('navadmins', 'class = "active"') ;
        $this->set(compact('getData')) ;

        //pr($result);die;
    }
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_add
     * @description   add staff
     * @param         Null
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    function admin_add () {
        //check for auth session
        $userId = $this->Session->read('Auth.User.id') ;

        //get group information
        $this->loadModel('StaffGroup') ;
        $group = $this->StaffGroup->find('list', array('conditions'=>array('status'=>1))) ;
        $this->set(compact('group'));
         //if data is posted
        if($this->request->is('post')){
            $data = $this->request->data ;
            $data['Staff']['password']=md5($this->request->data['Staff']['password']);
            $this->Staff->set($this->request->data);
            if($this->Staff->validates()){ 
                if($this->Staff->save($data)){
                    $this->Session->setFlash('User Staff has been saved successfully.', 'default', array('class'=>'alert alert-success')) ;
                    $this->redirect(array('controller'=>'staffs', 'action'=>'index', 'admin'=>true)) ;
                }else{
                    $this->Session->setFlash('Something went wrong. Please try again later.', 'default', array('class'=>'alert alert-danger')) ;
                }
            }
        }
        //set breadcrumb
        $this->set('breadcrumb', 'Users/Add') ;
        $this->set('userId', $userId) ;
    }

    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_edit
     * @description   edit Staff
     * @param         userId
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
   */
    function admin_edit ($id = NULL) {
        //check for auth session
        $userSession = $this->Session->read('Auth.User') ;
        $this->loadModel('StaffGroup') ;
        $group = $this->StaffGroup->find('list', array('conditions'=>array('status'=>1))) ;
        $this->set(compact('group')) ;
        $id=base64_decode($id);
        $this->set('id',$id);
        if(empty($this->request->data)){
            $this->request->data = $this->Staff->read(null, $id);
              }elseif(isset($this->request->data) && !empty($this->request->data))
	      {
                $this->request->data['Staff']['id'] = $this->request->data['Staff']['id'];
                $this->Staff->set($this->request->data);
                   if($this->Staff->validates()){
                      if($this->Staff->save($this->request->data)){ 	
                             $this->Session->setFlash("Staff User has been added sucessfully.",'default',array('class'=>'alert alert-success'));	
			     $this->redirect(array('action' => 'index'));
			     }
                     }    
			}

        //set breadcrumb
        $this->set('breadcrumb', 'Users / Edit') ;
    }
    
   /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_addedit
     * @description   edit profile
     * @param         userId
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
   */

    function admin_addedit($id = null){
        $this->layout = "admin" ;
        $new_user = false ;
        $this->set('id', $id) ;
        if($id == "me"){
            $id = base64_encode($this->Session->read('Auth.User.id')) ;
        }
        if(empty($this->request->data)){
            $this->request->data = $this->Staff->read(null, base64_decode($id)) ;
            $preSelectedPatients = '' ;
            if(!empty($this->request->data['AdvocatePatient'])){
                foreach($this->request->data['AdvocatePatient'] as $pat){
                    $preSelectedPatients[] = $pat['patient_id'] ;
                }
            }
            $this->set('preSelectedPatients', $preSelectedPatients) ;
        }elseif(isset($this->request->data) && !empty($this->request->data)){
            //pr($this->request->data);// exit;
            $this->request->data = Sanitize::clean($this->request->data, array('encode'=>false)) ;
            $id = base64_decode($id) ;
            $this->request->data['Staff']['id'] = $id ;
            $this->request->data['Staff']['status'] = 1 ;
            $this->request->data['Staff']['user_type_id'] = 1 ;
            $this->request->data['Staff']['email'] = strtolower($this->request->data['Staff']['email']) ;
            $this->Staff->set($this->request->data) ;

            if($this->Staff->validates()){
                $patientInfo = array() ;
                if(empty($this->request->data['Staff']['id'])){
                    $new_user = true ;
                }
                if($this->Staff->saveAll($this->request->data['Staff'], array('false'))){
                    if($new_user){
                        $userId = $this->Staff->getLastInsertId() ;
                        $hashCode = md5(uniqid(rand(), true)) ;
                    }
                    $this->Session->setFlash("The Profile has been updated successfully.", 'default', array('class'=>'alert alert-success')) ;
                    $this->redirect(array('controller'=>'dashboards')) ;
                }
            }
        }
        $textAction = ($id == null) ? 'Add' : 'Edit' ;
        $buttonText = ($id == null) ? 'Submit' : 'Update' ;
        $this->set('navadmins', 'class = "active"') ;
        $this->set('action', $textAction) ;
        $this->set('breadcrumb', 'Staff/'.$textAction) ;
        $this->set('buttonText', $buttonText) ;
    }
    
   /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_login
     * @description   login
     * @param         void
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
   */
    public function admin_login(){
        
        $this->layout = 'admin_login' ;
        
        $remember_me  = false ;
        
        $this->set('title_for_layout', 'Admin Login') ;
        
        $userSession  = $this->Session->read('Auth.User') ;
        
        if(!empty($this->request->data)){            
            $this->Staff->set($this->request->data);            
            if($this->Staff->validates()){
                if($this->checkEmailValidation($this->request->data['Staff']['email'])){                 
                    $email         = strtolower($this->data['Staff']['email']) ;
                    $userPassword  = md5($this->data['Staff']['password']) ;
                    $userInfo      = $this->Staff->find('first', array('fields'=>array('Staff.*'), 'conditions'=>array("Staff.email"=>$email, "Staff.password"=>$userPassword))) ;
                    //debug($userinfo); exit;
                    if(!empty($userInfo['Staff']['email']) && !empty($userInfo['Staff']['password']) && $userInfo['Staff']['password']== $userPassword){                   
                        if(!empty($this->request->data['Staff']['remember_me'])){
                            $password = base64_encode($this->data['Staff']['password']) ;
                            $hour     = TIME() + 60 * 60 * 24 * 30 ;
                            SETCOOKIE("EMAIL_COOKIE", $email, $hour) ;
                            SETCOOKIE("PASSWORD_COOKIE", $password, $hour) ;
                        }else{
                            SETCOOKIE("EMAIL_COOKIE", "", time() - 3600) ;
                            SETCOOKIE("PASSWORD_COOKIE", "", time() - 3600) ;
                        }
                        $this->Session->write('SESSION_ADMIN', $userInfo['Staff']) ;
                        $this->Session->write('Auth.User', $userInfo['Staff']) ;
                        $this->redirect(array('controller'=>'dashboards')) ;                    
                    }else{
                        $this->Session->setFlash('Email/Password is not correct.', 'default', array('class'=>'flashError', 'admin'=>1)) ;
                    }
                } else {
                    $this->Session->setFlash('Please enter a valid email address.', 'default', array('class'=>'flashError', 'admin'=>1)) ;
                }
            }
        }elseif(!empty($_COOKIE['EMAIL_COOKIE'])){
            $this->request->data['Staff']['email'] = @$_COOKIE['EMAIL_COOKIE'] ;
            $this->request->data['Staff']['password'] = base64_decode(@$_COOKIE['PASSWORD_COOKIE']) ;
            $remember_me = true ;
        }
        $this->set('remember_me', $remember_me) ;
    }
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_logout
     * @description   logout
     * @param         void
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
   */
    
    public function admin_logout(){
        $this->Session->setFlash('Your account has been logged out successfully', 'default', array('class'=>'success', 'admin'=>1)) ;
        $this->Session->destroy();
        return $this->redirect($this->Auth->logout()) ;
    }
    
    /*
    * @author        Sushil Kumar
    * @copyright     smartData Enterprise Inc.
    * @method        admin_forgot_password
    * @description   forgot password
    * @param         void
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function admin_forgot_password(){
        
        $this->layout = 'admin_login';
        
        $this->set('title','Forgot Password');
        
        $this->set('title_for_layout','Forgot Password');
        
        $this->loadModel('Emailtemplate');
        
        if(!empty($this->request->data)){
            
            $this->Staff->set($this->request->data);
            
            if($this->Staff->validates()){
                
               $this->request->data = Sanitize::clean($this->request->data, array('encode' => false));
               
               $getEmailStatus = $this->checkEmailValidation($this->request->data['Staff']['email']);
               
               if($getEmailStatus){
                
                    $userForgotData = $this->Staff->find('first',array('conditions'=>array('Staff.email'=>trim($this->request->data['Staff']['email']),'Staff.status'=>1),'fields'=>array('Staff.id','Staff.firstname','Staff.lastname','Staff.email')));
                    
                    if(!empty($userForgotData)){
                        
                        $this->Staff->id = $userForgotData['Staff']['id'];
                        $hashCode  = md5(uniqid(rand(), true));                        
                        $this->Staff->saveField('random_key',$hashCode, false);
                        $link      =  '<a href = "'.URL_SITE.'/admin/staffs/secure_check/'.$hashCode.'">Link </a>';
                        $to        = $userForgotData['Staff']['email'];
                        $template  = $this->Emailtemplate->getEmailTemplate('admin_forgot_password');                        
                        $emailData = $template['Emailtemplate']['template'];					
                        $emailData = str_replace('{FirstName}',ucfirst($userForgotData['Staff']['firstname']),$emailData);
                        $emailData = str_replace('{LastName}',ucfirst($userForgotData['Staff']['lastname']),$emailData);			    
                        $emailData = str_replace('{Link}',$link,$emailData);			
                        $subject   = ucfirst(str_replace('_', ' ', $template['Emailtemplate']['name']));
                        $sendMail  = $this->sendEmail($to, $subject, $emailData);
                        $this->Session->setFlash('Please check your mailbox to reset your account password.','default',array('class'=>'alert-success'));
                        $this->redirect(array('controller'=>'staffs','action'=>'login'));
                        
                    }else{
                        $this->Session->setFlash('Invalid email address.', 'default', array('class'=>'flashError', 'admin'=>1)) ;                        
                    }
                } else {
                    $this->Session->setFlash('Please enter a valid email address.', 'default', array('class'=>'flashError', 'admin'=>1)) ;
                }
            }
        }
    }
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        checkEmailValidation
     * @description   validate email-id
     * @param         email
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
   */
    public function checkEmailValidation($email){
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$";
        if (eregi($pattern, $email)){
           return true;
        } else {
           return false; 
        }
    }
    
    /*
    * @author        Sushil Kumar
    * @copyright     smartData Enterprise Inc.
    * @method        admin_secure_check
    * @description   get the password after forgot
    * @param         uniqueKey
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */    
    function admin_secure_check($uniqueKey){
        
        $this->layout = 'admin_login';        
        $this->set('title', 'Forgot Password');
        
        $this->set('title_for_layout', 'Forgot Password');        
        $this->set('uniqueKey', $uniqueKey);
        
        $data = $this->Staff->find('first', array('conditions'=>array('Staff.random_key'=>$uniqueKey)));
        if(empty($data)){
            $this->Session->setFlash('This link doesnot exist.Please reset your password again', 'default', array('class'=>'alert alert-danger')) ;
            $this->redirect(array('controller'=>'staffs', 'action'=>'forgot_password'));
        }
        if(!empty($this->request->data) && !empty($data['Staff']['id'])){
            $this->Staff->set($this->request->data);            
            if($this->Staff->validates()){                
                $this->request->data['Staff']['id']         = $data['Staff']['id'];
                $this->request->data['Staff']['password']   = md5(trim($this->request->data['Staff']['password'])) ;
                $this->request->data['Staff']['random_key'] = '';
                if($this->Staff->save($this->request->data,false)){
                    $this->Session->setFlash("Password has been changed successfully.", 'default', array('class'=>'alert alert-success')) ;
                    $this->redirect(array('controller'=>'staffs', 'action'=>'login')); 
                }else{
                    $this->Session->setFlash("Internal Error Occurs.Please try again.", 'default', array('class'=>'alert alert-danger')) ;
                }
            }
        }
    }
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_changepassword
     * @description   change the password in admin section
     * @param         void
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
   */
    function admin_changepassword(){
        $this->layout = "admin" ;
        $this->loadModel('EmailTemplate') ;
        if(!empty($this->request->data)){
            $id = $this->Session->read('Auth.User.id') ;
            $userInfo = $this->Staff->find('first', array('fields'=>array('id', 'password', 'email', 'firstname', 'lastname'), 'conditions'=>array("Staff.id"=>$id))) ;
            $Oldassword = md5(trim($this->request->data['Staff']['old_password'])) ;
            $this->Staff->set($this->request->data);
            

            if($this->Staff->validates()){
                if(!empty($userInfo['Staff']['password']) && ($userInfo['Staff']['password'] == $Oldassword)){
                    $this->Staff->create();
                    unset($this->request->data['Staff']['old_password']) ;
                    unset($this->request->data['Staff']['confirm_password']) ;
                    $this->request->data['Staff']['id']       = $id ;
                    $this->request->data['Staff']['password'] = md5(trim($this->request->data['Staff']['password'])) ;
                    if($this->Staff->save($this->request->data,false)){
                        $this->Session->setFlash("Password has been updated successfully.", 'default', array('class'=>'alert alert-success')) ;
                    }else{
                        $this->Session->setFlash("Internal Error Occurs.Please try again.", 'default', array('class'=>'alert alert-danger')) ;
                    }
                }else{
                    $this->Session->setFlash("Entered password does not match.Please try again.", 'default', array('class'=>'alert alert-danger')) ;
                }
                $this->redirect(array('action'=>'changepassword')) ;
            }
        }
        $this->set('navadmins', 'class = "active"') ;
        $this->set('breadcrumb', 'Staffs/Change Password') ;
    }
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_checkemail
     * @description   for checking email in our database
     * @param         email
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
   */
    
    function admin_checkemail($emailid = null){
        $this->autorender = false ;
        $emailid = strtolower($emailid) ;
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$" ;
        if(eregi($pattern, $emailid)){ 
            $enc_email = $emailid ;
            $userArr = $this->User->find('first', array('conditions'=>array('User.email'=>$enc_email))) ;
            if(!empty($userArr)){
                echo '<span style="color:red; font-weight:bold">This Email Id is already in use, Please try other.</span>' ;
            }else{
                echo '' ;
            }
        }
        exit ;
    }
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_delete
     * @description   delete user
     * @param         userId
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
   */
    
   function admin_delete($id){
        $id = base64_decode($id) ;
        $this->autorender = false ;
        if($id > 0){
           $this->Staff->delete($id) ;
           $this->Session->setFlash('Record deleted successfully.', 'default', array('class'=>'flashError', 'admin'=>1)) ;
           $this->redirect(array('controller'=>'staffs', 'action'=>'admin_index', 'admin'=>true)) ;
        }
    }
}