<div class="table-responsive">
<div class="companyMasters index">
	<h3><?php echo __('Company Masters'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
		
			
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('website'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('contactno'); ?></th>
			<th><?php echo $this->Paginator->sort('training'); ?></th>
			<th><?php echo $this->Paginator->sort('job'); ?></th>
			<th><?php echo $this->Paginator->sort('recstatus','Status'); ?></th> 
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($companyMasters as $companyMaster): ?>
	<tr>
		
		
		<td><?php echo h($companyMaster['CompanyMaster']['name']); ?>&nbsp;</td>
		<td><?php echo h($companyMaster['CompanyMaster']['website']); ?>&nbsp;</td>
		<td><?php echo h($companyMaster['CompanyMaster']['email']); ?>&nbsp;</td>
		<td><?php echo h($companyMaster['CompanyMaster']['contactno']); ?>&nbsp;</td>
		<td><?php if($companyMaster['CompanyMaster']['training'] == 1){
			echo $this->Html->image('TrainingAndPlacement.yes.png',array('width' => '30px', 'height' => '30px'));
			
		}
		else{
			echo $this->Html->image('TrainingAndPlacement.no.png',array('width' => '30px', 'height' => '30px'));
			
		}
		?>&nbsp;</td>
		<td><?php if($companyMaster['CompanyMaster']['job'] == 1){
			echo $this->Html->image('TrainingAndPlacement.yes.png',array('width' => '30px', 'height' => '30px'));
			
		}
		else{
			echo $this->Html->image('TrainingAndPlacement.no.png',array('width' => '30px', 'height' => '30px'));
			
		}
		?>&nbsp;</td>
		<td><?php 
		if($companyMaster['CompanyMaster']['recstatus'] == 1){
			echo "Active";	
			}
		else{
			echo "Not Active";
		}	 ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('',true), array('action' => 'view', $companyMaster['CompanyMaster']['id']), array('class' => 'glyphicon glyphicon-search')); ?> 
			<?php echo $this->Html->link(__('',true), array('action' => 'edit', $companyMaster['CompanyMaster']['id']), array('class' => 'glyphicon glyphicon-edit')); ?>
			<?php 
			if($companyMaster['CompanyMaster']['recstatus'] == 0){
				echo $this->Form->postLink(__('', true), array('action' => 'activate', $companyMaster['CompanyMaster']['id']), array('class' => 'glyphicon glyphicon-ok', 'escape' => false), null, __('Are you sure you want to Activate # %s?', $companyMaster['CompanyMaster']['id'])); 
			}
		?>
		<?php 
			if($companyMaster['CompanyMaster']['recstatus'] == 1){
				echo $this->Form->postLink(__('', true), array('action' => 'deactivate', $companyMaster['CompanyMaster']['id']), array('class' => 'glyphicon glyphicon-remove', 'escape' => false), null, __('Are you sure you want to Deactivate # %s?', $companyMaster['CompanyMaster']['id'])); 
			}
		?>
			
			
		</td>
		
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<ul class="pagination pagination-large pull-right">
                        <?php
                            echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                            echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                        ?>
                    </ul>
	
</div>

</div>