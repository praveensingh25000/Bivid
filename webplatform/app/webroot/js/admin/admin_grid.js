jQuery(document).ready(function(){
    jQuery(".close, body").click(function(e){
	jQuery("video").each(function () { this.stop() });				
    });
});

jQuery(document).ready(function(){
    $(window).scroll(function(){
	if ($(window).scrollTop() == $(document).height() - $(window).height()){
	    jQuery('#show-more-content-loader').show();
	    var limitCounter = Number(jQuery('#limitCounter').val());
	    var hours        = jQuery('#PostHours').val();
	    var keyword      = jQuery("#SearchName").val();
	    var content_type = jQuery("#PostContentType").val();
	    jQuery.ajax({
		type: "POST",
		data:"hours="+hours+"&keyword="+keyword+"&content_type="+content_type,
		url : URL_SITE+"/admin/posts/index_ajax/"+limitCounter,		
		success: function(msg){
		    jQuery('#show-more-content-loader').hide();
		    if (jQuery.trim(msg)!='0') {
			limitCounter = limitCounter+30;
			jQuery('#limitCounter').val(limitCounter);
			jQuery('#slideshowDivid').append(msg).show();	
		    }else{
			succuss('There is no more post.');
			scrollTop();
		    }
		    console.clear();
		}							
	    });	    
	}
    });
});

function functionLoadMoreData(){
    jQuery('#show-more-content-loader').show();
    var limitCounter = Number(jQuery('#limitCounter').val());
    var hours        = jQuery('#PostHours').val();
    var keyword      = jQuery("#SearchName").val();
    var content_type = jQuery("#PostContentType").val();
    jQuery.ajax({
	type: "POST",
	data:"hours="+hours+"&keyword="+keyword+"&content_type="+content_type,
	url : URL_SITE+"/admin/posts/index_ajax/"+limitCounter,		
	success: function(msg){
	    jQuery('#show-more-content-loader').hide();
	    if (jQuery.trim(msg)!='0') {
		limitCounter = limitCounter+30;
		jQuery('#limitCounter').val(limitCounter);
		jQuery('#slideshowDivid').append(msg).show();	
	    }else{
		succuss('There is no more post.');
		scrollTop();
	    }
	    console.clear();
	}							
    });	    
}

function functionGetPostGridDetail(id,key){
    if(id){
	jQuery('#get_post_grid_detail').html('').hide();
        jQuery('#tab'+id).addClass('floader');
        jQuery.ajax({
            type: "POST",
            url : URL_SITE+"/admin/posts/post_detail/"+id+'/'+key,		
            success: function(msg){
                jQuery('#tab'+id).removeClass('floader');
		jQuery('#gMapsLoaded').val(1);
                jQuery('#get_post_grid_detail').html(msg).show();
		jQuery('#myModal').modal('toggle');
                console.clear();
            }							
        });	
    }
    return false;
}

function getSortedPostDetail(hours){ 
    var keyword      = jQuery("#SearchName").val();    
    var content_type = jQuery("#PostContentType").val();    
    jQuery('#loader').addClass('floader').show();
    jQuery.ajax({
        type: "POST",
        data:"hours="+hours+"&keyword="+keyword+"&content_type="+content_type,
        url : URL_SITE+"/admin/posts/index_ajax/"+0,	
        success: function(msg){
            jQuery('#loader').removeClass('floader').show();
            if (jQuery.trim(msg)!='0') {
                jQuery('#slideshowDivid').html(msg).show();
            }else{
                succuss('There is no matching post.');
                scrollTop();
            }
            console.clear();
        }							
    });
}

function getFakeRealPostDetail(content_type){
    var hours        = jQuery('#PostHours').val();    
    var keyword      = jQuery("#SearchName").val();    
    jQuery('#loader').addClass('floader').show();
    jQuery.ajax({
        type: "POST",
        data:"hours="+hours+"&keyword="+keyword+"&content_type="+content_type,
        url : URL_SITE+"/admin/posts/index_ajax/"+0,	
        success: function(msg){
            jQuery('#loader').removeClass('floader').show();
            if (jQuery.trim(msg)!='0') {
                jQuery('#slideshowDivid').html(msg).show();
            }else{
                succuss('There is no matching post.');
                scrollTop();
            }
            console.clear();
        }							
    });
}

jQuery(document).ready(function(){    
    jQuery("#global_search_form").submit(function(e){	
	e.preventDefault();
	var searchType  = jQuery("#SearchSearchKeyword").val();		
	if (searchType=='1') {
	    error('Please select a content Type');
	    return false;
	}
	$('#PostHours').prop('selectedIndex', 0).selectric('refresh');
	$('#PostContentType').prop('selectedIndex', 0).selectric('refresh');
	var keyword = jQuery("#SearchName").val();
	jQuery('#loader').addClass('floader').show();
	jQuery.ajax({
	    type: "POST",
	    data:"keyword="+keyword,
	    url : URL_SITE+"/admin/posts/index_ajax/"+0,	
	    success: function(msg){
		jQuery('#loader').removeClass('floader').show();
		if (jQuery.trim(msg)!='0') {
		    jQuery('#slideshowDivid').html(msg).show();
		}else{
		    succuss('There is no matching post.');
		    scrollTop();
		}
		console.clear();
	    }							
	});	    
	return false;    
    });
});

function funInactivePostContent(id,status){
    var message       = 'Do you really want to deactivated this post?';
    var messageStatus = 'Post has been deactivated successfully';
    if (status=='1'){
	var message = 'Do you really want to activated this post?';
	var messageStatus = 'Post has been activated successfully';
    }
    if(id && confirm(message)){        
        jQuery.ajax({
            type: "POST",
            url : URL_SITE+"/admin/posts/post_status/"+id+'/'+status,		
            success: function(msg){
                jQuery('#post-status-message').html(messageStatus).show();
		jQuery('#post-status-message').delay(5000).fadeOut('slow');
		jQuery('#post-status-content').html(msg).show();
                console.clear();
            }							
        });	
    }
    return false;
}