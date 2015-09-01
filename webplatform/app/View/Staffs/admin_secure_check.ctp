<div class="row">

    <?php echo $this->Form->create('Staff',array('id'=>'forgotpasswordId','class'=>'form-horizontal','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
 
        <h1 class="col-sm-12 forgot_title"><img src="<?php echo URL_SITE; ?>/img/sad_face.png"><span>Reset your password</span></h1>
    
        <div class="col-sm-12 not_worry">Please enter the password and confirm password</div>
        
        <div class="col-sm-2"></div>
        
        <div class="col-sm-8">
	    
            <div class="field">
                <i class="icon"><img src="<?php echo URL_SITE; ?>/img/lock.png" alt=""></i>
                <?php echo $this->Form->input('password',array('label' => false,'div' => false,'id' => 'password', 'placeholder' => 'New Password','class' => '','maxlength' => 55));?>
                <?php echo $this->Form->error('password',null,array('wrap'=>'span','class'=>'error_form'));?>            
	    </div>	    
       
            <div class="field">
                <i class="icon"><img src="<?php echo URL_SITE; ?>/img/lock.png" alt=""></i>
                <?php echo $this->Form->input('confirm_password',array('label' => false,'div' => false,'id' => 'confirm_password','placeholder' => 'Confirm Password','class' => '','maxlength' => 30,'type '=> 'password'));?>
		<?php echo $this->Form->error('confirm_password',null,array('wrap'=>'span','class'=>'error_form'));?>
	    </div>
	    
        </div>
        
	<div class="row">
	    <div class="col-sm-12 login_btn"><?php echo $this->Form->submit('Update',array('class' => 'tolink full','div'=>false));?></div>
	</div>
        
	<div class="row">             
            <div class="back"><a href="<?php echo URL_SITE; ?>/admin"><i class="fa fa-angle-left fa-5"></i></a></div>
	</div>
	
    <?php echo $this->Form->end(); ?>
   
</div>