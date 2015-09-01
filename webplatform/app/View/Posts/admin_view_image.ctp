<?php if(!empty($_POST['image'])) $pathInfo= pathinfo($_POST['fileName']);?>
<!--------small-modal-start--------->
<div class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
       	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="delete_pro">
<div class="<?php if(strtolower($pathInfo['extension'])=="png"||strtolower($pathInfo['extension'])=="jpg"||strtolower($pathInfo['extension'])=="jpeg"||strtolower($pathInfo['extension'])=="gif"){ echo 'delete_profile'; }else{ echo'video_profile'; }?>">
            <?php if(strtolower($pathInfo['extension'])=="png"||strtolower($pathInfo['extension'])=="jpg"||strtolower($pathInfo['extension'])=="jpeg"||strtolower($pathInfo['extension'])=="gif"){?>
            <img src="<?php echo $_POST['image'] ?>" height="100" widht="100">
            <?php }else{?>
            <video width="320" height="240" autoplay>
            <source src="<?php echo URL_SITE;?>/img/drag/post/<?php echo $_POST['popupImage'] ?>" type="video/mp4">
            </video>
            <?php } ?>
	    </div>
            <h6><?php  echo $_POST['fileName']?></h6>
          </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<!--------small-modal-end--------->
</span>
	