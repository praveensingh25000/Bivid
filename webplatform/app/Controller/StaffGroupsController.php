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

class StaffGroupsController extends AppController {

    public $name = 'StaffGroups';
    public $uses = array('StaffGroup','EmailTemplate');

    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('');		
    }
    
    /*
	* @author        Praveen Kumar
	* @copyright     smartData Enterprise Inc.
	* @method        admin_index
	* @description   staff group listing
	* @param         Null
	* @return        void 
	* @since         version 0.0.1
	* @version       0.0.1 
    */	

    function admin_index() {
        $this->layout = "admin";

        /* Active/Inactive/Delete functionality */
        if ((isset($this->request->data["StaffGroup"]["setStatus"]))) { 
            if (!empty($this->request->data['StaffGroup']['status'])) {
                $status = $this->request->data['StaffGroup']['status'];
            } else {
                $this->Session->setFlash("Please select the action.", 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array('action' => 'admin_index'));
            }
            $CheckedList = $this->request->data['checkboxes']; 
            $model = 'StaffGroup';
            $controller = $this->params['controller']; 
            $action = $this->params['action'];
            $this->setStatus($status, $CheckedList, $model, $controller, $action); 
        }
        /* Active/Inactive/Delete functionality */
        $value = "";
        $value1 = "";
        $show = "";
        $account_type = "";
        $criteria = '';

        if (!empty($this->params)) {
            if (!empty($this->params->query['keyword'])) {
                $value = trim($this->params->query['keyword']);
            }
            if ($value != "") {
                $criteria .= " StaffGroup.name LIKE '%" . $value ."%' ";
            }
        }
        //read pagination limit
        $limit = Configure::read ('Settings.paginationLimit') ; 
        $this->Paginator->settings = array('conditions' => array($criteria),
            'limit' => $limit,
            'order' => array(
                'StaffGroup.id' => 'DESC'
            )
        );
	
        $this->set('getData', $this->Paginator->paginate('StaffGroup'));
        $this->set('keyword', $value);
        $this->set('show', $show);
	$this->set('navadmins', 'class = "active"');
        $this->set('breadcrumb', 'Manage StaffGroup');
	$this->set('models', Inflector::singularize($this->name));
        //set pagination limit
        $this->set(compact('limit'));
    }
    
    /*
	* @author        Praveen Kumar
	* @copyright     smartData Enterprise Inc.
	* @method        admin_addedit
	* @description   Add & edit the admin profile
	* @param         userId
	* @return        void 
	* @since         version 0.0.1
	* @version       0.0.1 
    */
    
    function admin_addedit($id = null) {
        
        $new_user = false;
        $this->set('id', $id);       
        if(empty($this->request->data)){
            $this->request->data = $this->StaffGroup->read(null, base64_decode($id));
            $preSelectedPatients = '';
            $this->set('preSelectedPatients', $this->request->data);
        }elseif(isset($this->request->data) && !empty($this->request->data)){
	    //pr($this->request->data);// exit;
            $this->request->data = Sanitize::clean($this->request->data, array('encode' => false));
            $id = base64_decode($id);
            $this->request->data['StaffGroup']['id'] = $id;           
            $this->StaffGroup->set($this->request->data);
            if ($this->StaffGroup->validates()) {                
                if ($this->StaffGroup->saveAll($this->request->data['StaffGroup'],array('false'))) {
                    $this->Session->setFlash("The StaffGroup Name has been saved successfully.", 'default', array('class' => 'alert alert-success'));
                    $this->redirect(array('action' => 'admin_index'));
                }
            }
        }
        $textAction = ($id == null) ? 'Add' : 'Edit';
        $buttonText = ($id == null) ? 'Submit' : 'Update';
        $this->set('navadmins', 'class = "active"');
        $this->set('action', $textAction);
        $this->set('breadcrumb', 'StaffGroup/' . $textAction);
        $this->set('buttonText', $buttonText);
    }
	
    /*
	* @author        Praveen Kumar
	* @copyright     smartData Enterprise Inc.
	* @method        admin_delete
	* @description   delete admin StaffGroup
	* @param         userId
	* @return        void 
	* @since         version 0.0.1
	* @version       0.0.1 
    */
    
    function admin_delete($id) {
	if(!($this->Session->read('Auth')) && !empty($this->params['admin']) ){
		$this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true));
	}
        $id = base64_decode($id);
        $this->autorender = false;
        if ($id > 0) {
            $this->StaffGroup->delete($id);
            $this->Session->setFlash('Record deleted successfully.', 'default', array('class' => 'flashError', 'admin' => 1));
            $this->redirect(array('controller' => 'groups', 'action' => 'admin_index', 'admin' => true));
        }
    }
    
    /*
	* @author        Praveen Kumar
	* @copyright     smartData Enterprise Inc.
	* @method        admin_setnewStatus
	* @description   set the new status
	* @param         userId,status,modelName
	* @return        void 
	* @since         version 0.0.1
	* @version       0.0.1 
    */
    
  function admin_setnewStatus($id, $status, $model) {
        $this->loadModel($model);
        $this->request->data[$model]['id'] = $id;
        $this->request->data[$model]['status'] = $status;
        if ($this->$model->save($this->request->data, false)) {
            echo $status;
            exit;
        }
    }

}//class end
