<script src="http://loopj.com/jquery-tokeninput/src/jquery.tokeninput.js" type="text/javascript"></script>
<?php echo $this->Html->script('admin/jquery.datetimepicker');?>
<?php echo $this->Html->css('admin/jquery.datetimepicker');?>
<?php echo $this->Html->script('admin/jquery.mCustomScrollbar.concat.min');?>
<?php echo $this->Html->css('admin/jquery.mCustomScrollbar');?>
<div class="main tabsdiv">
    <div id="loader"></div>
	<div class="tab-row">            
		<div class="tab-content">
		    <div id="step1" class="tab-pane active">
			<div class="row">
			    <div class="col-sm-8 left_user">
				<?php echo $this->element('admin/form'); ?>
				<?php echo $this->element('admin/postcontent'); ?>
			    </div>
			    <?php echo $this->element('admin/right_column'); ?>
			</div>
		    <div class="clearfix"></div>
		    </div>
		</div>
		<input type="hidden" value="" id="pageCounter">
	</div>
</div>


<!--<script src="/webplatform/js/admin/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
(function($){
$(window).load(function(){
$(".table_wrapper").mCustomScrollbar({
snapAmount:40,
scrollButtons:{enable:true},
keyboard:{scrollAmount:40},
mouseWheel:{deltaFactor:40},
scrollInertia:400,
 callbacks:{
   onTotalScroll:function(){
   $('#loader').addClass('loader'); 
   inputArray=$("#inputArray").val();
   page=$("#pageCounter").val();
      $.ajax({
		      type: "POST",
		      data:"inputArray="+inputArray,     
		      url : URL_SITE+"/admin/posts/ajaximport_paging/"+page,
		      success:function(data) {
				$('.dyntable').append(data);
				$('#loader').removeClass('loader');
		                var pageCounter=Number($("#pageCounter").val())+1;
				$("#pageCounter").val(pageCounter)
		      }
		    });
   
   }
 }
});
});
})(jQuery);
</script>-->
<style>
.table_wrapper {
  overflow:auto;  
  max-height:300px; 
}
</style>


<script type="text/javascript">
 $(window).load(function(){
    $(".my_scroll").mCustomScrollbar({
	    advanced:{updateOnContentResize: true}
				 //advanced:{autoExpandHorizontalScroll:true}
    });
});
$(document).ready(function() {
    
      
    $(".table_wrapper").scroll(function(){
	//console.log($(window).scrollTop())
	//console.log($(window).height())
	//console.log($(document).height())
	//console.log($(document).height());
//			if  ($(".table_wrapper").scrollTop()==1652){
//			    $('#loader').addClass('loader'); 
//   inputArray=$("#inputArray").val();
//   page=$("#pageCounter").val();
//      $.ajax({
//		      type: "POST",
//		      data:"inputArray="+inputArray,     
//		      url : URL_SITE+"/admin/posts/ajaximport_paging/"+page,
//		      success:function(data) {
//				$('.dyntable').append(data);
//				$('#loader').removeClass('loader');
//		                var pageCounter=Number($("#pageCounter").val())+1;
//				$("#pageCounter").val(pageCounter)
//		      }
//		    });
//			   
//			}
		}); 
    
   
    $('#PostPostDate').datetimepicker({
        minDate: 0,
        format:'Y-m-d H:i'
       });
	
    $("#PostUser").tokenInput(<?php echo $userArray?>,
     {
	tokenLimit: 1
    });
    $('.add_more').click(function(){
	    $('#add_post_form').toggle();
    });
    $('.btn-danger').click(function(){
    $('.add_more').css("display","show");
    $('#add_post_form')[0].reset();
    $('#add_post_form').hide();
    })
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
         
	 
	    $('.add_more').css("display","show");
	    var postImage=$("#postimage").val();
            var selectImage=$("#PostPostImage").val();
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
	    
	   if(postImage!="" && user!="" && address!="") {
	      $('#loader').addClass('loader');
	      $.ajax({ 
		    type:'POST',     
		    url : URL_SITE+"/admin/posts/add/",
		    data: formData,
		    success:function(data) {
			$('#loader').removeClass('loader');
			
			$('.deleteall').show();
			if($.trim(data)=="failure"){
			    $("span.failure").text("Please fill the right address");
			    $('.form').show();
			}else{
			   
			    $('.dyntable').append(data);
			     //$("#rowCount").val(rowCount);
			     //rowCount++;
			         
		//            rowCount= $('tr.posts').length;
		//	    $('tr.posts').append('<td>'+ rowCount +'</td>');
			  //    $('#images').append(data);
			//    setTimeout(function(){
			//	var data2 = $('#images').html();
			//	$('.dyntable').append(data2);
			//    },100)
			    $('.form').hide();
			}
			var seen = {};
			$('tr.posts').each(function(index) {
			    
			     var id = $(this).attr('id');
			     if(seen[id]){
				$("#post").remove();
				$("#"+$.trim(id)).remove();
				}else{
				 seen[id] = true;
				}
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
					$table  = $('.dyntable'),        // cache the target table DOM element
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
			//console.clear();	   
			       }
		       
		});
	}else if(selectImage!="" && user!="" && address!="") {
	      $('#loader').addClass('loader');
	      $.ajax({ 
		    type:'POST',     
		    url : URL_SITE+"/admin/posts/add/",
		    data: formData,
		    success:function(data) {
			$('#loader').removeClass('loader');
			
			$('.deleteall').show();
			if($.trim(data)=="failure"){
			    $("span.failure").text("Please fill the right address");
			    $('.form').show();
			}else{
			   
			    $('.dyntable').append(data);
			     //$("#rowCount").val(rowCount);
			     //rowCount++;
			         
		//            rowCount= $('tr.posts').length;
		//	    $('tr.posts').append('<td>'+ rowCount +'</td>');
			  //    $('#images').append(data);
			//    setTimeout(function(){
			//	var data2 = $('#images').html();
			//	$('.dyntable').append(data2);
			//    },100)
			    $('.form').hide();
			}
			var seen = {};
			$('tr.posts').each(function(index) {
			    
			     var id = $(this).attr('id');
			     if(seen[id]){
				$("#"+$.trim(id)).remove();
				}else{
				 seen[id] = true;
				}
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
					$table  = $('.dyntable'),        // cache the target table DOM element
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
			//console.clear();	   
			       }
		       
		});
	      
	     }else{
	      alert("Please fill the required fields");
	     }
        return false;
    });
    $('.checkall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkboxlist').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.checkboxlist').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
	if ($(".dyntable").html()!="") {
	  $(".low_pad_btn").toggle();
	}
    });

    $(".low_pad_btn").click(function(){
     if($('.checkall').is(":checked")){
	    if (confirm("Are you sure?")) {
		$(".dyntable").html('');
		//$(".table_wrapper").css({"max-height":"0px"})
		$(".checkall").attr('checked', false);
		}
	}
	return false;
    });
$("#import_post_form").submit(function(){
    
    var formData = new FormData($(this)[0]);
    if ($("#PostPostCsvFile").val()!="") {
	$('#loader').addClass('loader');
	     $.ajax({
		url: URL_SITE+"/admin/posts/ajaximport",
		type: 'POST',
		data: formData,
		async: false,
		success: function (data) {
		 $('#loader').removeClass('loader');
		   //$("#pageCounter").val('2')
		   if(data=="failure"){
		     $("span.failure").text("Please fill all the address filed in csv");
		    }else{ 
		    $('.dyntable').html(data);
		    $('.table_wrapper').css({height: '401px' });
		    }
		   if ($("ul.images").html()!="") {
			  $.ajax({
				type:'POST',     
				url : URL_SITE+"/admin/posts/postdata/",
				cache: false,
				data: $('#admin_post').serialize(),
				success:function(data) {
					$('.dyntable').html(data);
					//$table  = $('#sort-table'),        // cache the target table DOM element
					//$rows   = $('tbody > tr', $table); // cache rows from target table body
					//$rows.sort(function(a, b) {
					//    var keyA = $('td',a).text();
					//    var keyB = $('td',b).text();
					//    return (keyA > keyB) ? 1 : 0;  // A bigger than B, sorting ascending
					//    
					//});
					//$rows.each(function(index, row){
					//    $table.append(row);                  // append rows after sort
					//});
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
           
	    
            var uri = URL_SITE+"/admin/posts/sendfile";
	    var xhr = new XMLHttpRequest();
	    var fd = new FormData();
	    xhr.open("POST", uri, true);
	    xhr.onreadystatechange = function() {
	      $('#loader').addClass('loader');
		if (xhr.readyState == 4 && xhr.status == 200) {
		        $('#loader').removeClass('loader'); 
		        $("ul.images").append(xhr.responseText);
			$("table#images").append(xhr.responseText);
			$('#add_post_form')[0].reset();
			if ($(".dyntable").html()!="") {
			    $.ajax({  
			       type:'POST',     
			       url : URL_SITE+"/admin/posts/postdata/",
			       cache: false,
			       data: $('#admin_post').serialize(),
			       success:function(data) {
			        $('.dyntable').html(data);
			       
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

<script>
    $(document).on('change', '.btn-file :file', function() {
	
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
});
</script>

    