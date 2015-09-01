<?php if(isset($controllerName) && isset($actionName) && $controllerName=='Users' && $actionName=='admin_index'){?>

	<!--top search section starts-->
	<div class="container top-options">
	  
	  <h1 class="pull-left">Total: +<?php if(isset($getCountData)){echo count($getCountData).' Users';}?>
	  
	  <div class="pull-right inlines-mn">
	    
	      <div class="search-input2">
		  <input type="text" name="" placeholder="Search user by name/email/phone no....">
		  <button>Search</button>
	      </div>
	      
		<!--<div class="inlines grid-icon">
		  <?php //if($actionName=='admin_grid'){?>
			<a title="List View" href="<?php echo URL_SITE;?>/admin/users" class="grid"><img src="<?php echo URL_SITE;?>/img/list.png" alt=""></a>
		  <?php //} else{?>
		        <a title="Grid View" href="<?php echo URL_SITE;?>/admin/users/grid" class="grid"><img src="<?php echo URL_SITE;?>/img/grid.png" alt=""></a>
		  <?php //} ?>
	        </div>
	
	      <div class="inlines numbering numbering2">
		  <a href="#" class="arrows arrows-prev"></a>
		  <label><span>1 of</span> 6666</label>
		  <a href="#" class="arrows active arrows-next"></a>
	      </div>-->
	      
	  </div>
	</div>
	<!--top search section ends-->	
	
<?php } ?>

<?php if(isset($controllerName) && isset($actionName) && $controllerName=='Posts' && $actionName=='admin_index'){?>

	<!--top search section starts-->
	<div class="container top-options">
	  
	  <h1 class="pull-left">Total: +<?php if(isset($getCountData)){echo count($getCountData).' Posts';}?></h1>
	  
	  <div class="pull-right inlines-mn">
	    
	      <div class="inlines custom-selectric custom-selectric2 dropdown-width">
		<?php echo $this->Form->input('Post.content_type',array('value'=>'','label' => false,'div' => false, 'empty' => 'All','class' => '','options'=>array('1'=>'Real Post','2'=>'Fake Post'),'onchange'=>'getFakeRealPostDetail(this.value);'));?>
	      </div>
	    	      
	      <div class="inlines custom-selectric custom-selectric2 dropdown-width">
		<?php echo $this->Form->input('Post.hours',array('value'=>'','label' => false,'div' => false, 'empty' => 'All','class' => '','options'=>$postHours,'onchange'=>'getSortedPostDetail(this.value);'));?>
	      </div>
	      
	      <!--<div class="inlines grid-icon">

		<a title="Grid View" href="<?php echo URL_SITE;?>/admin/posts" class="grid"><img src="<?php echo URL_SITE;?>/img/grid.png" alt=""></a>
	
	      </div>
	
	      <div class="inlines numbering numbering2">
		  <a href="#" class="arrows arrows-prev"></a>
		  <label><span>1 of</span> 6666</label>
		  <a href="#" class="arrows active arrows-next"></a>
	      </div>-->
	      
	  </div>
	  
	</div>
	<!--top search section ends-->

<?php } ?>
