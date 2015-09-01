<?php echo $this->Html->script('admin/jquery.datetimepicker.js');?>
<?php echo $this->Html->css('admin/jquery.datetimepicker');?>
<div class="main tabsdiv">
    <div id="loader" style="z-index:1"></div>
	<div class="tab-row">            
		<div class="tab-content">
		    <div id="step1" class="tab-pane active">
			<div class="row">
			    <div class="col-sm-8 left_user">
				<?php echo $this->element('admin/user/form'); ?>
				<?php echo $this->element('admin/user/usercontent'); ?>
			    </div>
			    <?php echo $this->element('admin/user/right_column'); ?>
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
  margin-top:20px;
  max-height:401px; 
}
</style>


<script type="text/javascript">
$(document).ready(function() {
	 $('.add_more').click(function(){
	     $('#add_user_form').toggle();
         });
	 
	  $("#add_user_form").submit(function(e){
	    var user=$("#UserUsername").val();
	    var formData = new FormData($(this)[0]);
	    var userForm=$('#add_user_form').serializeArray();
	    e.preventDefault();
	    if (formData!="") {
		$.each(userForm,function(key,input){
		    formData.append(input.name,input.value);
		   });
	    }
	    
	   if(user!="") {
	      $('#loader').addClass('loader');
	      $.ajax({ 
		    type:'POST',     
		    url : URL_SITE+"/admin/users/add/",
		    data: formData,
		    success:function(data) {
			$('#loader').removeClass('loader');
			
			$('.deleteall').show();
			if($.trim(data)=="failure"){
			    $("span.failure").text("Please fill the right address");
			    $('.form').show();
			}else{
			    $('.dyntable').append(data);
			//    $('#images').append(data);
			//    setTimeout(function(){
			//	var data2 = $('#images').html();
			//	$('.dyntable').append(data2);
			//    },100)
			    $('.form').hide();
			}
			var seen = {};
			$('tr.users').each(function() {
			     var id = $(this).attr('id');
			     if(seen[id]){
				$("#"+$.trim(id)).remove();
				}else{
				 seen[id] = true;
				}
			});
			$('#add_user_form')[0].reset();
			
			
			if ($(".images").html()!="") {
			  $.ajax({
				type:'POST',     
				url : URL_SITE+"/admin/users/postdata/",
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
					$('tr.users').each(function() {
					
					   if ($('.users').hasClass('green') && !$('.users').hasClass('red'))
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
				   $('tr.users').each(function() {
					 if ($('.users').hasClass('green') && !$('.users').hasClass('red'))
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
});
</script>

<style>
.dragcontent{margin:-25px 0px 0px 0px;}
.postlist{display:none;}
#add_user_form{display:none;} 
.deleteall{display:none}
.txtred{color:red !important}
.txtgreen{color:green !important}
</style>
    