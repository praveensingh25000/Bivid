<?php
echo $this->Html->script('Emailtemplates.emailtemplate');
echo $this->Html->css('Emailtemplates.emailtemplate');
echo $this->Html->script('ckeditor/ckeditor');
?>  
       <?php echo $this->Form->create(null, array('url' => array('controller' => 'emailtemplates', 'action' => 'addedit'),'id'=>'emailTemplateId','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));              
              echo $this->Form->hidden('Emailtemplate.id',array('value'=>base64_encode($this->data['Emailtemplate']['id']))); 
        ?>
       <div class="row">
              <div class="col-lg-8">        
               
                <div class="col-lg-12">
                      <div class="form-group form-spacing">
                        <div class="col-lg-2 form-label">
                          <label>Name<span class="required"> * </span></label>
                        </div>
                        <div class="col-lg-5 form-box">                
                          <?php echo $this->Form->input('name',array('label' => false,'div' => false, 'placeholder' => 'Name','class' => 'form-control','maxlength' => 55));?>
                          <?php echo $this->Form->error('name',null,array('wrap'=>'span','class'=>'error_form'));?>
                        </div>
                        <div class="col-lg-5">
                          <!--blank div-->
                        </div>
                      </div>
                    </div>
                  </div>
       </div><!-- /.row -->
       <div class="row">
              <div class="col-lg-8">        
               
                <div class="col-lg-12">
                      <div class="form-group form-spacing">
                        <div class="col-lg-2 form-label">
                          <label>Dynamic Fields</label>
                        </div>
                        <div class="col-lg-5 form-box">
                          <?php $fields = array('{FirstName}'=>'First Name','{LastName}'=>'Last Name','{Email}'=>'Email Address','{Password}'=>'Password','{Link}'=>'Link'); ?>               
                          <?php echo $this->Form->input('dynamic_text',array('type'=>'select','options'=>$fields,'label' => false,'div' => false, 'empty' => 'Select Field','class' => 'form-control','onchange'=>'SetDynamicText()'));?>
                          
                        </div>
                        <div class="col-lg-5">
                          <!--blank div-->
                        </div>
                      </div>
                    </div>
                  </div>
       </div><!-- /.row -->
           <div class="row">        
           <div class="col-lg-8 form-spacing">
             <div class="col-lg-12"> 
               <div class="form-group">
               <div class="col-lg-2 form-label">
                   <label>Template<span class="required"> * </span></label>  
               </div> 
               <div class="col-lg-10 form-box">             
                   <?php echo $this->Form->input('template', array('id'=>'editor1','label' => false,'div' => false,'class' => 'ckeditor'));?>
                   <?php echo $this->Form->error('template',null,array('wrap'=>'span','class'=>'error_form'));?> 
               </div>
               </div>
             </div>
           </div>
           
            <div class="col-lg-8">
             <div class="col-lg-12">
               <div class="col-lg-2">
                 <!--blank div-->
               </div>
               <div class="col-lg-10 form-box">
               <?php echo $this->Form->button($buttonText, array('type' => 'submit','class' => 'btn btn-default'));?>             
               <?php echo $this->Form->button('Reset', array('type' => 'reset','class' => 'btn btn-default'));?>
               
               </div>
             </div>     
           </div> 
       </div><!-- /.row -->
       <?php echo $this->Form->end(); ?>
       <script type= "text/javascript">
           function SetDynamicText(){ 
                      var DynamicText = document.getElementById('EmailtemplateDynamicText').value ;
                      if(DynamicText){
                                 // tinyMCE.execInstanceCommand('content',"mceInsertContent",false,DynamicText);           
                                 var editor_data = CKEDITOR.instances['editor1'].getData();
                                 var fulldata = DynamicText+editor_data;
                                 CKEDITOR.instances['editor1'].setData(fulldata);
                                 //var oEditor = CKEDITOR.instances.ckfinder;
                                 //oEditor.insertHtml( DynamicText );
                                 //CKEDITOR.instances[**ckeditorname**].setData(DynamicText) 
                                 //var getvalues = tinyMCE.getContent() + DynamicText;
                                 //tinyMCE.setContent(getvalues);
                                 
                      }           
                      return false;
           } 
       </script>