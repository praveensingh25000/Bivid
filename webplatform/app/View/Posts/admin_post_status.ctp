<?php if($status=='1'){?>
    <a href="javascript:;" onclick="funInactivePostContent('<?php echo $postID;?>','0');" class="post-deactive-btn">Deactivate Post</a>
<?php } else { ?>
    <a href="javascript:;" onclick="funInactivePostContent('<?php echo $postID;?>','1');" class="post-deactive-btn">Activate Post</a>
<?php } ?>