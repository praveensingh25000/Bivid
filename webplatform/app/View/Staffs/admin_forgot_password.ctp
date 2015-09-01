<div class="row">
        
    <?php echo $this->Form->create('Staff',array('id'=>'forgotPasswordId','class'=>'form-horizontal','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
       
        <h1 class="col-sm-12 forgot_title"><img src="<?php echo URL_SITE; ?>/img/sad_face.png"><span>Forgot your password?</span></h1>
    
        <div class="col-sm-12 not_worry">Not to worry, just enter your registered email and we will send you instructions to reset your password?</div>
        
        <div class="col-sm-2"></div>
        
        <div class="col-sm-8">
            <div class="field">
                <i class="icon"><img src="<?php echo URL_SITE; ?>/img/forgot.png" alt=""></i>
                <?php echo $this->Form->input('email',array('label' => false,'type' => 'text','div' => false, 'placeholder' => 'Enter your Email','id' => 'email','class' => '','maxlength' => 55));?>                
                <?php echo $this->Form->error('email',null,array('wrap'=>'span','class'=>'error_form'));?>
            </div>
        </div>
        
	<div class="row">
	    <div class="col-sm-12 login_btn"><?php echo $this->Form->submit('Submit',array('class' => 'tolink full'));?></div>
	</div>
        
	<div class="row">             
            <div class="back"><a href="<?php echo URL_SITE; ?>/admin"><i class="fa fa-angle-left fa-5"></i></a></div>
	</div>
	
   <?php echo $this->Form->end(); ?>
   
</div>