<div class="examMasters form">
<?php echo $this->Form->create('ExamMaster'); ?>
	<fieldset>
		<legend><?php echo __('Edit Exam Master'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('student_id');
		echo $this->Form->input('semester_id');
		echo $this->Form->input('exam_year_id');
		echo $this->Form->input('s.credits_offered');
		echo $this->Form->input('s.credits_earned');
		echo $this->Form->input('s.grade_points_earned');
		echo $this->Form->input('s.credit_points_earned');
		echo $this->Form->input('sgpa');
		echo $this->Form->input('s.backlog');
		echo $this->Form->input('c.credits_offered');
		echo $this->Form->input('c.credits_earned');
		echo $this->Form->input('c.grade_points_earned');
		echo $this->Form->input('c.credit_points_earned');
		echo $this->Form->input('cgpa');
		echo $this->Form->input('c.backlog');
		echo $this->Form->input('result');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ExamMaster.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ExamMaster.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Exam Masters'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Semesters'), array('controller' => 'semesters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semester'), array('controller' => 'semesters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exam Years'), array('controller' => 'exam_years', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exam Year'), array('controller' => 'exam_years', 'action' => 'add')); ?> </li>
	</ul>
</div>
