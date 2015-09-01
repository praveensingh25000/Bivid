<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
App::uses('Controller', 'Controller') ;

class AppController extends Controller{

    public $components = array('Session', 'Cookie', 'Email', 'RequestHandler', 'Paginator', 'Auth','Thumbnail') ;
    public $helpers    = array('Html', 'Form', 'Js', 'Session', 'Common') ;

    function _setErrorLayout(){
        if($this->name == 'CakeError'){
            $this->layout = 'layout_404' ;
        }
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        beforeFilter
    * @param         null
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    public function beforeFilter(){
        parent::beforeFilter() ;
        $this->Auth->allow('*') ;
        $this->Auth->authenticate = array('Form') ;
        $this->Auth->authorize = array('Controller') ;
        if(isset($this->params['admin'])){
            $this->Auth->loginAction = array('controller'=>'staffs', 'action'=>'login', 'admin'=>true) ;
            $this->Auth->loginRedirect = array('controller'=>'dashboards', 'action'=>'index', 'admin'=>true) ;
            $this->Auth->logoutRedirect = array('controller'=>'staffs', 'action'=>'login', 'admin'=>true) ;
        }
        $this->__loadLayoutSettings() ;
        $this->__loadFormbuttonSettings() ;
        $this->__loadSiteSettings() ;
        $this->__loadSiteConstant() ;
    }
    
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        isAuthorized
    * @param         null
    * @return        null 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    public function isAuthorized(){
	return true ;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        beforeRender
    * @param         null
    * @return        null 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function beforeRender(){
        if($this->name == 'CakeError'){
            $this->layout = 'error' ;
        }
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        __loadLayoutSettings()
    * @param         null
    * @description   To set layout of admin as well as front
    * @return        null 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __loadLayoutSettings(){

        //Adminend layout setting
        if(isset($this->params['admin'])){
            if($this->Session->read('Auth.User.id')){
                $this->layout = 'admin' ;
            }else{
                $this->layout = 'admin_login' ;
            }
        }
        //Frontend layout setting
        if(!isset($this->params['admin'])){
            if($this->Session->read('Auth.User.id')){
                $this->layout = 'front' ;
            }else{
                $this->layout = 'default' ;
            }
        }

        //echo $this->layout;die;
    }
    
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        __loadSiteConstant()
    * @param         null
    * @description   To set Constant
    * @return        null 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __loadSiteConstant(){
	
	$this->set('controllerName', trim($this->name));
	$this->set('actionName', trim($this->action));
	
        if(!defined('DATEFORMAT')){
            define('DATEFORMAT', 'd M, Y') ;
            define('FULLDATEFORMAT', 'Y-m-d H:i:s') ;
            define('USERDATEFORMAT', 'd M Y H:i A') ;
        }
        $this->set('dateformat', 'd M Y');
	if(!defined('defaultDate')){
            define('defaultDate', Date('Y-m-d H:i:s'));
        }	
        if($this->Session->read('Auth.User.id')){
            if(!defined('SESSION_USER_NAME')){
                define('SESSION_USER_NAME', $this->Session->read('Auth.User.firstname').' '.$this->Session->read('Auth.User.lastname')) ;
            }
            if(!defined('SESSION_GROUP_ID')){
                define('SESSION_GROUP_ID', $this->Session->read('Auth.User.admin_group_id')) ;
            }
            if(!defined('SESSION_USER_ID')){
                define('SESSION_USER_ID', $this->Session->read('Auth.User.id')) ;
            }            
            if(!defined('USER_IMAGE')){
                define('USER_IMAGE', $this->Session->read('Auth.User.profile_pic')) ;
            }
        }
	if(!defined('thumbHeightSize')){
            define('thumbHeightSize', '80');
        }
	if(!defined('thumbWidthSize')){
            define('thumbWidthSize', '142');
        }
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        __loadFormbuttonSettings()
    * @param         null
    * @description   To set form button.
    * @return        null 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __loadFormbuttonSettings(){
	$this->set('postHours', array('5'=>'5 Hrs','10'=>'10 Hrs','20'=>'20 Hrs','30'=>'30 Hrs','40'=>'40 Hrs','50'=>'50 Hrs')) ;
        $this->set('status', array('1'=>'Active', '0'=>'Deactive')) ;
        $this->set('buttonTextSubmit', 'Submit') ;
        $this->set('buttonTextUpdate', 'Update') ;
        $this->set('buttonTextReset', 'Reset') ;
    }    
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        __loadSiteSettings()
    * @param         null
    * @description   To load the site settinhg.
    * @return        null 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __loadSiteSettings(){
        if(Configure::Read('Settings.initialized') == NULL){
            $this->loadModel('Site') ;
            $options['conditions'] = array('Site.status'=>1) ;
            $settings = $this->Site->find('all', $options) ;
            foreach($settings as $setting){
                Configure::Write('Settings.'.$setting['Site']['name'], $setting['Site']['value']) ;
            }
            Configure::Write('Settings.initialized', 1) ;
        }
        //pr(Configure::read('Settings'));
    }

    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        random_password()
    * @param         null
    * @description   To create the password.
    * @return        string 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function random_password($length = 8){
        // the wordlist from which the password gets generated 
        // (change them as you like)
        $words = 'AbbyMallard,AbigailGabble,AbisMal,Abu,Adella,TheAgent,AgentWendyPleakley,Akela,AltheAlligator,Aladar,Aladdin,AlamedaSlim,AlanaDale,Alana,Alcmene,Alice,AmeliaGabble,AmosSlade,Amphitryon,AnastasiaTremaine,Anda,Andrina,Angelique,AngusMacBadger' ;

        // Split by ",":
        $words = explode(',', $words) ;
        if(count($words) == 0){
            die('Wordlist is empty!') ;
        }

        // Add words while password is smaller than the given length
        $pwd = '' ;
        while(strlen($pwd) < $length){
            $r = mt_rand(0, count($words) - 1) ;
            $pwd .= $words[$r] ;
        }

        $num = mt_rand(1, 99) ;
        if($length > 2){
            $pwd = substr($pwd, 0, $length - strlen($num)).$num ;
        }else{
            $pwd = substr($pwd, 0, $length) ;
        }

        $pass_length = strlen($pwd) ;
        $random_position = rand(0, $pass_length) ;

        $syms = "!@#$%^&*()-+?" ;
        $int = rand(0, 51) ;
        $rand_char = @$syms[$int] ;
        $pwd = substr_replace($pwd, $rand_char, $random_position, 0) ;
        return $pwd ;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        get_list()
    * @param         null
    * @description   To get a list.
    * @return        array() 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function get_list($mode_name = null, $fields, $criteria, $order = array('modified ASC'), $limit= 10, $recursive = null){
        if(!empty($mode_name)){
            if(empty($fields)){
                $fields = array() ;
            }
            if(empty($criteria)){
                $criteria = array() ;
            }

            if(empty($order)){
                $order = array() ;
            }

            $this->paginate = array(
                'limit'=>$limit,
                'order'=>$order,
                'conditions'=>$criteria,
                'fields'=>$fields
            ) ;
            $this->$mode_name->recursive = $recursive ;
            return $this->paginate($mode_name) ;
        }else{
            return 0 ;
        }
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        setParamsData()
    * @param         null
    * @description   To get a search data.
    * @return        array() 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function setParamsData(){
        /** for search and sorting* */
        if(isset($this->params['named']['searchin']))
            $this->request->data['Search']['searchin'] = $this->params['named']['searchin'] ;
        else
            $this->request->data['Search']['searchin'] = '' ;

        if(isset($this->params['named']['keyword']))
            $this->request->data['Search']['keyword'] = $this->params['named']['keyword'] ;
        else
            $this->request->data['Search']['keyword'] = '' ;
        if(isset($this->params['named']['showtype']))
            $this->request->data['Search']['show'] = $this->params['named']['showtype'] ;
        else
            $this->request->data['Search']['show'] = '' ;
    }    
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        generateRandomString()
    * @param         null
    * @description   To get a random string.
    * @return        string 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function generateRandomString($length = 10){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' ;
        $randomString = '' ;
        for($i = 0 ; $i < $length ; $i ++){
            $randomString .= $characters[rand(0, strlen($characters) - 1)] ;
        }
        return $randomString ;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        sendEmail()
    * @param         null
    * @description   To send a email.
    * @return        string 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function sendEmail($to = null, $subject = '', $messages = null, $from = null, $reply = null, $path = null, $file_name = null){
        $host         = Configure::read('Settings.host') ;
        $username     = Configure::read('Settings.username');
        $password     = Configure::read('Settings.password');
        $timeout      = Configure::read('Settings.timeout');
        $adminName    = Configure::read('Settings.adminName') ;
        $replytoEmail = Configure::read('Settings.replytoEmail');
        $fromEmail    = Configure::read('Settings.fromEmail');
        $this->Email->smtpOptions = array(
            'host'     => $host,
            'username' => $username,
            'password' => $password,
            'timeout'  => $timeout
        );

        $this->Email->delivery = 'mail' ; //possible values smtp or mail 
        if(empty($reply)){
            $reply = $adminName.'<'.$replytoEmail.'>' ;
        }
        if(empty($from)){
           $from = $adminName.'<'.$fromEmail.'>' ;
        }
        $this->Email->from = $from ;
        $this->Email->replyTo = $reply ;
        if($to == 'admin'){
            $this->Email->to = $from ;
        }else{
            $this->Email->to = $to ;
        }
        if(!empty($path) && !empty($file_name))
           $this->Email->attachments = array($file_name, $path.$file_name) ;

        if(empty($subject)){
            $subject = 'Admin' ;
        }
        $this->Email->subject = $subject ;
        $this->set('data', $messages) ;
        $this->set('smtp_errors', $this->Email->smtpError) ;
        $this->Email->sendAs = 'both' ;
        $this->Email->template = 'comman_template' ;

        if($this->Email->send()){
            return true ;
        }else{
            return false ;
        }
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        setStatus()
    * @param         null
    * @description   to active/Inactive/Delete the records based on controller/model
    * @return        string 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function setStatus($status, $CheckedList, $model, $controller, $action, $prm= NULL){

        if(count($CheckedList) < 1){
            $this->Session->setFlash("Please select the at least one record.", 'default', array('class'=>'alert alert-danger')) ;
        }else{
            for($i = 0 ; $i < count($CheckedList) ; $i ++){
                $this->$model->id = null ;
                $this->$model->id = base64_decode($CheckedList[$i]) ;
                $id = base64_decode($CheckedList[$i]) ;
                if($status == '1' || $status == '2'){
                    $statusValue = ($status == 1) ? '1' : '0' ;
                    $operation = ($status == 1) ? 'active' : 'inactive' ;
                    $operation1 = ($status == 1) ? 'activated' : 'inactivated' ;
                    $this->$model->saveField('status', $statusValue) ;
                }else{
                    $this->$model->delete() ;
                    $operation1 = 'deleted' ;
                }
            }
            $message = (count($CheckedList) == 1) ? "Record has been ".$operation1." successfully" : "Records have been ".$operation1." successfully" ;
            $this->Session->setFlash($message, 'default', array('class'=>'alert alert-success')) ;
        }
        $this->redirect(array("controller"=>$controller, "action"=>$action, $prm)) ;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        __setStatus()
    * @param         null
    * @description   to active/Inactive/Delete the records based on controller/model
    * @return        string 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __setStatus($status, $CheckedList, $model, $controller, $action, $prm= NULL){

        if(count($CheckedList) < 1){
            $this->Session->setFlash("Please select the at least one record.", 'default', array('class'=>'alert alert-danger')) ;
        }else{
           foreach($CheckedList as $idEncoded){
                $this->$model->id = null ;
                $this->$model->id = base64_decode($idEncoded) ;
                $id = base64_decode($idEncoded) ;

                switch($status){
                    CASE '0':
                        $operation = 'inactivated' ;
                        $this->$model->saveField('status', $status) ;
                        break ;
                    CASE '1':
                        $operation = 'activated' ;
                        $this->$model->saveField('status', $status) ;
                        break ;
                    CASE '2':
                        $operation = 'deleted' ;
                        $this->$model->saveField('status', $status) ;
                        break ;
                    CASE '3':
                        $operation = 'permanently deleted' ;
                        $this->$model->delete() ;
                        break ;
                }
            }
        }
        $message = "Records have been ".$operation." successfully" ;
        $this->Session->setFlash($message, 'default', array('class'=>'alert alert-success')) ;
        $this->redirect(array("controller"=>$controller, "action"=>$action, $prm)) ;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        __formatActionNavigation()
    * @param         null
    * @description   Creating the navigation
    * @return        array() 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __formatActionNavigation($data = array(), $type = NULL){
        $navigation = array() ;
        if(!empty($data)){
            $links = $this->buildTree($data, $parentId = 0) ;
            foreach($links as $keyone=> $linkAll){
                foreach($linkAll as $keytwo=> $link){
                    if(!empty($link['actions'])){
                        foreach($link['actions'] as $key=> $linkaction){
                            $linkwithid = $link['alias'] ;
                            if($type == 'list'){
                                $linkwithid = $link['alias'].'-'.$link['id'] ;
                            }
                            $navigation[$linkwithid][$linkaction['Module']['id']]['id']
                                    = $linkaction['Module']['id'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['href']
                                    = trim('/'.$link['name'].'/'.$linkaction['Module']['name']) ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['controller']
                                    = $link['name'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['action']
                                    = $linkaction['Module']['name'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['alias']
                                    = $linkaction['Module']['alias'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['type']
                                    = $linkaction['Module']['type'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['class']
                                    = $linkaction['Module']['class'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['status']
                                    = $link['status'] ;
                        }
                    }
                }
            }
        }
        //pr($navigation);	   	
        return $navigation ;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        __formatActionNavigation()
    * @param         null
    * @description   Creating the navigation
    * @return        array() 
    * @since         version 0.0.1
    * @version       0.0.1 
    */    
    function __formatActionFrontNavigation($data = array(), $type = NULL){
        $navigation = array() ;
        if(!empty($data)){
            $links = $this->buildTree($data, $parentId = 0) ;
            foreach($links as $keyone=> $linkAll){
                foreach($linkAll as $keytwo=> $link){
                    if(!empty($link['actions'])){
                        foreach($link['actions'] as $key=> $linkaction){
                            $linkwithid = $link['alias'] ;
                            if($type == 'list'){
                                $linkwithid = $link['alias'].'-'.$link['id'] ;
                            }
                            $navigation[$linkwithid][$linkaction['Module']['id']]['id']
                                    = $linkaction['ModuleRole']['id'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['href']
                                    = trim('/'.$link['name'].'/'.$linkaction['Module']['name']) ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['controller']
                                    = $link['name'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['action']
                                    = $linkaction['Module']['name'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['alias']
                                    = $linkaction['Module']['alias'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['type']
                                    = $linkaction['Module']['type'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['class']
                                    = $linkaction['Module']['class'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['status']
                                    = $link['status'] ;
                            $navigation[$linkwithid][$linkaction['Module']['id']]['orderby']
                                    = $linkaction['ModuleRole']['orderby'] ;
                        }
                    }
                }
            }
        }
        //pr($navigation);	   	
        return $navigation ;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        buildTree()
    * @param         null
    * @description   Creating the tree stucture
    * @return        array() 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function buildTree(array &$elements, $parentId = 0){
        $tree = array() ;
        foreach($elements as $element){
            if($element['Module']['parent_id'] == $parentId){
                $children = $this->buildTree($elements, $element['Module']['id']) ;
                if($children){
                    $element['Module']['actions'] = $children ;
                }
                $tree[] = $element ;
            }
        }
        return $tree ;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        __formatDate()
    * @param         null
    * @description   To geta formated date
    * @return        formated date
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __formatDate($date, $format = 'Y-m-d'){
        return date($format, strtotime($date)) ;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        countries()
    * @param         null
    * @description   To geta Countries list
    * @return        array
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function countries(){
        $this->loadModel('Country') ;
        $listing = $this->Country->find('list', array('conditions'=>array('Country.status'=>1))) ;
        return $listing ;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        states()
    * @param         null
    * @description   To geta Country wise state listing 
    * @return        array
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function states($id = NULL){
        if($id){
            $this->loadModel('State') ;
            $state_listing = $this->State->find('list', array('conditions'=>array('State.status'=>1, 'State.country_id'=>$id))) ;
            return $state_listing ;
        }else{
            return false;
        }
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        uploadFiles()
    * @param         null
    * @description   To upload any types og files
    * @return        filename
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function uploadFiles($folder, $formdata, $itemId = null,$contentType=NULL){

        // setup dir names absolute and relative
        $folder_url = WWW_ROOT.$folder ;
        $rel_url = $folder ;

        // create the folder if it does not exist
        if(!is_dir($folder_url)){
            mkdir($folder_url) ;
            chmod($folder_url, 0777) ;
        }

        // if itemId is set create an item folder
        if($itemId){
            // set new absolute folder
            $folder_url = WWW_ROOT.$folder.'/'.$itemId ;
            // set new relative folder
            $rel_url = $folder.'/'.$itemId ;
            // create directory
            if(!is_dir($folder_url)){
                mkdir($folder_url) ;
                chmod($folder_url, 0777) ;
            }
        }

        // list of permitted file types, this is only images but documents can be added
        $permitted = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png') ;

        // loop through and deal with the files
        foreach($formdata as $file){
            // replace spaces with underscores
            $filename    = str_replace(' ', '_', $file['name']) ;
	    $orgFilename = str_replace(' ', '_', $file['name']) ;
	    if(!is_null($contentType)){
		$filename =  $contentType.'-'.$filename;
	    }
            // assume filetype is false
            $typeOK = false ;
            // check filetype is ok
            foreach($permitted as $tythumbWidthSizepe){
                if($type == $file['type']){
                    $typeOK = true ;
                    break ;
                }
            }

            // if file type ok upload the file
            if($typeOK){
                // switch based on error code
                switch($file['error']){
                    case 0:
                        // check filename already exists  
			if (!file_exists($folder_url . '/' . $filename)) {
			    // create full filename  
			    $full_url = $folder_url . '/' . $filename;
			    // upload the file  
			    $success = move_uploaded_file($file['tmp_name'], $full_url);
			} else {
			    // create unique filename and upload file                              
			    $now = substr((int) gmdate('U'),-2);
			    $filename = $contentType.'-'.$now.$orgFilename;
			    $full_url = $folder_url . '/' . $filename;
			    // upload the file  
			    $success = move_uploaded_file($file['tmp_name'], $full_url);			   
			}
                        // if upload was successful
                        if($success){
                            // save the url of the file
                            $result['succuss'][] = $filename ;
                        }else{
                            $result['errors'][] = "Error uploaded $filename. Please try again." ;
                        }
                        break ;
                    case 3:
                        // an error occured
                        $result['errors'][] = "Error uploading $filename. Please try again." ;
                        break ;
                    default:
                        // an error occured
                        $result['errors'][] = "System error uploading $filename. Contact webmaster." ;
                        break ;
                }
            }elseif($file['error'] == 4){
                // no file was selected for upload
                $result['errors'][] = "No file Selected" ;
            }else{
                // unacceptable file type
                $result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png." ;
            }
        }
        return $result ;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        getExplodeData()
    * @param         null
    * @description   To upload in a particular table
    * @return        string
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __uploadImageFile($dirName=NULL,$model=NULL,$inputname=NULL,$imageData=array(),$actionType=NULL,$id=NULL){

	if(!empty($imageData['name']) && ($actionType == 'add' || $actionType == 'edit')){
	    $folder      = $dirName.'original/' ;
	    $formdata[]  = $imageData ;
	    $contentType = strtolower($model).'-'.$this->Session->read ('Auth.User.id');
	    $result      = $this->uploadFiles($folder,$formdata,null,$contentType) ;
	    if(!empty($result['succuss'][0])){		    
		    //Coping file in two directory
		    copy($dirName.'original/'.$result['succuss'][0], $dirName.'thumb/' . $result['succuss'][0]);
		    
		    //Thumbnail Image
		    $postImageThumbPath = $dirName.'thumb/'.$result['succuss'][0];
		    $this->Thumbnail->Thumbnail($postImageThumbPath);
		    $this->Thumbnail->allow_enlarge = true;
		    $this->Thumbnail->size(thumbHeightSize, thumbWidthSize);
		    $this->Thumbnail->process();
		    $this->Thumbnail->save($postImageThumbPath);		    
		if($actionType == 'edit')$this->__removeImageFile($dirName,$model,$inputname,$id);
		return array($result['succuss'][0],'success') ;
	    }else if(!empty($result['errors'][0])){
		return array($result['errors'][0],'error') ;
	    }   
	}else if(empty($imageData['name']) && $actionType == 'edit'){	    
	    $fileData = $this->$model->read(null, $id);
	    if(!empty($fileData[$model][$inputname])){
		$imageName = $this->getExplodeData($fileData[$model][$inputname], 'end', '/');
		return array(trim($imageName),'success') ;
	    }else{
		return array('Error! Post doesnot exists','error') ;
	    }	    
	}	
    }
    
    
    
    function __uploadImages($dirName=NULL,$postImage=NULL){
	if($dirName=="img/drag/post/"){
        copy($dirName.$postImage,'img/post/original/'.$postImage);
	copy($dirName.$postImage,'img/post/thumb/'.$postImage);
	}
	$postImageThumbPath ='img/post/thumb/'.$postImage;
	$this->Thumbnail->Thumbnail($postImageThumbPath);
	$this->Thumbnail->allow_enlarge = true;
	$this->Thumbnail->size(thumbHeightSize, thumbWidthSize);
	$this->Thumbnail->process();
	$this->Thumbnail->save($postImageThumbPath);
	if($dirName=="img/drag/post/"){
	unlink("img/drag/post/$postImage");
	}
     }
    
    
    
    
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        getExplodeData()
    * @param         null
    * @description   To upload in a particular table
    * @return        string
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __uploadImage($dirName=NULL,$model=NULL,$inputname=NULL,$imageData=array(),$actionType=NULL,$id=NULL){

	if(!empty($imageData['name']) && ($actionType == 'add' || $actionType == 'edit')){
	    $folder      = $dirName ;
	    $formdata[]  = $imageData ;
	    $contentType = strtolower($model).'-'.$this->Session->read ('Auth.User.id');
	    $result      = $this->uploadFiles($folder,$formdata,null,$contentType) ;
	    if(!empty($result['succuss'][0])){		    
		if($actionType == 'edit')$this->__removeImage($dirName,$model,$inputname,$id);
		return array($result['succuss'][0],'success') ;
	    }else if(!empty($result['errors'][0])){
		return array($result['errors'][0],'error') ;
	    }   
	}else if(empty($imageData['name']) && $actionType == 'edit'){	    
	    $fileData = $this->$model->read(null, $id);
	    if(!empty($fileData[$model][$inputname])){
		$imageName = $this->getExplodeData($fileData[$model][$inputname], 'end', '/');
		return array(trim($imageName),'success') ;
	    }else{
		return array('Error! Post doesnot exists','error') ;
	    }	    
	}	
    }
    
    
     /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        getExplodeData()
    * @param         null
    * @description   To remove a file from a directory
    * @return        string
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __removeImage($dirName,$model,$inputname,$id){
	$rmData = $this->$model->read(null, $id);
	if(!empty($rmData[$model][$inputname])){
	    $imageName = $this->getExplodeData($rmData[$model][$inputname], 'end', '/');
	    $removeDir  = $dirName.'/'.$imageName;
	    if(is_file($removeDir))unlink($removeDir);
	    return true;
	}	
    }
    
     /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        getExplodeData()
    * @param         null
    * @description   To remove a file from a directory
    * @return        string
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __removeImageFile($dirName,$model,$inputname,$id){
	$rmData = $this->$model->read(null, $id);
	if(!empty($rmData[$model][$inputname])){
	    $imageName = $this->getExplodeData($rmData[$model][$inputname], 'end', '/');
	    $removeOrgDir   = $dirName.'original/'.$imageName;
	    $removeThumbDir = $dirName.'thumb/'.$imageName;
	    if(is_file($removeOrgDir))unlink($removeOrgDir);
	    if(is_file($removeThumbDir))unlink($removeThumbDir);
	    return true;
	}	
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        getExplodeData()
    * @param         null
    * @description   To explode a string
    * @return        string
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function getExplodeData($array = array(), $position, $delemeter = '-'){
        $data = explode($delemeter, $array) ;
	if($position=='end'){
	    return !empty($data) ? end($data) : '';
	}else{
	    return !empty($data) && array_key_exists($position, $data) ? trim($data[$position]) : '' ;
	}        
    }

    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        __getCSVData()
    * @param         null
    * @description   To sort a array
    * @return        string
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __getCSVData($model,$filename='', $delimiter=','){
	if(!file_exists($filename) || !is_readable($filename))
	    return FALSE;	    
	$header = NULL;
	$data = array();
	if (($handle = fopen($filename, 'r')) !== FALSE){
	    $counter = -1;
	    while (($row = fgetcsv($handle, 10000, $delimiter)) !== FALSE){
		if(!$header){
		    $header = $row;
		}else{
		    $data[$counter][$model] = array_combine($header, $row);
		    if($model=='Post'){
			$data[$counter][$model]['followes'] = '1';
			$data[$counter][$model]['world']    = '0';
			$data[$counter][$model]['postDate'] = defaultDate;
		    }
		    if($model=='User'){
			$data[$counter][$model]['password'] = md5('bivid');
		    }
		}
		$counter++;
	    }
	    fclose($handle);
	}
	return $data;
    }
    
    /* @author       Sushil Kumar
    * @copyright     smartData Enterprise Inc.
    * @method        getQuickExtension()
    * @param         null
    * @description   To sort a array
    * @return        string
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    
    function __getCSV($model,$filename=''){
	$file = file_get_contents($this->request->data['Post']['post_csv_file']['tmp_name']);
        $postData = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $file));
	$counter=-1;
	$header = NULL;
	$data = array();
	if(!empty($postData)){
	  foreach($postData as $key=>$row){
	    if(!$header){
		$header = $row;
	    }else{
		$data[$counter][$model] = @array_combine($header, $row);
	    }
	    $counter++;
	 }
	return $data;
	}
      
    }
    
    
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        getQuickExtension()
    * @param         null
    * @description   To sort a array
    * @return        string
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __getQuickExtension($filename){
	return pathinfo($filename, PATHINFO_EXTENSION);
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        is_uploaded()
    * @param         null
    * @description   To sort a array
    * @return        string
    * @since         version 0.0.1
    * @version       0.0.1
    */
    function __isUploaded($filename){
	return is_uploaded_file($filename);
    }    
    
    /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        getAddress
     * @description   getAddress by lat,long
     * @param         latitude,longitude
     * @return        address 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    
    function __getAddress($lat, $lon){
        $url      = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDWSrIo1p8iz28yN2_aHao0SSi9JWDEfYE&latlng=".$lat.",".$lon."&sensor=false";
        $json     = file_get_contents($url);
        $data     = json_decode($json);
	//pr($data);
        $status   = $data->status;
        $address  = '';
        if($status == "OK"){
           $address = $data->results[0]->formatted_address;
        }
        return $address;
    }
    
     /*
     * @author        Sushil Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        getAddress
     * @description   getAddress by lat,long
     * @param         latitude,longitude
     * @return        address 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
     
    function __decimalToOrdinalCoords($lat, $lon){
     
	$ordinalNS = ($lat > 0) ? "N" : "S";
	$ordinalEW = ($lon > 0) ? "E" : "W";
	 
	$deg = "&deg;";
	$min = "&rsquo;";
	$sec = "&rdquo;";
	 
	 
	$latDeg = ($lat > 0) ? abs( floor($lat) ) : abs( ceil($lat) );
	$latMin = abs( ($lat - floor($lat)) * 60 );
	$latSec = abs( ($latMin - floor($latMin)) * 60 );
	 
	$degLatValue = $latDeg . $deg . floor($latMin) . $min . floor($latSec) . $sec . $ordinalNS;
	 
	$lonDeg = ($lon > 0) ? abs( floor($lon)) : abs( ceil($lon));
	$lonMin = abs( ($lon - floor($lon)) * 60 );
	$lonSec = abs( ($lonMin - floor($lonMin)) * 60 );
	 
	$degLonValue = $lonDeg . $deg . floor($lonMin) . $min . floor($lonSec) . $sec . $ordinalEW;
	 
	return $degLatValue . "@" . $degLonValue;
	 
    }
    
     /*
     * @author        Praveen Singh
     * @copyright     smartData Enterprise Inc.
     * @method        date_diff_hour_min
     * @description   getAddress by lat,long
     * @param         latitude,longitude
     * @return        address 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    function __date_diff_hour_min($date){
	    
	$string = "";

	//global  MONTHS, MONTH, DAYS, DAY, YEARS, YEAR, MINUTE, MINS, WEEK, WEEKS;
	$todaydate = date('Y-m-d H:i:s');
	$time = $this->__dateDiffNew($date, $todaydate);
	
	if(array_key_exists('year', $time)){
	    $string .= $time['year'];
	    if(array_key_exists('month', $time)) {
		    $string .= $time['month'];
	    }
	}else if(array_key_exists('month', $time)) {
	    if(array_key_exists('week', $time)) {
		    if($time['week']>3) {
			    $time['month'] = $time['month']+1;
		    }
	    }
	    if($time['month']!=1)
		    $string .= $time['month']." ".'Months';
	    else
		    $string .= $time['month']." ".'Month';
	}
	else if(array_key_exists('week', $time)) {
	    if(array_key_exists('day', $time)) {
		    if($time['day']>3) {
			    $time['week'] = $time['week']+1;
		    }
	    }
	    if($time['week']!=1)
		    $string .= $time['week']." ".'Weeks';
	    else
		    $string .= $time['week']." ".'Week';
	}else if(array_key_exists('day', $time)) {
	    if(array_key_exists('hour', $time)) {
		    if($time['hour']>13) {
			    $time['day'] = $time['day']+1;
		    }
	    }
	    if($time['day']!=1)
		    $string .= $time['day']." ".'Days';
	    else
		    $string .= $time['day']." ".'Day';
	}else if(array_key_exists('hour', $time)) {
	    if(array_key_exists('minute', $time)) {
		    if($time['minute']>30) {
			    $time['hour'] = $time['hour']+1;
		    }
	    }
	    if($time['hour']!=1)
		    $string .= $time['hour']." ".'Hours';
	    else
		    $string .= $time['hour']." ".'Hour';
	}else if(array_key_exists('minute', $time)) {
	    if($time['minute']!=1)
		    $string .= $time['minute']." ".'Mins';
	    else
		    $string .= $time['minute']." ".'Minute';
	}else{
		$string .= "0 ".'Minute';
	}
	$string .= " ".'Ago';
	return $string;
    }
    
     /*
     * @author        Praveen Singh
     * @copyright     smartData Enterprise Inc.
     * @method        date_diff_hour_min
     * @description   getAddress by lat,long
     * @param         latitude,longitude
     * @return        address 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    function __dateDiffNew($time1, $time2, $precision = 6) {
	
	// Returns difference as days, months ,weeks, seconds ,minutes etc.
	// If not numeric then convert texts to unix timestamps
	if (!is_int($time1)) {
	  $time1 = strtotime($time1);
	}
	if (!is_int($time2)) {
	  $time2 = strtotime($time2);
	}
     
	// If time1 is bigger than time2
	// Then swap time1 and time2
	if ($time1 > $time2) {
	  $ttime = $time1;
	  $time1 = $time2;
	  $time2 = $ttime;
	}
     
	// Set up intervals and diffs arrays
	$intervals = array('year','month','week','day','hour','minute','second');
	$diffs = array();
     
	// Loop thru all intervals
	foreach ($intervals as $interval) {
	  // Set default diff to 0
	  $diffs[$interval] = 0;
	  // Create temp time from time1 and interval
	  $ttime = strtotime("+1 " . $interval, $time1);
	  // Loop until temp time is smaller than time2
	  while ($time2 >= $ttime) {
	    $time1 = $ttime;
	    $diffs[$interval]++;
	    // Create new temp time from time1 and interval
	    $ttime = strtotime("+1 " . $interval, $time1);
	  }
	}
     
	$count = 0;
	$times = array();
	// Loop thru all diffs
	foreach ($diffs as $interval => $value) {
	  // Break if we have needed precission
	  if ($count >= $precision) {
	    break;
	  }
	  // Add value and interval 
	  // if value is bigger than 0
	  if ($value > 0) { 
	    // Add value and interval to times array
	    $times[$interval] = $value  ;
	    $count++;
	  }
	}
	return $times;
    }
    
    /* @author       Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        __arraysort()
    * @param         null
    * @description   To sort a array
    * @return        string
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function __arraysort(&$arr, $col, $dir = SORT_ASC){
        $sort_col = array() ;
	foreach($arr as $key1=> $rowAll){	    
	    foreach($rowAll as $key2=> $row){
		if(isset($row[$col])){
		    $sort_col[$key1] = $row[$col] ;
		}		
	    }
	}
        array_multisort($sort_col, $dir, $arr);	
	return $arr;
    }
    
     /*
     * @author        Praveen Singh
     * @copyright     smartData Enterprise Inc.
     * @method        date_diff_hour_min
     * @description   getAddress by lat,long
     * @param         latitude,longitude
     * @return        address 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    function __arraysortelement($array, $on, $order=SORT_ASC) {
	
	//pr($array);
	
	$new_array = array();
	$sortable_array = array();

	if (count($array) > 0) {
	    foreach ($array as $k => $v){
		if (is_array($v)) {
		    foreach ($v as $k2 => $v2){			
			foreach ($v2 as $k3 => $v3){			    
			    if ($k3 == $on) {
				$sortable_array[$k][$k3] = $v2;
			    }
			}
		    }
		} else {
		    $sortable_array[$k][$k3] = $v;
		}
	    }
	    switch ($order) {
		case SORT_ASC:
			asort($sortable_array);
			break;
		case SORT_DESC:
			arsort($sortable_array);
			break;
	    }

	    foreach ($sortable_array as $k => $v) {
		    $new_array[$k] = $array[$k];
	    }
	}
	unset($array,$sortable_array);
	return $new_array;
    }
    
    function __arraysortvalue($array, $colname, $colvalue, $order=SORT_ASC){
	$sortable_array = array();
	if (count($array) > 0) {
	    foreach ($array as $k => $v){
		if (is_array($v)) {		    
		    foreach ($v as $k2 => $v2){			
			if (isset($v2[$colname]) && $v2[$colname] > '0' && $v2[$colname] == $colvalue) {
			    $sortable_array[$k][$k2] = $v2;
			}else{
			    $sortable_array[$k][$k2] = $v2;
			}
		    }
		}
	    }	  
	    $sortable_array = $this->__arraysort($sortable_array, $col='hours', $dir = SORT_ASC);
	}
	return $sortable_array;
    }
    
     /*
     * @author        Praveen Singh
     * @copyright     smartData Enterprise Inc.
     * @method        date_diff_hour_min
     * @description   __timeDiff
     * @param         two dates
     * @return        hours 
     * @since         version 0.0.1
     * @version       0.0.1 
    */
    function __timeDiff ($oldTime, $newTime, $timeType) {
        $timeCalc = strtotime($newTime) - strtotime($oldTime);        
        if ($timeType == "x") {
            if ($timeCalc = 60) {
                $timeType = "m";
            }
            if ($timeCalc = (60*60)) {
                $timeType = "h";
            }
            if ($timeCalc = (60*60*24)) {
                $timeType = "d";
            }
        }        
        if ($timeType == "s") {
            $timeCalc .= " seconds ago";
        }
        if ($timeType == "m") {
            $timeCalc = round($timeCalc/60);
        }        
        if ($timeType == "h") {
            $timeCalc = round($timeCalc/60/60).' Hours';
        }
        if ($timeType == "d") {
            $timeCalc = round($timeCalc/60/60/24);
        }
        return ($timeCalc>0)?$timeCalc:'0 Hour';
    }
}
