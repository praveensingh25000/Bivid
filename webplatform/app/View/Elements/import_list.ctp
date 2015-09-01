<?php if($check==0){
    unset($userDataInfo);
    }
    if(!empty($userDataInfo)){
    foreach($userDataInfo as $formData){?>
<tr class="users" style="background-color:<?php if(empty($formData['User']['user_image'])){ echo 'red';}else{ echo 'green';}?>"id="user<?php echo $formData['User']['username']?>">
			<td align="center"><input type="checkbox" name="checkboxes[]" class ="checkboxlist" value="<?php echo base64_encode($formData['User']['username']);?>" ></td> 
			<input type="hidden" name="username[]" value="<?php echo $formData['User']['username']?>" />
			<input type="hidden" name="firstname[]" value="<?php echo $formData['User']['firstname']?>" />
			<input type="hidden" name="lastname[]" value="<?php echo $formData['User']['lastname']?>" />
			<input type="hidden" name="email[]" value="<?php if(empty($formData['User']['email'])){echo $formData['User']['username'].'@bivid.com';}else{echo $formData['User']['email'];}?>" />
		        <td align="left" class="firstname" id="<?php if(!empty($formData['User']['firstname']))echo $formData['User']['firstname']?>" ><?php if(!empty($formData['User']['firstname']))echo ucfirst($formData['User']['firstname']);?></td>
			<td align="left" class="lastname"  id="<?php if(!empty($formData['User']['lastname']))echo $formData['User']['lastname']?>"><?php if(!empty($formData['User']['lastname']))echo ucfirst($formData['User']['lastname']);?></td>
			<td align="left" class="username"  id="<?php if(!empty($formData['User']['username']))echo $formData['User']['username']?>"><?php if(!empty($formData['User']['username']))echo ucfirst($formData['User']['username']);?></td>
			<td align="left" class="email"  id="<?php if(!empty($formData['User']['email']))echo $formData['User']['email']?>"><?php if(empty($formData['User']['email'])){echo $formData['User']['username'].'@bivid.com';}else{echo $formData['User']['email'];}?></td>
		        <td align="left" class="profilepic"  id="<?php if(!empty($formData['User']['username']))echo $formData['User']['username']?>"><?php if(!empty($formData['User']['username']))echo ucfirst($formData['User']['username']);?></td>
			<td align="left" class="status"  id="<?php if(!empty($formData['User']['user_image']))echo $formData['User']['user_image']?>">0</td>
			<td align="center">
			    <?php
			    echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),"/admin/users/edit/".$formData['User']['username'],array('class' => 'edit','id'=>$formData['User']['username'],'escape' =>false));
			    echo $this->Html->link($this->Html->image("admin/delete.png", array("alt" => "Edit","title" => "Delete")),"/admin/users/delete/".$formData['User']['username'],array('class' => 'del','id'=>'del'.$formData['User']['username'],'escape' =>false));
			   // echo $this->Html->link($this->Html->image("admin/view.png", array("alt" => "Edit","title" => "Edit")),"/admin/users/view/".base64_encode($res['User']['userID']),array('escape' =>false));
			    ?>
			  </td>
</tr>


<?php }}
if(!empty($userDataInfos)){
    foreach($userDataInfos as $formData){?>
<tr class="users" item="<?php if(!empty($formData['user_image'])){ echo 'sucess';}else{ echo 'error';}?>"  style="background-color:<?php if(!empty($formData['user_image'])){ echo 'green';}else{ echo 'red';}?>"  id="user<?php echo $formData['user_id']?>">
				  <td align="center"><input type="checkbox" name="checkboxes[]" class ="checkboxlist" value="<?php echo base64_encode($formData['username']);?>" ></td> 
			<input type="hidden" name="username[]" value="<?php echo $formData['username']?>" />
			<input type="hidden" name="firstname[]" value="<?php echo $formData['firstname']?>" />
			<input type="hidden" name="lastname[]" value="<?php echo $formData['lastname']?>" />
			<input type="hidden" name="email[]" value="<?php if(empty($formData['email'])){echo $formData['username'].'@bivid.com';}else{echo $formData['email'];}?>" />
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
	if (confirm("Are you sure?ssss")) {
	   $(this).parent().parent().remove();
           
	}
        $('tr.users').each(function() {
				var item = $(this).attr('item');
				
				    if (item=="error") {
					$(".userlist").hide();
				    }else{
					$(".userlist").show();
				    }
	       });
    return false;
});
 $('.edit').click(function(){
    var id=$(this).parent().prev().prev().prev().prev().attr('id');
    var username=$(this).parent().prev().prev().prev().attr('id');
    $("#UserUserID").val(id);
    $("#UserUsername").val(username);
    return false;
});
});
</script>

		