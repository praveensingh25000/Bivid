<?php $folder_url = WWW_ROOT.'img/drag' ;
if(isset($userData)&&!empty($userData)){
    $imageName=preg_replace('/\\.[^.\\s]{3,4}$/', '',strtolower($userData['User']['userImage']['name']));                    

?>
<tr class="users <?php if(!empty($userData['User']['firstname'])  && !empty($userData['User']['username']) && !empty($userData['User']['status'])){ echo "green"; }else{ echo "red";}?>" id="user<?php echo $userData['User']['username']?>">

		<td align="center"><input type="checkbox" name="checkboxes[]" class ="checkboxlist"  ></td>
                <input type="hidden" name="firstname[]" value="<?php echo $userData['User']['firstname']?>" />
		<input type="hidden" name="lastname[]" value="<?php echo $userData['User']['lastname']?>" />
		<input type="hidden" name="username[]" value="<?php echo $userData['User']['username']?>" />
                <input type="hidden" name="status[]" value="<?php echo $userData['User']['status']?>" />
		<input type="hidden" name="email[]" value="<?php if(empty($userData['User']['email'])){echo $userData['User']['username'].'@bivid.com';}else{echo $userData['User']['email'];}?>" />
		<?php if(!empty($userData['User']['userImage']['name'])){?>
		<?php  $filename = time().$userData['User']['userImage']['name'];
	               $folder_url.='/'.strtolower($filename);
		       move_uploaded_file($userData['User']['userImage']['tmp_name'], $folder_url);
	       ?>
	       <input type="hidden" name="user_image[]" value="<?php echo $userData['User']['userImage']['name']?>" />
                 <input type="hidden" name="userImage[]" value="<?php echo $filename?>" />
		<?php }?>
                <td align="left" class="firstname <?php if(!empty($userData['User']['firstname'])){ echo 'txtgreen';}else{ echo 'txtred';}?>" id="<?php if(!empty($userData['User']['firstname']))echo $userData['User']['firstname']?>" ><?php if(!empty($userData['User']['firstname'])){echo ucfirst($userData['User']['firstname']);}else{echo 'Firstname';}?></td>
		<td align="left" class="username <?php if(!empty($userData['User']['username'])){ echo 'txtgreen';}else{ echo 'txtred';}?>"  id="<?php if(!empty($userData['User']['username']))echo $userData['User']['username']?>"><?php if(!empty($userData['User']['username']))echo ucfirst($userData['User']['username']);?></td>
		<td align="left" class="email txtgreen"  id="<?php if(!empty($userData['User']['email']))echo $userData['User']['email']?>"><?php if(empty($userData['User']['email'])){echo $userData['User']['username'].'@bivid.com';}else{echo $userData['User']['email'];}?></td>
		<td align="left" class="<?php if(!empty($userData['User']['userImage']['name'])){ echo 'txtgreen';}else{ echo 'txtred';}?>"><?php if(!empty($userData['User']['userImage']['name'])){echo ucfirst($userData['User']['userImage']['name']);}else{echo $userData['User']['username'].'.'.'jpg'; }?></td>
		<td align="left" class="status  <?php if(!empty($userData['User']['status'])){ echo 'txtgreen';}else{ echo 'txtred';}?>" id="<?php if(!empty($userData['User']['status']))echo $userData['User']['status']?>"><?php if(!empty($userData['User']['status'])){echo ucfirst($userData['User']['status']);}else{echo 'Status';}?></td>
		<td align="center">
		<?php
		echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),"/admin/users/edit/".$userData['User']['username'],array('class' => 'edit','id'=>$userData['User']['username'],'escape' =>false));
		echo $this->Html->link($this->Html->image("admin/delete.png", array("alt" => "Edit","title" => "Delete")),"/admin/users/delete/".$userData['User']['username'],array('class' => 'del','id'=>'del'.$userData['User']['username'],'escape' =>false));
		// echo $this->Html->link($this->Html->image("admin/view.png", array("alt" => "Edit","title" => "Edit")),"/admin/users/view/".base64_encode($res['User']['userID']),array('escape' =>false));
		?>
		</td>
</tr>
<?php }if(!empty($userDataInfo)){
    foreach($userDataInfo as $formData){
	
?>
<tr class="users" style="background-color:<?php if(empty($formData['user_image'])){ echo 'red';}else{ echo 'green';}?>"id="user<?php echo $formData['User']['username']?>">
			<td align="center"><input type="checkbox" name="checkboxes[]" classadmin@bivid.com ="checkboxlist" value="<?php echo base64_encode($formData['username']);?>" ></td> 
			<input type="hidden" name="username[]" value="<?php echo $formData['username']?>" />
			<input type="hidden" name="firstname[]" value="<?php echo $formData['firstname']?>" />
			<input type="hidden" name="lastname[]" value="<?php echo $formData['lastname']?>" />
			<input type="hidden" name="email[]" value="<?php if(empty($formData['email'])){echo $formData['username'].'@bivid.com';}else{echo $formData['email'];}?>" />
			<input type="hidden" name="status[]" value="<?php if(!empty($formData['status']))echo $formData['status']?>" />
                        <td align="left" class="firstname" id="<?php if(!empty($formData['firstname']))echo $formData['firstname']?>" ><?php if(!empty($formData['firstname']))echo ucfirst($formData['firstname']);?></td>
			<td align="left" class="lastname"  id="<?php if(!empty($formData['lastname']))echo $formData['lastname']?>"><?php if(!empty($formData['lastname']))echo ucfirst($formData['lastname']);?></td>
			<td align="left" class="username"  id="<?php if(!empty($formData['username']))echo $formData['username']?>"><?php if(!empty($formData['username']))echo ucfirst($formData['username']);?></td>
			<td align="left" class="email"  id="<?php if(!empty($formData['email']))echo $formData['email']?>"><?php if(!empty($formData['email']))echo ucfirst($formData['email']);?></td>
			<td align="left" class="profilepic"  id="<?php if(!empty($formData['user_image']))echo $formData['user_image']?>"><?php if(!empty($formData['user_image']))echo ucfirst($formData['user_image']);?></td>
			<td align="left" class="status"  id="<?php if(!empty($formData['user_image']))echo $formData['user_image']?>">0</td>
			<td align="center">
			    <?php
			    echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),"/admin/users/edit/".$formData['username'],array('class' => 'edit','id'=>$formData['username'],'escape' =>false));
			    echo $this->Html->link($this->Html->image("admin/delete.png", array("alt" => "Edit","title" => "Delete")),"/admin/users/delete/".$formData['username'],array('class' => 'del','id'=>'del'.$formData['username'],'escape' =>false));
			   // echo $this->Html->link($this->Html->image("admin/view.png", array("alt" => "Edit","title" => "Edit")),"/admin/users/view/".base64_encode($res['User']['userID']),array('escape' =>false));
			    ?>
			  </td>
</tr>

<?php }}?>
<script>
$(document).ready(function() {
 $('.del').click(function(){
	if (confirm("Are you sure?")) {
	   $(this).parent().parent().remove();
	}
    $('#add_user_form').find("input[type=text], input[type=file]").val("");	 
    return false;
    
});
 $('.edit').click(function(){
    parentId=$.trim($(this).parent().parent().attr('id'));
    $('.form').show();
	var firstname=$('#'+parentId).children('td.firstname').attr('id');
	var lastname=$('#'+parentId).children('td.lastname').attr('id');
	var username=$('#'+parentId).children('td.username').attr('id');
	var email=$('#'+parentId).children('td.email').attr('id');
        var status=$('#'+parentId).children('td.status').attr('id');
        $("#UserStatus").val(status);
	$("#UserFirstname").val(firstname);
        $("#UserLastname").val(lastname);
	$("#UserUsername").val(username);
	$("#UserEmail").val(email);
        return false;
});
});
</script>

		