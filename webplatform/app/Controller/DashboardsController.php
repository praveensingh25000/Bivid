<?php
App::uses('Sanitize', 'Utility');

class DashboardsController extends AppController{
    
    var $name = 'Dashboards';
    
    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
     /*
    * listing the Site Setting
    * @author        Praveen Singh
    * @method        admin_index
    * @param         $id 
    * @return        true 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function admin_index(){         
         //pr($this->Session->read('Auth'));die;
    }
    
    /*
    * listing the Site Setting
    * @author        Praveen Singh
    * @method        admin_index
    * @param         $id 
    * @return        true 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function index(){
        $this->layout = 'default';
    }
    
}