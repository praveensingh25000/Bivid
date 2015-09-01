<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppModel', 'Model');
 
class Emailtemplate extends AppModel {
	
    var $name = 'Emailtemplate';
    
    public $validate = array(
	    'name' => array(
	    'rule'    => 'notEmpty',
	    'message' => 'Please enter the template name.'
	),'template' => array (
            'notEmpty' => array (
                'rule' => 'notEmpty',
                'message' => 'Please Enter Template detail '
            )
        ),
	    
    );
    
    /*
     * to get the email template content by passing the unique code
     * 
     * @author         Praveen Singh
     * @copyright     smartData Enterprise Inc.
     * @method        getEmailTemplate
     * @param         $code 
     * @return        Email tempalte data 
     * @since         version 0.0.1
     * @version       0.0.1 
     */
    function getEmailTemplate($name = null) {	
	$result = $this->find('first', array('conditions' => array('Emailtemplate.name LIKE' => $name)));    
	if(!empty($result)) { 
	    return $result;
	}else {
	    return false;
	}
    }
}
?>
