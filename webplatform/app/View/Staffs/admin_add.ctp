<?php
echo $this->Html->css('admin/admin_custom');
?>
<div class="row">  
    
    <?php echo $this->Form->create('Staff',array('id'=>'add_staff_form','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>First Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('firstname',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'First Name')); ?>
            <?php echo $this->Form->error('firstname',null,array('wrap'=>'span','class'=>'error_form'));?>
            <?php echo $this->Form->hidden('admin_id',array('value'=>$userId));?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Last Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('lastname',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Last Name')); ?>
            <?php echo $this->Form->error('lastname',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Group<span class="required"> * </span></label>                
                <?php echo $this->Form->input('staff_group_id',array('type'=>'select','options'=>$group,'empty'=>'Select','class'=>'validate[required] form-control select_group','placeholder'=>'Group')); ?>
            <?php echo $this->Form->error('staff_group_id',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
   <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Username<span class="required"> * </span></label>                
                <?php echo $this->Form->input('username',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Username')); ?>
            <?php echo $this->Form->error('username',null,array('wrap'=>'span','class'=>'error_form'));?>
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
            <label>Password<span class="required"> * </span></label>                
                <?php echo $this->Form->input('password',array('type'=>'password','maxlength'=>16,'autocomeplete'=>'off','class'=>'validate[required] form-control','placeholder'=>'Password')); ?>
            <?php echo $this->Form->error('password',null,array('wrap'=>'span','class'=>'error_form'));?>
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
            <label>Activate<span class="required"> * </span></label>                
                <?php echo $this->Form->input('status',array('label' => false,'div' => false,'type '=> 'checkbox', 'checked'=>'checked','class'=>'status_checkbox'));?>
        </div>
    </div>
    
    <div class="col-sm-6">
            <?php echo $this->Form->button($buttonTextSubmit, array('type' => 'submit','class' => 'btn btn-default'));?> 
	    <?php echo $this->Html->link('Back',array('controller' => 'staffs','action'=>'index'),array('class' => 'btn btn-default')); ?>
    </div>
    
    <?php echo $this->Form->end(); ?>
    
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Location</h4>
            </div>

            <div class="modal-body">
                <label>Country<span class="required"> * </span></label>     
              <?php echo $this->Form->input('country',array('type'=>'select','options'=>$country,'class'=>'validate[required] form-control','default'=>1));?>								
            </div>
            <div class="modal-body">
                <label>State<span class="required"> * </span></label> 
                <div class='replace_state'>
                    <?php echo $this->Form->input('state',array('type'=>'select','options'=>$states,'class'=>'validate[required] form-control','default'=>1,'id'=>'state'));?>
                </div>
              								
            </div>
            <div class="modal-body">
                   
              <?php echo $this->Html->link('Add','javascript:void(0);',array('class' => 'btn btn-default add_dynamic_location')); ?>								
            </div>
        </div>
    </div>
</div>