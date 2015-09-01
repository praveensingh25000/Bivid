<div class="row">
        
    <?php echo $this->Form->create('', array('url' => array('controller' => 'SiteTypes', 'action' => 'addedit',$id),'id'=>'editProfileId'));?>
    
        <div class="col-sm-6">
            <div class="form-group form_margin">
                <label>Site Type Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('SiteType.name',array('label' => false,'div' => false, 'placeholder' => 'SiteType Name','class' => 'form-control','maxlength' => 30));?>
            </div>
        </div>
        
        <div class="col-sm-6">
            <div class="form-group form_margin">
                <div class="active-block">
                    <label>Activate </label>                
                    <?php if(isset($this->request->data['SiteType']['status']) && $this->request->data['SiteType']['status'] == 0){  $checked= "";}else{  $checked= "checked";} ?>
                    <?php echo $this->Form->input('status',array('label' => false,'div' => false,'type '=> 'checkbox', 'checked' => $checked));?>
                </div>
            </div>
        </div>
        
        <div class="col-sm-11">
            <?php echo $this->Form->button($buttonText, array('type' => 'submit','class' => 'btn btn-default'));?>             
            <?php echo $this->Form->button($buttonTextReset, array('type' => 'reset','class' => 'btn btn-default'));?>
        </div>    
    
    <?php echo $this->Form->end(); ?>
    
</div><!-- /.row -->