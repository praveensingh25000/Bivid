<?php echo $this->Html->script('admin/admin_managegroup'); ?>   
   
    <?php 
        $recordExits = false;            
        if(isset($getData) && !empty($getData))
        {
           $recordExits = true;            
        }
        echo $this->Form->create('Search', array('url' => array('controller' => 'groups', 'action' => 'admin_index'),'id'=>'AdminId','type'=>'get'));  ?>
	
       <div class="row padding_btm_20">
         <div class="col-lg-4">   
                 <?php echo $this->Form->input('keyword',array('value'=>$keyword,'label' => false,'div' => false, 'placeholder' => 'Keyword Search','class' => 'form-control','maxlength' => 55));?>
				 <span class="blue">(<b>Search by:</b>Group Name)</span>
            </div>
           
            <div class="col-lg-4">                        
                <?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
	        <?php echo $this->Html->link('List All',array('controller'=>'AdminGroups','action'=>'admin_index'),array('class' => 'btn btn-default'));?>
            </div>
	    
        </div>
		
    <?php echo $this->Form->end();?>
    
    <?php echo $this->Form->create('Group', array('url' => array('controller' => 'AdminGroups', 'action' => 'admin_managegroup'),'id'=>'AdminFormId'));  ?>
    
    <div class="row">
        <div class="col-lg-12">            
            <div class="table-responsive"> 
                <?php if($recordExits)
                { ?>
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th class="th_checkbox">#</th>
                            <th><?php echo $this->Paginator->sort('status', 'Status'); ?> </th>
                            <th><?php echo $this->Paginator->sort('name', 'Group Name'); ?></th>                                                       
                            <th class="th_checkbox">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="dyntable">
                        <?php
                        $i = 0;
                        
                        foreach($getData as $key => $getData)
                        {
                            $class = ($i%2 == 0) ? ' class="active"' : '';
                            ?>
                        <tr <?php echo $class;?>>
                           <td align="center"><?php echo $key+1;?></td>     
                           <?php  $status = $getData['AdminGroup']['status'];
                                    $statusImg = ($getData['AdminGroup']['status'] == 1) ? 'active' : 'inactive';
                                    echo $this->Form->hidden('status',array('value'=>$status,'id'=>'statusHidden_'.$getData['AdminGroup']['id'])); ?>
                            <?php  $pid = $getData['AdminGroup']['id'];?>
                            <td align="center"><?php echo $this->Html->link($this->Html->image("admin/".$statusImg.".png", array("alt" => ucfirst($statusImg),"title" => ucfirst($statusImg))),'javascript:void(0)',array('escape'=>false,'id'=>'link_status_'.$getData['AdminGroup']['id'],'onclick'=>'setStatus('.$pid.')')) ; ?></td>
                            <td><?php echo ucfirst($getData['AdminGroup']['name']);?></td>
                                                  
                            <td align="center">
                            <?php
                                echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),"/admin/AdminGroups/addedit/".base64_encode($getData['AdminGroup']['id']),array('escape' =>false));
                                echo $this->Html->image("admin/view.png", array("class" => "a-cursor","data-toggle"=>"modal", "data-target"=>"#myModal".$i));
                            ?>
                            <!----Start-------->
                            <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				      <div class="modal-content">
					<div class="modal-header">
					      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					      <h4 class="modal-title" id="myModalLabel">Group Details</h4>
					</div>
					
					<div class="modal-body">
					      <span style="float:left;font-weight:bold; ">Name :</span><span style="float:left; margin-left:30px;"><?php echo ucfirst($getData['AdminGroup']['name']); ?></span>									
					</div>
				       
					
					<div class="modal-footer">
					      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				      </div>
				</div>
			      </div>
                            <!---End---------->
                            </td>                    
                        </tr>
                        <?php
                            $i++;
                        } ?>
                    </tbody>
                    
                </table>
		
		<div class="row">&nbsp;</div>
                
                <div class="row">                                      
                     <div class="col-lg-12"> <?php
                       if ($this->Paginator->counter('{:count}') > $limit)
                        {
                            echo $this->element('admin/pagination');                 
                        }
                        ?>
                     </div>
                 </div>
                <div class="row padding_btm_20 ">
                    <div class="legend-block">
                        <div class="legend-label">
                          LEGENDS:                 
                         </div>
                        <div class="legend-rw">                            
                             <div class="legend-desc">
                            <?php echo $this->Html->image("admin/edit.png"). " Edit"; ?> 
                            </div>
                            <div class="legend-desc">
                            <?php echo $this->Html->image("admin/active.png"). " Active"; ?>
                            </div>
                            <div class="legend-desc">
                            <?php echo $this->Html->image("admin/inactive.png"). " Inactive"; ?>
                            </div>
                        </div>
                    </div>
                 </div>
              
               <?php
                }else{ 
                    echo $this->element('admin/no_record_exists');
                } ?>
            </div>
        </div>         
    </div><!-- /.row -->
   <?php  echo $this->Form->end(); ?>