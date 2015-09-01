<?php echo $this->Html->script('admin/admin_user');?>

<div id="loader">
    
    <div class="main tabsdiv">
	
	<div class="slider-div">
	    
	    <ul id="slideshowDivid" class="slideshow-div">
		
		<?php $i=1; $userID = $userKey = '0'; ?>
		
		<?php foreach($getData as $key => $data){?>
		
		    <?php if(!($userID))$userID = $data['User']['userID'];?>		    
		    <?php if(is_null($userKey))$userKey = $key;?>
		    <?php $followers  = !empty($data['Follow'])?count($data['Follow']).' Followers':'0 Followers';?>
		    <?php $followings = !empty($data['Following'])?count($data['Following']).' Followings':'0 Followings';?>
		    <?php $userAvatar = !empty($data['User']['userAvatar'])?$data['User']['userAvatar']:'/img/noimage.png';?>
		    
		    <li data-label="tab<?php echo $data['User']['userID']?>">
			
			<?php echo $this->Html->image($userAvatar,array('class'=>'mCS_img_loaded post-image-loaded','id'=>'viewdetail'.$key.'','onclick'=>'functionGetUserDetail('.$data['User']['userID'].','.$key.')','alt'=>'userAvatar','title'=>'userAvatar','style'=>'border-radius: 100%;'));?>
						
			<span class="name"><?php echo $data['User']['username']?></span>			
			
			<label class="name"><span id="userAddress<?php echo $data['User']['userID']?>"><?php echo !empty($data['User']['userAddress'])?'<i class="fa fa-map-marker"></i> '.substr($data['User']['userAddress'],0,45):'--';?></span></label>
			<?php if(empty($data['User']['userAddress'])){?>
			<script>
			    $(document).ready(function(){
				jQuery('#userAddress<?php echo $data['User']['userID'];?>').addClass('sloader');
				jQuery.ajax({
				    url : URL_SITE+"/admin/users/getaddress/<?php echo $data['User']['userID'];?>",		
				    success: function(msg){
					jQuery('#userAddress<?php echo $data['User']['userID'];?>').removeClass('sloader');
					var obj = jQuery.parseJSON(msg);
					if(obj.error == '1')
					jQuery('#userAddress<?php echo $data['User']['userID'];?>').html(obj.data).show();
					console.clear();
				    }							
				});	
				return false;
			    });
			</script>
			<?php } ?>
			
			<span class="follow"><?php echo $followers;?></span>
			
			<span class="following"><?php echo $followings;?></span>
			
			<span class="arrowdown"><a href="javascript:;" onclick="functionGetUserDetail('<?php echo $data['User']['userID'] ?>','<?php echo $key; ?>');"><img src="<?php echo URL_SITE;?>/img/arrow.png" alt=""/></a></span>
			    
		    </li>
		    
		<?php $i++;} ?>
		
	    </ul>
	    
	    <div id="loaderSliderDiv">
		<input type="hidden" value="<?php echo $limit;?>" id="limitCounter">
		<input type="hidden" value="1910" id="limitwidth">
	    </div>
	    
	</div>
	
	<div class="tab-contentdiv" id="get_user_detail_data" style="display:none;">
	    <script>functionGetUserDetail('<?php echo $userID;?>','<?php echo $userKey;?>');</script>
	</div>
	
    </div>
    
</div>