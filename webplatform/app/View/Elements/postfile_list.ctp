<?php $folder_url = WWW_ROOT.'img/drag/post' ;
if(!empty($filesArray)){
    foreach($filesArray as $fileArray){
	       $now = time();
	       $filename = $now.$fileArray['name'];
	       $folder_url.='/'.strtolower($filename);
	       $imageName=preg_replace('/\\.[^.\\s]{3,4}$/', '',strtolower($fileArray['name']));
	       
	       $aExtraInfo = getimagesize($fileArray['tmp_name']);
               $sImage = "data:" . $aExtraInfo["mime"] . ";base64," . base64_encode(file_get_contents($fileArray['tmp_name']));
	   ?>
   <li>
                            <?php move_uploaded_file($fileArray['tmp_name'], $folder_url);?>  
			    <span><?php echo $fileArray['name'];?></span>
			    
			    <label>
				<?php echo $this->Html->link($this->Html->image("admin/view.png"), '', array('escape' => false,'class' => 'view','item'=>'post'.$imageName,'id'=>$fileArray['name']));
				      echo $this->Html->link($this->Html->image("admin/delete.png"), '', array('escape' => false,'class' => 'delete_image','id'=>$filename,'item'=>'post'.$imageName));
				?>
		           </label>
			    <input type="hidden" id="filename"  value="<?php echo $fileArray['name']?>" />
                            <input type="hidden" id="imageName" value="<?php echo $sImage?>" />
			    <input type="hidden" name="post_image[]" value="<?php echo $fileArray['name']?>" />
			    <input type="hidden" name="postImage[]" value="<?php echo $filename?>" />
			    <input type="hidden" name="tmp_name[]" value="<?php echo $fileArray['tmp_name']?>" />
    </li>
<?php }}?>
<script>  
$(document).ready(function() {
    $('ul.images .delete_image').unbind('click').click(function(){
	var imageName=$(this).attr('item');
	if (confirm("Are you sure?")) {
	   $(this).parent().parent().remove();
		$.ajax({
			url: URL_SITE+"/admin/posts/delteImage/"+$(this).attr('id'),
			type: 'POST',
			success: function (data) {
			    $('tr.posts').each(function() {
			    if ($.trim($(this).attr('item'))==$.trim(imageName)) {
				$(this).removeClass('green');
				image=$('#'+$(this).attr('id')).children('td.postimage').text();
				$('#'+$(this).attr('id')).children('td.postimage').text(image);
				$('#'+$(this).attr('id')).children('td.postimage').removeClass('txtgreen');
				$('#'+$(this).attr('id')).children('td.postimage').addClass('txtred');
				$('.postlist').hide();
				scrollTop();
			    }
			});
			    
			}
		  });
	}
	 
   return false;
});
     $('ul.images .view').unbind('click').click(function(){
	setTimeout(function(){
		    $("div#mCSB_1_container").css({"position":"relative", "top":"0px"});
		  
	 },100)
	scrollToSelected("show_image");
	var item=$.trim($(this).attr('item'));
	var fileName=$(this).parent().next().val();
	
	var popupImage=$(this).parent().next().next().next().next().val();
	var image=$(this).parent().next().next().val();
	$('#loader').addClass('loader');
	$.ajax({
			url: URL_SITE+"/admin/posts/view_image/",
			type: 'POST',
			data:{ fileName: fileName, image: image,popupImage:popupImage },
			success: function (data) {
			    $('#loader').removeClass('loader');
			    $("#show_image").html(data);
			    $('.modal').modal('show');
			    $('body').removeClass('modal-open');
			    $('body').removeAttr('style');
			    scrollTop();
			    
			}
		  });
	
        return false;
});
});
</script>

		