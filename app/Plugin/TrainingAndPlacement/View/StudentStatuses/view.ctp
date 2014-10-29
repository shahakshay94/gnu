<br>
<div class="table-responsive">
<div class="Student Statuses view">
<h3><?php echo __('Training/Job Status'); ?></h3>
<table class="table table-striped">
	<tr>
		<th><?php echo __('Training At'); ?></th>
		<td>
			<?php echo h($StudentStatus['StudentStatus']['trainingAt']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Company Name'); ?></th>
		<td>
			<?php echo h($StudentStatus['StudentStatus']['companyname']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Project Title'); ?></th>
		<td>
			<?php echo h($StudentStatus['StudentStatus']['project_title']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Project Description'); ?></th>
		<td>
			<?php echo h($StudentStatus['StudentStatus']['project']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Training'); ?></th>
		<td>
			<?php if($StudentStatus['StudentStatus']['training'] == 1){
				echo 'Confirm';
				}
				else{
				echo 'Not Confirm';		
				} ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Job'); ?></th>
		<td>
			<?php if($StudentStatus['StudentStatus']['job'] == 1){
				echo 'Confirm';
				}
				else{
				echo 'Not Confirm';		
				} ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Designation'); ?></th>
		<td>
			<?php echo h($StudentStatus['StudentStatus']['post']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Salary Package'); ?></th>
		<td>
			<?php echo h($StudentStatus['StudentStatus']['salary']); ?>
			&nbsp;
		</td>	
	</tr>
</table>
	
</div>
