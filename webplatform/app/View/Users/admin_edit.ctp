<div class="row">  
    <?php echo $this->Form->create('User',array('id'=>'edit_staff_form','enctype'=>'multipart/form-data','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
    <?php echo $this->Form->hidden('User.userID',array('value'=>$id));?>
   
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>User Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('User.username',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'User Name')); ?>
            <?php echo $this->Form->error('username',null,array('wrap'=>'span','class'=>'error_form'));?>
            
        </div>
    </div>
    
   <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Email<span class="required"> * </span></label>                
                <?php echo $this->Form->input('User.email',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Email')); ?>
            <?php echo $this->Form->error('User.email',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Contact<span class="required">  </span></label>                
                <?php echo $this->Form->input('User.phoneno',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Contact Number')); ?>
            <?php echo $this->Form->error('phoneno',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Description<span class="required"> </span></label>                
                <?php echo $this->Form->input('User.userDescription',array('label' => false,'div' => false,'type '=> 'textarea','rows'=>4));?>
        </div>
    </div>
    
     <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Age<span class="required">  </span></label>                
                <?php echo $this->Form->input('User.age',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Age')); ?>
            <?php echo $this->Form->error('phone',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
     
     <div class="col-sm-6">
        <div class="form-group form_margin">
         </div>
    </div>
     
     <div class="col-sm-6">
        <div class="form-group form_margin">
            <?php if(!isset($this->request->data['User']['userAvatar']['name'])){?> 
	    <img src="<?php echo $this->request->data['User']['userAvatar'] ?>" height="50" width="50"/>
	    <?php }?>
	    <label>Edit Image</label>
	     <?php echo $this->Form->input('userAvatar',array( 'type' => 'file','class'=>'validate[required]')); ?>
             <?php echo $this->Form->error('userAvatar',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
     
   
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Activate<span class="required"> * </span></label>                
                <?php echo $this->Form->input('User.status',array('label' => false,'div' => false,'type '=> 'checkbox', 'checked'=>'checked','class'=>'status_checkbox'));?>
        </div>
    </div>
     <div class="col-sm-6">
            <?php echo $this->Form->button($buttonTextSubmit, array('type' => 'submit','class' => 'btn btn-default'));?> 
	    <?php echo $this->Html->link('Back',array('controller' => 'users','action' => 'index'),array('class' => 'btn btn-default')); ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>

<?php
//js included at bottom of page
     echo $this->Html->script('admin/admin_userstaff');
 ?>
