<div class="row">  
    <?php echo $this->Form->create('Staff',array('id'=>'edit_staff_form','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
    <?php echo $this->Form->hidden('Staff.id',array('value'=>$id));?>
     <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>First Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Staff.firstname',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'First Name')); ?>
            <?php echo $this->Form->error('firstname',null,array('wrap'=>'span','class'=>'error_form'));?>
            
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Last Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Staff.lastname',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Last Name')); ?>
            <?php echo $this->Form->error('lastname',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Group<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Staff.staff_group_id',array('type'=>'select','options'=>$group,'empty'=>'Select','class'=>'validate[required] form-control select_group','placeholder'=>'Group')); ?>
            <?php echo $this->Form->error('staff_group_id',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
   <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Username<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Staff.username',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Username')); ?>
            <?php echo $this->Form->error('username',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Email<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Staff.email',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Email')); ?>
            <?php echo $this->Form->error('email',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Contact Number<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Staff.phone',array('type'=>'text','maxlength'=>30,'class'=>'validate[required] form-control','placeholder'=>'Contact Number')); ?>
            <?php echo $this->Form->error('phone',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
   
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Activate<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Staff.status',array('label' => false,'div' => false,'type '=> 'checkbox', 'checked'=>'checked','class'=>'status_checkbox'));?>
        </div>
    </div>
    
    <div class="col-sm-6">
            <?php echo $this->Form->button($buttonTextSubmit, array('type' => 'submit','class' => 'btn btn-default'));?> 
	    <?php echo $this->Html->link('Back',array('controller' => 'staffs','action' => 'index'),array('class' => 'btn btn-default')); ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>