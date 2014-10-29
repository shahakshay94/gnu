<style type="text/css">
	p{
		color:#ba373d;
		font-size:20px;
		font-weight: 100;
		text-transform: uppercase;
	}
	th{
		width:25%;
		text-transform: capitalize;

	}
</style>
<div class="table-responsive">
<div class="Student Resumes view">
<h3><?php echo __('Your Short Resume'); ?></h3><br><br>
<?php foreach ($student_resumes as $student_resume): ?>
	<p><?php echo __('Career objective'); ?></p><hr><br>
	<?php echo h($student_resume['StudentResume']['careerobjective']); ?><br><br>
	<p><?php echo __('Personal Details'); ?></p><hr><br>
<table class="table table-striped">
	<tr>
		<th>Name</th>
		<td><?php 
		foreach ($student_details as $key => $details) {
			echo $details['Student']['firstname'].' '.$details['Student']['lastname'];
		}
		 ?></td>
	</tr>
	<tr>
		<th>Institution</th>
		<td><?php 
			foreach ($institute as $clg){
			echo $clg['Institution']['name'];} ?></td>
	</tr>
	<tr>
		<th>Department</th>
		<td><?php 
			foreach ($department as $branch){
			echo $branch['Department']['name'];} ?></td>
	</tr>
	<tr>
		<th>Degree</th>
		<td><?php 
			foreach ($degree as $deg){
			echo $deg['Degree']['name'];} ?></td>
	</tr>
		<tr>
			<th><?php echo __('Email-ID'); ?></th>
			<td><?php foreach ($email as $key => $mail) {
					echo $mail['User']['email'];
			} ?></td>
		</tr>
		<tr>
			<th><?php echo __('Hobbies'); ?></th>
			<td><?php echo h($student_resume['StudentResume']['hobbies']); ?></td>
		</tr>
		<tr>
			<th><?php echo __('Strengths'); ?></th>
			<td><?php echo h($student_resume['StudentResume']['strengths']); ?></td>
		</tr>
	</table>
<br>
	<p><?php echo __('Education Qualification'); ?></p><hr><br>
	<label style="color:#ba373d;text-transform: uppercase;"><?php echo __('Ganpat University Result'); ?></label><br>
	<table>
	<tr>
		<?php foreach ($semesters as $sem): ?>
		<th style="width:15%"><?php echo 'Semester-'.$sem['ScheduleExam']['session_no'];?></th>
		<?php endforeach; ?>
	</tr>
	<tr>
		<?php foreach ($sgpas as $sgpa): ?>	
		<td><?php echo $sgpa['ExamMaster']['sgpa']; ?></td>
		<?php endforeach; ?>
	</tr>	
</table>
	<label style="color:#ba373d;text-transform: uppercase;"><?php echo __('SSC Result'); ?></label><br>
	<?php foreach ($resultsBoards as $resultsBoard): ?>
		<?php if($resultsBoard['ResultsBoard']['exam_type'] == 'SSC'){?>
	<table>
		<tr>
			<th>Board/University</th>
			<td><?php echo h($resultsBoard['ResultsBoard']['board_name']); ?></td>
		</tr>
		<tr>
			<th>Percentage</th>
			<td><?php echo h($resultsBoard['ResultsBoard']['percentage'].'%'); ?></td>
		</tr>
	</table>
	<?php } ?>
	<?php endforeach; ?>
	<br>
	<label style="color:#ba373d;text-transform: uppercase;"><?php echo __('HSC Result'); ?></label><br>
	<?php foreach ($resultsBoards as $resultsBoard): ?>
		<?php if($resultsBoard['ResultsBoard']['exam_type'] == 'HSC'){?>
	<table>
		<tr>
			<th>Board/University</th>
			<td><?php echo h($resultsBoard['ResultsBoard']['board_name']); ?></td>
		</tr>
		<tr>
			<th>Percentage</th>
			<td><?php echo h($resultsBoard['ResultsBoard']['percentage'].'%'); ?></td>
		</tr>
	</table>
	<?php } ?>
	<?php endforeach; ?>
<br>
	<p><?php echo __('Technical Skills'); ?></p><hr><br>
	<table>
		<tr>
			<th><?php echo __('Operating Systems'); ?></th>
			<td><?php echo h($student_resume['StudentResume']['os']); ?></td>
		</tr>
		<tr>
			<th><?php echo __('Technical Languages'); ?></th>
			<td><?php echo h($student_resume['StudentResume']['techlanguages']); ?></td>
		</tr>
		<tr>
			<th><?php echo __('Database Technology'); ?></th>
			<td><?php echo h($student_resume['StudentResume']['db']); ?></td>
		</tr>
		<tr>
			<th><?php echo __('Web Technologies'); ?></th>
			<td><?php echo h($student_resume['StudentResume']['webtechnologies']); ?></td>
		</tr>
		<tr>
			<th><?php echo __('Software Programming Tools'); ?></th>
			<td><?php echo h($student_resume['StudentResume']['sw_prog_tools']); ?></td>
		</tr>
	</table>
	<br>
	<p><?php echo __('Projects'); ?></p><hr><br>
		<label style="text-transform: capitalize;"><?php echo h($student_resume['StudentResume']['projectname']);
		 ?></label><br><br>
		
	<p><?php echo __('Area of interest'); ?></p><hr><br>
		<label style="text-transform: capitalize;"><?php echo h($student_resume['StudentResume']['interestedin']); ?></label><br><br>
	<p><?php echo __('Extra Curricular Activities'); ?></p><hr><br>
		<label style="color:#ba373d;text-transform: uppercase;"><?php echo __('Workshops & Contests'); ?></label><br>
		<label style="text-transform: capitalize;"><?php echo h($student_resume['StudentResume']['workshops']); ?></label><br><br>
		<label style="color:#ba373d;text-transform: uppercase;"><?php echo __('Seminars'); ?></label><br>
		<label style="text-transform: capitalize;"><?php echo h($student_resume['StudentResume']['seminars']); ?></label><br><br>		
	
	<?php endforeach; ?>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Download'), array('action' => 'view', $student_resume['Student']['id'],'ext'=>'pdf')); ?></li>
		<li><?php echo $this->Html->link(__('Edit Link'), array('action' => 'edit', $student_resume['StudentResume']['id'])); ?></li>
	</ul>
</div>
</div>