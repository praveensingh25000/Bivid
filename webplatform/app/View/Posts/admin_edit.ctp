<div class="row">  
    <?php echo $this->Form->create('Post',array('id'=>'edit_staff_form','type'=>'file','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
    
     <div class="col-sm-12">
        <div class="form-group">
            <label>Description<span class="required"> * </span></label>                
            <?php echo $this->Form->input('description',array('type'=>'textarea','rows'=>'1','maxlength'=>250,'class'=>'validate[required] form-control','placeholder'=>'Description')); ?>
            <?php echo $this->Form->error('description',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group">
	    <label>Upload Image<span class="required"> * </span></label>                
	    <?php echo $this->Form->input('postImage',array('type'=>'file','class'=>'validate[required]')); ?>
	    <div><img src="<?php echo $postThumbImage;?>"/></div>
	    <?php echo $this->Form->error('postImage',null,array('wrap'=>'span','class'=>'error_form'));?>
        </div>
    </div>
    
       
    
    <div class="col-sm-6">
	<?php echo $this->Form->hidden('Post.postID',array('value'=>$id));?>
        <?php echo $this->Form->button($buttonTextSubmit, array('type' => 'submit','class' => 'btn btn-default'));?> 
	<?php echo $this->Html->link('Back',array('controller' => 'posts','action' => 'index'),array('class' => 'btn btn-default')); ?>
    </div>
    
    <?php echo $this->Form->end(); ?>
</div>

<?php
//js included at bottom of page
     echo $this->Html->script('admin/admin_userstaff');
 ?>
