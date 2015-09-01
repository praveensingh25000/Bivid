<?php echo $this->Html->script('admin/admin_managegroup');?>      
<div class="row">        
<?php echo $this->Form->create('', array('url' => array('controller' => 'AdminGroups', 'action' => 'addedit',$id),'id'=>'editProfileId'));?>
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Group Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('AdminGroup.name',array('label' => false,'div' => false, 'placeholder' => 'Group Name','class' => 'form-control','maxlength' => 30));?>
        </div>
    </div>
    
    
 <?php echo $this->Form->end(); ?>
 
</div><!-- /.row -->