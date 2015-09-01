<?php if(!empty($getData)){?>

    <?php $userLat     = !empty($getData['User']['userLat'])?$getData['User']['userLat']:'0';?>
    <?php $userLong    = !empty($getData['User']['userLong'])?$getData['User']['userLong']:'0';?>
    <?php $userAddress = !empty($getData['User']['userAddress'])?$getData['User']['userAddress']:'not-defined';?>
    <?php $gpsData     = !empty($getData['User']['decimal'])?explode("@",$getData['User']['decimal']):array();?>
    <?php $gpsDataN    = !empty($gpsData[0])?$gpsData[0]:'0';?>
    <?php $gpsDataS    = !empty($gpsData[1])?$gpsData[1]:'0';?>
    <?php $userAvatar  = !empty($getData['User']['userAvatar'])?$getData['User']['userAvatar']:'/img/noimage.png';?>
    
    <div class="three-blocks">
	
	<span class="postImage"><?php echo $this->Html->image($userAvatar,array('alt'=>'userAvatar','title'=>'userAvatar','style'=>'border-radius: 100%;'));?> </span>
	
	<div class="profile">
	    <div class="pro-content">
		<span class="name"><?php echo $getData['User']['username']?></span>
	    </div>
	</div>
	
    </div>
    
    <div class="three-blocks">
	<div id="map_canvas" class="mapcanvas"><span class="sloader"></span></div>
	<div class="cordinates">
	    <div class="in">
		<div class="row">
		    <div class="col-md-6">
			<strong>Longitude:</strong><?php echo $userLat;?><br>
			<strong>Latiude:</strong><?php echo $userLat;?>
		    </div>
		    <div class="col-md-6 text-right">
			<span> <?php echo $gpsDataN;?><br><?php echo $gpsDataS;?></span>
		    </div>
		</div>
	    </div>
	</div>
    </div>
    
    <div class="three-blocks">		
	<p>
	    <span class="active-post"><?php echo !empty($getData['ActivePost'])?'+ '.count($getData['ActivePost']).' Active Posts':'+0 Active Post';?></span>&nbsp;&nbsp;&nbsp;
	    <span class="inactive-post"><?php echo !empty($getData['InactivePost'])?'+ '.count($getData['InactivePost']).' Inactive Posts':'+0 Inactive Post';?></span>
	</p>
	
	<h5 style="color: green;font-size: 15px;padding-top: 20px;">Active Post</h5>
	<ul class="active-inactive-post">
	    <?php if(!empty($getData['ActivePost'])){?>	    
		<?php foreach($getData['ActivePost'] as $key => $values){?>
		    <?php if(!empty($values['postImage']) && !empty($values['postThumbImage'])){?>
			<li>
			    <?php echo $this->Html->image($values['postThumbImage'],array('alt'=>'postThumbImage','title'=>'postThumbImage'));?>
			</li>
		    <?php }else if(!empty($values['postVideo']) && !empty($values['postVideoThumbImage'])){?>
			<li>
			    <?php echo $this->Html->image($values['postVideoThumbImage'],array('alt'=>'postVideoThumbImage','title'=>'postVideoThumbImage'));?>
			</li>
		    <?php } ?>
		<?php } ?>	    
	    <?php } else {?>
		    <li style="color: rgb(0, 0, 0); font-size: 13px;">No Post</li>
	    <?php } ?>
	<ul>	    
	<br />	
	<h5 style="color: red;font-size: 15px;padding-top: 20px;">Inactive Post</h5>
	<ul class="active-inactive-post">
	    <?php if(!empty($getData['InactivePost'])){?>	    
		<?php foreach($getData['InactivePost'] as $key => $values){?>
		    <?php if(!empty($values['postImage']) && !empty($values['postThumbImage'])){?>
			    <li>
				<?php echo $this->Html->image($values['postThumbImage'],array('alt'=>'postThumbImage','title'=>'postThumbImage'));?>
			    </li>
			<?php }else if(!empty($values['postVideo']) && !empty($values['postVideoThumbImage'])){?>
			    <li>
				<?php echo $this->Html->image($values['postVideoThumbImage'],array('alt'=>'postVideoThumbImage','title'=>'postVideoThumbImage'));?>
			    </li>
			<?php } ?>
		<?php } ?>
	    <?php } else {?>
		<li style="color: rgb(0, 0, 0); font-size: 13px;">No Post</li>
	    <?php } ?>
	<ul>
	
    </div>
    
    <a class="close-tabdiv" href="javascript:void(0);"><img src="<?php echo URL_SITE;?>/img/cross.png" alt=""></a>
        
    <script>
    jQuery(document).ready(function() {
	$("a.close-tabdiv").click(function(){
	    $("#get_user_detail_data").removeClass("active");
	});		
    });
    </script>   
    
    <?php if(!empty($userLat) && !empty($userLong)){?>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize"></script>
    <script>
	var directionsDisplay,directionsService,map;	
	function initialize() {
	    var directionsService = new google.maps.DirectionsService();
	    directionsDisplay = new google.maps.DirectionsRenderer();
	    var chicago = new google.maps.LatLng(<?php echo $userLat;?>, <?php echo $userLat;?>);
	    var mapOptions = {
		zoom:8, mapTypeId: google.maps.MapTypeId.ROADMAP, center: new google.maps.LatLng(<?php echo $userLat;?>, <?php echo $userLong;?>)
	    }
	    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
	    var myMarkerLatlng = new google.maps.LatLng(<?php echo $userLat;?>, <?php echo $userLong;?>);	  
	    var marker = new google.maps.Marker({
		    position: myMarkerLatlng,
		    map: map,
		    title: '<?php echo $userAddress;?>',
		    content: '<?php echo $userAddress;?>'
	    });
	    directionsDisplay.setMap(map);
	    var infowindow = new google.maps.InfoWindow({
		    content:'<?php echo $userAddress;?>'
	    });
	    google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map,marker);
	    });
	}	
    </script>
    <?php } ?>
    
<?php }else{ ?>
    No records found.
<?php } ?>