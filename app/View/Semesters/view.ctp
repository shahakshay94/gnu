<div class="semesters view">
<h2><?php echo __('Semester'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Academic Year'); ?></dt>
		<dd>
			<?php echo $this->Html->link($semester['AcademicYear']['name'], array('controller' => 'academic_years', 'action' => 'view', $semester['AcademicYear']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Degree'); ?></dt>
		<dd>
			<?php echo $this->Html->link($semester['Degree']['name'], array('controller' => 'degrees', 'action' => 'view', $semester['Degree']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>