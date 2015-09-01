<div class="row padding_btm_20">
    <?php echo $this->Form->create('Search', array('url' => array('controller' => 'staffs', 'action' => 'admin_index'),'id'=>'SiteIndexId','type'=>'get'));  ?>
    
    <div class="col-lg-4">   
                 <?php echo $this->Form->input('keyword',array('value'=>$keyword,'label' => false,'div' => false, 'placeholder' => 'Keyword Search','class' => 'form-control','maxlength' => 55));?>
        <span class="blue">(<b>Search by:</b> Name,Email)</span>
    </div>

    <div class="col-lg-4">                        
                <?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
		<?php echo $this->Html->link('List All',array('controller'=>'staffs','action'=>'admin_index'),array('class' => 'btn btn-default'));?>
    </div>

    <div class="col-lg-4 fl_right">    
        <div class="addbutton">                

                    <?php echo $this->Html->link('Add New',array('controller'=>'staffs','action'=>'admin_add'),array('class'=>'btn btn-default')); ?>
        </div>
</div>
<?php echo $this->Form->end();  ?>
</div>
<div style="clear: both"></div>
<div class='contentDiv'>
    <div class="row">
        <div class="col-lg-12">            
            <div class="table-responsive"> 
                <?php if(!empty($getData))
                { ?>
                    <?php echo $this->Form->create('Staff', array('url' => array('controller' => 'staffs', 'action' => 'admin_index'),'id'=>'AdminFormId'));  ?>
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th class="th_checkbox"><input type="checkbox" class="checkall"></th>
                            <th><?php echo $this->Paginator->sort('status', 'Status'); ?> </th>
                            <th><?php echo $this->Paginator->sort('name', 'Name'); ?></th>
                            <!--<th><?php //echo $this->Paginator->sort('username', 'Staffname'); ?></th>-->
                            <th><?php echo $this->Paginator->sort('email', 'Email'); ?></th>
                            <th><?php echo $this->Paginator->sort('phone', 'Contact'); ?></th>
                            <th>Created By</th>
                            <th class="th_checkbox">Actions</th>
                        </tr>
                    </thead>
			<tbody class="dyntable">
				<?php 
				   $i = 0;
				   $j=0;
				foreach($getData as $res){
				//pr($res);
				    $class = ($i%2 == 0) ? ' class="active"' : '';
				    $disable='';
				      if($res['Staff']['id']==1){
				     $disable='disabled="disabled"';
				}
			    ?>
			<tr <?php echo $class;?>>
				<td align="center"><input <?php echo $disable;?>type="checkbox" name="checkboxes[]" class ="checkboxlist" value="<?php echo base64_encode($res['Staff']['id']);?>" ></td> 
				<td align="center"><?php echo ($res['Staff']['status'] == 1)? $this->Html->image("admin/active.png") : $this->Html->image("admin/inactive.png"); ?></td>    
				<td align="left"><?php echo ucfirst($res['Staff']['firstname']).' '.ucfirst($res['Staff']['lastname']);?></td> 
				<!--<td align="left"><?php //echo $res['Staff']['username'];?></td>-->
				<td align="left"><?php echo $res['Staff']['email'];?></td> 
				<td align="left"><?php echo $res['Staff']['phone'];?></td>
				<td align="left"><?php echo $res['Staff']['created'];?></td>
				<td align="center">
				<?php
				echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),"/admin/staffs/edit/".base64_encode($res['Staff']['id']),array('escape' =>false));
				if($disable==''){echo $this->Html->link($this->Html->image("admin/delete.png", array("alt" => "Delete","title" => "Delete")),"/admin/staffs/delete/".base64_encode($res['Staff']['id']),array('escape' =>false),"Are you sure you wish to delete this user type?");}
				echo $this->Html->image("admin/view.png",array("class" => "a-cursor","alt" => "View","title" => "View","data-toggle"=>"modal", "data-target"=>"#myModal".$j));
				?>
				</td>
			<div class="modal fade" id="myModal<?php echo $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			    <div class="modal-content">
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				    <h4 class="modal-title" id="myModalLabel">Staff Details</h4>
				</div>
			        <div class="modal-body">
				    <span style="float:left;font-weight:bold; ">Name :</span><span style="float:left; margin-left:30px;"><?php echo ucfirst($res['Staff']['firstname']).' '.ucfirst($res['Staff']['lastname']); ?></span>									
				</div>
				 <div class="modal-body">
				    <span style="float:left;font-weight:bold; ">Staffname :</span><span style="float:left; margin-left:30px;"><?php echo $res['Staff']['username']; ?></span>									
				</div>
				<div class="modal-body">
				    <span style="float:left;font-weight:bold; ">Email :</span><span style="float:left; margin-left:30px;"><?php echo $res['Staff']['email']; ?></span>									
				</div>
				<div class="modal-body">
				    <span style="float:left;font-weight:bold; ">Contact :</span><span style="float:left; margin-left:30px;"><?php echo $res['Staff']['phone']; ?></span>									
				</div>
				<div class="modal-body">
				    <span style="float:left;font-weight:bold; ">Created By :</span><span style="float:left; margin-left:30px;"><?php echo date(USERDATEFORMAT,strtotime($res['Staff']['created']));?></span>									
				</div>
			       <div class="modal-footer">
				    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			    </div>
			</div>
			</div>
			<!---End---------->
			</tr>
			<?php
				$i++;
				$j++;
				}
			?>
			</tbody>

                </table>
		<div class="row oprdiv">
                    <div class="col-lg-12 actiondivinr"> 
                     <?php
                        if(!empty($getData)){
                            
                            echo $this->element('admin/operation');  // Active/ Inactive/ Delete
                        }
                     ?>
                    </div>
                </div>

		<div class="row">
                    <div class="col-lg-12">
                        <ul class="pagination">
			    <?php
			     if ($this->Paginator->counter('{:count}') > $limit)
			     {
				 ?>
				 <li><?php echo $this->Paginator->first('First'); ?></li>
				 <li><?php echo $this->Paginator->prev('<< Previous', array('class' => 'PrevPg previous'), null, array('class' => 'PrevPg DisabledPgLk previous'));?></li>
				 <li><?php echo $this->Paginator->numbers(array('separator' => '', 'class' => 'numbers')); ?> &nbsp;    </li>
				 <li><?php echo $this->Paginator->next('Next >>', array('class' => 'NextPg next'), null, array('class' =>'NextPg DisabledPgLk next'));?></li>
				 <li> <?php echo $this->Paginator->last('Last'); ?></li>
                    
                           <?php } ?>
	                </ul>
		    </div>
                </div>
                <div class="row padding_btm_20 ">
                    <div class="legend-block">
                        <div class="legend-label">
                            LEGENDS:                 
                        </div>
                        <div class="legend-rw">
                            <div class="legend-desc">
                            <?php echo $this->Html->image("admin/delete.png"). " Delete &nbsp;"; ?>
                            </div>
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
                <?php  echo $this->Form->end(); ?>
               <?php
                }else{ 
                    echo $this->element('admin/no_record_exists');
                } ?>
            </div>
        </div>         
    </div><!-- /.row -->
</div>