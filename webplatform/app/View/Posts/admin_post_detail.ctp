<?php if(!empty($getData)){?>

    <?php $postID        	= !empty($getData['Post']['postID'])?$getData['Post']['postID']:'0';?>
    <?php $status		= !empty($getData['Post']['status']) && $getData['Post']['status']=='1'?1:'0';?>
    <?php $postLat        	= !empty($getData['Post']['postLat'])?$getData['Post']['postLat']:'0';?>
    <?php $postLong       	= !empty($getData['Post']['postLong'])?$getData['Post']['postLong']:'0';?>
    <?php $postAddress 	  	= !empty($getData['Post']['address'])?$getData['Post']['address']:'not-defined';?>
    <?php $postImage      	= !empty($getData['Post']['postImage'])?$getData['Post']['postImage']:'';?>
    <?php $postThumbImage 	= !empty($getData['Post']['postThumbImage'])?$getData['Post']['postThumbImage']:'';?>
    <?php $postVideoThumbImage 	= !empty($getData['Post']['postVideoThumbImage'])?$getData['Post']['postVideoThumbImage']:'';?>
    <?php $postVideo     	= !empty($getData['Post']['postVideo'])?$getData['Post']['postVideo']:'';?>
    <?php $postVideoPath     	= !empty($getData['Post']['postVideo'])?parse_url($getData['Post']['postVideo'], PHP_URL_PATH):'';?>
    <?php $userAvatar     	= !empty($getData['User']['userAvatar'])?$getData['User']['userAvatar']:'/img/noimage.png';?>
    <?php $gpsData        	= !empty($getData['Post']['decimal'])?explode("@",$getData['Post']['decimal']):array();?>
    <?php $gpsDataN       	= !empty($gpsData[0])?$gpsData[0]:'0';?>
    <?php $gpsDataS       	= !empty($gpsData[1])?$gpsData[1]:'0';?>
    <?php $postDateHour   	= !empty($getData['Post']['postDateHour'])?$getData['Post']['postDateHour'].' Hrs':'0 Hr';?>
    <?php $postDateMin    	= !empty($getData['Post']['postDateMin'])?$getData['Post']['postDateMin'].' Mins':'0 Min';?>
    <?php $postDateSec   	= !empty($getData['Post']['postDateSec'])?$getData['Post']['postDateSec'].' Secs':'0 Sec';?>
    <?php $postLifeHour   	= !empty($getData['Post']['postLifeHour']) && $getData['Post']['postLifeHour']>0?$getData['Post']['postLifeHour'].' Hrs':'0 Hr';?>
    <?php $postLifeMin    	= !empty($getData['Post']['postLifeMin']) && $getData['Post']['postLifeMin']>0?$getData['Post']['postLifeMin'].' Mins':'0 Min';?>
    <?php $postLifeSec    	= !empty($getData['Post']['postLifeSec']) && $getData['Post']['postLifeSec']>0?$getData['Post']['postLifeSec'].' Secs':'0 Sec';?>
        
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      
	<div class="modal-dialog modal-dialog-custom" role="document">
	  
	    <div class="modal-content">
	      
		<div class="modal-header clearfix">
		  <button type="button" id="data-close-id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h4 id="myModalLabel" class="modal-title title-left-align">Post Detail</h4>
		 <div class="success-msg-row" style=""><span id="post-status-message" class="alert alert-success" style="display: none;"></span></div>
		</div>
		
		<div class="modal-body">
		    
		     <div class="tab-contentdiv tab-contentdiv-block">
	
			    <div class="three-blocks">
				
				<span class="postImage">
				    <?php if(!empty($postImage)){		    
					echo $this->Html->image($postImage, array('alt'=>'postImage','title'=>'postImage',"class" => "a-cursor","data-toggle"=>"modal", "data-target"=>"#myModalpostImage".$postID));
				    }else if(!empty($postVideoThumbImage)){
					echo $this->Html->image($postVideoThumbImage, array('alt'=>'postImage','title'=>'postImage'));
					echo $this->Html->image('/img/play.png', array('alt'=>'postImage','title'=>'postImage',"class" => "play-btn","data-toggle"=>"modal", "data-target"=>"#myModalpostImage".$postID));
				    }else{
					echo $this->Html->image('/img/noimage.png',array('alt'=>'postImage','title'=>'postImage'));
				    }
				    ?>
				</span>
				
				<div class="profile">
				    
				    <div class="imgdiv">
					<?php echo $this->Html->image($userAvatar, array('alt'=>'userAvatar','title'=>'userAvatar',"class" => "a-cursor","data-toggle"=>"modal", "data-target"=>"#myModaluserAvatar".$postID));?>
				    </div>
			
				    <div class="pro-content">
					<label class="name">@<?php if(!empty($getData['User']['username'])){echo $getData['User']['username']; }?></label>
					<p class="address-txt"><i class="fa fa-map-marker"></i> <?php if(!empty($getData['Post']['address'])){ echo strip_tags($getData['Post']['address']);}?></p>
					<p class="time-row">
					    <strong>Posted time:</strong> <i class="fa fa-clock-o"></i> <?php echo $postDateHour.' '.$postDateMin;?><br>
					    <strong>Expiry time:</strong>
					    <i class="fa fa-calendar-times-o"></i> <b id="postlife<?php echo $getData['Post']['postID']?>"><?php echo $postLifeHour.' '.$postLifeMin;?></b><br>
					    <i class="fa fa-thumbs-o-up"></i> +<?php echo !empty($getData['allPostLikeCount'])?count($getData['allPostLikeCount']):'0';?>
					    | <i class="fa fa-comments-o"></i>  +<?php echo !empty($getData['allPostCommentCount'])?count($getData['allPostCommentCount']):'0';?>
					    | <i class="fa fa-eye"></i> +<?php echo !empty($getData['allPostViewCount'])?count($getData['allPostViewCount']):'0';?>
					    | <i class="fa fa-flag"></i> +0
					</p>	
				    </div>
				</div>
				    
				<p class="black">Extend Expiration Day By</p>				
				<?php echo $this->Form->create('Post',array('class'=>'extend_expiration_form'.$postID.'','id'=>'extend_expiration_form'.$postID.'','type'=>'file','inputDefaults' => array('required' => false,'div'=>false,'error'=>false,'label'=>false,'legend'=>false)));?>
				    <div class="form-group form-group-custom hours-block custom-selectric-wth custom-selectric2 custom-selectric">
					<?php echo $this->Form->hidden('Post.postID',array('value'=>$getData['Post']['postID']));?>
					<?php echo $this->Form->hidden('Post.postLife',array('value'=>$getData['Post']['postLife']));?>	    
					<?php echo $this->Form->input('post_hours',array('type'=>'select','options'=>$postHours,'empty'=>'Select hours')); ?>
					<?php echo $this->Form->button('Save', array('type' => 'submit','class' => 'save-blue-btn'));?>
				    </div>	    
				<?php echo $this->Form->end();?>
				
			    </div>
			    
			    <div class="three-blocks">
				
				<div id="map_canvas" class="mapcanvas">				    
				    <iframe width="100%" height="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAQY2p_k-D1oQglLITgbpxBNknHbbKZCyk&q=<?php echo urlencode($postAddress);?>" allowfullscreen></iframe>
				</div>
				
				<div class="cordinates">
				    <div class="in">
					<div class="row cordinates-row">
					    <div class="col-xs-6">
						<strong>Longitude:</strong><?php echo $getData['Post']['postLat'] ?><br>
						<strong>Latiude:</strong><?php echo $getData['Post']['postLong'] ?>
					    </div>
					    <div class="col-xs-6 cordinates-r-col">
						<span><?php echo $gpsDataN;?><br><?php echo $gpsDataS;?></span>
					    </div>
					</div>
				    </div>
				</div>
				
			    </div>
			    
			    <div class="three-blocks post-description">	
				<h4><?php if(!empty($getData['Post']['description'])){ echo strip_tags($getData['Post']['description']);}?></h4>	
				<p class="black">Current Date: <?php echo Date(DATEFORMAT)?> | Expiry Date:<?php echo Date(DATEFORMAT,strtotime($getData['Post']['postLife']));?></p>
			    </div>
			    
			    <div id="post-status-content">
				<?php if($status=='1'){?>
				    <a href="javascript:;" onclick="funInactivePostContent('<?php echo $postID;?>','0');" class="post-deactive-btn">Deactivate Post</a>
				<?php } else { ?>
				    <a href="javascript:;" onclick="funInactivePostContent('<?php echo $postID;?>','1');" class="post-deactive-btn">Activate Post</a>
				<?php } ?>
			    </div>				
				
			    <script>$(function(){$('select').selectric();});</script>
				
			    <script>
			    jQuery(document).ready(function(){		
				jQuery("#extend_expiration_form<?php echo $postID;?>").submit(function(event){
				    event.preventDefault();
				    var postId        = $("#PostPostID").val();
				    var PostPostHours = $("#PostPostHours").val();
				    if (PostPostHours && postId) {
					$.ajax({
					    url : URL_SITE+"/admin/posts/addHours/"+postId+'/'+PostPostHours,
					    success:function(data){
						$("#postlife"+postId).html(data);
						$("#PostPostHours").val('');
					    }
					});
				    }
				    return false;
				});
			    });    
			    </script>
			    
			</div>	    
		    
		</div>
		
	    </div>
	    
	</div>
	
    </div>
    <!-- /Modal -->
    
    <!----Start-------->
    <div class="modal fade modal-pic-popup" id="myModalpostImage<?php echo $postID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	      <div class="modal-content">				    
		<div class="modal-body">
		     <button type="button" id="data-close-id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <?php if(!empty($postImage)){
			echo $this->Html->image($postImage,array('class'=>'img-responsive','id'=>'viewdetail','onclick'=>'','alt'=>'Thumbnail','title'=>'Thumbnail'));
		    }else if(!empty($postVideo)){?>
			<video height="500" controls autoplay>
			    <source src="<?php echo $postVideoPath;?>" type="video/mp4">
			    Your browser does not support HTML5 video.
			</video>
		    <?php }else{
			echo $this->Html->image('/img/noimage.png',array('class'=>'img-responsive','id'=>'viewdetail','onclick'=>'','alt'=>'Thumbnail','title'=>'Thumbnail'));
		    }
		    ?>
		</div>		    
	      </div>
	</div>
    </div>
    <!---End---------->
    
    <!----Start-------->
    <div class="modal fade modal-pic-popup" id="myModaluserAvatar<?php echo $postID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	      <div class="modal-content">
				    
		<div class="modal-body">
		    <button type="button" id="data-close-id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <?php echo $this->Html->image($userAvatar,array('class'=>'img-responsive','alt'=>'Thumbnail','title'=>'Thumbnail'));?>
		</div>		    
	      </div>
	</div>
    </div>
    <!---End---------->
    
<?php }else{
    echo 'This Post doesnot exists.';
}
?>