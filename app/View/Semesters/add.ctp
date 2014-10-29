<div class="semesters form">
<?php echo $this->Form->create('Semester'); ?>
	<fieldset>
		<legend><?php echo __('Add Semester'); ?></legend>
	<?php
		echo $this->Form->input('academic_year_id');
		echo $this->Form->input('degree_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>