<?php
echo $this->Html->script('TrainingAndPlacement.companypopulatedropdowns');
?>
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
		<legend><?php echo __('Add Company Job Eligibility'); ?></legend>
<?php

$url            = $this->Html->url(array(
    'controller' => 'company_jobs',
    'action' => 'list_jobs',
    'ext' => 'json'
));
$emptyCompanyJob     = count($company_jobs) > 0 ? Configure::read('Select.defaultAfter') : array(
    '0' => Configure::read('Select.naBefore') . __('Select Company First') . Configure::read('Select.naAfter')
);

echo $this->Form->input('company_master_id', array(
    'id' => 'company_masters',
    'empty' => 'Please Select First',
    'rel' => $url,
    'options' => $company_masters
));
echo $this->Form->input('company_job_id', array(
    'id' => 'company_jobs',
    'empty' => $emptyCompanyJob,
));
?>
	<?php
		echo $this->Form->input('min_eligible_10', ['label' => 'Minimum Eligibility for SSC', 'placeholder' => 'Enter only digit without any letter e.g. 60']);
		echo $this->Form->input('min_eligible_12', ['label' => 'Minimum Eligibility for HSC', 'placeholder' => 'Enter only digit without any letter e.g. 60']);
		echo $this->Form->input('min_eligible_degree', ['label' => 'Minimum Eligibility for Degree', 'placeholder' => 'Enter only digit without any letter e.g. 7.5,8.0 etc.']);
		echo $this->Form->input('interestedin', ['placeholder' => 'e.g. c,c++,data structure etc.']);
		echo $this->Form->input('hiring', ['placeholder' => 'Total Hiring by company']);
		echo $this->Form->input('verbal', array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('aptitude', array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('interview', array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('gd', array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('hr', array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
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
</div></div>