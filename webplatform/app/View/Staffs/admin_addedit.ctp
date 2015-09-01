<?php echo $this->Html->script('admin/admin_editprofile');?>    

<div class="row">        
        <?php echo $this->Form->create('', array('url' => array('controller' => 'staffs', 'action' => 'addedit',$id),'id'=>'editProfileId'));?>
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>First Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Staff.firstname',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','maxlength' => 30));?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Last Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Staff.lastname',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','maxlength' => 20));?>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Email<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Staff.email',array('label' => false,'div' => false, 'placeholder' => 'Email','class' => 'form-control','maxlength' => 55));?>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Phone</label>
                <?php echo $this->Form->input('Staff.phone',array('label' => false,'div' => false, 'placeholder' => 'Phone','class' => 'form-control','maxlength' => 15));?>
            (Example : (XXX) XXX-XXXX)
        </div>
    </div>

    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <div class="active-block">
                <label>Activate </label>                
                <?php if(isset($this->request->data['Staff']['status']) && $this->request->data['Staff']['status'] == 0){  $checked= "";}else{  $checked= "checked";} ?>
                     <?php echo $this->Form->input('status',array('label' => false,'div' => false,'type '=> 'checkbox', 'checked' => $checked));?>
            </div>
        </div>
    </div>

            <?php /*if($this->request->data['Staff']['id'] ==""){ ?>
            <div class="form-group form_margin">
                <label>Password<span class="required"> * </span></label>                
                <?php echo $this->Form->input('password',array('type'=>'password','label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control','maxlength' => 55));?>
            </div>
            <?php }*/ ?>



    <div class="col-sm-11">
            <?php echo $this->Form->button($buttonText, array('type' => 'submit','class' => 'btn btn-default'));?> 
			<?php echo $this->Html->link('Back',array('controller' => 'dashboards'),array('class' => 'btn btn-default')); ?>
    </div>


        <?php echo $this->Form->end(); ?>
</div><!-- /.row -->