
<div class="examMasters view">
<h3><?php echo __('Results Of Degree'); ?></h3>
</div>
<div class="examMasters view">
<h3><?php echo __('Current Semester Performance'); ?></h3>
<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo  'Semester'; ?></th>
			<th><?php echo  'Credits Offered'; ?></th>
			<th><?php echo  'Credits Earned'; ?></th>
			<th><?php echo  'Grade Points Earned'; ?></th>
			<th><?php echo  'Credit Points Earned'; ?></th>
			<th><?php echo  'SGPA'; ?></th>
			<th><?php echo  'Backlog'; ?></th>
			<th><?php echo  'Credits Offered'; ?></th>
			<th><?php echo  'Credits Earned'; ?></th>
			<th><?php echo  'CGPA'; ?></th>
			<th><?php echo  'Backlog'; ?></th>
			<th><?php echo  'Result'; ?></th>
	</tr>
	<?php foreach ($examMasters as $examMaster): ?>
	<tr>
		<td><?php echo h($examMaster['ScheduleExam']['session_no']); ?>&nbsp;</td>
		<td><?php echo h($examMaster['ExamMaster']['s_credits_offered']); ?>&nbsp;</td>
		<td><?php echo h($examMaster['ExamMaster']['s_credits_earned']); ?>&nbsp;</td>
		<td><?php echo h($examMaster['ExamMaster']['s_grade_points_earned']); ?>&nbsp;</td>
		<td><?php echo h($examMaster['ExamMaster']['s_credit_points_earned']); ?>&nbsp;</td>
		<td><?php echo h($examMaster['ExamMaster']['sgpa']); ?>&nbsp;</td>
		<td><?php echo h($examMaster['ExamMaster']['s_backlog']); ?>&nbsp;</td>
		<td><?php echo h($examMaster['ExamMaster']['c_credits_offered']); ?>&nbsp;</td>
		<td><?php echo h($examMaster['ExamMaster']['c_credits_earned']); ?>&nbsp;</td>
		<td><?php echo h($examMaster['ExamMaster']['cgpa']); ?>&nbsp;</td>
		<td><?php echo h($examMaster['ExamMaster']['c_backlog']); ?>&nbsp;</td>
		<td><?php if($examMaster['ExamMaster']['result'] == 1){
			echo "PASS";
		} 
		else{
			echo "FAIL ATKT";
		}?></td>
	</tr>
<?php endforeach; ?>
	</table>	
	</div>
	
	