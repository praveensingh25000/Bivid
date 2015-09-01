<?php
//pr($postData);
$folder_url = WWW_ROOT.'img/drag/post' ;
if(isset($postData)&&!empty($postData)){
    if(!empty($postData['Post']['address'])){
    list($lat,$long)=$this->Common->getAddress($postData['Post']['address']);
    }
    $imageName=preg_replace('/\\.[^.\\s]{3,4}$/', '',strtolower($postData['Post']['postImage']['name']));                    
      if(!empty($postData['Post']['user'])){
      $userName= $this->requestAction(array('controller' => 'posts', 'action' => 'userName',$postData['Post']['user']));
      }
       $pathInfo= pathinfo($postData['Post']['postImage']['name']);
       if(!empty($lat) && !empty($long)){
?>

<tr class="posts <?php if(!empty($postData['Post']['postImage']['name']) && !empty($postData['Post']['address']) && !empty($lat) && !empty($postData['Post']['description']) && !empty($postData['Post']['user'])){ echo "green"; }else{ echo "red";}?>" id="post<?php echo strtolower($postData['Post']['description'])?>">

<!--<tr class="posts <?php //if($imageName==strtolower($postData['Post']['description'])){echo'green';}else{echo'red';}?>" style="background-color:<?php //if($imageName==strtolower($postData['Post']['description'])){ echo 'green';}else{ echo 'red';}?>" id="post<?php //echo $postData['Post']['description']?>">
-->		<td><input type="checkbox" name="checkboxes[]" class ="checkboxlist"  ></td>
		<?php if(!empty($postData['Post']['description']))?>
		<input type="hidden" name="description[]" value="<?php if(!empty($postData['Post']['description'])) echo $postData['Post']['description']?>" />
		<?php if(!empty($postData['Post']['address']))?>
		<input type="hidden" class="postaddress" name="address[]" value="<?php if(!empty($postData['Post']['address'])) echo $postData['Post']['address']?>" />
		<?php if(!empty($lat))?>
		<input type="hidden" name="lat[]" value="<?php  if(!empty($lat)) echo $lat?>" />
		<?php if(!empty($long))?>
		<input type="hidden" name="long[]" value="<?php if(!empty($long)) echo $long?>" />
		<?php if(!empty($postData['Post']['user_id']))?>
		<input class="userId" type="hidden" name="user_id[]" value="<?php if(!empty($postData['Post']['user'])) echo $postData['Post']['user']?>" />
		<?php if(!empty($postData['Post']['user']))?>
		<input class="userName" type="hidden" name="user_name[]" value="<?php if(!empty($userName)) echo $userName ?>" />
		<?php if(!empty($postData['Post']['postImage']['name'])){?>
		<?php  $filename = $postData['Post']['description'].'.'.$pathInfo['extension'];
	               $folder_url.='/'.strtolower($filename);
		       $postData['Post']['description'].'.'.$pathInfo['extension'];
		       move_uploaded_file($postData['Post']['postImage']['tmp_name'], $folder_url);
	       ?>
	       <input type="hidden" name="post_image[]" value="<?php echo strtolower($filename)?>" />
               <input type="hidden" name="postImage[]" value="<?php echo $filename?>" />
		<?php }?>
		
		<?php if(!empty($postData['Post']['post_date']))?>
		<input type="hidden" name="post_date[]" value="<?php  if(!empty($postData['Post']['post_date'])) echo $postData['Post']['post_date']?>" />
                <td align="left" class="description <?php if(!empty($postData['Post']['description'])){ echo 'txtgreen';}else{ echo 'txtred';}?>" id="<?php if(!empty($postData['Post']['description']))echo $postData['Post']['description']?>" ><?php if(!empty($postData['Post']['description']))echo ucfirst($postData['Post']['description']);?></td>
                <td align="left" class="postuser <?php if(!empty($userName)){ echo 'txtgreen';}else{ echo 'txtred';}?>" id="<?php if(!empty($userName))echo $userName?>" ><?php if(!empty($userName))echo $userName?></td>
		<td align="left" class="latlong <?php if(!empty($lat)){ echo 'txtgreen';}else{ echo 'txtred';}?>" id="<?php if(!empty($postData['Post']['lat']))echo $postData['Post']['lat']?>" ><?php if(!empty($lat) && !empty($long)) {echo $lat.'/'.$long;}else{ echo 'Not Found';} ?></td>
		<td align="left" class="<?php if(!empty($postData['Post']['postImage']['name'])){echo 'txtgreen';}else{ echo 'txtred'; }?>"><?php if(!empty($postData['Post']['postImage']['name'])){echo $postData['Post']['description'].'.'.$pathInfo['extension'];}else{echo $postData['Post']['description']; }?></td>
		<td align="left" class="txtgreen">Pic</td>
		<td>
                      <a class="edit" href="#" id"=<?php echo $postData['Post']['description']?>"><i class="fa fa-pencil-square-o"></i></a>
		      <a href="#" class="del",id="del<?php echo $postData['Post']['description']?>"><i class="fa fa-trash-o"></i></a>
		</td>
		<!--<td align="center">
		<?php
		//echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),"/admin/users/edit/".$postData['Post']['description'],array('class' => 'edit','id'=>$postData['Post']['description'],'escape' =>false));
		//echo $this->Html->link($this->Html->image("admin/delete.png", array("alt" => "Edit","title" => "Delete")),"/admin/users/delete/".$postData['Post']['description'],array('class' => 'del','id'=>'del'.$postData['Post']['description'],'escape' =>false));
		// echo $this->Html->link($this->Html->image("admin/view.png", array("alt" => "Edit","title" => "Edit")),"/admin/users/view/".base64_encode($res['Post']['userID']),array('escape' =>false));
		?>
		</td>-->
</tr>
<script>
$(document).ready(function() {
 $('.edit').click(function(){
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
$('.del').click(function(){

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
	
   $("#PostUser").tokenInput("clear");
   $('#add_post_form')[0].reset();	 
    return false;
    
});
});

</script>

<?php }else{echo "failure";}
    }if(!empty($postDataInfo)){
    foreach($postDataInfo as $formData){
?>
<tr class="posts <?php if(empty($formData['post_image'])){ echo 'red';}else{ echo 'green';}?>"  id="post<?php echo strtolower($formData['description'])?>">
			<td><input type="checkbox" name="checkboxes[]" class ="checkboxlist" value="<?php echo base64_encode($formData['description']);?>" ></td> 
			<?php if(!empty($formData['description']))?>
			<input type="hidden" name="description[]" value="<?php if(!empty($formData['description'])) echo $formData['description']?>" />
			<?php if(!empty($formData['address']))?>
			<input type="hidden" name="address[]" value="<?php if(!empty($formData['address'])) echo $formData['address']?>" />
		        <?php if(!empty($formData['lat']))?>
			<input type="hidden" name="lat[]" value="<?php if(!empty($formData['lat'])) echo $formData['lat']?>" />
		        <?php if(!empty($formData['long']))?>
			<input type="hidden" name="long[]" value="<?php if(!empty($formData['long'])) echo $formData['long']?>" />
		        <?php if(!empty($formData['user_id']))?>
			<input class="userId" type="hidden" name="user_id[]" value="<?php if(!empty($formData['user_id'])) echo $formData['user_id']?>" />
			 <?php if(!empty($formData['user_name']))?>
			<input class="userName" type="hidden" name="user_name[]" value="<?php if(!empty($formData['user_name'])) echo $formData['user_name']?>" />
			<?php if(!empty($formData['post_date']))?>
		        <input type="hidden" name="post_date[]" value="<?php  if(!empty($formData['post_date'])) echo $formData['post_date'];?>" />
                
			<td align="left" class="description <?php if(!empty($formData['description'])){ echo 'txtgreen';}else{ echo 'txtred';}?>" id="<?php if(!empty($formData['description']))echo $formData['description']?>" ><?php if(!empty($formData['description']))echo ucfirst($formData['description']);?></td>
			
			<td align="left" class="postuser <?php if(!empty($formData['user_name'])){ echo 'txtgreen';}else{ echo 'txtred';}?>" id="<?php if(!empty($formData['user_name']))echo $formData['user_name']?>" ><?php if(!empty($formData['user_name']))echo $formData['user_name'];?></td>
			
			<td align="left" class="latlong <?php if(!empty($formData['lat'])){ echo 'txtgreen';}else{ echo 'txtred';}?>" id="<?php if(!empty($formData['lat']))echo $formData['lat'].'/'.$formData['long']?>" ><?php if(!empty($formData['lat'])){echo $formData['lat'].'/'.$formData['long'];}else{'Not Found';}?></td>
			
			<td align="left" class="media <?php if(!empty($formData['post_image'])){ echo 'txtgreen';}else{ echo 'txtred';}?>"  id="<?php if(!empty($formData['post_image']))echo $formData['post_image']?>"><?php if(!empty($formData['post_image'])){echo $formData['post_image'];}else{echo $formData['description']; }?></td>
			<td align="left" class="txtgreen">Pic</td>
			
			<td>
                      <a class="edit" href="#" id"=<?php echo $formData['description']?>"><i class="fa fa-pencil-square-o"></i></a>
		      <a href="#" class="del",id="del<?php echo $formData['description']?>"><i class="fa fa-trash-o"></i></a>
		        </td>
			
</tr>

<script>
$(document).ready(function() {
     $('.edit').click(function(){
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
    $('.del').click(function(){
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
	
   $("#PostUser").tokenInput("clear");
   $('#add_post_form')[0].reset();	 
    return false;
    
});
});
</script>
<?php }}?>




