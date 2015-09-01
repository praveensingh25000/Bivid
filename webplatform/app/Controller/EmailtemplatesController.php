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
class EmailtemplatesController extends AppController {        
    
    var $name = 'Emailtemplates';
    
    public $components = array('Paginator');
    public $paginate = array(
			'limit' => 10,
			'order' => array(
			'Emailtemplate.id' => 'Asc'
			)
    );
    function beforeFilter(){
	parent::beforeFilter();
	$this->Auth->allow('admin_index', 'admin_addedit');
	
    }
    /*
    * @author        Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        admin_index
    * @description   Emailtemplates Listing
    * @param         postId
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */    
    function admin_index(){
	
	$value ="";
	$show ="";
	$criteria=  "1"; 
	
	if(!empty($this->params)){ 
	    if(!empty($this->params->query['keyword'])){
		$value = trim($this->params->query['keyword']);	
	    }
	    if($value !="") {
		$criteria .= " AND Emailtemplate.name LIKE '%".$value."%'";						
	    }
	}
	$this->Paginator->settings = array('conditions' => array($criteria),'limit'=>10,'order'=>'id DESC');
	$data = $this->Paginator->paginate('Emailtemplate');
	
	// Used to show count of data in breadcrum
	$getrecCount = $this->Emailtemplate->find('count');
	$this->set('getrecCount',$getrecCount);
	
	$this->set('getData',$data);
	$this->set('keyword', $value);
	if($value == "" && empty($data)){
	    $this->redirect(array('controller'=>'Emailtemplates','action' => 'addedit'));
	}
	$this->set('navemailtemplate','class = "active"');			
	$this->set('breadcrumb','Emailtemplates/List');	
    }
	    
    
    /*
    * @author        Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        admin_addedit
    * @description   Add & edit the Emailtemplates
    * @param         postId
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */	     
    function admin_addedit($id = null){
	
	if(empty($this->request->data)){
	    $this->request->data = $this->Emailtemplate->read(null, base64_decode($id));			
	}else if(isset($this->request->data) && !empty($this->request->data)){
	
	    $this->request->data['Emailtemplate']['id'] = base64_decode($this->request->data['Emailtemplate']['id']);
	    
	    #sanitize data (remove tags)
	    $temp = $this->request->data['Emailtemplate']['template'];
	    $this->request->data = $this->sanitizeData($this->request->data);
	    $this->request->data['Emailtemplate']['template'] = $temp;				
	    
	    $this->Emailtemplate->set($this->request->data);	
	    if($this->Emailtemplate->validates()){
		$this->request->data['Emailtemplate']['name'] = trim($this->request->data['Emailtemplate']['name']);					
		if($this->Emailtemplate->save($this->request->data,false)){ 	
		    $this->Session->setFlash("Emailtemplate has been saved sucessfully.",'default',array('class'=>'alert alert-success'));	
		    $this->redirect(array('action' => 'index'));
		}
	    }    
	}
	$textAction = ($id == null) ? 'Add' : 'Update';			
	$this->set('navemailtemplate','class = "active"');			
	$this->set('action',$textAction);			
	$this->set('breadcrumb','Emailtemplates/'.$textAction);
	$buttonText = ($id == null) ? 'Submit' : 'Update';	
	$this->set('buttonText',$buttonText);			
    }
    
    /*
    * @author        Praveen Singh
    * @copyright     smartData Enterprise Inc.
    * @method        sanitizeData
    * @description   Filtering of data
    * @param         postId
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */	 
    public function sanitizeData($data) {
	if (empty ( $data )) {
	    return $data;
	}
	if (is_array ( $data )) {
	    foreach ( $data as $key => $val ) {
		$data [$key] = $this->sanitizeData ( $val );
	    }
	    return $data;
	} else {
	    $data = trim ( strip_tags ( $data ) );
	    return $data;
	}
    }

}
?>