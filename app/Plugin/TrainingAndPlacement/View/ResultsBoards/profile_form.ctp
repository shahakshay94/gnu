<?php
echo $this->Html->script('TrainingAndPlacement.populatedropdowns');
?><br><br>
<div class="row">
          <div class="col-lg-6">
             
                <h3>View Students Profile</h3>
<div class="Student form">
<?php echo $this->Form->create('Student', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
    ),
    'class' => 'well form-horizontal'
)); ?>
    <fieldset>
        
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
    'rel' => $urla,
    'type' => 'select', 
    'options' => $departments
));
echo $this->Form->input('degree_id', array(
    'id' => 'degrees',
    'empty' => $emptyDegree,
));
 echo $this->Form->submit('Submit', array(
        'div' => 'form-group',
        'class' => 'btn btn-primary'
    ));
?>
</fieldset>
<?php
echo $this->Form->end();
?>
</div></div></div>