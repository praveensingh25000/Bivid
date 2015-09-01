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

App::uses ( 'Sanitize', 'Utility' ) ;
App::uses ( 'File', 'Utility' ) ;
App::import("Vendor", "UploadHandler") ;

class TestsController extends AppController {
    

    function beforeFilter(){
	parent::beforeFilter(); 
    }    
    
    /*
    * @author        Sushil Kumar
    * @copyright     smartData Enterprise Inc.
    * @method        admin_grid
    * @description   Post listing
    * @param         Null
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function admin_index($page=NULL) {
	    
	$userSession           =  $this->Session->read('Auth.User') ;	
	$conditions            =  array();		
	$limit                 =  Configure::read('Settings.paginationLimit')+20;
	$options['conditions'] =  array('Post.postLifeHour !='=>'') ;
	$options['order']      =  array('Post.postID DESC');
        $options['limit']      =  $limit;
	$options['offset']     =  '0';
        $getData               =  $this->Post->find('all', $options);
	$getCountData          =  $this->Post->find('all');
	$this->set('breadcrumb', 'Posts/All list') ;
	$this->set('limit', $limit) ;
	$this->set('getCountData', $getCountData) ;
	$this->set('getData', $getData) ;
	//pr($getData);die;
    }
    
    /*
    * @author        Sushil Kumar
    * @copyright     smartData Enterprise Inc.
    * @method        admin_grid_ajax
    * @description   Post listing
    * @param         Null
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function admin_index_ajax($startLimit=NULL) {
	
	//pr($this->request->data);die;	
	$this->layout = 'ajax' ;	
	$conditions   = $getData = $getDataInfo = array();
	$endLimit     = Configure::read('Settings.paginationLimit')+20;
	
	if(!empty($this->request->data['hours'])){
	    $options['conditions'] =  array('Post.postDateHour <=' => trim($this->request->data['hours']));
	}
	if(!empty($this->request->data['keyword'])){
	    $options['conditions'] =  array(
		'OR'=>array(
		    'User.username'         => trim($this->request->data['keyword']),
		    'Post.description LIKE' =>'%'.trim($this->request->data['keyword']).'%'
		)
	    );	    
	}
	$options['order']      =  array('Post.postID DESC');
        $options['limit']      =  $endLimit;
	$options['offset']     =  $startLimit;
        $getData               =  $this->Post->find('all', $options);	
	$this->set('limit', $endLimit) ;
	$this->set('getData', $getData);
	//pr($options);pr($getData);die;
    }
    
     /*
     * @author        Praveen Singh
     * @copyright     smartData Enterprise Inc.
     * @method        admin_grid_detail
     * @description   listing Post
     * @param         id,key
     * @return        array list 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    function admin_post_detail($id=NULL,$key=NULL){
	$followId   = $followingId = $returnData = array();
        $userId     = $this->Session->read('Auth.User.id') ;
	$returnData = $this->Post->read(null, $id);
	$returnData['Post']['address']  =  $this->__getAddress($returnData['Post']['postLat'],$returnData['Post']['postLong']);
	$returnData['Post']['decimal']	=  $this->__decimalToOrdinalCoords($returnData['Post']['postLat'],$returnData['Post']['postLong']);
	$returnData['Post']['postDate']	=  $this->__timeDiff($returnData['Post']['postDate'],defaultDate,'h');
	$returnData['Post']['postLife']	=  $returnData['Post']['postLifeHour'].' Hours';
	$this->set('getData', $returnData);
    }
    
    /*
     * @author        Praveen Singh
     * @copyright     smartData Enterprise Inc.
     * @method        admin_addHours
     * @description   admin add Hours Post
     * @param         id,key
     * @return        array list 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    function admin_addHours($id=NULL,$postHour=NULL){
	$this->autoRender = false;
	$dataSave         = array();	
	$data             = $this->Post->read(null, $id);	
	$postLifeNum      = strtotime($data['Post']['postLife']);
	$defaultDateNum   = strtotime(defaultDate);
	$extendedPostLife = ($postLifeNum < $defaultDateNum)?defaultDate:$data['Post']['postLife'];
	$addHour          = "+".$postHour.'hour';
	$dataSave['Post']['id']       = $id;
	$dataSave['Post']['postLife'] = date('Y-m-d H:i:s',strtotime($addHour,strtotime($extendedPostLife)));		
	if($this->Post->save($dataSave)){
	    $getData        = $this->Post->read(null, $id);
	    $postLifeHour   = !empty($getData['Post']['postLifeHour']) && $getData['Post']['postLifeHour']>0?$getData['Post']['postLifeHour'].' Hrs':'0 Hr';
	    $postLifeMin    = !empty($getData['Post']['postLifeMin']) && $getData['Post']['postLifeMin']>0?$getData['Post']['postLifeMin'].' Mins':'0 Min';
	    echo $postLifeHour.' '.$postLifeMin;exit;
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
	    $postData = $this->Post->read(null, $id);
	    $address  = $postData['Post']['address'];
	    if(empty($address) && !empty($postData['Post']['postLat']) && !empty($postData['Post']['postLong'])){
		$address        = $this->__getAddress($postData['Post']['postLat'],$postData['Post']['postLong']);
		$this->Post->id = $id;               
		$this->Post->saveField('address',$address, false);
	    }
	    $data  = !empty($address)?'<i class="fa fa-map-marker"></i> '.substr($address,0,45):'--';
	    $error = !empty($data)?'1':'0';
	}
	echo json_encode(array('data'=>$data, 'url'=>$url, 'error'=>$error, 'message'=>$message));exit ;
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
    
    function admin_create(){
        //check for auth session
        $userSession = $this->Session->read('Auth.User') ;
	$userArray=array();
        $this->loadModel('User');
        $userLists =$this->User->find('list',array('fields'=>'User.username'));
	$counter=0;
	foreach($userLists as $key=>$value){
	   $userArray[$counter]['id']=$key;
	  $userArray[$counter]['name']=$value;
	  $counter++;
	}
	$this->set("userArray",json_encode($userArray));
      }
    
    
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        admin_add
     * @description   add UserManhattan, NY 
     * @param         Null
     * @return        void 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    
    function admin_add (){
       $this->autoRender=false;
       $postData=$this->data;
       $userId = $this->Session->read('Auth.User.userID') ;       
       $userArray=$this->getAlluser();
       $this->set("userArray",json_encode($userArray));
       $this->set('postData',$postData);
       $this->viewPath = 'Elements';
       $this->render('post_list', 'ajax');
    }
      
    
    function getAlluser(){
	$this->loadModel('User');
        $userLists =$this->User->find('list',array('fields'=>'User.username'));
	$counter=0;
	foreach($userLists as $key=>$value){
	   $userArray[$counter]['id']=$key;
	  $userArray[$counter]['name']=$value;
	  $counter++;
	}
	return $userArray;
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
	$this->render('postfile_list', 'ajax');
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
	$this->loadModel('User');
        $userId        = $this->Session->read ('Auth.User.id');        
        $postDataArray = array();	
	if(!empty($this->request->data)){    
	    if($this->__isUploaded($this->request->data['Post']['post_csv_file']['tmp_name'])){
		 $postDataArray = $this->__getCSV('Post',$this->request->data['Post']['post_csv_file']['tmp_name']);		
	     }
	     
	     
	    //pr($postDataArray);die;
	     $userLists =$this->User->find('list',array('fields'=>'User.username'));
		
		foreach($userLists as $key=>$value){
		   $users[$key]=$value;
		 }
            
	     //$postDataInfo=array_slice($postDataArray,0,50);
	     $postDataInfo=$postDataArray;
	     $userArray=$this->getAlluser();	 
	     $this->set("users",$users);
	     $this->set("userArray",json_encode($userArray));
	     $this->set('check',1);
	     $this->set('postDataInfo',$postDataInfo);
	     $this->Session->write('postDataArray',$postDataArray);
	     $this->set('limit',2) ;
	     $this->viewPath = 'Elements';
	     $this->render('importpost_list', 'ajax');
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
	
     
     
    function admin_ajaximport_paging($page=NULL) {
	    //$this->autoRender=false;
	    $this->loadModel('User');
	    $show_per_page=50;
	    $input=$this->Session->read('postDataArray');
	    $start = ($page-1) * $show_per_page;
	    $end = $start + $show_per_page;
	    $count = count($input);
	    // Conditionally return results
	    
	    if ($start < 0 || $count <= $start){
	    // Page is out of rangehttp://bivid.com/webplatform/admin/posts/create
	      return array(); 
	    }else if ($count <= $end) {
	    // Partially-filled page
	       $result= array_slice($input, $start);
	       //pr($result);
	    }else{
	    // Full page 
	     $result= array_slice($input, $start, $end - $start);
	     //pr($result);
            }
	     $userLists =$this->User->find('list',array('fields'=>'User.username'));
		
		foreach($userLists as $key=>$value){
		   $users[$key]=$value;
		 }
	    $userArray=$this->getAlluser();		 
	    $this->set("users",$users);	 
	    $this->set('limit', $page) ;
	    $this->set('postDataInfo',$result);
	    $this->set('postDataArray',$input);
	    $this->set("userArray",json_encode($userArray));
	    
	    
    }
    function admin_view_image(){}
     
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
	
    function admin_postdata(){
	$this->autoRender=false;
        $postData = $imageData = $imageDataTemp = $postDataInfo = array();
       
	if(!empty($_POST)){ 
	foreach($_POST as $keyName => $valueAll){            
            if(is_array($valueAll)){            
                foreach($valueAll as $key => $values){
                    if($keyName=='description' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='address' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='lat' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='long' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='user_id' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='user_name' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='post_date' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
                    if($keyName=='post_image' && !empty($values)){
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
	
	foreach($postData as $key1 => $userValues){
            if(!empty($imageData)){ 
            foreach($imageData as $key2 => $imgValues){
                if(strtolower($userValues['description']) == strtolower($imgValues['post_image'])){
		    if(!empty($userValues['description']))
		    $postDataInfo[$key1]['description']  = $userValues['description'];
		    if(!empty($userValues['address']))
		    $postDataInfo[$key1]['address']  = $userValues['address'];
		    if(!empty($userValues['user_name']))
		    $postDataInfo[$key1]['user_name']  = $userValues['user_name'];
		    if(!empty($userValues['lat']))
		    $postDataInfo[$key1]['lat']  = $userValues['lat'];
		    if(!empty($userValues['long']))
		    $postDataInfo[$key1]['long']  = $userValues['long'];
		    if(!empty($userValues['user_id']))
		    $postDataInfo[$key1]['user_id']  = $userValues['user_id'];
		    if(!empty($imgValues['post_image']))
                    $postDataInfo[$key1]['post_image'] = $imgValues['post_image'].'.'.$imgValues['extension'];
		    if(!empty($userValues['post_date']))
		    $postDataInfo[$key1]['post_date']  = $userValues['post_date'];
                    
                 }else{
                    if(!empty($userValues['description']))
		    $postDataInfo[$key1]['description']  = $userValues['description'];
		    if(!empty($userValues['address']))
		    $postDataInfo[$key1]['address']  = $userValues['address'];
		    if(!empty($userValues['user_name']))
		    $postDataInfo[$key1]['user_name']  = $userValues['user_name'];
		    if(!empty($userValues['lat']))
		    $postDataInfo[$key1]['lat']  = $userValues['lat'];
		    if(!empty($userValues['long']))
		    $postDataInfo[$key1]['long']  = $userValues['long'];
		    if(!empty($userValues['user_id']))
		    $postDataInfo[$key1]['user_id']  = $userValues['user_id'];
		    if(!empty($userValues['post_date']))
		    $postDataInfo[$key1]['post_date']  = $userValues['post_date'];
		  }
             }
            }else{
                    if(!empty($userValues['description']))
		    $postDataInfo[$key1]['description']  = $userValues['description'];
		    if(!empty($userValues['address']))
		    $postDataInfo[$key1]['address']  = $userValues['address'];
		    if(!empty($userValues['user_name']))
		    $postDataInfo[$key1]['user_name']  = $userValues['user_name'];
		    if(!empty($userValues['lat']))
		    $postDataInfo[$key1]['lat']  = $userValues['lat'];
		    if(!empty($userValues['long']))
		    $postDataInfo[$key1]['long']  = $userValues['long'];
		    if(!empty($userValues['user_id']))
		    $postDataInfo[$key1]['user_id']  = $userValues['user_id'];
		    if(!empty($userValues['post_date']))
		    $postDataInfo[$key1]['post_date']  = $userValues['post_date'];
		}
            
        }
       	
       $userArray=$this->getAlluser();		
       $this->set('postDataInfo',$postDataInfo);
       $this->set('postDataInfos',$postDataInfo);
       $this->set("userArray",json_encode($userArray));
       $this->set('check',0);
       $this->viewPath = 'Elements';
       if(!empty($_POST['import_list']))
       $this->render('importpost_list', 'ajax');
       }if(empty($_POST['import_list'])){
	$this->render('post_list', 'ajax');
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
     $postData = $imageData = $imageDataTemp = $postDataInfo = array();
     $this->loadModel('Post');    
     $userDataInfo = array();
     $dirName     = 'img/post/' ;
     
     
    // echo thumbHeightSize .thumbWidthSize;die;
    
     if(!empty($_POST['description']) && !empty($_POST['user_id']) && !empty($_POST['address']))
     foreach($_POST as $keyName => $valueAll){            
             if(is_array($valueAll)){            
                foreach($valueAll as $key => $values){
                    if($keyName=='description' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='address' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='lat' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='long' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='user_id' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='postImage' && !empty($values)){
                        $imageData[$key][$keyName] = $values;
                    }
		    if($keyName=='user_id' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
		    if($keyName=='post_date' && !empty($values)){
                        $postData[$key][$keyName] = $values;
                    }
                    if($keyName=='post_image' && !empty($values)){
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
       
       
        foreach($postData as $key1 => $userValues){
            if(!empty($imageData)){
             foreach($imageData as $key2 => $imgValues){
             if(!empty($imgValues['postImage'])){
              if(strtolower($userValues['description']) == strtolower($imgValues['post_image'])){
		  $postDataInfo[$key1]['userID']  = $userValues['user_id'];
                  $postDataInfo[$key1]['description']  = $userValues['description'];
		  $postDataInfo[$key1]['address']  = $userValues['address'];
		  $postDataInfo[$key1]['postLat']  = $userValues['lat'];
		  $postDataInfo[$key1]['postLong']  = $userValues['long'];
		    if(!empty($userValues['post_date'])){
			$postDataInfo[$key1]['postDate']  = $userValues['post_date'];
			$postDataInfo[$key1]['postLife']  = date('Y-m-d H:i:s',strtotime('+24 hour',strtotime($userValues['post_date'])));
		    }else{
			$postDataInfo[$key1]['postDate']  = date('Y-m-d H:i:s');
			$postDataInfo[$key1]['postLife']  = date('Y-m-d H:i:s',strtotime('+24 hour',strtotime(date('Y-m-d H:i:s'))));
		    }
		 // $postDataInfo[$key1]['user']  = $userValues['user'];
		    $postDataInfo[$key1]['content_type']  = 2;
		    $postImage     =strtolower($imgValues['postImage']);
		    if($imgValues['extension']=="gif" || $imgValues['extension']=="jpeg" || $imgValues['extension']=="png" || $imgValues['extension']=="jpg" ){
		    $this->__uploadImages('img/drag/post/',$postImage);
		    $postDataInfo[$key1]['postImage']   = URL_SITE.'/'.$dirName.'original/'.$postImage;
		    $postDataInfo[$key1]['postThumbImage']   = URL_SITE.'/'.$dirName.'thumb/'.$postImage;
                    }else{
		    $this->__uploadImages('img/post/','video.png');
		    $postDataInfo[$key1]['postVideo']   = URL_SITE.'/'.'img/drag/post/'.$postImage;  
		    $postDataInfo[$key1]['postVideoThumbImage']   = URL_SITE.'/'.$dirName.'thumb/video.png';
		    }
		   }
            }
            }
            
        }
        }
	
         try {
               if(!empty($postDataInfo) && $this->Post->saveAll($postDataInfo)){
		echo "Posts Add Successfully";exit;
	       }else{
		echo "Error while add";exit;
	       }
            } catch (Exception $e) {
                echo 'Record Allready Exist';
            }
    
}
    
	

    
    
    /*
	* @author        Praveen Singh
	* @copyright     smartData Enterprise Inc.
	* @method        admin_edit
	* @description   edit post
	* @param         postId
	* @return        void 
	* @since         version 0.0.1
	* @version       0.0.1 
    */
    function admin_edit ($id = NULL) {
	
	$user_id      = $this->Session->read ('Auth.User.id');
	$dirName      = 'img/post/' ;
        $this->set('id',$id);
	
	$postData = $this->Post->read(null, base64_decode($id));
	$this->set('postImage',!empty($postData['Post']['postImage'])?$postData['Post']['postImage']:'');
	$this->set('postThumbImage',!empty($postData['Post']['postThumbImage'])?$postData['Post']['postThumbImage']:'');
	
	if(empty($this->request->data)){
	    $this->request->data =$postData;
	}else if(!empty($this->request->data)){
	    
	    $this->request->data = Sanitize::clean($this->request->data,array('encode'=>false));
	   
	    $this->Post->set($this->request->data);
	    $this->Post->validator()->remove('postImage');
	 
	    if($this->Post->validates()){		
		list($postImage,$postImageStatus)= $this->__uploadImageFile($dirName,$model='Post',$inputname='postImage',$imageData=$this->request->data['Post']['postImage'],$actionType='edit',base64_decode($id));		
		if($postImageStatus=='success'){
		    $this->request->data['Post']['postImage']      = URL_SITE.'/'.$dirName.'original/'.$postImage ;
		    $this->request->data['Post']['postThumbImage'] = URL_SITE.'/'.$dirName.'thumb/'.$postImage ;
		}else{
		    $this->Session->setFlash(trim($postImage),'default',array('class'=>'alert alert-danger')) ;
		    return $this->redirect(array('action' => 'admin_edit',$id)) ;
		}
		$this->request->data['Post']['postID']   = base64_decode($id);
		$this->request->data['Post']['postDate'] = defaultDate;		
		if($this->Post->save($this->request->data)){
                    $this->Session->setFlash ( "Post has been saved successfully.", 'default', array ( 'class' => 'alert alert-success' ) ) ;
                    $this->redirect(array('action' =>'admin_index'));
                }
	    }
	}
	$this->set('breadcrumb', 'Posts/Edit') ;
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
    function admin_import(){
	
	$userId  = $this->Session->read ('Auth.User.id');
	$postDataArray = array();
	
	if(!empty($this->request->data)){
	    
	    $this->request->data = Sanitize::clean($this->request->data,array('encode'=>false));
	    $this->Post->set($this->request->data);
	    
	    if($this->Post->validates()){		
		if($this->__isUploaded($this->request->data['Post']['post_csv_file']['tmp_name'])){
		    $postDataArray = $this->__getCSVData('Post',$this->request->data['Post']['post_csv_file']['tmp_name']);		
		}		
		//pr($postDataArray);die;
		if(!empty($postDataArray) && $this->Post->saveAll($postDataArray)){
                    $this->Session->setFlash ("Post has been imported successfully.", 'default', array ( 'class' => 'alert alert-success' ) ) ;
                    $this->redirect(array('action' =>'admin_index'));
		}else{
		    $this->Session->setFlash ("Error occurs in importing.", 'default', array ( 'class' => 'alert alert-danger' ) ) ;
                    $this->redirect(array('action' =>'admin_import'));
		}
	    }
	}
	$this->set('breadcrumb', 'Posts/Import CSV Data');      
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
    function admin_delete($id){
        $id = base64_decode($id) ;
        $this->autorender = false ;
	$dirName='img/post/';
        $model='Post';
        $postThumbImage='postThumbImage';
	$postImage='postImage';
        if($id){
	    $this->__removeImageFile($dirName,$model,$postThumbImage,$id);
	    $this->__removeImageFile($dirName,$model,$postImage,$id);
            $this->Post->delete($id) ;
            $this->Session->setFlash('Record deleted successfully.', 'default', array('class'=>'flashError', 'admin'=>1)) ;
            $this->redirect(array('controller'=>'posts', 'action'=>'admin_index', 'admin'=>true)) ;
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
    function admin_userName($id){
	if(!empty($id)){
	$this->loadModel('User');
        $postData = $this->User->read(array('User.username'),$id);
	return $postData['User']['username'];
	}else{
	    
	    return "Not Found";
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
    function admin_delteImage($postImage){
	$this->autorender = false ;
	$postImage=strtolower($postImage);
	unlink("img/drag/post/$postImage");
	  echo "Sucess";exit;
    }
    /*
    * @author        Sushil Kumar
    * @copyright     smartData Enterprise Inc.
    * @method        admin_grid
    * @description   Post listing
    * @param         Null
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function admin_test($page=NULL) {
	    
	$userSession           =  $this->Session->read('Auth.User') ;	
	$conditions            =  array();		
	$limit                 =  Configure::read('Settings.paginationLimit')+20;
	$options['conditions'] =  array('Post.postLifeHour !='=>'') ;
	$options['order']      =  array('Post.postID DESC');
        $options['limit']      =  $limit;
	$options['offset']     =  '0';
        $getData               =  $this->Post->find('all', $options);
	$getCountData          =  $this->Post->find('all');
	$this->set('breadcrumb', 'Posts/All list') ;
	$this->set('limit', $limit) ;
	$this->set('getCountData', $getCountData) ;
	$this->set('getData', $getData) ;
	//pr($getData);die;
    }
}
?>
