<?php echo $this->Html->script('admin/admin_sites');?>

<div class="row">
        
    <?php echo $this->Form->create('', array('url' => array('controller' => 'sites', 'action' => 'addedit',$id),'id'=>'editSiteId','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
            
        <div class="col-sm-6">                    
             <div class="form-group form_margin">
                    <label for="sel1">Select Site Type</label>
                    
                    <?php echo $this->Form->input(
                        'site_type_id',
                         array(
                             "type"    => "select",
                             'empty'   => 'Select Site Type',
                             "options" => $siteTypes,                                                    
                             'class'   => 'required form-control',
                             'label'   => false,
                             'div'     => false
                        )
                    );
                    ?>
                     <?php echo $this->Form->error('site_type_id',null,array('wrap'=>'span','class'=>'error_form'));?>
            </div>
        </div>               
        
        <div class="col-sm-6">
            <div class="form-group form_margin">
                <label>Site Name<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Site.name',array('label' => false,'div' => false, 'placeholder' => 'SiteType Name','class' => 'required form-control','maxlength' => 300));?>
                <?php echo $this->Form->error('name',null,array('wrap'=>'span','class'=>'error_form'));?>
            </div>
        </div>
        
        <div class="col-sm-6">
            <div class="form-group form_margin">
                <label>Site Value<span class="required"> * </span></label>                
                <?php echo $this->Form->input('Site.value',array('label' => false,'div' => false, 'placeholder' => 'SiteType Name','class' => 'required form-control','maxlength' => 300));?>
                <?php echo $this->Form->error('value',null,array('wrap'=>'span','class'=>'error_form'));?>
            </div>
        </div>
        
        <div class="col-sm-6">
            <div class="form-group form_margin">
                <div class="active-block">
                    <label>Activate </label>                
                    <?php if(isset($this->request->data['Site']['status']) && $this->request->data['Site']['status'] == 0){  $checked= "";}else{  $checked= "checked";} ?>
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