    <div class="row">
        <div class="col-lg-2">
	    <?php
	    if(strtolower($this->params['controller']) =='contacts' && $this->params['action'] =='admin_index'){
	        echo $this->Form->input('setStatus', array('name' => 'data['.$models.'][setStatus]','type' => 'hidden','id'=>'setStatus','value'=>'1'));
                echo $this->Form->input('status', array('name' => 'data['.$models.'][status]','label' => false,'div' => false,'options' => array('2' => 'Delete'),'class' => 'form-control','id' => 'statusId','empty'=>'-Select Action-'));
	    }else{
	        echo $this->Form->input('setStatus', array('name' => 'data['.$models.'][setStatus]','type' => 'hidden','id'=>'setStatus'));
                echo $this->Form->input('status', array('name' => 'data['.$models.'][status]','label' => false,'div' => false,'options' => array('1' => 'Activate', '2' => 'Deactivate','3' => 'Delete'),'class' => 'form-control','id' => 'statusId','empty'=>'-Select Action-'));
	    }
	    ?>
        </div>
        <div class="col-lg-1">   
            <?php
	    if($this->params['action'] !='admin_list'){
	      echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-default disabled','id' => 'operationId'));
	    }
	    ?>
        </div>
    </div>