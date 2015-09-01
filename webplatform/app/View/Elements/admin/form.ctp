<div class="upper_table_form">
	<div class="row">
		<div class="col-md-8 col-md-12">
			<div class="inner_full_wrap">
			   <?php echo $this->Form->create('Post',array('id'=>'import_post_form','type'=>'file','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
				<div class="input-group-mn">
					<div class="input-group">
						<input type="text" class="form-control" readonly>
						<span class="input-group-btn">
							<span class="btn btn-primary btn-file">
							Upload CSV Data  <?php echo $this->Form->input('post_csv_file',array('type'=>'file')); ?>
							<input type="hidden" value="1" name="import_list">
							<input type="hidden"  id="imagesImport">
							</span>
						</span>
					</div>
				</div>
				<?php echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-default my_btn'));?> 
			    <?php echo $this->Form->end(); ?>	
			</div>
			<div class="inner_full_wrap">
			    <a href="<?php echo URL_SITE ?>/files/postfile.csv" class="download_sample"><i class="fa fa-file-excel-o"></i><span>Sample Download</span></a>
			</div>
		</div>
		<div class="col-md-4 col-lg-4  pull-right">
			<div class="inner_full_wrap">
			    <a href="#" class="btn btn-default my_btn pull-right low_pad_btn checkboxlist" style="display:none"><i class="fa fa-trash-o"></i></a>
			 </div>
			<div class="inner_full_wrap text_right"><b><a href="javascript:void(0)" class="add_more add_more2">Add more</a></b></div>
		</div>
	</div>
</div>
<div class="update_table">
    <?php echo $this->Form->create('Post',array('id'=>'add_post_form','class'=>'form','type'=>'file','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="form-group">
			    <label for="exampleInputEmail1">Post Title</label>
			     <?php echo $this->Form->input('description',array('type'=>'text','maxlength'=>30,'class'=>'form-control','placeholder'=>'Description')); ?>
			     <input type="hidden" name="data[Post][post_image]" id="postimage" />
			     <input type="hidden" name="postImages[]" id="postimages" />
			     <input type="hidden" name="data[Post][rowCount]" id="rowCount" />
			</div>
		</div>
		<div class="col-sm-6 col-md-4">
			<div class="form-group">
			    <label for="exampleInputEmail1">Users<b>*</b></label>
			    <?php echo $this->Form->input('user',array('type'=>'text','maxlength'=>30,'class'=>'form-control','placeholder'=>'User')); ?>
			</div>
		</div>
		<div class="col-sm-6 col-md-4">
			<div class="form-group">
			    <label for="exampleInputEmail1">Date/Time</label>
			     <?php echo $this->Form->input('post_date',array('type'=>'text ','class'=>'form-control','placeholder'=>'Date','autocomplete'=>'off')); ?>
			</div>
		</div>
		
		
		
		
	 </div>
	 <div class="row">

		<!--<div class="col-sm-4">
			<div class="form-group">
			    <label></label>
			    <div class="newfileUpload">
				<span>Upload CSV Data</span>
				<input type="file" class="upload">
			    </div>
			    <div class="clearfix"></div>
			</div>
	        </div>-->
		<div class="col-sm-6 col-md-4">
		    <div class="form-group">
			<label for="exampleInputEmail1">Address<b>*</b></label>
			<?php echo $this->Form->input('address',array('type'=>'textarea ','rows'=>3,'class'=>'form-control','placeholder'=>'Address')); ?>
			<span class="failure"></span>
		    </div>
		</div>
		<div class="col-sm-6 col-md-4">
			<div class="form-group">
			    <label for="exampleInputEmail1">Upload Image<b>*</b></label>
			    <div class="input-group-mn input-group-mn2">
					<div class="input-group">
						<input type="text" class="form-control" readonly>
						<span class="input-group-btn">
							<span class="btn btn-primary btn-file">
							Browse  <?php echo $this->Form->input('postImage',array('type'=>'file')); ?>
							<input type="hidden" value="1" name="import_list">
							<input type="hidden"  id="imagesImport">
							</span>
						</span>
					</div>
				</div>
			  </div>
		</div>
		
	</div>
	<div class="row">
		<div class="col-xs-12">
		    <div class="form-group form-btn-row">
			<?php echo $this->Form->button('Save', array('type' => 'submit','class' => 'btn btn-success'));?> 
			<button class="btn btn-danger" type="button">Cancel</button>
		    </div>
		</div>
	</div>
    <?php echo $this->Form->end(); ?>
    
    
</div>