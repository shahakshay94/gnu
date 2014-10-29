<div class="row">
          <div class="col-lg-6">
<div class="companyJobEligibilities view">
<h3><?php echo __('Company Job Eligibility'); ?></h3>
<table class="table table-striped">
	<tr>
		<th><?php echo __('Company Master'); ?></th>
		<td>
			<?php echo $this->Html->link($companyJobEligibility['CompanyMaster']['name'], array('controller' => 'company_masters', 'action' => 'view', $companyJobEligibility['CompanyMaster']['id'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Company Job'); ?></th>
		<td>
			<?php echo $this->Html->link($companyJobEligibility['CompanyJob']['name'], array('controller' => 'company_jobs', 'action' => 'view', $companyJobEligibility['CompanyJob']['id'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>		
		<th><?php echo __('Minimum 10th Eligible Percentage'); ?></th>
		<td>
			<?php echo h($companyJobEligibility['CompanyJobEligibility']['min_eligible_10']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>		
		<th><?php echo __('Minimum 12th Eligible Percentage'); ?></th>
		<td>
			<?php echo h($companyJobEligibility['CompanyJobEligibility']['min_eligible_12']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>		
		<th><?php echo __('Minimum Eligible Degree'); ?></th>
		<td>
			<?php echo h($companyJobEligibility['CompanyJobEligibility']['min_eligible_degree']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>		
		<th><?php echo __('Interested in'); ?></th>
		<td>
			<?php echo h($companyJobEligibility['CompanyJobEligibility']['interestedin']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>		
		<th><?php echo __('Hiring'); ?></th>
		<td>
			<?php echo h($companyJobEligibility['CompanyJobEligibility']['hiring']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>		
		<th><?php echo __('Verbal'); ?></th>
		<td>
			<?php if($companyJobEligibility['CompanyJobEligibility']['verbal'] == 1){
				echo 'Yes';
			}	
			else{
				echo 'No';
			}	
			 ?>
			&nbsp;
		</td>
	</tr>
	<tr>		
		<th><?php echo __('Aptitude'); ?></th>
		<td>
			<?php if($companyJobEligibility['CompanyJobEligibility']['aptitude'] == 1){
				echo 'Yes';
			}	
			else{
				echo 'No';
			}	
			 ?>
			&nbsp;
		</td>
	</tr>
	<tr>		
		<th><?php echo __('Interview'); ?></th>
		<td>
			<?php if($companyJobEligibility['CompanyJobEligibility']['interview'] == 1){
				echo 'Yes';
			}	
			else{
				echo 'No';
			}	
			 ?>
			&nbsp;
		</td>
	</tr>
	<tr>		
		<th><?php echo __('Gd'); ?></th>
		<td>
			<?php if($companyJobEligibility['CompanyJobEligibility']['gd'] == 1){
				echo 'Yes';
			}	
			else{
				echo 'No';
			}	
			 ?>
			&nbsp;
		</td>
	</tr>
	<tr>		
		<th><?php echo __('Hr'); ?></th>
		<td>
			<?php if($companyJobEligibility['CompanyJobEligibility']['hr'] == 1){
				echo 'Yes';
			}	
			else{
				echo 'No';
			}	
			 ?>
			&nbsp;
		</td>
	</tr>
	</table>
</div>