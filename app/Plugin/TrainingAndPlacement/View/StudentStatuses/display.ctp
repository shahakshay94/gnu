<br>
<div class="table-responsive">
<div class="Student Statuses view">
<h3><?php echo __('Training/Job Status'); ?></h3>
<table class="table table-striped">
	<?php foreach ($studentStatuses as $studentStatus): ?>
	<tr>
		<th><?php echo __('TrainingAt'); ?></th>
		<td>
			<?php echo h($studentStatus['StudentStatus']['trainingAt']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Company Name'); ?></th>
		<td>
			<?php echo h($studentStatus['StudentStatus']['companyname']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Project Title'); ?></th>
		<td>
			<?php echo h($studentStatus['StudentStatus']['project_title']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Project Description'); ?></th>
		<td>
			<?php echo h($studentStatus['StudentStatus']['project']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Training'); ?></th>
		<td>
			<?php if($studentStatus['StudentStatus']['training'] == 1){
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
			<?php if($studentStatus['StudentStatus']['job'] == 1){
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
			<?php echo h($studentStatus['StudentStatus']['post']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Salary Package'); ?></th>
		<td>
			<?php echo h($studentStatus['StudentStatus']['salary']); ?>
			&nbsp;
		</td>	
	</tr>
	</table>
	<?php endforeach; ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Your Status'), array('action' => 'edit', $studentStatus['StudentStatus']['id'])); ?> </li>
	</ul>
</div>
</div>