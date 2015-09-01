<!DOCTYPE html>
<html lang="en">
<head>    
    <?php echo $this->Html->charset('UTF-8'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo Configure::read('Settings.SiteAdminName');?></title>
    <script> var URL_SITE = '<?php echo URL_SITE;?>'</script>    
    <?php echo $this->Html->css('admin/bootstrap'); ?>
    <?php echo $this->Html->css('admin/style'); ?>
    <?php echo $this->Html->css('admin/animate'); ?>
    <?php echo $this->Html->css('admin/build'); ?>
    <?php echo $this->Html->css('admin/set1'); ?>
    <?php echo $this->Html->css('admin/font-awesome.min.css');?> 
    <?php echo $this->Html->css('admin/responsive');?>  
    <?php echo $this->Html->css('admin/general');?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo $this->Html->script('jquery.min');?>   
    <?php echo $this->Html->script('admin/bootstrap');?>   
    <?php echo $this->Html->script('jquery.validate');?>
    <?php echo $this->Html->script('admin/general');?>
    <?php $actionName = $this->action;?>
</head>
<body class="bg">
    
    <div class="main-container">
	
	<section class="loginform">
	    
	    <section class="container">
		
		    <?php if(isset($actionName) && ($actionName=='admin_forgot_password' || $actionName =='admin_secure_check')){?>
			<section class="middle_login middle_forgot">
		    <?php } else {?>
			<section class="middle_login">
		    <?php } ?>
		    
			    <section class="allign_mdl">
				
				<div>
				    
				    <section class="landinglogo">
					<a href=""><img src="<?php echo URL_SITE; ?>/img/landing_logo.png" alt="" ></a>
				    </section>
				    
				    <div id="flashMessageajax"><?php echo $this->Session->flash();?></div>
			    
				    <?php echo $this->fetch('content'); ?>
				    
				    <script type="text/javascript">
					jQuery('#flashMessageajax').delay(5000).fadeOut('slow');  
				    </script>			    
				   
				</div>
				
			    </section>
			    
		    </section>
		    
	    </section>
	    
	</section>
	
    </div>
    
</body>
</html>