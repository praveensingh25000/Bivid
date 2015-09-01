 <?php //debug($this->request->data);
  echo $this->Html->script('front/Manageuser');?> 

<div class="row">
    <div class="col s12">
        <h1 class="inner">Profile : <label><?php if(defined('SESSION_USER_NAME')){echo SESSION_USER_NAME;}?></label></h1>
    </div>
</div>
<div class="row ">
	 <?php echo $this->Form->create('', array('url' => array('controller' => 'users', 'action' => 'account'),'id'=>'edituserRegisterId','enctype'=>'multipart/form-data','class'=>'col s12 offset-s0'));?>
    <div class="row">
        <div class="input-field col s6">
          <?php echo $this->Form->input('User.firstname',array('label' => false,'div' => false,'class' => 'validate form-control','maxlength' => 30));?>
            <label for="last_name">First Name<span class="red-text">*</span></label>
        </div>
        <div class="input-field col s6">
         <?php echo $this->Form->input('User.lastname',array('label' => false,'div' => false,'class' => 'validate','maxlength' => 30));?>
            <label for="last_name">Last Name</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
          <?php echo $this->Form->input('User.username',array('label' => false,'div' => false,'class' => 'validate','maxlength' => 30));?>
            <label for="last_name">Username<span class="red-text">*</span></label>
        </div>
        <div class="input-field col s6">
           <?php echo $this->Form->input('User.email',array('label' => false,'div' => false,'class' => 'validate','maxlength' => 55,'disabled'=>'disabled'));?>
            <label for="email">Email<span class="red-text">*</span></label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
         <?php echo $this->Form->input('User.phone',array('label' => false,'div' => false,'class' => 'validate','maxlength' =>15));?>
            <label for="email">Phone</label>
        </div>
        <div class="input-field col s6">
           <?php echo $this->Form->input('User.fax',array('label' => false,'div' => false,'class' => 'validate','maxlength' => 15));?>
            <label for="email">Fax Number</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
			<?php echo $this->Form->input('User.country',array('label' => false,'div' => false,'empty'=>'--Select Country--','options' =>$country,'onchange'=>'getStateByCountry(this.value)'));?>
                        <!--label>Country<span class="red-text">*</span></label-->
        </div>
        <div class="input-field col s6">
			<?php echo $this->Form->input('User.state',array('label' => false,'div' => false,'empty'=>'--Select State/Province--','options' =>$states));?>
                        <!--label>State/Province<span class="red-text">*</span></label-->
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
          <?php echo $this->Form->input('User.city',array('label' => false,'div' => false,'class' => 'validate','maxlength' => 55));?>
            <label for="email">City<span class="red-text">*</span></label>
        </div>
        <div class="input-field col s6">
          <?php echo $this->Form->input('User.zip',array('label' => false,'div' => false,'class' => 'validate','maxlength' => 10,'type'=>'text'));?>
            <label for="email">Zip code<span class="red-text">*</span></label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
           <?php echo $this->Form->textarea('User.address',array('label' => false,'div' => false,'class' => 'validate materialize-textarea','type'=>'text'));?>
            <label for="textarea1">Textarea<span class="red-text">*</span></label>
        </div>
		<?php if($group_id ==3 || $group_id ==4){?>
        <div class="input-field col s6">
           <?php echo $this->Form->input('User.company_id',array('label' => false,'div' => false,'empty'=>'--Select Company Name--','options'=>$companys));?>
 <!--label for="email">Company<span class="red-text">*</span></label-->
        </div>
		<?php } ?>
    </div>
	   <?php if($group_id ==3){?>
    <div class="row">
        <div class="input-field col s6 replace_location">
           <?php echo $this->Form->input('User.location',array('label' => false,'div' => false,'options'=>'','empty'=>'--Select Location--')); ?>
 <!--label for="email">Location<span class="red-text">*</span></label-->
        </div>
        <div class="input-field col s6" id='fancy_anchor' style="display:none">
		 <?php echo $this->Form->input('User.new_location',array('label' => false,'div' => false,'type'=>'text','maxlength'=>30,'class'=>'validate','onblur'=>'setNewLocation(this.value);'));?>
            <label for="email">Location<span class="red-text">*</span></label>
        </div> 

    </div>
	  <?php } if($group_id ==4){?>
    <div class="row">
        <div class="file-field input-field file-reg col s6">
            <input class="file-path validate" type="text"/>
            <div class="btn">
                <span>Profile Picture<span class="red-text">*</span></span>
			<?php echo $this->Form->input('User.profile_pic',array('label' => false,'div' => false,'type'=>'file'));?>
            </div>

        </div>

        <div class="input-field col s6 account-img">
	       <?php 
		 $profilep=$this->request->data['User']['profile_pic'];
		 echo $this->Html->image("profile_pic/".$profilep,array("alt" => "Profile Picture"));?>

        </div>
    </div>

	   <?php } ?>


	   <?php if($group_id ==4){?>
    <div class="row">
        <div class="input-field col s6">
	       <?php echo $this->Form->input('User.user_type_id',array('label' => false,'div' => false,'empty' => '--Select User Type--','options' =>$usertype));?>
        </div>
    </div>
	   <?php } ?>


    <div class="row">
        <div class="col s12">
	    <?php echo $this->Form->input('User.group_id',array('type' => 'hidden','value' =>isset($this->request->data['User']['group_id'])?$this->request->data['User']['group_id']:''));?>
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit</button>
            <a href="javascript:void(0);" class="btn waves-effect waves-light" onclick="window.history.back();"><span>Back</span></a>
        </div>
    </div>
      <?php echo $this->Form->end(); ?>
</div>


