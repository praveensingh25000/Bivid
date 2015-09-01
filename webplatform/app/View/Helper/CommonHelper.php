<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class CommonHelper extends Helper {
   
   /**
   * For listing the Module Role table data
   * @author        Praveen Singh
   * @method        getModuleRoleData
   * @param         $id
   * @return        one row of Module Role table 
   * @since         version 0.0.1
   * @version       0.2.9
   */
   function getControllerActions($controllerID){
     App::import("Model", "Module");  
     $model = new Module();  
     $datas  = $model->find("all",array('conditions'=>array('Module.parent_id'=>$controllerID)));
     return $datas;
   }
   
   /**
   * For listing the Country
   * @author        Praveen Singh
   * @method        getCountry
   * @param         $module_id,$group_id
   * @return        one row of Module Role table 
   * @since         version 0.0.1
   * @version       0.2.9
   */
   function getCountry($cntId){
     App::import("Model", "Country");  
     $model = new Country();  
     $datas  = $model->find("first",array('conditions'=>array('Country.id'=>$cntId)));
     return $datas;
   }
   
   /**
   * For listing the State
   * @author        Praveen Singh
   * @method        getState
   * @param         id
   * @return        one row of Module Role table 
   * @since         version 0.0.1
   * @version       0.2.9
   */
   function getState($statId){
     App::import("Model", "State");  
     $model = new State();  
     $datas  = $model->find("first",array('conditions'=>array('State.id'=>$statId)));
     return $datas;
   } 
    
   /**
   * For listing the Module Role table data
   * @author        Praveen Singh
   * @method        getModuleRoleData
   * @param         $module_id,$group_id
   * @return        one row of Module Role table 
   * @since         version 0.0.1
   * @version       0.2.9
   */   
   function getModuleRoleData($module_id,$group_id){
     App::import("Model", "ModuleRole");  
     $model = new ModuleRole();  
     return $model->find("first",array('conditions'=>array('ModuleRole.module_id'=>$module_id,'ModuleRole.group_id'=>$group_id)));
   }
   
   /**
   * For getting user image
   * @author        Praveen Singh
   * @method        get_user_image
   * @param         data
   * @return        one row table 
   * @since         version 0.0.1
   * @version       0.2.9
   */   
   function get_user_image($id){
      App::import("Model", "User");  
      $model = new User();
      $data  = $model->find("first",array('conditions'=>array('User.id'=>$id)));     
      return !empty($data['User']['profile_pic'])?trim($data['User']['profile_pic']):'';
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
   function date_hour_min_sec_ago($date){
	    
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
   
   /**
   * For counting/listing the Post table data
   * @author        Praveen Singh
   * @method        getPostFlagCountData
   * @param         $type
   * @return        integer/array
   * @since         version 0.0.1
   * @version       0.2.9
   */   
   function getPostFlagCountData($type){
      App::import("Model", "Post");  
      $model = new Post();
      if($type){
	 return $model->find("count",array('conditions'=>array('Post.flag_type'=>1)));
      }
      return $model->find("all",array('conditions'=>array('Post.flag_type'=>1)));
   }
   
   function showImage($filePath,$width,$height){
      
      //echo $filePath;die;
      
      App::import('Vendor', 'Thumbnail', array('file' => 'thumbnail.inc.php'));
      
      /* ERROR Image */
      if(!file($filePath)) {
	 $filePath =URL_SITE.'/img/noimage.png';
	 $size = getimagesize($filePath);
	 if(empty($width)){
	    $width = $size[0];
	 }
      }
      
      /* End of error image */
      
      $thumb = new Thumbnail($filePath);
      $size  = getimagesize($filePath);
      
      /* width and height setting and resize width and height with respect to image width and height  */
      if(!empty($width)){
	 if($size[0] > $width){
	    $width = $width;
	 }else{
	    $width = $size[0];
	 }
      }
      if(!empty($height)){
	 if($size[1] > $height){
	    $height = $height;
	 }else{
	    $height = $size[0];
	 }
      }
      
      //echo $width.'/'.$height;die;
      
      /* end of setting */
      //check to see if file exists
      //$thumb->resize($width,$height);
      
      echo $thumb->show();exit;
      
      //$thumb->crop(110,120,$width,$height);
      if(isset($filePath)){
	 $thumb->show();exit;
      } else {
	 $thumb->destruct();exit;
      }
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
    
    function getAddress($address){       
        $address = str_replace(" ", "+", $address);  
        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
        $data = json_decode($json);
        $status   = $data->status;
        if($status == "OK"){
            $lat = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $long = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
            return  array($lat,$long);
        }
    }
    
}