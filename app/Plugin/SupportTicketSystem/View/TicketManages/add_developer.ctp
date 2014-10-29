<div class="row">
          <div class="col-lg-6">
<?php echo $this->Html->script('SupportTicketSystem.chain_coordinator');?>
<div class="ticketManages form">
<?php echo $this->Form->create('TicketManage', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Add Ticket Coordinator'); ?></legend>
	<?php
	$url             = $this->Html->url(array('controller' => 'departments','plugin'=>false,
'action' => 'list_departments',
'ext' => 'json'
));
$urla            = $this->Html->url(array('controller' => 'staffs', 'plugin'=>false,
'action' => 'list_staff',
'ext' => 'json'
));
$emptyDepartment = count($departments) > 0 ? Configure::read('Select.defaultAfter') : array('0' => Configure::read('Select.naBefore') . __('Select Institution First') . Configure::read('Select.naAfter')
);
$emptyStaff     = count($staffs) > 0 ? Configure::read('Select.defaultAfter') : array('0' => Configure::read('Select.naBefore') . __('Select Department First') . Configure::read('Select.naAfter')
);
$urlb            = $this->Html->url(array('controller' => 'categories', 'plugin'=>'support_ticket_system',
'action' => 'list_category',
'ext' => 'json'
));
$emptyCategory = count($categories) > 0 ? Configure::read('Select.defaultAfter') : array('0' => Configure::read('Select.naBefore') . __('Select Department First') . Configure::read('Select.naAfter')
);

echo $this->Form->input('institution_id', array('id' => 'institutions','empty' => 'Please Select First',
'rel' => $url
));
echo $this->Form->input('department_id', array('id' => 'departments','empty' => $emptyDepartment,'rel' => $urla,
	'data-rel' => $urlb));
echo $this->Form->input('staff_id', array('id' => 'staffs','empty' => $emptyStaff));
echo $this->Form->input('category_id', array('id' => 'categories','empty' => $emptyCategory));
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