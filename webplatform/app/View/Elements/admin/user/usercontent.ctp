<div class="btm_table">
	<div class="upper_table_wrap">
	    <h3 class="range_title">Select Range</h3>
		<div class="inner_full_wrap select_drop">
			<!--<div class="form-group form-group-custom custom-selectric">
				<label>Min</label>
				    <select>
					    <option>100</option>
					    <option>200</option>
					    <option>500</option>
					    <option>1000</option>
				    </select>
				<label>Max</label>
				    <select>
					<option>100</option>
					<option>200</option>
					<option>500</option>
					<option>1000</option>
				    </select>
				<input type="submit" value="submit" name="" class="btn btn-default my_btn mob_my_btn">
			    </div>-->
		 </div>
	</div>
	
	<h6 class="title_btm_table">Posts</h6>
	 <?php echo $this->Form->create('Post',array('url'=>array('controller'=>'posts','action'=>'savedata'),'id'=>'admin_post','type'=>'file','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
		
	 <div class="table_wrapper">
		    <table id="example" class="table" cellspacing="0" width="100%">
			<thead>
			  <tr>
			     <th><input type="checkbox" class="checkall" value="action" id="check-1" name="genre"></th>
			     <th>FirsName</th>
			     <th>Username</th>
			     <th>Email</th>
			     <th>Media</th>
			     <th>Status</th>
			     <th>Actions</th>
			 </tr>
			</thead>
			<tbody class="dyntable"></tbody>
			<table id="images" style="display:none"></table>
		    </table>
	</div>
	
	<?php echo $this->Form->button('Submit', array('type' => 'submit','class' => 'my_btn btn btn-default postlist'));?> 
	<?php  echo $this->Form->end(); ?>
	<!--<div class="prev_next"><a href="#">
		<i class="fa fa-angle-left"></i></a>
		<span>1 of 6666</span><a href="#">
		<i class="fa fa-angle-right"></i></a>
	</div>-->
</div>