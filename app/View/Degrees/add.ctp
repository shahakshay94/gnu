<div class="degrees form">
<?php echo $this->Form->create('Degree'); ?>
	<fieldset>
		<legend><?php echo __('Add Degree'); ?></legend>
	<?php
		echo $this->Form->input('department_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
