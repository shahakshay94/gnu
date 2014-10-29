<br><br>
<?php
echo $this->Html->script('TrainingAndPlacement.populatedropdowns');
?>
<div class="row">
          <div class="col-lg-6">
<div class="companycampus form">
<?php echo $this->Form->create('PlacementResult', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
    ),
    'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Get list of interested student for "Campus Placement" / Prepare Placement Result'); ?></legend>
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

$emptyDepartment = count($departments) > 0 ? Configure::read('Select.defaultAfter') : array(
    '0' => Configure::read('Select.naBefore') . __('Select Institution First') . Configure::read('Select.naAfter')
);
$emptyDegree     = count($degrees) > 0 ? Configure::read('Select.defaultAfter') : array(
    '0' => Configure::read('Select.naBefore') . __('Select Department First') . Configure::read('Select.naAfter')
);


echo $this->Form->input('institution_id', array(
    'id' => 'institutions',
    'empty' => 'Please Select First',
    'rel' => $url
));
echo $this->Form->input('department_id', array(
    'id' => 'departments',
    'empty' => $emptyDepartment,
    'rel' => $urla
));
echo $this->Form->input('degree_id', array(
    'id' => 'degrees',
    'empty' => $emptyDegree,
));

		echo $this->Form->input('company_master_id');
	?>
    <div class="col">
            <?php echo $this->Form->submit('Search', array(
                'div' => false,
                'class' => 'btn btn-primary'
            )); ?>
            <button type="reset" class="btn btn-default">Cancel</button>
        </div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
