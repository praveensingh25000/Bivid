jQuery(document).ready(function(){
    
    jQuery(".arrowdown").click(function(){
	jQuery(this).parent('li').attr('data-label');	
	jQuery(this).parent('li').attr('data-label');
    });
    
    jQuery("#next").click( function() {  
    });
    jQuery("#prev").click( function() {   
    });    
    
    jQuery(".slider-div").mCustomScrollbar({
        axis:"x",
        callbacks:{
            onTotalScroll:function(){                
                var limitCounter = Number(jQuery('#limitCounter').val());
                var limtwidth    = Number(jQuery('#limitwidth').val());
                var hours        = jQuery('#PostHours').val();
                jQuery('#mCSB_1_container').addClass('floader').show();
                jQuery.ajax({
                    type: "POST",
                    data:"hours="+hours,
                    url : URL_SITE+"/admin/posts/index_ajax/"+limitCounter,		
                    success: function(msg){
                        jQuery('#mCSB_1_container').removeClass('floader').show();
                        if (jQuery.trim(msg)!='0') {
                            limitCounter = limitCounter+10;
                            widthData    = limtwidth+1920;
                            jQuery("#mCSB_1_container").width(widthData);
                            jQuery("#slideshowDivid").width(widthData);
                            jQuery('#limitwidth').val(widthData);
                            jQuery('#limitCounter').val(limitCounter);
                            jQuery('#slideshowDivid').append(msg).show();
                        }else{
                            succuss('No more post');
                            scrollTop();
                        }
                        console.clear();
                    }							
                });
            }
        }
    });
	    
    var width = 0;
    jQuery('.slider-div li').each(function() {
	width += jQuery(this).outerWidth() + 24;
    });
	    
    jQuery('.slider-div ul').css("width",width+"px");
	    
    jQuery('.slider-div li').click(function(){
	jQuery('.slider-div li').removeClass("active");
	jQuery(this).addClass("active");		
	jQuery('.tab-contentdiv').removeClass("active");
	jQuery('#' + jQuery(this).attr('data-label')).addClass("active");
    });
});

function functionGetPostDetail(id,key){
    if(id){
        jQuery('#loader').addClass('loader');
        jQuery('#get_post_detail_data').html('').removeClass('active');
        jQuery.ajax({
            type: "POST",
            url : URL_SITE+"/admin/posts/post_detail/"+id+'/'+key,		
            success: function(msg){
                jQuery('#loader').removeClass('loader');
                jQuery('#get_post_detail_data').addClass('active');
                jQuery('#get_post_detail_data').html(msg).show(); 
                console.clear();
            }							
        });	
    }
    return false;
}

function getSortedPostDetail(hours){    
    jQuery('#mCSB_1_container').addClass('floader').show();
    jQuery.ajax({
        type: "POST",
        data:"hours="+hours,
        url : URL_SITE+"/admin/posts/index_ajax/"+0,	
        success: function(msg){
            jQuery('#mCSB_1_container').removeClass('floader').show();
            if (jQuery.trim(msg)!='0') {
                jQuery('#slideshowDivid').html(msg).show();            
                jQuery('#get_post_detail_data').html('').removeClass('active');
                var postID = jQuery('#postID').val();
                var key    = jQuery('#postKey').val();
                functionGetPostDetail(postID,key);
            }else{
                succuss('No post found');
                scrollTop();
            }
            console.clear();
        }							
    });
}
