<?php
echo $this->Html->css('rolenavigation');
?><br>
<div class="row">
          <div class="col-lg-6">
<div class="tickets form">
	<?php echo $this->Html->script('manage_role');?>

<?php echo $this->Form->create('ManageRole', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>

<fieldset>
		<legend><?php echo __('Manage Department Co-ordinator'); ?></legend>
		<?php
		$url             = $this->Html->url(array('controller' => 'departments','plugin'=>false,
'action' => 'list_departments',
'ext' => 'json'
));
$urla            = $this->Html->url(array('controller' => 'staffs', 'plugin'=> false ,
'action' => 'list_staff',
'ext' => 'json'
));
		//echo $this->Form->input('institution_id');
		//echo $this->Form->input('department_id');
		//echo $this->Form->input('staff_id');
		$emptyDepartment = count($departments) > 0 ? Configure::read('Select.defaultAfter') : array('0' => Configure::read('Select.naBefore') . __('Select Institution First') . Configure::read('Select.naAfter')
);
$emptyStaff     = count($staffs) > 0 ? Configure::read('Select.defaultAfter') : array('0' => Configure::read('Select.naBefore') . __('Select Department First') . Configure::read('Select.naAfter')
);
echo $this->Form->input('institution_id', array('id' => 'institutions','empty' => 'Please Select First',
'rel' => $url
));
echo $this->Form->input('department_id', array('id' => 'departments','empty' => $emptyDepartment,'rel' => $urla));
echo $this->Form->input('staff_id', array('id' => 'staffs','empty' => $emptyStaff));
echo $this->Form->input('role_id');
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