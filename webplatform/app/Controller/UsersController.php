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
App::uses ( 'File', 'Utility' ) ;
App::import("Vendor", "UploadHandler") ;

class UsersController extends AppController{

    public $name = 'Users';    
    
    public function beforeFilter(){
        parent::beforeFilter() ;
        $this->Auth->allow('index','admin_forgot_password','login', 'admin_login', 'admin_logout', 'registration', 'successPage', 'checkemail', 'register', 'getState', 'forgotPassword', 'setPassword', 'socialLogin', 'twitterLogin', 'setOAuth', 'twitter_callback', 'quickbookTest','emailavail','usernameavail') ;
    }
    
    /*
    * @author        Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        admin_user
    * @description   User listing
    * @param         Null
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function admin_index($page=NULL) {
	
	$this->loadModel('User');	    
	$userSession = $this->Session->read('Auth.User') ;	
	$conditions  = array();		
	$limit       = Configure::read('Settings.paginationLimit');
	
	$options['conditions'] =  array() ;
	$options['order']      =  array('User.userID DESC');
        $options['limit']      =  $limit;
	$options['offset']     =  '0';
        $getData               =  $this->User->find('all', $options);
	$getCountData          =  $this->User->find('all');
	$this->set('breadcrumb', 'Users/All list') ;
	$this->set('limit', $limit) ;
	$this->set('getCountData', $getCountData) ;
	$this->set('getData', $getData) ;
	//pr($getData);die;
    }
    
    /*
    * @author        Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        admin_user_ajax
    * @description   User listing ajax call
    * @param         Null
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function admin_index_ajax($startLimit=NULL) {
	
	//pr($this->request->data);die;	
	$this->layout = 'ajax' ;	
	$conditions   = $getData = $getDataInfo = array();
	$this->loadModel('User');
	$endLimit              = Configure::read('Settings.paginationLimit');
	$options['order']      =  array('User.userID DESC');
        $options['limit']      =  $endLimit;
	$options['offset']     =  $startLimit;
        $getData               =  $this->User->find('all', $options);
	$this->set('limit', $endLimit) ;
	$this->set('getData', $getData);	
    }
    
    /*
     * @author        Praveen Singh
     * @copyright     smartData Enterprise Inc.
     * @method        admin_user_detail
     * @description   listing User detail
     * @param         id,key
     * @return        array list
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    function admin_index_detail($id=NULL,$key=NULL){
	$this->loadModel('User');
	$followId   = $followingId = $returnData = array();
        $userId     = $this->Session->read('Auth.User.id') ;
	$returnData = $this->User->read(null, $id);
	$returnData['User']['decimal'] = $this->__decimalToOrdinalCoords($returnData['User']['userLat'],$returnData['User']['userLong']);
	$returnData['ActivePost']      = $this->__getActivePostDetail($returnData['Post']);
	$returnData['InactivePost']    = $this->__getInactivePostDetail($returnData['Post']);	
	$this->set('getData', $returnData);
	//pr($returnData);die;
    }
    
    /*
     * @author        Praveen Singh
     * @copyright     smartData Enterprise Inc.
     * @method        __getActivePostDetail()
     * @description   listing User detail
     * @param         id,key
     * @return        array list
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    function __getActivePostDetail($data=array()){
	$returnActivePost = array();
	if(!empty($data)){
	    foreach($data as $key => $values){
		$postLife    = strtotime($values['postLife']);
		$defaultDate = strtotime(defaultDate);
		if($postLife >= $defaultDate){
		    $returnActivePost[$key] = $values;
		}
	    }
	}
	return $returnActivePost;
    }
    
     /*
     * @author        Praveen Singh
     * @copyright     smartData Enterprise Inc.
     * @method        __getInactivePostDetail
     * @description   listing User detail
     * @param         id,key
     * @return        array list
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    function __getInactivePostDetail($data=array()){
	$returnInactivePost = array();
	if(!empty($data)){
	    foreach($data as $key => $values){
		$postLife    = strtotime($values['postLife']);
		$defaultDate = strtotime(defaultDate);
		if($postLife < $defaultDate){
		    $returnInactivePost[$key] = $values;
		}
	    }
	}
	return $returnInactivePost;
    } 
    
        
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_add
     * @description   add User
     * @param         Null
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    
    function admin_add (){
       $this->autoRender=false;
       $userData=$this->data;
       $userId = $this->Session->read('Auth.User.userID') ;
       $this->set('userData',$userData);
       $this->viewPath = 'Elements';
       $this->render('user_list', 'ajax');
    }
    
    
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_add
     * @description   add User
     * @param         Null
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    
    function admin_create (){
        //check for auth session
        $userSession = $this->Session->read('Auth.User') ;

        /* search functionality */
        $value      = '';
        $value1     = '';
        $show       = '';
        $conditions = '';

        if(!empty($this->params)){
            if(!empty($this->params->query['keyword'])){
                $keyword    = $this->params->query['keyword'];
                $value      = $keyword ;
                $conditions = array('OR'=>array('User.username LIKE'=>"%$keyword%", 'User.email LIKE'=>"%$keyword%")) ;
             }
        }

        //read pagination limit
        $limit = Configure::read('Settings.paginationLimit');

        //search and paginate
        $this->paginate = array(
            'limit'     => $limit,
            'fields'    => array(),
            'conditions'=> $conditions,
            'order'     => array('User.id'=>'desc')
        );

        $getData = $this->paginate('User') ;

        /* Active/Inactive/Delete functionality */
        
         
    }
    
     /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_add
     * @description   add User
     * @param         Null
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    
    function admin_sendfile (){
      $this->autoRender=false;
      $filesArray=$this->request->form;
      $this->set('filesArray',$filesArray);
      $this->viewPath = 'Elements';
      $this->render('file_list', 'ajax');
      
    }
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_add
     * @description   edit User
     * @param         userId
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
   */
    
    function admin_edit($id = NULL){
        
        //check for auth session
        $userSession = $this->Session->read('Auth.User') ;
        $id          = base64_decode($id);
        $this->set('id',$id);
         $dirName     = 'img/user/' ;
        
        if(empty($this->request->data)){
            $this->request->data = $this->User->read(null, $id);
        }elseif(!empty($this->request->data)){
            $this->User->set($this->request->data);
            $this->User->validator()->remove('userAvatar');
            if($this->User->validates()){
                list($userAvatar,$userAvatarStatus) = $this->__uploadImage($dirName,$model='User',$inputname='userAvatar',$imageData=$this->request->data['User']['userAvatar'],$actionType='edit',$id);
                if($userAvatarStatus=='success'){
                    $this->request->data['User']['userAvatar'] = URL_SITE.'/'.$dirName.'/'.$userAvatar ;
                }else{
                    $this->Session->setFlash(trim($userAvatar),'default',array('class'=>'alert alert-danger')) ;
                    return $this->redirect(array('action' => 'admin_edit',base64_encode($id))) ;
                }
                $this->request->data['User']['userID'] = $id;	
                if($this->User->save($this->request->data)){ 	
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
     * @method        admin_view
     * @description   view user detail
     * @param         userId
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    
    function admin_view($id = NULL){
        
        //check for auth session
        $followId = $followingId = $returnData = array();
        $userSession = $this->Session->read('Auth.User') ;
        
        $id         = base64_decode($id);
        $returnData = $this->User->read(null, $id);
        
        if(!empty($returnData)){
            
            //getting adress of the user
            $returnData['address']= $this->__getAddress($returnData['User']['userLat'], $returnData['User']['userLong']);
            
            if(!empty($returnData['Follow'])){
                foreach($returnData['Follow'] as $follow){            
                    $followId[]= $follow['followingID'];            
                }
            }
            if(!empty($returnData['Following'])){
                foreach($returnData['Following'] as $following){            
                    $followingId[]= $following['userID'];            
                }
            } 
            
            $followUser    = $this->User->find('all',array("conditions"=>array("User.userID"=>$followId),'fields'=>'User.username'));
            $followingUser = $this->User->find('all',array("conditions"=>array("User.userID"=>$followingId),'fields'=>'User.username'));
            
            if(!empty($followUser)){
                foreach($followUser as $key=>$value){        
                    $returnData['Follow'][$key]['username']=$value['User']['username'];        
                }
            }
            if(!empty($followingUser)){
                foreach($followingUser as $key=>$value){            
                    $returnData['Following'][$key]['username']=$value['User']['username'];            
                }
            }  
        }
        $this->set('getData', $returnData) ;
        $this->set('breadcrumb', 'Users / View Detail') ;
    }    
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_delete
     * @description   delete User
     * @param         userId
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    
    function admin_delete($id){
        $id = base64_decode($id) ;
        $dirName='img/user/';
        $model='User';
        $inputname='userAvatar';
        $this->autorender = false ;
        if($id){
            $this->__removeImage($dirName,$model,$inputname,$id);
            $this->User->delete($id) ;
            $this->Session->setFlash('Record deleted successfully.', 'default', array('class'=>'flashError', 'admin'=>1)) ;
            $this->redirect(array('controller'=>'users', 'action'=>'admin_index', 'admin'=>true)) ;
        }
    }
    
    
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_import
     * @description   Import User
     * @param         Null
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
    */    
    function admin_import(){
	
	$userId        = $this->Session->read ('Auth.User.id');        
        $userDataArray = array();	
	if(!empty($this->request->data)){    
	    
	    $this->request->data = Sanitize::clean($this->request->data,array('encode'=>false));
	    $this->User->set($this->request->data);
	    
	    if($this->User->validates()){
		if($this->__isUploaded($this->request->data['User']['user_csv_file']['tmp_name'])){
		    $userDataArray = $this->__getCSVData('User',$this->request->data['User']['user_csv_file']['tmp_name']);		
		}                
                //pr($userDataArray);die;            
                if(!empty($userDataArray) && $this->User->saveAll($userDataArray)){
                    $this->Session->setFlash ("User has been imported successfully.", 'default', array ( 'class' => 'alert alert-success' ) ) ;
                    $this->redirect(array('action' =>'admin_index'));
		}else{
		    $this->Session->setFlash ("Error occurs in importing.", 'default', array ( 'class' => 'alert alert-danger' ) ) ;
                    $this->redirect(array('action' =>'admin_import'));
		}
	    }
	}
	$this->set('breadcrumb', 'Users/Import CSV Data') ;
    }
    
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_import
     * @description   Import User
     * @param         Null
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
    */    
    function admin_ajaximport(){
        $this->autoRender=false;
        $userId        = $this->Session->read ('Auth.User.id');        
        $userDataArray = array();	
	if(!empty($this->request->data)){    
	       if($this->__isUploaded($this->request->data['User']['user_csv_file']['tmp_name'])){
		    $userDataArray = $this->__getCSVData('User',$this->request->data['User']['user_csv_file']['tmp_name']);		
		}                
                //pr($userDataArray);die;
                $this->set('check',1);
                $this->set('userDataInfo',$userDataArray);
                $this->viewPath = 'Elements';
                $this->render('import_list', 'ajax');
	    }
	}
    /*
     * @author        Praveen Singh
     * @copyright     smartData Enterprise Inc.
     * @method        admin_postDetail
     * @description   listing Post
     * @param         id,key
     * @return        array list 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    function admin_drop($id=NULL,$key=NULL){
	
	$upload_handler = new UploadHandler();
        
    }
    
function admin_userdata(){
     $this->autoRender=false;
        $userData = $imageData = $imageDataTemp = $userDataInfo = array();
       
       if(!empty($_POST)){ 
        foreach($_POST as $keyName => $valueAll){            
            if(is_array($valueAll)){            
                foreach($valueAll as $key => $values){
                    
                    if($keyName=='username' && !empty($values)){
                        $userData[$key][$keyName] = $values;
                    }
                     if($keyName=='firstname' && !empty($values)){
                        $userData[$key][$keyName] = $values;
                    }
                    if($keyName=='lastname' && !empty($values)){
                        $userData[$key][$keyName] = $values;
                    }
                    if($keyName=='email' && !empty($values)){
                        $userData[$key][$keyName] = $values;
                    }
                    if($keyName=='status' && !empty($values)){
                        $userData[$key][$keyName] = $values;
                    }
                    if($keyName=='user_image' && !empty($values)){
                        $pathInfo                     = pathinfo($values);
                        $imageData[$key][$keyName]    = preg_replace('/\\.[^.\\s]{3,4}$/', '',strtolower($values));
                        $imageData[$key]['extension'] = $pathInfo['extension'];
                    }
                    if($keyName=='tmp_name' &&!empty($values)){
                        $imageData[$key][$keyName] = $values;
                    }
                }
            }
        }
        
        foreach($userData as $key1 => $userValues){
            if(!empty($imageData)){ 
            foreach($imageData as $key2 => $imgValues){
                if(strtolower($userValues['username']) == strtolower($imgValues['user_image'])){
                    $userDataInfo[$key1]['username']  = $userValues['username'];
                    $userDataInfo[$key1]['user_image'] = $imgValues['user_image'].'.'.$imgValues['extension'];
                    $userDataInfo[$key1]['firstname']   = $userValues['firstname'];
                    $userDataInfo[$key1]['lastname']   = $userValues['lastname'];
                    $userDataInfo[$key1]['userDescription']   = $userValues['status'];
                    $userDataInfo[$key1]['email']   = $userValues['email'];
                    $userDataInfo[$key1]['flag_type']   = 0;
                 }else{
                    $userDataInfo[$key1]['username']  = $userValues['username'];
                    $userDataInfo[$key1]['firstname']   = $userValues['firstname'];
                    $userDataInfo[$key1]['lastname']   = $userValues['lastname'];
                    $userDataInfo[$key1]['email']   = $userValues['email'];
                    $userDataInfo[$key1]['flag_type']   = 0;
                 }
             }
            }else{
                $userDataInfo[$key1]['username']  = $userValues['username'];
                $userDataInfo[$key1]['flag_type']   = 0;
            }
            
        }
       
       $this->set('userDataInfo',$userDataInfo);
       $this->set('userDataInfos',$userDataInfo);
       $this->set('check',0);
       $this->viewPath = 'Elements';
       $this->render('user_list', 'ajax');
       $this->render('import_list', 'ajax');
       }
}
    
    /*
     * @author        Sushil Sharma
     * @copyright     smartData Enterprise Inc.
     * @method        admin_postDetail
     * @description   listing Post
     * @param         id,key
     * @return        array list 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    
 function admin_savedata(){
     $this->autoRender=false;
     $userData = $imageData = $imageDataTemp = $userDataInfo = array();
         
     $userDataInfo = array();
     $dirName     = 'img/user/' ;
     
     foreach($_POST as $keyName => $valueAll){            
             if(is_array($valueAll)){            
                foreach($valueAll as $key => $values){
                    
                    if($keyName=='username' && !empty($values)){
                        $userData[$key][$keyName] = $values;
                    }
                     if($keyName=='firstname' && !empty($values)){
                        $userData[$key][$keyName] = $values;
                    }
                    if($keyName=='lastname' && !empty($values)){
                        $userData[$key][$keyName] = $values;
                    }
                    if($keyName=='email' && !empty($values)){
                        $userData[$key][$keyName] = $values;
                    }
                    if($keyName=='status' && !empty($values)){
                        $userData[$key][$keyName] = $values;
                    }
                    if($keyName=='userImage' && !empty($values)){
                        $imageData[$key][$keyName] = $values;
                    }
                    if($keyName=='user_image' && !empty($values)){
                        $pathInfo                     = pathinfo($values);
                        $imageData[$key][$keyName]    = preg_replace('/\\.[^.\\s]{3,4}$/', '',strtolower($values));
                        $imageData[$key]['extension'] = $pathInfo['extension'];
                    }
                    if($keyName=='tmp_name' &&!empty($values)){
                        $imageData[$key][$keyName] = $values;
                    }
                }
            }
        }
     
        foreach($userData as $key1 => $userValues){
            if(!empty($imageData)){
             foreach($imageData as $key2 => $imgValues){
             if(!empty($imgValues['userImage'])){
              if(strtolower($userValues['username']) == strtolower($imgValues['user_image'])){
                   $userDataInfo[$key1]['username']    = $userValues['username'];
                    $userDataInfo[$key1]['user_image'] = $imgValues['user_image'].'.'.$imgValues['extension'];
                    $userDataInfo[$key1]['firstname']  = $userValues['firstname'];
                    $userDataInfo[$key1]['lastname']   = $userValues['lastname'];
                    $userDataInfo[$key1]['userDescription']   = $userValues['status'];
                    $userDataInfo[$key1]['password']   = md5($userValues['username']);
                    $userDataInfo[$key1]['email']      = $userValues['email'];
                    $userDataInfo[$key1]['flag_type']     = 0;
                    $userImage     =strtolower($imgValues['userImage']);
                    $userDataInfo[$key1]['userAvatar']   = $userImage;
                    copy('img/drag/'.$userImage,$dirName.'/'.$userImage);
		    unlink("img/drag/$userImage");
                 }
            }
            }
            
        }
        }
        
         try {
                $this->User->saveAll($userDataInfo);
                echo "Users Add Successfully";exit;
                
            } catch (Exception $e) {
                echo 'Record Allready Exist';
            }
    
}
    
    
    /*
	* @author        Sushil Kumar
	* @copyright     smartData Enterprise Inc.
	* @method        admin_delete
	* @description   delete post
	* @param         postId
	* @return        void 
	* @since         version 0.0.1
	* @version       0.0.1 
    */
    
    function admin_getaddress($id = NULL){
	
	$this->autoRender = false ;
	$userId  = $this->Session->read('Auth.User') ;
	$error   = '0' ;
	$message = 'Internal Error' ;
	$url     = '';
	$data    = '';
	$class   = '';
	
	if($id){
	    $userData = $this->User->read(null, $id);
	    $address  = $userData['User']['userAddress'];
	     if(empty($address) && !empty($userData['User']['userLat']) && !empty($userData['User']['userLong'])){
		$address  = $this->__getAddress($userData['User']['userLat'],$userData['User']['userLong']);
		$this->User->id = $id;               
		$this->User->saveField('userAddress',$address, false);
	    }
	    $data  = !empty($address)?'<i class="fa fa-map-marker"></i> '.substr($address,0,45):'--';
	    $error = !empty($data)?'1':'0';
	}
	echo json_encode(array('data'=>$data, 'url'=>$url, 'error'=>$error, 'message'=>$message));exit ;
    }  

    
    
    
    
}//class end