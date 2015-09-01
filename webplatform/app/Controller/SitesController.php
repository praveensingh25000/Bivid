<?php


App::uses('Sanitize', 'Utility');

class SitesController extends AppController{
    
    var $name = 'Sites';
    
    function beforeFilter(){
        parent::beforeFilter();
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
        
        /* Active/Inactive/Delete functionality */
        if (isset($this->request->data["Site"]["setStatus"])) {
            
            //pr($this->request->data);die;
            
            if (!empty($this->request->data['Site']['status'])) {
                $status = $this->request->data['Site']['status'];
            } else {
                $this->Session->setFlash("Please select the action.", 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array('action' => 'admin_index'));
            }
            $CheckedList = $this->request->data['checkboxes']; 
            $model       = 'Site';
            $controller  = $this->params['controller']; 
            $action      = $this->params['action'];
            parent::setStatus($status, $CheckedList, $model, $controller, $action); 
        }
        /* Active/Inactive/Delete functionality */
        $value        = "";
        $value1       = "";
        $show         = "";
        $criteria     = "";

        if (!empty($this->params)) {
            if (!empty($this->params->query['keyword'])) {
                $criteria .= " Site.name LIKE '%" . trim($this->params->query['keyword']) ."%'";
            }
        }
        //read pagination limit
        $limit = Configure::read ( 'Settings.paginationLimit' );
        $this->Paginator->settings = array(
            'conditions' => array($criteria),
            'limit' => $limit,
            'order' => array('Site.id' => 'DESC')
        );
        
        $getDataArray = $this->Paginator->paginate('Site');        
        if(!empty($getDataArray)){            
            foreach($getDataArray as $key => $values){
                $getData[$values['SiteType']['name']][$key] = $values['Site'];                
            }
        }
        //pr($getData);die;        
        $this->set('getData', $getData);
        $this->set('keyword', $value);
        $this->set('show', $show);
        $this->set('navadmins', 'class = "active"');
        $this->set('breadcrumb', 'Sites/All list');
        $this->set('models', Inflector::singularize($this->name));
        //set pagination limit
        $this->set(compact('limit'));
    }
    
     /*
    * Adding and Editing the Site Setting
    * @author        Praveen Singh
    * @method        admin_addedit
    * @param         $id 
    * @return        true 
    * @since         version 0.0.1
    * @version       0.0.1 
    */     
    function admin_addedit($id = null) {
        
        $this->set('id', $id);
       
        if(empty($this->request->data)){
            $this->request->data = $this->Site->read(null, base64_decode($id));
            $this->set('preSelectedPatients', $this->request->data);
        }elseif(!empty($this->request->data)){
	    //pr($this->request->data);exit;
            $this->request->data = Sanitize::clean($this->request->data, array('encode' => false));
            $id  = base64_decode($id);
            $this->request->data['Site']['id'] = $id;            
            $this->Site->set($this->request->data);

            if ($this->Site->validates()) {                
                if ($this->Site->saveAll($this->request->data['Site'],array('false'))) {
                    $this->Session->setFlash("The Site Type Name has been saved successfully.", 'default', array('class' => 'alert alert-success'));
                    $this->redirect(array('action' => 'admin_index'));
                }
            }
        }
        $this->loadModel('SiteType');        
        $siteTypes  = $this->SiteType->find('list',array('SiteType.status'=>1));        
        $textAction = ($id == null) ? 'Add' : 'Edit';
        $buttonText = ($id == null) ? 'Submit' : 'Update';
        $this->set('navadmins', 'class = "active"');
        $this->set('action', $textAction);
        $this->set('breadcrumb', 'Sites/' . $textAction);
        $this->set('buttonText', $buttonText);
        $this->set('siteTypes', $siteTypes);
    }
    
    /*
    * Deleting the Site Type
    * @author        Praveen Singh
    * @method        admin_delete
    * @param         $id 
    * @return        true 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    function admin_delete($id) {        
        $this->autorender = false;        
        $id = base64_decode($id);        
        if ($id > 0) {
            $this->Site->delete($id);
            $this->Session->setFlash("Record deleted successfully.", 'default', array('class' => 'alert alert-success'));
            $this->redirect(array('controller' => 'sites', 'action' => 'index', 'admin' => true));
        }
    }
    
    function admin_resize($image=null,$width=null,$height=null)
    {
	$this->autoRender=false;
	$this->layout=false;	
	
	$image='/var/www/html/api/Uploads/PicturesThumbs/6/'.$image;

	$image_properties = getimagesize($image);
	$image_width = $image_properties[0];
	$image_height = $image_properties[1];
	$image_ratio = $image_width / $image_height;
	$type = $image_properties["mime"];

	if(!$width && !$height) {
	    $width = $image_width;
	    $height = $image_height;
	}
		
	echo $width;
	echo '/';
	echo $height;
	die;
	
	if($type == "image/jpeg") {
	    header('Content-type: image/jpeg');
	    $thumb = imagecreatefromjpeg($image);
	} elseif($type == "image/png") {
	    header('Content-type: image/png');
	    $thumb = imagecreatefrompng($image);
	} else {
	    header('Content-type: image/jpeg');
	    $thumb = imagecreatefromjpeg($image);
	}

	$temp_image = imagecreatetruecolor($width, $height);
	imagecopyresampled($temp_image, $thumb, 0, 0, 0, 0, $width, $height, $image_width, $image_height);
	$thumbnail = imagecreatetruecolor($width, $height);
	imagecopyresampled($thumbnail, $temp_image, 0, 0, 0, 0, $width, $height, $width, $height);

	if($type == "image/jpeg") {
		imagejpeg($thumbnail);
	} else {
		imagepng($thumbnail);
	}

	imagedestroy($temp_image);
	imagedestroy($thumbnail);
    }
}