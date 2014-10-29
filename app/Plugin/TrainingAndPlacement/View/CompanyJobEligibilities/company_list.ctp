<div class="table-responsive">
<div class="companyJobEligibilities index">
	<h2><?php echo __('Company List'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('CompanyJobEligibility.company_master_id','Company'); ?></th>
			<th><?php echo $this->Paginator->sort('CompanyJobEligibility.company_job_id','Designation'); ?></th>
			<th><?php echo $this->Paginator->sort('CompanyJobEligibility.min_eligible_10','Min % in SSC'); ?></th>
			<th><?php echo $this->Paginator->sort('CompanyJobEligibility.min_eligible_12','Min % in HSC'); ?></th>
			<th><?php echo $this->Paginator->sort('CompanyJobEligibility.min_eligible_degree','Min CGPA'); ?></th>
			<th><?php echo $this->Paginator->sort('interestedin'); ?></th>
			<th><?php echo $this->Paginator->sort('Tests'); ?></th>
	</tr>
	<?php foreach ($CompanyJobEligibilities as $companyJobEligibility): ?>
		<?php  
			if($companyJobEligibility['CompanyJobEligibility']['recstatus'] == 1){ ?>
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
		<td><?php 
				if($companyJobEligibility['CompanyJobEligibility']['verbal'] == 1){
					echo '*Verbal Test';	
				}
				if($companyJobEligibility['CompanyJobEligibility']['aptitude'] == 1){
					echo '*Aptitude Test';
				}
				if($companyJobEligibility['CompanyJobEligibility']['interview'] == 1){
					echo '*Interview';	
				}
				if($companyJobEligibility['CompanyJobEligibility']['gd'] == 1){
					echo '*GD';
				} 
				if($companyJobEligibility['CompanyJobEligibility']['hr'] == 1){
					echo '*HR';	
				}		
			?>&nbsp;</td>
			
	</tr>
	<?php } ?>
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
