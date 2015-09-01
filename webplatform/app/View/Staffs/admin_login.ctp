<div class="row">
    
    <?php echo $this->Form->create('Staff',array('id'=>'loginformId','class'=>'form-horizontal','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
        
        <div class="field">
            <i class="icon"><img src="<?php echo URL_SITE; ?>/img/username.png" alt=""></i>
            <?php echo $this->Form->input('email',array('type' => 'text','label' => false,'div' => false,'id' => 'email', 'placeholder' => 'E-mail','class' => '','maxlength' => 55));?>
            <?php echo $this->Form->error('email',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>

        <div class="field">
            <i class="icon"><img src="<?php echo URL_SITE; ?>/img/lock.png" alt=""></i>
            <?php echo $this->Form->input('password',array('label' => false,'div' => false,'id' => 'password','placeholder' => 'Password','class' => '','maxlength' => 30,'type '=> 'password'));?>
            <?php echo $this->Form->error('password',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
        
        <div class="row mar_top_15">
            <div class="col-xs-6 right_no_pad">
                <div class="checkbox checkbox-info">
                    <?php echo $this->Form->input('remember_me',array('label' => false,'id'=>'remember_me','class'=>'styled','div' => false,'type '=> 'checkbox','checked' => ''));?>
                    <label for="checkbox1">Remember me</label>
                </div>
            </div>
            <div class="col-xs-6 forgot"><?php echo $this->Html->link("Forgot Password?","/admin/staffs/forgot_password/",array('class' => 'forgot'));?></div>
        </div>
	
	<div class="row">
	    <div class="col-sm-12 login_btn">
                <?php echo $this->Form->submit('Sign in',array('class' => 'tolink full','div'=>false));?>
                <?php echo $this->Form->reset('Reset',array('class' => 'tolink full','div'=>false));?>
            </div>
	</div>
        
      <?php echo $this->Form->end(); ?>
      
</div>