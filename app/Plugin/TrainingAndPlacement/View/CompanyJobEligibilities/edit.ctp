<div class="row">
          <div class="col-lg-6">
<div class="companyJobEligibilities form">
<?php echo $this->Form->create('CompanyJobEligibility', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Edit Company Job Eligibility'); ?></legend>
	<?php
		echo $this->Form->input('company_master_id');
		echo $this->Form->input('company_job_id');
		echo $this->Form->input('min_eligible_10');
		echo $this->Form->input('min_eligible_12');
		echo $this->Form->input('min_eligible_degree');
		echo $this->Form->input('interestedin');
		echo $this->Form->input('hiring');
	echo $this->Form->input('verbal', array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('aptitude', array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('interview', array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('gd', array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('hr', array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
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

