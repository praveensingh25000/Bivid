<?php echo $this->Html->script('admin/admin_managegroup');?>      
<div class="row">        
        <?php echo $this->Form->create('', array('url' => array('controller' => 'AdminGroups', 'action' => 'addedit',$id),'id'=>'editProfileId'));?>
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <label>Group Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('AdminGroup.name',array('label' => false,'div' => false, 'placeholder' => 'Group Name','class' => 'form-control','maxlength' => 30));?>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group form_margin">
            <div class="active-block">
                <label>Activate </label>                
                <?php if(isset($this->request->data['AdminGroup']['status']) && $this->request->data['AdminGroup']['status'] == 0){  $checked= "";}else{  $checked= "checked";} ?>
                <?php echo $this->Form->input('AdminGroup.status',array('label' => false,'div' => false,'type '=> 'checkbox', 'checked' => $checked));?>
            </div>
        </div>
    </div>

    <div class="col-sm-11">
        <?php echo $this->Form->button($buttonText, array('type' => 'submit','class' => 'btn btn-default'));?> 
	<?php echo $this->Html->link('Back',array('controller' => 'AdminGroups','action' => 'admin_index'),array('class' => 'btn btn-default')); ?>
    </div>

 <?php echo $this->Form->end(); ?>
 
</div><!-- /.row -->