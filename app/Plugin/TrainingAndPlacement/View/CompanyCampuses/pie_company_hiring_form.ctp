<?php
echo $this->Html->script('TrainingAndPlacement.yearsdropdown');
?>
<div class="row">
          <div class="col-lg-6">
<div class="companycampus form">
<?php echo $this->Form->create('CompanyCampus', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
    ),
    'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Get Pie Chart of Company & Hiring Status'); ?></legend>
<?php

$url            = $this->Html->url(array(
    'controller' => 'academic_years',
    'action' => 'list_years',
    'ext' => 'json',
    'plugin' => false
));
$emptyacademicyear     = count($academicyears) > 0 ? Configure::read('Select.defaultAfter') : array(
    '0' => Configure::read('Select.naBefore') . __('Select Institution First') . Configure::read('Select.naAfter')
);

echo $this->Form->input('institution_id', array(
    'id' => 'institutions',
    'empty' => 'Please Select First',
    'rel' => $url
));
echo $this->Form->input('academic_year_id', array(
    'id' => 'academic_years',
    'empty' => $emptyacademicyear,
));
	?>
     <div class="col">
            <?php echo $this->Form->submit('Submit', array(
                'div' => false,
                'class' => 'btn btn-primary'
            )); ?>
            <button type="reset" class="btn btn-default">Cancel</button>
        </div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>

