<style type="text/css">
	table{
		width: 70%;
	}
	a{
		text-decoration: none;
	}
	th{
		text-transform: uppercase;
	}
</style>
<h3>Click any of the link to import CSV</h3>

<table class="table table-striped">
	<tr>
		<th>Import CVS Section - Company</th>
		<th>Get sample files from here</th>
	</tr>
	<tr>
		<td><?php echo $this->Html->link(__('To import data of COMPANY BASIC DETAILS(COMPANY MASTER)'), array('controller' => 'company_masters', 'action' => 'import'), array('target'=>'_blank')); ?></td>
		<td>Sample file</td>
	</tr>
	<tr>
		<td><?php echo $this->Html->link(__('To import data of COMPANY VISIT DATES DETAILS'), array('controller' => 'company_visits', 'action' => 'import'), array('target'=>'_blank')); ?></td>
		<td>Sample file</td>
		
	</tr>
	<tr>
		<td><?php echo $this->Html->link(__('To import data of COMPANY JOBS DETAILS'), array('controller' => 'company_jobs', 'action' => 'import'), array('target'=>'_blank')); ?></td>
		<td>Sample file</td>
		
	</tr>
	<tr>
		<td><?php echo $this->Html->link(__('To import data of COMPANY JOB ELIGIBILITY DETAILS'), array('controller' => 'company_job_eligibilities', 'action' => 'import'), array('target'=>'_blank')); ?></td>
		<td>Sample file</td>
	</tr>
	<tr>
		<td><?php echo $this->Html->link(__('To import data of COMPANY AT CAMPUS DETAILS'), array('controller' => 'company_campuses', 'action' => 'import'), array('target'=>'_blank')); ?></td>
		<td>Sample file</td>
	</tr>
</table>

<table class="table table-striped">
	<tr>
		<th>Import CVS Section - Placement Result , Status & Resume</th>
		<th>Get sample files from here</th>
	</tr>
	<tr>
		<td><?php echo $this->Html->link(__('To import data of PLACEMENT RESULTS'), array('controller' => 'placement_results', 'action' => 'import'), array('target'=>'_blank')); ?></td>
		<td><?php echo $this->Html->link('Sample file', '/files/tasks.csv'); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Html->link(__('To import data of TRAINING/JOB STATUS'), array('controller' => 'stu_statuses', 'action' => 'import'), array('target'=>'_blank')); ?></td>
		<td>Sample file</td>
	</tr>
	<tr>
		<td><?php echo $this->Html->link(__('To import data of STUDENTS RESUMES'), array('controller' => 'stu_resumes', 'action' => 'import'), array('target'=>'_blank')); ?></td>
		<td>Sample file</td>
	</tr>
</table>
		




