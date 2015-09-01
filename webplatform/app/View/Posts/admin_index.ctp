<?php echo $this->Html->script('admin/admin_grid');?>

<div id="loader" class="post-detail-popup">
	
	<div class="main">
		
		<div id="GiTheWallImagesShow" class="slider-div slider-div2">
			
			<ul id="slideshowDivid">
				
				<?php $i=1; $postID = $postKey = '0'; ?>
		
				<?php foreach($getData as $key => $data){?>
				
					<?php $postID                       = !empty($data['Post']['postID'])?$data['Post']['postID']:'0';?> 
					<?php $postThumbImage               = !empty($data['Post']['postThumbImage'])?$data['Post']['postThumbImage']:'';?>
					<?php $postVideoThumbImage          = !empty($data['Post']['postVideoThumbImage'])?$data['Post']['postVideoThumbImage']:'';?>
					
					<li id="tab<?php echo $data['Post']['postID']?>">
						
						<div class="media-box">
							<div class="media-box-pic">
								<?php if(!empty($postThumbImage)){
									echo $this->Html->image($postThumbImage,array('class'=>'','id'=>'viewdetail'.$key.'','onclick'=>'functionGetPostGridDetail('.$data['Post']['postID'].','.$key.')','alt'=>'Thumbnail','title'=>'Thumbnail'));
								}else if(!empty($postVideoThumbImage)){
									echo $this->Html->image($postVideoThumbImage,array('class'=>'','id'=>'viewdetail'.$key.'','onclick'=>'functionGetPostGridDetail('.$data['Post']['postID'].','.$key.')','alt'=>'Thumbnail','title'=>'Thumbnail'));
								}else{
									echo $this->Html->image('/img/noimage.png',array('class'=>'','id'=>'viewdetail'.$key.'','onclick'=>'functionGetPostGridDetail('.$data['Post']['postID'].','.$key.')','alt'=>'Thumbnail','title'=>'Thumbnail'));
								}
								?>
							</div>
							
							<label class="name"><span id="post_adress<?php echo $data['Post']['postID']?>"><?php if(!empty($data['Post']['post_address'])){echo !empty($data['Post']['post_address'])?'<i class="fa fa-map-marker"></i> '.substr($data['Post']['post_address'],0,45):'--';} ?></span></label>
							
							<?php if(empty($data['Post']['post_address'])){?>
							
							<script>
							    $(document).ready(function(){								
								jQuery('#post_adress<?php echo $data['Post']['postID'];?>').addClass('sloader');								
								jQuery.ajax({
								    url : URL_SITE+"/admin/posts/getaddress/<?php echo $data['Post']['postID'];?>",		
								    success: function(msg){
									jQuery('#post_adress<?php echo $data['Post']['postID'];?>').removeClass('sloader');
									var obj = jQuery.parseJSON(msg);
									if(obj.error == '1')
									jQuery('#post_adress<?php echo $data['Post']['postID'];?>').html(obj.data).show();
									console.clear();
								    }							
								});	
								return false;
							    });
							</script>
							
							<?php } ?>							
							
							<span><i class="fa fa-calendar-times-o"></i>&nbsp;<?php echo $this->common->date_hour_min_sec_ago($data['Post']['postDate']);?></span>
			
							<label>Shared by <?php echo $data['User']['username']; ?></label>
							
						</div>						

					</li>
					
				<?php $i++; } ?>
			</ul>
			
		</div>
		
		<div id="loaderSliderDiv">
			<div id="show-more-content-loader" class="txtcenter" style="display: none;"><span class="cloader"></span></div>
			<?php if(!empty($getData) && count($getData) >= 30){?>		
			<div class="txtcenter">
				<?php echo $this->Html->link('Load More','javascript:;',array('class' => 'load-blue-btn', 'onclick' => 'functionLoadMoreData();'));?>
			</div>
			<?php } ?>
			<input type="hidden" value="<?php echo $limit;?>" id="limitCounter">
			<input type="hidden" value="1910" id="limitwidth">
			<input type="hidden" value="0" id="gMapsLoaded">
		</div>
		
	</div>
	
	<div id="get_post_grid_detail"></div>
</div>