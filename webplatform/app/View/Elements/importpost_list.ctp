<?php
if($check==0){
    unset($postDataInfo);
    }  
   $count=1;
   if(!empty($postDataInfo)){
    foreach($postDataInfo as $postData){
		      $lat=$long='';
		 if(!empty($postData['Post']['address'])){
		       list($lat,$long)=$this->Common->getAddress($postData['Post']['address']);
		 }
		 
           if(!empty($postData['Post'])){
		    $key = array_search(strtolower($postData['Post']['user']), $users);
		    $imageName=preg_replace('/\\.[^.\\s]{3,4}$/', '',strtolower($postData['Post']['postImage']));
		    $pathInfo= pathinfo($postData['Post']['postImage']);
           
?>
<tr class="posts red"    id="post<?php echo $count?>" item="post<?php echo strtolower($imageName)?>">
<input type="hidden" value="<?php //echo $count;?>" id="pageCounter">
<input type="hidden" name=rowCount[] value="<?php echo $count;?>" id="rowcounts">
		<td align="center"><input type="checkbox" name="checkboxes[]" class ="checkboxlist"  ></td>
		<input type="hidden" value="<?php //echo $limit;?>" id="pageCounter">
		<?php if(!empty($postData['Post']['description']))?>
		<input type="hidden" name="description[]" value="<?php if(!empty($postData['Post']['description'])) echo $postData['Post']['description']?>" />
		<?php if(!empty($postData['Post']['address']))?>
		<input type="hidden" class="postaddress" name="address[]" value="<?php if(!empty($postData['Post']['address'])) echo $postData['Post']['address']?>" />
		<?php if(!empty($postData['Post']['postImage']))?>
		<input type="hidden" name="postImages[]" value="<?php  if(!empty($postData['Post']['postImage'])) echo $postData['Post']['postImage']?>" />
		<?php if(!empty($lat))?>
		<input type="hidden" name="lat[]" value="<?php  if(!empty($lat)) echo $lat?>" />
		<?php if(!empty($long))?>
		<input type="hidden" name="long[]" value="<?php if(!empty($long)) echo $long?>" />
		
		<input class="userId" type="hidden" name="user_id[]" value="<?php  if($key){ echo $key;}?>" />
		
		<?php if(!empty($postData['Post']['user']))?>
		<input class="userName" type="hidden" name="userName[]" value="<?php if($key==""){echo $postData['Post']['user'];}?>" />
		<input class="user_name" type="hidden" name="user_name[]" value="<?php if($key){ echo $postData['Post']['user'];}?>" />
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
                <td align="left" class="postuser <?php if($key){ echo 'txtgreen';}else{ echo 'txtred';}?>"id="<?php if(!empty($postData['Post']['user']))echo $postData['Post']['user']?>" ><?php if($key){ echo $postData['Post']['user'];}else{ echo $postData['Post']['user'];}?></td>
		<td align="left" class="latlong <?php if($lat){ echo 'txtgreen';}else{ echo 'txtred';}?>"><?php if(!empty($lat) && !empty($long)) {echo $lat.'/'.$long;}else{ echo 'Not Found';} ?></td>
		<td align="left" class="postimage txtred"><?php if(!empty($postData['Post']['postImage'])){echo $postData['Post']['postImage'];}else{echo $postData['Post']['description']; }?></td>
		<td align="left" class="txtgreen"><?php if(strtolower($pathInfo['extension'])=="png"||strtolower($pathInfo['extension'])=="jpg"||strtolower($pathInfo['extension'])=="jpeg"||strtolower($pathInfo['extension'])=="gif"){?>Picture<?php }else{?>Video<?php }?></td>
		<td>
                <a class="editrow" href="#" id"=<?php echo $postData['Post']['description']?>"><i class="fa fa-pencil-square-o"></i></a>
		<a href="#" class="delrow" id="del<?php echo $postData['Post']['description']?>"><i class="fa fa-trash-o"></i></a>
		</td>
		
		
</tr>


<?php }$count++;}}

if(!empty($postDataInfos)){
    foreach($postDataInfos as $formData){
	//style="background-color:<?php if(!empty($formData['post_image'])){ echo 'green';}else{ echo 'red';}
	if(!empty($formData['post_image'])){
	$imageName=preg_replace('/\\.[^.\\s]{3,4}$/', '',strtolower($formData['post_image']));
        $pathInfo= pathinfo($formData['post_image']);
	}
	//pr($formData);
		    ?>
		    
<tr class="posts <?php if(!empty($formData['post_image']) && isset($formData['media']) && !empty($formData['lat']) && !empty($formData['user_name']) && !empty($formData['description'])){ echo "green"; }else{ echo "red";}?>" item="<?php if(!empty($formData['post_image'])){ echo 'sucess';}else{ echo 'error';}?>" id="post<?php if(!empty($formData['rowCount']))  echo $formData['rowCount']?>" item="post<?php echo strtolower($imageName)?>">
		    <td align="center"><input type="checkbox" name="checkboxes[]" class ="checkboxlist" value="<?php //echo base64_encode($formData['description']);?>" ></td> 
			<input type="hidden" value="<?php //echo $limit;?>" id="pageCounter">
			<input type="hidden" name=rowCount[] value="<?php if(!empty($formData['rowCount']))  echo $formData['rowCount'];?>" id="rowcounts">
			<?php if(!empty($formData['description']))?>
			<input type="hidden" name="description[]" value="<?php if(!empty($formData['description'])) echo $formData['description']?>" />
			<?php if(!empty($formData['address']))?>
			<input type="hidden" class="postaddress" name="address[]" value="<?php if(!empty($formData['address'])) echo $formData['address']?>" />
		        <?php if(!empty($formData['lat']))?>
			<input type="hidden" name="lat[]" value="<?php if(!empty($formData['lat'])) echo $formData['lat']?>" />
		        <?php if(!empty($formData['long']))?>
			<input type="hidden" name="long[]" value="<?php if(!empty($formData['long'])) echo $formData['long']?>" />
		        <?php if(!empty($formData['user_id']))?>
			<input type="hidden" class="userId" name="user_id[]" value="<?php if(!empty($formData['user_id'])) echo $formData['user_id']?>" />
			 <?php if(!empty($formData['user_name']))?>
			 <input class="userName" type="hidden" name="userName[]" value="<?php if(!empty($formData['userName'])){echo $formData['userName'];}?>" />
			<input type="hidden" class="user_name" name="user_name[]" value="<?php if(!empty($formData['user_name'])) echo $formData['user_name']?>" />
			<?php if(!empty($formData['post_date']))?>
		        <input type="hidden" name="post_date[]" value="<?php  if(!empty($formData['post_date'])) echo $formData['post_date'];?>" />
                        <input type="hidden" value="1" name="import_list"> 
			<input type="hidden" name="postImages[]" value="<?php  if(!empty($formData['post_image'])) echo $formData['post_image']?>" />
		        
			
			<td align="left" class="description <?php if(!empty($formData['description'])){echo 'txtgreen';}else{ echo 'txtred'; }?>" id="<?php if(!empty($formData['description']))echo $formData['description']?>" ><?php if(!empty($formData['description']))echo ucfirst($formData['description']);?></td>
			  
			<td align="left" class="postuser <?php if(!empty($formData['user_name']) && empty($formData['userName'])){echo 'txtgreen';}else{ echo 'txtred'; }?>" id="<?php if(!empty($formData['user_name']))echo $formData['user_name']?>" ><?php if(!empty($formData['user_name'])){echo $formData['user_name'];}if(!empty($formData['userName'])){ echo $formData['userName'];}?></td>
			
			<td align="left" class="latlong <?php if(!empty($formData['lat'])){echo 'txtgreen';}else{ echo 'txtred'; }?>"><?php if(!empty($formData['lat'])){echo $formData['lat'].'/'.$formData['long'];}else{ echo 'Not Found';}?></td>
			<td align="left" class="postimage <?php if(!empty($formData['post_image']) && isset($formData['media'])){echo 'txtgreen';}else{ echo 'txtred'; }?>"  id="<?php if(!empty($formData['post_image']))echo $formData['post_image']?>"><?php if(!empty($formData['post_image'])){echo $formData['post_image'];}else{echo  $formData['post_image'];  }?></td>
			<td align="left" class="txtgreen"><?php if(strtolower($pathInfo['extension'])=="png"||strtolower($pathInfo['extension'])=="jpg"||strtolower($pathInfo['extension'])=="jpeg"||strtolower($pathInfo['extension'])=="gif"){?>Picture<?php }else{?>Video<?php }?></td>
			<td>
		          <a class="editrow" href="#" id"=<?php echo $formData['description']?>"><i class="fa fa-pencil-square-o"></i></a>
		          <a href="#" class="delrow" id="del<?php echo $formData['description']?>"><i class="fa fa-trash-o"></i></a>
		       </td>
			<!--<td align="center">
			    <?php  
			    //echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),"/admin/users/edit/".$formData['description'],array('class' => 'editrow','id'=>$formData['description'],'escape' =>false));
			    //echo $this->Html->link($this->Html->image("admin/delete.png", array("alt" => "Edit","title" => "Delete")),"/admin/users/delete/".$formData['description'],array('class' => 'delrow','id'=>'del'.$formData['description'],'escape' =>false));
			   // echo $this->Html->link($this->Html->image("admin/view.png", array("alt" => "Edit","title" => "Edit")),"/admin/users/view/".base64_encode($res['Post']['userID']),array('escape' =>false));
			    ?>
			  </td>-->
</tr>

<?php }}?>

<script>
$(document).ready(function() {

 var page=$("#pageCounter").val();
 
 
 $('.delrow').unbind('click').click(function(){
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
 $('.editrow').unbind('click').click(function(){
		    scrollTop();
        parentId=$.trim($(this).parent().parent().attr('id'));
        $("#postimage").val('');
	$("#postimages").val('');
        
        $('.add_more').css("display","none");		    
	$('.form').show();
	//$('#add_post_form')[0].reset();
	$("#PostUser").tokenInput("clear");
	var description=$('#'+parentId).children('td.description').attr('id');
	var postaddress=$('#'+parentId).children('.postaddress').val();
	var id=$('#'+parentId).children('.userId').val();
	var name=$('#'+parentId).children('.user_name').val();
	var postImage=$('#'+parentId).children('.postimage').text();
	var rowCount=$('#'+parentId).children('#rowcounts').val();
	//var postImages=$('#'+parentId).children('.postimage').text();
	
	$("#PostUser").tokenInput(<?php echo $userArray?>,{
	    prePopulate: [
		    {id: id, name: name},
		    
		    ],
	    tokenLimit: 1
	    });
	$('ul.token-input-list:not(:last)').remove();
	$("#PostDescription").val(description);
	$("#PostAddress").val(postaddress);
	if ($('#'+parentId).children('.postimage').hasClass('txtgreen'))
	{
	$("#postimage").val(postImage);
	$("#postimages").val(postImage);
	}
	$("#rowCount").val(rowCount)
	
	$("#imagesImport").val('2');
     return false;
});
 });
</script>


		