<?php
$shrLowerFlag =0;                       
$breadcrumbArray =  isset($breadcrumb)?explode('/',$breadcrumb ):array(); 
$breadcrumbArray1 = $breadcrumbArray;

if(!empty($breadcrumbArray1)){?>
    <!-- Bread Crumb -->
    <div class="row">
        <div class="col-lg-12">            
            <ol class="breadcrumb breadcrumb-custom"> 
                <?php
                //THis code finds a values in array and replaces it with other(Here items is being replaced with products)
                if($this->params['controller'] == "questionnaire" && $this->params['action'] == "admin_addRule"){
                    
                    $breadcrumbArray = array_replace($breadcrumbArray,
                        array_fill_keys(
                            array_keys($breadcrumbArray, "Matching Rules"),"questionnaire/rulelist"
                        )
                    );
                    
                }
                
                if($this->params['controller'] == "questionnaire" && $this->params['action'] == "admin_editRule"){
                    
                    $breadcrumbArray = array_replace($breadcrumbArray,
                        array_fill_keys(
                            array_keys($breadcrumbArray, "Matching Rules"),"questionnaire/rulelist"
                        )
                    );
                    
                }
                if( ($this->params['controller'] == "users" && ($this->params['action'] == "admin_patient_add" || $this->params['action'] == "admin_patient_edit" || $this->params['action'] == "admin_patient_view") ) || ($this->params['controller'] == "reports" && ($this->params['action'] == "admin_generate_report") ) ){                                 
                    $breadcrumbArray = array_replace($breadcrumbArray,
                        array_fill_keys(
                            array_keys($breadcrumbArray, "Manage Patients"),"users/patient_manage"
                        )
                    );
                    
                }
                if($this->params['controller'] == "users" && ($this->params['action'] == "admin_facility_add" || $this->params['action'] == "admin_facility_edit" || $this->params['action'] == "admin_facility_view" || $this->params['action'] == "admin_facility_appointments")){                                 
                    $breadcrumbArray = array_replace($breadcrumbArray,
                        array_fill_keys(
                            array_keys($breadcrumbArray, "Manage Facility"),"Admins/facility_manage"
                        )
                    );
                    
                }
                                                //pry($this->params);
                if($this->params['controller'] == "Admins" && ($this->params['action'] == "admin_advocate_addedit" || $this->params['action'] == "admin_advocate_view")){      
                                                        
                    $breadcrumbArray = array_replace($breadcrumbArray,
                        array_fill_keys(
                            array_keys($breadcrumbArray, "Manage Advocates"),"Admins/manage_advocates"
                        )
                    );
                    
                }
                if($this->params['controller'] == "SubscriptionPlans" && ($this->params['action'] == "admin_addedit" || $this->params['action'] == "admin_view") && $this->params['pass'][0] == 'facility'){      
                                                        
                    $breadcrumbArray = array_replace($breadcrumbArray,
                        array_fill_keys(
                            array_keys($breadcrumbArray, "Subscription Plan"),"SubscriptionPlans/index/facility"
                        )
                    );
                    
                }
                if($this->params['controller'] == "SubscriptionPlans" && ($this->params['action'] == "admin_addedit" || $this->params['action'] == "admin_view") && $this->params['pass'][0] == 'patient'){      
                                                        
                    $breadcrumbArray = array_replace($breadcrumbArray,
                        array_fill_keys(
                            array_keys($breadcrumbArray, "Subscription Plan"),"SubscriptionPlans/index/patient"
                        )
                    );
                    
                }  
               
                for($i = 0 ; $i < count($breadcrumbArray);$i++)
                {  $shrLowerFlag =1;
                    if($i == count($breadcrumbArray)-1 )
                    {
                       echo "<li class='active'><i class='icon-file-alt'></i>". $breadcrumbArray1[count($breadcrumbArray) -1] ."</li>";
                    }else{
                        if( $shrLowerFlag == 1){
                            echo "<li>".$this->Html->link($breadcrumbArray1[$i],'/admin/'.$breadcrumbArray[$i].'/',array('class' => 'icon-file-alt','title' => $breadcrumbArray[$i] ))."</li>";
                        }else{
                             echo "<li>".$this->Html->link($breadcrumbArray1[$i],'/admin/'.strtolower($breadcrumbArray[$i]).'/',array('class' => 'icon-file-alt','title' => $breadcrumbArray[$i] ))."</li>";
                        }
                       
                    }
                    $shrLowerFlag =0;
                }
                ?>
        </div>
    </div>
    <!-- Bread Crumb -->
    
<?php } ?>

<div class="row">
    <div class="col-sm-12">        
        <div class="alert-success alert-success-custom flashMessageajax-msg" id="flashMessageajax">
            <?php echo $this->Session->flash();?>
        </div>
    </div>
</div>
<div class="clear"></div>