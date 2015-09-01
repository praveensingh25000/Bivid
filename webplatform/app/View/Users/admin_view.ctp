<?php if(!empty($getData)){?>
<div class="col-sm-3 sidebar">
    <div class="profilepic">
        <?php if(!empty($getData['User']['userAvatar'])){?>
        <?php echo $this->Html->image($getData['User']['userAvatar'],array('alt'=>'Avatar','title'=>'Avatar','height'=>250,'width'=>250));?>
        <?php }?>
        <?php if(!empty($getData['address'])){?>
        <label>Location</label>
        <p><?php echo $getData['address'];?></p>
         <?php }?>
        <a class="btn btn-default" style="margin:0 0 10px 0">Like (<?php if(!empty($getData['Like']))echo count($getData['Like']);?>)</a>
        <div>                        
            <a class="btn btn-default followers">Followers(<?php if(!empty($getData['Follow']))echo count($getData['Follow']);?>)</a>
            <a class="btn btn-default followings">Followings(<?php if(!empty($getData['Following']))echo count($getData['Following']);?>)</a>
        </div>
        
    </div>                
</div>
<?php }?>

<div class="followers col-sm-6" style="display:none">       
       <?php if(!empty($getData['Follow'])){foreach($getData['Follow'] as $follow){          
            echo $follow['username']."<br>";          
        }}
        ?>       
    </div>
            
    <div class="followings col-sm-6" style="display:none">    
        <?php  if(!empty($getData['Following'])){  
        foreach($getData['Following'] as $Following){                  
            echo $Following['username']."<br>";                  
        }}
        ?>               
    </div>
<div class="col-sm-9 rightbar">
    
    <div class="topedit">
      <?php if(!empty($getData['User']['username'])){?>
        <h1>Mr.<?php echo $getData['User']['username'];?></h1>
        <?php }?>
    </div>
    <?php if(!empty($getData['Post'])){?>
    <div class="pics">    
        <?php foreach($getData['Post'] as $post){?>
                <?php if(isset($post['postThumbImage'])){?>    
                    <img alt="" title="Post Thumb Image" src="<?php echo $post['postThumbImage']?>">
                <?php } ?>    
        <?php } ?>
    </div>
    <?php }?>
    
</div>

<script>
$(document).ready(function(){      
     $(".followers").click(function(){      
        $("div.followers").toggle();
    });
    $(".followings").click(function(){      
        $("div.followings").toggle();
    });
});
</script>