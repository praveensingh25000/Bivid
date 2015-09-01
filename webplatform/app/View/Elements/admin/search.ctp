<?php $searchKeyword = (isset($controllerName) && $controllerName=='Users')?'1':'2';?>

<?php if(isset($controllerName) && ($controllerName=='Users' || $controllerName=='Posts') && $actionName=='admin_index'){?>

       <?php echo $this->Form->create('Search',array('id'=>'global_search_form','role'=>'search','class'=>'navbar-form navbar-form2 clearfix navbar-left','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
	   <div class="form-group form-group-custom custom-selectric">
	       <?php echo $this->Form->input('searchKeyword',array('value'=>$searchKeyword,'label' => false,'div' => false,'class' => '','options'=>array('1'=>'Search By User','2'=>'Search By Content')));?>
	   </div>
	   <div class="search-input">
	       <?php echo $this->Form->input('Search.name',array('label' => false,'div' => false, 'placeholder' => 'username/posttitle/hours'));?>
	       <button class="btn btn-default" type="submit">
		   <img src="<?php echo URL_SITE;?>/img/search-icn.png" width="15" height="19" alt="">
	       </button>
	   </div>                        
       <?php echo $this->Form->end();?>

<?php } ?>

<ul class="nav navbar-nav navbar-right navbar-icons">
                        
       <li class="user-info-top"><a  href="javascript:;"><img title="user" alt="user" src="<?php echo URL_SITE;?>/img/user.png">&nbsp; &nbsp; Welcome <?php if(defined('SESSION_USER_NAME')){echo SESSION_USER_NAME;}?></a></li>
       
       <!--flag post-->
       <?php echo $this->element('admin/flag_post'); ?>
       <!--flag post-->
       
       <li class="dropdown">
	   <a href="<?php echo URL_SITE;?>/admin/staffs/logout"><img title="logout" alt="logout" src="<?php echo URL_SITE;?>/img/logout.png"></a>
       </li>

</ul>