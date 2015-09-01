<div class="row">  
    
    <?php echo $this->Form->create('User',array('id'=>'import_post_form','type'=>'file','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
    
    <div class="col-sm-12">
        <div class="form-group">
	    <label>Upload User CSV Data<span class="required"> * </span> <?php echo $this->Html->link('Download File Format',"/files/userFileFormat.csv",array('escape' =>false));?></label>                
	    <?php echo $this->Form->input('user_csv_file',array('type'=>'file','class'=>'validate[required]')); ?>
	    <?php echo $this->Form->error('user_csv_file',null,array('wrap'=>'span','class'=>'error_form'));?>
           
        </div>
    </div>
    
    <div class="col-sm-12">
        <?php echo $this->Form->button($buttonTextSubmit, array('type' => 'submit','class' => 'btn btn-default'));?> 
	<?php echo $this->Html->link('Back',array('controller' => 'users','action' => 'index'),array('class' => 'btn btn-default')); ?>
    </div>
    
    <?php echo $this->Form->end(); ?>
    
</div>