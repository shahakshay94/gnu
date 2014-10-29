<div class="table-responsive">
<div class="companyJobs index">
	<h3><?php echo __('Company Jobs'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('company_master_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name','Designation'); ?></th>
			<th><?php echo $this->Paginator->sort('probationperiod','Probation Period'); ?></th>
			<th><?php echo $this->Paginator->sort('salary'); ?></th>
			<th><?php echo $this->Paginator->sort('recstatus','Status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($companyJobs as $companyJob): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($companyJob['CompanyMaster']['name'], array('controller' => 'company_masters', 'action' => 'view', $companyJob['CompanyMaster']['id'])); ?>
		</td>
		<td><?php echo h($companyJob['CompanyJob']['name']); ?>&nbsp;</td>
		<td><?php echo h($companyJob['CompanyJob']['probationperiod']); ?>&nbsp;</td>
		<td><?php echo h($companyJob['CompanyJob']['salary']); ?>&nbsp;</td>
		<td>
		<?php if($companyJob['CompanyJob']['recstatus'] == 1){
				echo "Active";	
			} else {
			echo "Not Active";
		} ?>&nbsp;
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('', true), array('action' => 'view', $companyJob['CompanyJob']['id']), array('class' => 'glyphicon glyphicon-search')); ?>
			<?php echo $this->Html->link(__('', true), array('action' => 'edit', $companyJob['CompanyJob']['id']), array('class' => 'glyphicon glyphicon-edit')); ?>
			<?php 
			if($companyJob['CompanyJob']['recstatus'] == 0){
				echo $this->Form->postLink(__('', true), array('action' => 'activate', $companyJob['CompanyJob']['id']), array('class' => 'glyphicon glyphicon-ok', 'escape' => false), null, __('Are you sure you want to Activate # %s?', $companyJob['CompanyJob']['id'])); 
			}
		?>
		<?php 
			if($companyJob['CompanyJob']['recstatus'] == 1){
				echo $this->Form->postLink(__('', true), array('action' => 'deactivate', $companyJob['CompanyJob']['id']), array('class' => 'glyphicon glyphicon-remove', 'escape' => false), null, __('Are you sure you want to Deactivate # %s?', $companyJob['CompanyJob']['id'])); 
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
