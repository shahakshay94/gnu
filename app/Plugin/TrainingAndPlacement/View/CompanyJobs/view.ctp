<div class="table-responsive">
<div class="companyJobs view">
<h3><?php echo __('Company Job'); ?></h3>
<table class="table table-striped">
	<tr>
		<th><?php echo __('Company Master'); ?></th>
		<td>
			<?php echo $this->Html->link($companyJob['CompanyMaster']['name'], array('controller' => 'company_masters', 'action' => 'view', $companyJob['CompanyMaster']['id'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<th><?php echo __('Post'); ?></th>
		<td>
			<?php echo h($companyJob['CompanyJob']['name']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Probation Period'); ?></th>
		<td>
			<?php echo h($companyJob['CompanyJob']['probationperiod']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Salary'); ?></th>
		<td>
			<?php echo h($companyJob['CompanyJob']['salary']); ?>
			&nbsp;
		</td>
	</tr>
	</table>
</div>
