<?php
echo $this->Html->css('admin/admin_custom');
?>
<div class="row col-sm-4">  
    
    <?php echo $this->Form->create('User',array('id'=>'add_staff_form','enctype'=>'multipart/form-data','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>User Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('username',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Username')); ?>
            <?php echo $this->Form->error('username',null,array('wrap'=>'span','class'=>'error_form'));?>
            <?php echo $this->Form->hidden('admin_id',array('value'=>$userId));?>
	    <?php echo $this->Form->hidden('flag_type',array('value'=>'0'));?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Password<span class="required"> * </span></label>                
                <?php echo $this->Form->input('password',array('type'=>'password','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Password')); ?>
            <?php echo $this->Form->error('password',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
    
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>User Type<span class="required"> * </span></label>                
                <?php echo $this->Form->input('user_type_id',array('type'=>'select','options'=>$userType,'empty'=>'Select','class'=>'validate[required] form-control select_group','placeholder'=>'Group')); ?>
            <?php echo $this->Form->error('user_type_id',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
   <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Descrption<span class="required"> * </span></label>                
                <?php echo $this->Form->input('userDescription',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Descrption')); ?>
            <?php echo $this->Form->error('userDescription',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Email<span class="required"> * </span></label>                
                <?php echo $this->Form->input('email',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Email')); ?>
            <?php echo $this->Form->error('email',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
    
    
    
     <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Contact Number<span class="required"> * </span></label>                
                <?php echo $this->Form->input('phone',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Contact Number')); ?>
            <?php echo $this->Form->error('phone',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
     
     <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Age</label>                
                <?php echo $this->Form->input('age',array('type'=>'text','maxlength'=>3,'class'=>'validate[required] form-control','placeholder'=>'Age')); ?>
         </div>
    </div>
     
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Avatar Image</label>                
              <?php echo $this->Form->input('userAvatar',array( 'type' => 'file','class'=>'validate[required]')); ?>
             <?php echo $this->Form->error('userAvatar',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
     
    <div class="col-sm-12">
        <div class="form-group form_margin">
            <label>Address</label>                
                <?php echo $this->Form->input('userAddress',array('type'=>'textarea','rows'=>1,'class'=>'validate[required] form-control','placeholder'=>'Address')); ?>
            <?php echo $this->Form->error('userAddress',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
   
    <div class="col-sm-6">
            <?php echo $this->Form->button($buttonTextSubmit, array('type' => 'submit','class' => 'btn btn-default'));?> 
	    <?php echo $this->Html->link('Back',array('controller' => 'users','action' => 'index'),array('class' => 'btn btn-default')); ?>
    </div>
    
    <?php echo $this->Form->end(); ?>
    
</div>

<div class="row col-sm-6">
    
    Drag and Drop the images
    
</div>

<?php
//js included at bottom of page
     echo $this->Html->script('admin/admin_userstaff');
 ?>
