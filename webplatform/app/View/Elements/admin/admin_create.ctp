<script src="http://loopj.com/jquery-tokeninput/src/jquery.tokeninput.js" type="text/javascript"></script>
<link type="text/css" href="http://loopj.com/jquery-tokeninput/styles/token-input.css" rel="stylesheet">
<div id="loader"></div>
<div class="row col-lg-7">
       <div class="msg"></div>
       <fieldset style="border: 1px solid rgb(204, 204, 204); padding: 6px; margin-bottom: 28px;">
	<?php echo $this->Form->create('Post',array('id'=>'import_post_form','type'=>'file','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
			<div class="col-sm-12">
			    <div class="form-group">
				<label>Upload User CSV Data<span class="required"> * </span> <?php echo $this->Html->link('Download Sample File Format',"/files/userFileFormat.csv",array('escape' =>false));?></label>                
				<?php echo $this->Form->input('post_csv_file',array('type'=>'file','class'=>'validate[required]')); ?>
				<input type="hidden" value="1" name="import_list">
				
			    </div>
			</div>
			<div class="col-sm-12">
			    <?php echo $this->Form->button($buttonTextSubmit, array('type' => 'submit','class' => 'btn btn-default'));?> 
			 </div>
		<?php echo $this->Form->end(); ?>
	</fieldset>
       <fieldset style="border: 1px solid rgb(204, 204, 204); padding: 6px; margin-bottom: 28px;">
		<div class="table-responsive">
		    <?php echo $this->Form->create('Post',array('url'=>array('controller'=>'posts','action'=>'savedata'),'id'=>'admin_post','type'=>'file','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
				  <table class="table table-bordered table-hover table-striped tablesorter" id="sort-table">
					  <thead>
						  <tr>
						      <th class="th_checkbox"><input type="checkbox" class="checkall"></th>
						      <th>Post</th>
						      <th>User</th>
						      <th>Lat/Long</th>
						      <th>Media</th>
						      <th>type</th>
						      <th class="th_checkbox">Actions</th>
						  </tr>
					  </thead>
					  <tbody class="dyntable"></tbody>
					  <table id="images" style="display:none"></table>
				  </table>
				  <div class="col-sm-6">
				      <?php echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-default postlist'));?> 
				  </div>
		      <?php echo $this->Form->button('Delete', array('type' => 'button','class' => 'btn btn-default delete deleteall'));?> 
		      <?php  echo $this->Form->end(); ?>
		</div>
	</fieldset>
       
<fieldset style="clear:both;float: right; padding: 6px; margin-bottom: 28px;">
     <a href="javascript:;" class="add_more">Add More</a>
</fieldset>

<fieldset style="border: 1px solid rgb(204, 204, 204); padding: 6px; margin-bottom: 28px;">

	<div class="form">
		<?php echo $this->Form->create('Post',array('id'=>'add_post_form','type'=>'file','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
			<div class="col-sm-6">
				<div class="form-group form_margin">
				    <label>Post Title*</label>                
				    <?php echo $this->Form->input('description',array('type'=>'text','maxlength'=>30,'class'=>'form-control','placeholder'=>'Description')); ?>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form_margin">
				    <label>Users*</label>                
				    <?php echo $this->Form->input('user',array('type'=>'text','maxlength'=>30,'class'=>'form-control','placeholder'=>'User')); ?>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form_margin">
				    <label>Address*</label>                
				    <?php echo $this->Form->input('address',array('type'=>'textarea ','rows'=>3,'class'=>'form-control','placeholder'=>'Address')); ?>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group">
				    <label>Upload Image</label>                
				    <?php echo $this->Form->input('postImage',array('type'=>'file')); ?>
				</div>
			</div>
			<div class="col-sm-6">
			    <?php echo $this->Form->button('Save', array('type' => 'submit','class' => 'btn btn-default'));?> 
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</fieldset>
</div>

<div  class="col-sm-5 dragcontent">
<!-- Begin page content -->
    <div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
	    <div style="width:100%;" class="text-center" >
	    <h2> Drag and Drop File Upload </h2>
	     </div>
	     <table id="imagaDataDiv" style="margin: 30px; width: 500px; height: auto; border: 1px dotted grey; display: block;" class="images"></table>
	    <div id="dropzone" style="margin:30px; width:500px; height:300px; border:1px dotted grey;">Drag & drop your file here...</div>
	</div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	
    $("#PostUser").tokenInput(<?php echo $userArray?>,
     {
	tokenLimit: 1
    });
    $('.add_more').click(function(){
	    $('.form').toggle();
    });
     $("#admin_post").submit(function(){
	            $.ajax({
			       type:'POST',     
			       url : URL_SITE+"/admin/posts/savedata/",
			       cache: false,
			       data: $('#admin_post').serialize(),
			       success:function(data) {
				succuss(data);
				scrollTop()
				  //$(".msg").html(data);
				
				  $('.form').show();
				  $("#imagaDataDiv").html('').hide();
				  $(".dyntable").html('');
				  //location.reload();
				   }
			    });
		return false;    
     });
     $("#add_post_form").submit(function(e){
	    $('#loader').addClass('loader');
	    var postName=$("#PostDescription").val();
	    var user=$("#PostUser").val();
	    var address=$("#PostAddress").val();
	    var formData = new FormData($(this)[0]);
	    var userForm=$('#add_post_form').serializeArray();
	    e.preventDefault();
	    if (formData!="") {
		$.each(userForm,function(key,input){
		    formData.append(input.name,input.value);
		   });
	    }
	    
	   if(postName!="" && user!="" && address!="") {
	      $.ajax({ 
		    type:'POST',     
		    url : URL_SITE+"/admin/posts/add/",
		    data: formData,
		    success:function(data) {
			$('#loader').removeClass('loader');
			$('.form').hide();
			$('.deleteall').show();
			$('.dyntable').append(data);
			
			var seen = {};
			$('tr.posts').each(function() {
			     var id = $(this).attr('id');
			     if(seen[id]){
				$("#"+$.trim(id)).remove();
				}else{
				 seen[id] = true;
				}var className = $(this).attr('item');
			});
			$table  = $('#sort-table'),        // cache the target table DOM element
			$rows   = $('tbody > tr', $table); // cache rows from target table body
			$rows.sort(function(a, b) {
				var keyA = $('td',a).text();
				var keyB = $('td',b).text();
				return (keyA > keyB) ? 1 : 0;  // A bigger than B, sorting ascending
			});
			$rows.each(function(index, row){
			    $table.append(row);                  // append rows after sort
		        });
			$("#PostUser").tokenInput("clear");
			$('#add_post_form')[0].reset();
			
			
			if ($(".images").html()!="") {
			  $.ajax({
				type:'POST',     
				url : URL_SITE+"/admin/posts/postdata/",
				cache: false,
				data: $('#admin_post').serialize(),
				success:function(data) {
				         $('.form').hide();
					$('.dyntable').html(data);
					$('.deleteall').show();
					$table  = $('#sort-table'),        // cache the target table DOM element
					$rows   = $('tbody > tr', $table); // cache rows from target table body
					$rows.sort(function(a, b) {
					    var keyA = $('td',a).text();
					    var keyB = $('td',b).text();
					    return (keyA > keyB) ? 1 : 0;  // A bigger than B, sorting ascending
					    
					});
					$rows.each(function(index, row){
					    $table.append(row);                  // append rows after sort
					});
				 },complete:function(){
					$('tr.posts').each(function() {
					
					   if ($('.posts').hasClass('green') && !$('.posts').hasClass('red'))
					   {
						$(".postlist").show();
					   }else{
						 $(".postlist").hide();
						 
					    }
					    
					});
				    },
		    });
			
			}	
		    },
		cache: false,
		contentType: false,
		processData: false,
		complete:function(){
				   $('tr.posts').each(function() {
					 if ($('.posts').hasClass('green') && !$('.posts').hasClass('red'))
					   {
						$(".postlist").show();
					    }else{
						 $(".postlist").hide();
						 
					    }
					    
					});
			console.clear();	   
			       }
		       
		});
	}else{
	      alert("Please fill the required fields");
	     }
        return false;
    });
    $(".delete").click(function(){
	    if (confirm("Are you sure?")) {
		$(".dyntable").html('');
		$(".checkall").attr('checked', false);
		}
	return false;
    });
$("#import_post_form").submit(function(){
    $('#loader').addClass('loader');
    var formData = new FormData($(this)[0]);
    if ($("#PostPostCsvFile").val()!="") {
	     $.ajax({
		url: URL_SITE+"/admin/posts/ajaximport",
		type: 'POST',
		data: formData,
		async: false,
		success: function (data) {
		 $('#loader').removeClass('loader');
		   $('.dyntable').html(data);
		   if ($(".images").html()!="") {
			  $.ajax({
				type:'POST',     
				url : URL_SITE+"/admin/posts/postdata/",
				cache: false,
				data: $('#admin_post').serialize(),
				success:function(data) {
					$('.dyntable').html(data);
					$table  = $('#sort-table'),        // cache the target table DOM element
					$rows   = $('tbody > tr', $table); // cache rows from target table body
					$rows.sort(function(a, b) {
					    var keyA = $('td',a).text();
					    var keyB = $('td',b).text();
					    return (keyA > keyB) ? 1 : 0;  // A bigger than B, sorting ascending
					    
					});
					$rows.each(function(index, row){
					    $table.append(row);                  // append rows after sort
					});
				 },complete:function(){
					$('tr.posts').each(function() {
					
					    if ($('.posts').hasClass('green') && !$('.posts').hasClass('red'))
					   {
						$(".postlist").show();
					   }else{
						 $(".postlist").hide();
						 
					    }
					});
				    }
		    });
			}
		 },
		cache: false,
		contentType: false,
		processData: false
	    });
	}else{
	    alert("Please select the file to upload");
	    
	}
return false;
});
});
</script>
<script type="text/javascript">
function sendFile(file) {
            $('#loader').addClass('loader');
            var uri = URL_SITE+"/admin/posts/sendfile";
	    var xhr = new XMLHttpRequest();
	    var fd = new FormData();
	    xhr.open("POST", uri, true);
	    xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
		        $('#loader').removeClass('loader');
			$("table.images").append(xhr.responseText);
			$("table#images").append(xhr.responseText);
			if ($(".dyntable").html()!="") {
			    $.ajax({  
			       type:'POST',     
			       url : URL_SITE+"/admin/posts/postdata/",
			       cache: false,
			       data: $('#admin_post').serialize(),
			       success:function(data) {
			        $('.dyntable').html(data);
			        $('#add_post_form').find("input[type=text], input[type=file]").val("");
			      },complete:function(){
					$('tr.posts').each(function() {
					if ($('.posts').hasClass('green') && !$('.posts').hasClass('red'))
					   {
						$(".postlist").show();
					     }else{
						 $(".postlist").hide();
						 
					    }
					});
				    }
			   });
		    }
		}
	    };
	    fd.append('myFile', file);
	    // Initiate a multipart/form-data upload
	    xhr.send(fd);
}
window.onload = function() {
    var dropzone = document.getElementById("dropzone");
    dropzone.ondragover = dropzone.ondragenter = function(event) {
	    event.stopPropagation();
	    event.preventDefault();
    }
    dropzone.ondrop = function(event) {
	event.stopPropagation();
	event.preventDefault();
	var filesArray = event.dataTransfer.files;
	for (var i=0; i<filesArray.length; i++) {
	sendFile(filesArray[i]);
	}
    }
}
</script>
<style>
.dragcontent{margin:-25px 0px 0px 0px;}
.postlist{display:none;}
/*.form{display:none;} */
.btn-default {margin: 10px 3px 0 4px;}
.deleteall{display:none}
</style>
