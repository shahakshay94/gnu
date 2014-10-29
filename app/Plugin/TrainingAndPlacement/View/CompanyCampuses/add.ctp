<?php
echo $this->Html->script('TrainingAndPlacement.populatedropdowns');
?>

<div class="row" style="height:100%;">
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
		<legend><?php echo __('Add Company Campus'); ?></legend>
<?php
$url             = $this->Html->url(array(
    'controller' => 'departments',
    'action' => 'list_departments',
    'ext' => 'json',
    'plugin' => false
));
$urla            = $this->Html->url(array(
    'controller' => 'degrees',
    'action' => 'list_degrees',
    'ext' => 'json',
    'plugin' => false
));
$urlc            = $this->Html->url(array(
    'controller' => 'academic_years',
    'action' => 'list_years',
    'ext' => 'json',
    'plugin' => false
));

$emptyDepartment = count($departments) > 0 ? Configure::read('Select.defaultAfter') : array(
    '0' => Configure::read('Select.naBefore') . __('Select Institution First') . Configure::read('Select.naAfter')
);
$emptyDegree     = count($degrees) > 0 ? Configure::read('Select.defaultAfter') : array(
    '0' => Configure::read('Select.naBefore') . __('Select Department First') . Configure::read('Select.naAfter')
);
$emptyAcademicYear     = count($academic_years) > 0 ? Configure::read('Select.defaultAfter') : array(
    '0' => Configure::read('Select.naBefore') . __('Select Degree First') . Configure::read('Select.naAfter')
);

echo $this->Form->input('institution_id', array(
    'id' => 'institutions',
    'empty' => 'Please Select First',
    'rel' => $url
));
echo $this->Form->input('department_id', array(
    'id' => 'departments',
    'empty' => $emptyDepartment,
    'rel' => $urla,
));
echo $this->Form->input('degree_id', array(
    'id' => 'degrees',
    'empty' => $emptyDegree,
    'rel' => $urlc
));
echo $this->Form->input('academic_year_id', array(
    'id' => 'academic_years',
    'empty' => $emptyAcademicYear
));
echo $this->Form->input('company_master_id',['type'=>'select','options'=>$company_masters]);
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
