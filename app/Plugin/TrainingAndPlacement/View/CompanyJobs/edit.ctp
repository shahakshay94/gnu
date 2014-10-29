<div class="row">
          <div class="col-lg-6">
<div class="companyJobs form">
<?php echo $this->Form->create('CompanyJob', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Edit Company Job'); ?></legend>
	<?php
		echo $this->Form->input('company_master_id');
		echo $this->Form->input('name');
		echo $this->Form->input('probationperiod');
		echo $this->Form->input('salary');
	?>
	<div class="col">
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>

