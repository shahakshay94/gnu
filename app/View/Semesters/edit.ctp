<div class="semesters form">
<?php echo $this->Form->create('Semester'); ?>
	<fieldset>
		<legend><?php echo __('Edit Semester'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('academic_year_id');
		echo $this->Form->input('name');
		echo $this->Form->input('degree_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>