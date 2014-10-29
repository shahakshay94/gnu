<div class="scheduleExams index">
	<h2><?php echo __('Schedule Exams'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('creator_id'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('modifier_id'); ?></th>
			<th><?php echo $this->Paginator->sort('recstatus'); ?></th>
			<th><?php echo $this->Paginator->sort('academic_year_id'); ?></th>
			<th><?php echo $this->Paginator->sort('degree_id'); ?></th>
			<th><?php echo $this->Paginator->sort('session_no'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($scheduleExams as $scheduleExam): ?>
	<tr>
		<td><?php echo h($scheduleExam['ScheduleExam']['id']); ?>&nbsp;</td>
		<td><?php echo h($scheduleExam['ScheduleExam']['created']); ?>&nbsp;</td>
		<td><?php echo h($scheduleExam['ScheduleExam']['creator_id']); ?>&nbsp;</td>
		<td><?php echo h($scheduleExam['ScheduleExam']['modified']); ?>&nbsp;</td>
		<td><?php echo h($scheduleExam['ScheduleExam']['modifier_id']); ?>&nbsp;</td>
		<td><?php echo h($scheduleExam['ScheduleExam']['recstatus']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($scheduleExam['AcademicYear']['name'], array('controller' => 'academic_years', 'action' => 'view', $scheduleExam['AcademicYear']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($scheduleExam['Degree']['name'], array('controller' => 'degrees', 'action' => 'view', $scheduleExam['Degree']['id'])); ?>
		</td>
		<td><?php echo h($scheduleExam['ScheduleExam']['session_no']); ?>&nbsp;</td>
		<td><?php echo h($scheduleExam['ScheduleExam']['description']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $scheduleExam['ScheduleExam']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $scheduleExam['ScheduleExam']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $scheduleExam['ScheduleExam']['id']), null, __('Are you sure you want to delete # %s?', $scheduleExam['ScheduleExam']['id'])); ?>
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
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Schedule Exam'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Academic Years'), array('controller' => 'academic_years', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Academic Year'), array('controller' => 'academic_years', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Degrees'), array('controller' => 'degrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Degree'), array('controller' => 'degrees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exam Masters'), array('controller' => 'exam_masters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exam Master'), array('controller' => 'exam_masters', 'action' => 'add')); ?> </li>
	</ul>
</div>
