<div class="academicYears form">
<?php echo $this->Form->create('AcademicYear'); ?>
	<fieldset>
		<legend><?php echo __('Edit Academic Year'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>