<div class="table-responsive">
<div class="companyJobEligibilities index">
	<h3><?php echo __('Company Job Eligibilities'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('company_master_id'); ?></th>
			<th><?php echo $this->Paginator->sort('company_job_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Min % in SSC','SSC'); ?></th>
			<th><?php echo $this->Paginator->sort('Min % in HSC','HSC'); ?></th>
			<th><?php echo $this->Paginator->sort('Min CGPA','CGPA'); ?></th>
			<th><?php echo $this->Paginator->sort('interestedin', 'Skills'); ?></th>
			<th><?php echo $this->Paginator->sort('hiring'); ?></th>
			<th><?php echo $this->Paginator->sort('Verbal'); ?></th>
			<th><?php echo $this->Paginator->sort('Aptitude'); ?></th>
			<th><?php echo $this->Paginator->sort('Interview'); ?></th>
			<th><?php echo $this->Paginator->sort('GD'); ?></th>
			<th><?php echo $this->Paginator->sort('HR'); ?></th>
			<th><?php echo $this->Paginator->sort('recstatus','Status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($companyJobEligibilities as $companyJobEligibility): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($companyJobEligibility['CompanyMaster']['name'], array('controller' => 'company_masters', 'action' => 'view', $companyJobEligibility['CompanyMaster']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($companyJobEligibility['CompanyJob']['name'], array('controller' => 'company_jobs', 'action' => 'view', $companyJobEligibility['CompanyJob']['id'])); ?>
		</td>
		<td><?php echo h($companyJobEligibility['CompanyJobEligibility']['min_eligible_10'].'%'); ?>&nbsp;</td>
		<td><?php echo h($companyJobEligibility['CompanyJobEligibility']['min_eligible_12'].'%'); ?>&nbsp;</td>
		<td><?php echo h($companyJobEligibility['CompanyJobEligibility']['min_eligible_degree']); ?>&nbsp;</td>
		<td><?php echo h($companyJobEligibility['CompanyJobEligibility']['interestedin']); ?>&nbsp;</td>
		<td><?php echo h($companyJobEligibility['CompanyJobEligibility']['hiring']); ?>&nbsp;</td>
		<td><?php if($companyJobEligibility['CompanyJobEligibility']['verbal'] == 1){
				echo 'Yes';
			}	
			else{
				echo 'No';
			}	
			 ?>&nbsp;</td>
		<td><?php if($companyJobEligibility['CompanyJobEligibility']['aptitude'] == 1){
				echo 'Yes';
			}	
			else{
				echo 'No';
			}	
			 ?>&nbsp;</td>
		<td><?php if($companyJobEligibility['CompanyJobEligibility']['interview'] == 1){
				echo 'Yes';
			}	
			else{
				echo 'No';
			}	
			 ?>&nbsp;</td>
		<td><?php if($companyJobEligibility['CompanyJobEligibility']['gd'] == 1){
				echo 'Yes';
			}	
			else{
				echo 'No';
			}	
			 ?>&nbsp;</td>
		<td><?php if($companyJobEligibility['CompanyJobEligibility']['hr'] == 1){
				echo 'Yes';
			}	
			else{
				echo 'No';
			}	
			 ?>&nbsp;</td>
			 <td><?php 
		if($companyJobEligibility['CompanyJobEligibility']['recstatus'] == 1){
			echo "Active";	
		} else{
			echo "Not Active";
		}?>&nbsp;
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('', true), array('action' => 'view', $companyJobEligibility['CompanyJobEligibility']['id']), array('class' => 'glyphicon glyphicon-search')); ?>
			<?php echo $this->Html->link(__('', true), array('action' => 'edit', $companyJobEligibility['CompanyJobEligibility']['id']), array('class' => 'glyphicon glyphicon-edit')); ?>
			<?php 
			if($companyJobEligibility['CompanyJobEligibility']['recstatus'] == 0){
				echo $this->Form->postLink(__('', true), array('action' => 'activate', $companyJobEligibility['CompanyJobEligibility']['id']),array('class' => 'glyphicon glyphicon-ok', 'escape' => false), null, __('Are you sure you want to Activate # %s?', $companyJobEligibility['CompanyJobEligibility']['id'])); 
			}
		?>
		<?php 
			if($companyJobEligibility['CompanyJobEligibility']['recstatus'] == 1){
				echo $this->Form->postLink(__('', true), array('action' => 'deactivate', $companyJobEligibility['CompanyJobEligibility']['id']),array('class' => 'glyphicon glyphicon-remove', 'escape' => false), null, __('Are you sure you want to Deactivate # %s?', $companyJobEligibility['CompanyMaster']['id'])); 
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
