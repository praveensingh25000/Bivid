<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->Html->charset('UTF-8'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">  
    <title><?php echo Configure::read('Settings.SiteAdminName');?></title>
    <?php echo $this->Html->meta('favicon.ico','/favicon.png',array('type' => 'icon'));?>
    <script> var URL_SITE = '<?php echo URL_SITE;?>'</script>
    <?php echo $this->Html->css('admin/bootstrap');?>
    <?php echo $this->Html->css('admin/selectric');?>
    <?php echo $this->Html->css('admin/token-input'); ?>
    <?php echo $this->Html->css('admin/style'); ?>
    <?php echo $this->Html->css('admin/font-awesome.css');?>
    <?php echo $this->Html->css('admin/responsive');?>
    <?php echo $this->Html->css('admin/default'); ?>
    <?php echo $this->Html->css('admin/component'); ?>
    <?php echo $this->Html->css('admin/scrollbar'); ?>    
    <?php echo $this->Html->css('admin/general');?>
    <?php echo $this->Html->script('admin/jquery.min');?>
    <?php echo $this->Html->script('admin/jquery.blockUI');?>
</head>

<body>
    
    <?php echo $this->element('admin/header'); ?>
    
    <?php if($this->Session->read('Auth.User.id')){?>
    
    <?php echo $this->element('admin/tab'); ?>
    
    <?php echo $this->element('admin/menu_filter'); ?>
    
    <?php } ?>
    
    <?php echo $this->fetch('content'); ?>
    
    <?php echo $this->element('admin/footer'); ?>
    
    <?php //echo $this->element('sql_dump'); ?>
    
</body>    
</html>