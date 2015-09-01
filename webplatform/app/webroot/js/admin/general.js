function loader_show(divid,classname,content){
    jQuery('#'+divid+'').html("<div class = "+classname+">"+content+"</div>").show();
    jQuery('#'+divid+'').delay(5000).fadeOut('slow');
}

function loader_hide(divid){
    jQuery('#'+divid+'').html('').hide();
}

function scrollTop(){
	$("html, body").animate({ scrollTop: 0 }, "slow");
}
function scrollBottom(){
	$("html, body").animate({ scrollTop: $(document).height() }, 1000);
}

function scrollToSelected(divid){
	$('html, body').animate({ scrollTop: $('#'+divid+'').position().top }, 1000);
}

function succuss(message){		
	jQuery.blockUI({ 
		message: (message), 
		fadeIn: 700, 
		fadeOut: 700, 
		timeout: 6000, 
		showOverlay: false, 
		centerY: false, 
		css: {
		    position:'absolute',border: '1px solid #C1D779',width:'100%',top:'53px',left:'0',padding:'5px',backgroundColor:'#EFFEB9',font:'25px', color: '#70A300' 
		} 
	}); 
}

function error(message){		
	jQuery.blockUI({ 
		message: (message), 
		fadeIn: 700, 
		fadeOut: 700, 
		timeout: 6000, 
		showOverlay: false, 
		centerY: false, 
		css: {
			position:'absolute',border: '1px solid #C1D779',width:'100%',top:'53px',left:'0',padding:'5px',backgroundColor:'#FAD5CF',font:'25px', color: 'red'
		} 
	}); 
}

function alertmsg(message){		
	jQuery.blockUI({ 
		message: (message), 
		fadeIn: 700, 
		fadeOut: 700, 
		timeout: 6000, 
		showOverlay: false, 
		centerY: false, 
		css: {

			position:'absolute',border: '1px solid #C1D779',width:'100%',top:'0',left:'-12px',padding:'5px',backgroundColor:'#FFE9AD',font:'25px', color: '#70A300'
		} 
	}); 
}

jQuery(document).ready(function() {
    /* check and uncheck functionality Start*/
    jQuery('.checkall').click(function() {
		//alert("clicked");
        if (!jQuery(this).is(':checked')) {
            jQuery('.dyntable input[type=checkbox]').each(function() {
                jQuery(this).attr('checked', false);
            });
        } else {
            jQuery('.dyntable input[type=checkbox]').each(function() {
                jQuery(this).attr('checked', true);
            });
        }
    });
    jQuery('.checkboxlist').click(function() {
        var selectedCounter = 0, no_of_records = 0;
        jQuery('.dyntable input[type=checkbox]').each(function() {
            no_of_records++;
            if (jQuery(this).is(':checked')) {
                selectedCounter++;
            }
        })
        checkAllStatus = (no_of_records == selectedCounter) ? true : false;
        jQuery('.checkall').attr('checked', checkAllStatus);
    });
    jQuery('#operationId').click(function() {
        var selectedCounter = 0;
        jQuery('.dyntable input[type=checkbox]').each(function() {
            if (jQuery(this).is(':checked')) {
                selectedCounter++;
            }
        });
        if (selectedCounter < 1)
        {
            alert('Please select the at least one record.');
            return false;
        }
        return confirm("Are you sure you wish to continue?");
    });
    jQuery('#statusId').change(function() {
        $class = (jQuery(this).val() == '') ? 'btn btn-default disabled' : 'btn btn-default';
        jQuery('#operationId').attr('class', $class);
    });
    /* check and uncheck functionality End*/
    /*for admin_addedit.ctp:: dynamic show/hide of assign patients---------STARTS*/
    $("#UserGroupId").change(function() {
        var value = $(this).val();
        if (value == 3) {
            $("#assignPatientToAdvocate").show();
        } else {
            $("#assignPatientToAdvocate").hide();
        }
    });
    /*for admin_addedit.ctp:: dynamic show/hide of assign patients---------END*/

});