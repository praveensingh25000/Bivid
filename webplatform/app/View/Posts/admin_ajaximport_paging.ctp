<?php
  if(!empty($postDataInfo)){
    foreach($postDataInfo as $postData){
		    $lat=$long='';
		     
		 if(!empty($postData['Post']['address'])){
		       list($lat,$long)=$this->Common->getAddress($postData['Post']['address']);
		 }
		 

		    $key = array_search($postData['Post']['user'], $users);
?>
<tr class="posts red"    id="post<?php echo $postData['Post']['description']?>">
                <input type="hidden" value="<?php echo $limit;?>" id="pageCounter">
		<td align="center"><input type="checkbox" name="checkboxes[]" class ="checkboxlist"  ></td>
		<input type="hidden" value="<?php echo $limit;?>" id="pageCounter">
		<?php if(!empty($postData['Post']['description']))?>
		<input type="hidden" name="description[]" value="<?php if(!empty($postData['Post']['description'])) echo $postData['Post']['description']?>" />
		<?php if(!empty($postData['Post']['address']))?>
		<input type="hidden" class="postaddress" name="address[]" value="<?php if(!empty($postData['Post']['address'])) echo $postData['Post']['address']?>" />
		<?php if(!empty($lat))?>
		<input type="hidden" name="lat[]" value="<?php  if(!empty($lat)) echo $lat?>" />
		<?php if(!empty($long))?>
		<input type="hidden" name="long[]" value="<?php if(!empty($long)) echo $long?>" />
		
		<input class="userId" type="hidden" name="user_id[]" value="<?php  if($key){ echo $key;}?>" />
		
		<?php if(!empty($postData['Post']['user']))?>
		<input class="userName" type="hidden" name="user_name[]" value="<?php if($key){ echo $postData['Post']['user'];}?>" />
		<?php if(!empty($postData['Post']['postImage']['name'])){?>
		<?php  $filename = $postData['Post']['description'].'.'.$pathInfo['extension'];
	               $folder_url.='/'.strtolower($filename);
		       $postData['Post']['description'].'.'.$pathInfo['extension'];
		       move_uploaded_file($postData['Post']['postImage']['tmp_name'], $folder_url);
	       ?>
	       <input type="hidden" name="post_image[]" value="<?php echo $filename?>" />
               <input type="hidden" name="postImage[]" value="<?php echo $filename?>" />
		<?php }?>
		<input type="hidden" value="1" name="import_list">
		<?php if(!empty($postData['Post']['post_date']))?>
		<input type="hidden" name="post_date[]" value="<?php  if(!empty($postData['Post']['post_date'])) echo $postData['Post']['post_date']?>" />
                <td align="left" class="description <?php if(!empty($postData['Post']['description'])){ echo 'txtgreen';}else{ echo 'txtred';}?>" id="<?php if(!empty($postData['Post']['description']))echo $postData['Post']['description']?>" ><?php if(!empty($postData['Post']['description']))echo ucfirst($postData['Post']['description']);?></td>
                <td align="left" class="<?php if($key){ echo 'txtgreen';}else{ echo 'txtred';}?>" class="postuser" id="<?php if(!empty($postData['Post']['user']))echo $postData['Post']['user']?>" ><?php if($key){ echo $postData['Post']['user'];}else{ echo "Invalid User";}?></td>
		<td align="left" class="<?php if($lat){ echo 'txtgreen';}else{ echo 'txtred';}?> latlong" id="<?php if(!empty($postData['Post']['lat']))echo $postData['Post']['lat']?>" ><?php if(!empty($lat) && !empty($long)) {echo $lat.'/'.$long;}else{ echo 'Not Found';} ?></td>
		<td align="left" class="txtred"><?php if(!empty($postData['Post']['postImage'])){echo $postData['Post']['postImage'];}else{echo $postData['Post']['description']; }?></td>
		<td align="left" class="txtgreen">Pic</td>
		
		<td>
                <a class="editrow" href="#add_post_form" id"=<?php echo $postData['Post']['description']?>"><i class="fa fa-pencil-square-o"></i></a>
		<a href="#" class="delrow",id="del<?php echo $postData['Post']['description']?>"><i class="fa fa-trash-o"></i></a>
		</td>
		
</tr>


<?php }}else{
     echo "<span class='msg'> There is no post </span>";
    } ?>
<script>
$(document).ready(function() {
// var inputArray='<?php echo json_encode($postDataArray);?>';
 var page=$("#pageCounter").val();
 
 
 $('.delrow').click(function(){
	if (confirm("Are you sure?")) {
	   $(this).parent().parent().remove();
           
	}
        $('tr.posts').each(function() {
              if ($('.posts').hasClass('green') && !$('.posts').hasClass('red'))
		 {
		   $(".postlist").show();
		  }else{
		   $(".postlist").hide();
		 }
           });
    return false;
});
 $('.editrow').click(function(){
    scrollTop();
 parentId=$.trim($(this).parent().parent().attr('id'));
	$('.form').show();
	//$('#add_post_form')[0].reset();
	$("#PostUser").tokenInput("clear");
	var description=$('#'+parentId).children('td.description').attr('id');
	var postaddress=$('#'+parentId).children('.postaddress').val();
	var id=$('#'+parentId).children('.userId').val();
	var name=$('#'+parentId).children('.userName').val();
	$("#PostUser").tokenInput(<?php echo $userArray?>,{
	    prePopulate: [
		    {id: id, name: name},
		    
		    ],
	    tokenLimit: 1
	    });
	$('ul.token-input-list:not(:last)').remove();
	$("#PostDescription").val(description);
	$("#PostAddress").val(postaddress);
	 return false;
});

   
 
});
</script>