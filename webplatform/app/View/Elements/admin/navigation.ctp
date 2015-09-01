<?php $loggedUserInfo = $this->Session->read('Auth'); ?>
<?php //pr($loggedUserInfo);?>
<?php $navigationData = $this->requestAction(array('controller' => 'Modules', 'action' => 'navigation'),array('return'));?>
<?php //pr($navigationData);die; ?>

<ul class="nav navbar-nav side-nav">

    <li class="sub">       
	<?php echo $this->Html->link('<i class="fa fa-tachometer"></i> Dashboard','/admin/dashboards',array('escape' =>false,'title' => 'Dashboard'));?>
    </li>
    
    <?php $url = $this->Html->url(array('controller' => $this->params['controller'], 'action' => $this->params['action'])); ?>
    
    <?php if(!empty($navigationData)){?>			
	    
	    <?php foreach($navigationData as $heading => $navigationAll){?>
		
		<li class="sub">
		    <a id="click<?php echo str_replace(' ','-',$heading);?>" href="javascript:;">
			<i class="fa fa-database"></i> <?php echo ucwords($heading);?> <div class="pull-right"><span class="caret"></span></div>
		    </a>
		    
		    <script type="text/javascript">
		    jQuery(document).ready(function($) {   
			$('#click<?php echo str_replace(' ','-',$heading);?>').click(function() {				
			    $("#toggle<?php echo str_replace(' ','-',$heading);?> li").removeClass('closenav');
			    $("#toggle<?php echo str_replace(' ','-',$heading);?>").slideDown('medium');
			});
		    });
		    </script>
		
		    <?php if(!empty($navigationAll) && is_array($navigationAll)){?>
		
			<ul class="templatemo-submenu" id="toggle<?php echo str_replace(' ','-',$heading);?>">
			    
			    <?php foreach($navigationAll as $heading => $navigation){?>
				
				<?php
				$display ='closenav';$selected ='';				
				if(strtolower($navigation['controller']) =='admingroups' && strtolower($navigation['controller'])== strtolower($this->name.'s')){
				    $display ='current';	
				}else if(strtolower($navigation['controller'])== strtolower($this->name)){
				    $display ='current';					
				}
				if(strtolower($navigation['controller']) =='admingroups' && (strtolower($navigation['controller'])== strtolower($this->name.'s')) && (strtolower($navigation['action'])== strtolower($this->action))){
				    $selected ='selected';		
				}else if((strtolower($navigation['controller'])== strtolower($this->name)) && (strtolower($navigation['action'])== strtolower($this->action))){
				    $selected ='selected';					
				}
				?>
			
				<li class="<?php echo $display;?>">
				    <?php echo $this->Html->link(ucwords($navigation['alias']),array('controller' => $navigation['controller'],'action' => $navigation['action'],'full_base' => true),array('class' => $selected));?>
				</li>			
		    
			    <?php } ?>
			    
			</ul>
		
		    <?php } ?>
		</li>
		
	    <?php } ?>
	    
    <?php } ?>
    
</ul>

