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
App::uses('Sanitize', 'Utility');

class SiteTypesController extends AppController{
    
    var $name = 'SiteTypes';
    
    function beforeFilter(){
        parent::beforeFilter();    
    }
    
    /*
	* @author        Praveen Kumar
	* @copyright     smartData Enterprise Inc.
	* @method        admin_index
	* @description   siteType  listing
	* @param         Null
	* @return        void 
	* @since         version 0.0.1
	* @version       0.0.1 
    */
    
    function admin_index(){
        
        /* Active/Inactive/Delete functionality */
        if (isset($this->request->data["SiteType"]["setStatus"])) {
	    
	    //pr($this->request->data);die;
	    
            if (!empty($this->request->data['SiteType']['status'])) {
                $status = $this->request->data['SiteType']['status'];
            } else {
                $this->Session->setFlash("Please select the action.", 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array('action' => 'admin_index'));
            }
            $CheckedList = $this->request->data['checkboxes']; 
            $model      = 'SiteType';
            $controller = $this->params['controller']; 
            $action     = $this->params['action'];
            parent::setStatus($status, $CheckedList, $model, $controller, $action); 
        }
        /* Active/Inactive/Delete functionality */
        $value        = "";
        $value1       = "";
        $show         = "";
        $criteria     = "";

        if (!empty($this->params)) {
            if (!empty($this->params->query['keyword'])) {
                $criteria .= " SiteType.name LIKE '%" . trim($this->params->query['keyword']) ."%' ";
            }
        }
        
        $this->Paginator->settings = array('conditions' => array($criteria),
            'limit' => Configure::read('Settings.paginationLimit'),
            'order' => array('SiteType.id' => 'DESC')
        );

        $this->set('getData', $this->Paginator->paginate('SiteType'));
        $this->set('keyword', $value);
        $this->set('show', $show);
        $this->set('navadmins', 'class = "active"');
        $this->set('breadcrumb', 'SiteTypes/Listing');
	$this->set('models', Inflector::singularize($this->name));
    }
    
    /*
	* @author        Praveen Kumar
	* @copyright     smartData Enterprise Inc.
	* @method        admin_addedit
	* @description   Adding and Editing Site Type
	* @param         siteId
	* @return        void 
	* @since         version 0.0.1
	* @version       0.0.1 
    */
    
    function admin_addedit($id = null) { 
        
        $new_user = false;
        $this->set('id', $id);
       
        if(empty($this->request->data)){
            $this->request->data = $this->SiteType->read(null, base64_decode($id));
            $this->set('preSelectedPatients', $this->request->data);
        }elseif(!empty($this->request->data)){
	    //pr($this->request->data);// exit;
            $this->request->data = Sanitize::clean($this->request->data, array('encode' => false));
            $id = base64_decode($id);
            $this->request->data['SiteType']['id'] = $id;          
            $this->SiteType->set($this->request->data);

            if ($this->SiteType->validates()) {
                
                if ($this->SiteType->saveAll($this->request->data['SiteType'],array('false'))) {
                    $this->Session->setFlash("The Site Type Name has been saved successfully.", 'default', array('class' => 'alert alert-success'));
                    $this->redirect(array('action' => 'admin_index'));
                }
            }
        }
        $textAction = ($id == null) ? 'Add' : 'Edit';
        $buttonText = ($id == null) ? 'Submit' : 'Update';
        $this->set('navadmins', 'class = "active"');
        $this->set('action', $textAction);
        $this->set('breadcrumb', 'SiteTypes/' . $textAction);
        $this->set('buttonText', $buttonText);
    }
    
    /*
	* @author        Praveen Kumar
	* @copyright     smartData Enterprise Inc.
	* @method        admin_delete
	* @description   Deleting the Site Type
	* @param         siteId
	* @return        void 
	* @since         version 0.0.1
	* @version       0.0.1 
    */
    
    function admin_delete($id) {
        
        $this->autorender = false;        
        $id = base64_decode($id);        
        if ($id > 0) {
            $this->SiteType->delete($id);
            $this->Session->setFlash("Record deleted successfully.", 'default', array('class' => 'alert alert-success'));
            $this->redirect(array('controller' => 'SiteTypes', 'action' => 'index', 'admin' => true));
        }
    }
}
