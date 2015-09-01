<?php $folder_url = WWW_ROOT.'img/drag' ;

if(!empty($filesArray)){
    foreach($filesArray as $fileArray){
	       $now = time();
	       $filename = $now.$fileArray['name'];
	       $folder_url.='/'.strtolower($filename);
	       
   ?>
<tr>
	       <?php move_uploaded_file($fileArray['tmp_name'], $folder_url);?>
               <td align="left"><?php echo $fileArray['name'];?></td>
               <input type="hidden" name="user_image[]" value="<?php echo $fileArray['name']?>" />
	       <input type="hidden" name="userImage[]" value="<?php echo $filename?>" />
	       <input type="hidden" name="tmp_name[]" value="<?php echo $fileArray['tmp_name']?>" />			
              
 </tr>
    

<?php }}?>

		