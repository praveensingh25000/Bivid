<!--header starts-->
<header>
    <nav class="navbar navbar-custom navbar-default">
        <div class="container-fluid">
            
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header navbar-header-custom">
                <button aria-expanded="false" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php echo $this->Html->link('bivid','/admin/dashboards',array('class'=>'navbar-brand','escape' =>false,'title' => 'Bivid'));?>
            </div>
            <!-- Brand and toggle get grouped for better mobile display -->
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
                
                <?php echo $this->element('admin/menu');?> 
                
                <div class="nav-right-side">
                    
                    <?php echo $this->element('admin/search');?> 
                    
                </div>
                
            </div><!-- /.navbar-collapse -->
            
        </div><!-- /.container-fluid -->
        
    </nav>
    
</header>
<!--header ends-->