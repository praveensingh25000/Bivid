<?php $sessionData   = $this->Session->read('Auth.User.id'); ?>
<?php $href          = $this->Html->url(array('controller' => $this->params['controller'], 'action' => $this->params['action'])); ?>
<?php $postFlagCount = $this->common->getPostFlagCountData(true);?>

<ul class="nav navbar-nav nav-custom <?php if(!empty($postFlagCount)){?>notification<?php } ?>">
                    
    <li class="<?php if(isset($href) && $href=='/webplatform/admin/users'){echo 'active';}?>"><a href="#">User View</a></li>
    <li class="<?php if(isset($href) && $href=='/webplatform/admin/posts'){echo 'active';}?>"><a href="<?php echo URL_SITE;?>/admin/posts">Content View</a></li>                    
    
    <li class="dropdown custom-dropdown">
        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">Create Content <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo URL_SITE;?>/admin/posts/create">Create Content</a></li>
            <li><a href="#">Create User</a></li>
        </ul>
    </li>
    
</ul>