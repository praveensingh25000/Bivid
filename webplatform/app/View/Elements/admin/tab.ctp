<?php if(isset($controllerName) && isset($actionName) && $controllerName=='Posts' && $actionName=='admin_create'){?>

<ul role="tablist" id="nav-new" class="nav nav-tabs responsive ">    
    <li class="active"><a href="<?php echo URL_SITE;?>/admin/posts/create" aria-expanded="false">Create Content</a></li>
    <li><a href="#" aria-expanded="true">Create User</a></li>
</ul>

<?php } ?>

<?php if(isset($controllerName) && isset($actionName) && $controllerName=='Users' && $actionName=='admin_create'){?>

<ul role="tablist" id="nav-new" class="nav nav-tabs responsive ">    
    <li><a href="<?php echo URL_SITE;?>/admin/posts/create" aria-expanded="false">Create Content</a></li>
    <li class="active"><a href="#" aria-expanded="true">Create User</a></li>
</ul>

<?php } ?>