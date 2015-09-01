    <?php        
        //echo $this->Html->script('admin/admin_changepassword');
    ?>
    
    <div class="row">
	
	<?php echo $this->Form->create('Staff', array('url' => array('controller' => 'staffs', 'action' => 'changepassword'),'id'=>'changePasswordId','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
	
        <div class="col-lg-6">
		 <div class="form-group form_margin" style="font-weight:bold;">
          Note : Password must be 6 or more characters, include  atleast 1 uppercase, 1 lowercase, and 1 number, example -  Password14
		  </div>
            <div class="form-group form_margin">
                <label>Old Password<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Staff.old_password',array('label' => false,'div' => false, 'placeholder' => 'Old Password','class' => 'form-control  required','maxlength' => 30,'type' => 'password'));?>                
		<?php echo $this->Form->error('old_password',null,array('wrap'=>'span','class'=>'error_form'));?>
	    </div>
            
            <div class="form-group form_margin">
                <label>New Password<span class="required"> * </span></label>
                <?php echo $this->Form->input('Staff.password',array('label' => false,'div' => false, 'placeholder' => 'New Password','class' => 'form-control required','maxlength' => 30,'type' => 'password'));?>                
		<?php echo $this->Form->error('password',null,array('wrap'=>'span','class'=>'error_form'));?>
	    </div>
            
            <div class="form-group form_margin">
                <label>Confirm Password<span class="required"> * </span></label>
                <?php echo $this->Form->input('Staff.confirm_password',array('label' => false,'div' => false, 'placeholder' => 'Confirm Password','class' => 'form-control required','maxlength' => 30,'type' => 'password'));?>
                <?php echo $this->Form->error('confirm_password',null,array('wrap'=>'span','class'=>'error_form'));?>
            </div>         
            
            <?php echo $this->Form->button('Update', array('type' => 'submit','class' => 'btn btn-default'));?>
            <?php echo $this->Html->link('Back',array('controller' => 'dashboards'),array('class' => 'btn btn-default')); ?>
            
        </div>
        
    </div><!-- /.row -->