<div class="upper_table_form">
	<div class="row">
		<div class="col-md-8">
			<!--<div class="inner_full_wrap">
			   <?php //echo $this->Form->create('User',array('id'=>'import_post_form','type'=>'file','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
				<div class="fileUpload">
				    <span>Upload CSV Data</span>
				    <?php //echo $this->Form->input('post_csv_file',array('type'=>'file','class'=>'upload')); ?>
				    <input type="hidden" value="1" name="import_list">
				</div>
				<?php //echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-default my_btn'));?> 
			    <?php //echo $this->Form->end(); ?>	
			</div>-->
			<div class="inner_full_wrap">
			    <a href="<?php echo URL_SITE ?>/files/postfile.csv" class="download_sample"><i class="fa fa-file-excel-o"></i><span>Download Sample</span></a>
			</div>
		</div>
		<div class="col-md-4 col-xs-12 pull-right">
			<div class="inner_full_wrap">
			    <!--a href="#" class="btn btn-default my_btn pull-right low_pad_btn"><i class="fa fa-trash-o"></i></a>-->
			 </div>
			<div class="inner_full_wrap text_right"><b><a href="#" class="add_more">Add more</a></b></div>
		</div>
	</div>
</div>
<div class="update_table">
    <?php echo $this->Form->create('User',array('id'=>'add_user_form','class'=>'form','type'=>'file','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
	<div class="row">
		<div class="col-sm-4">
			<div class="form-group">
			    <label for="exampleInputEmail1">First Name</label>
			     <?php echo $this->Form->input('firstname',array('type'=>'text','maxlength'=>30,'class'=>'form-control','placeholder'=>'Firstname')); ?>
			     
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
			    <label for="exampleInputEmail1">Last Name</label>
			     <?php echo $this->Form->input('lastname',array('type'=>'text','maxlength'=>30,'class'=>'form-control','placeholder'=>'Lastname')); ?>
			     
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
			    <label for="exampleInputEmail1">UsersName<b>*</b></label>
			    <?php echo $this->Form->input('username',array('type'=>'text','maxlength'=>30,'class'=>'form-control','placeholder'=>'UserName')); ?>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
			    <label for="exampleInputEmail1">Status</label>
			    <?php echo $this->Form->input('status',array('type'=>'text','maxlength'=>30,'class'=>'form-control','placeholder'=>'Status')); ?>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
			    <label for="exampleInputEmail1">email</label>
			    <?php echo $this->Form->input('email',array('type'=>'text','maxlength'=>30,'class'=>'form-control','placeholder'=>'email')); ?>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
			    <label for="exampleInputEmail1">Upload Image</label>
			    <div class="newfileUpload">
				<span>Upload Image</span>
				<?php echo $this->Form->input('userImage',array('type'=>'file','class'=>'upload')); ?>
			    </div>
			 </div>
		</div> 
	 </div>
	
	<div class="row">
		<div class="col-sm-4">
		    <div class="form-group">
			<?php echo $this->Form->button('Save', array('type' => 'submit','class' => 'btn btn-success'));?> 
			<button class="btn btn-danger" type="button">Cancel</button>
		    </div>
		</div>
	</div>
    <?php echo $this->Form->end(); ?>
    
    
</div>