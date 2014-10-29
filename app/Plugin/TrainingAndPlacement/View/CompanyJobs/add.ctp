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
		<legend><?php echo __('Add Job Details'); ?></legend>
	<?php
		echo $this->Form->input('company_master_id');
		echo $this->Form->input('name', ['label' => 'Post/Designation', 'placeholder' => 'Enter job/designation for selected comapny']);
		echo $this->Form->input('probationperiod', ['label' => 'Probation Period', 'placeholder' => 'Enter Probation Period']);
		echo $this->Form->input('salary', ['label' => 'Salary Package', 'placeholder' => 'Enter salary package for entered job/designation']);
	?>
	<div class="col col-md-9 col-md-offset-3">
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
			<button type="reset" class="btn btn-default">Cancel</button>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
