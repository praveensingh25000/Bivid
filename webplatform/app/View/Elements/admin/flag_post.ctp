<?php $postFlagCount = $this->common->getPostFlagCountData(true);?>

<?php if(!empty($postFlagCount)){?>
<li class="dropdown dropdown-li">
    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"><img title="flagged images" alt="flagged images" src="<?php echo URL_SITE;?>/img/images.png"><span class="counters"><?php echo $postFlagCount;?></span></a>
    <ul class="dropdown-menu">
        <li>
            <a href="#">
                <span class="delete-icon">
                    <i class="fa fa-times"></i>
                </span>
                <img src="<?php echo URL_SITE;?>/img/dropdown-pic/pic1.png" width="93" height="54" alt="">
            </a>
            
        </li>
        <li>
            <a href="#">
                <span class="delete-icon">
                    <i class="fa fa-times"></i>
                </span>
                <img src="<?php echo URL_SITE;?>/img/dropdown-pic/pic2.png" width="93" height="54" alt="">
            </a>
        </li>
        <li>
            <a href="#">
                <span class="delete-icon">
                    <i class="fa fa-times"></i>
                </span>
                <img src="<?php echo URL_SITE;?>/img/dropdown-pic/pic3.png" width="93" height="54" alt="">
            </a>
        </li>
        <li>
            <a href="#">
                <span class="delete-icon">
                    <i class="fa fa-times"></i>
                </span>
                <img src="<?php echo URL_SITE;?>/img/dropdown-pic/pic4.png" width="93" height="54" alt="">
            </a>
        </li>
    </ul>
</li>
<?php } ?>