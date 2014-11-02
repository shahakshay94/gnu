<div class="row">
          <div class="col-lg-6">
<div class="transfers form">
<?php echo $this->Form->create('DepartmentTransfer',array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Change ticket Status'); ?></legend>
	<?php
		echo $this->Form->input('status_id');
	?>
	<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>