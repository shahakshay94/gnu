<div class="row">
          <div class="col-lg-6">
          	<?php echo $this->Html->script('SupportTicketSystem.chained_transfer');?>
<div class="departmenttransfers form">
<?php echo $this->Form->create('DepartmentTransfer', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>

	<fieldset>
		<legend><?php echo __('Select the Department and appropiate Category.'); ?></legend>
	<?php

	$urla            = $this->Html->url(array('controller' => 'categories', 'plugin'=>'support_ticket_system',
'action' => 'list_categories',
'ext' => 'json'
));
	$emptyCategory = count($categories) > 0 ? Configure::read('Select.defaultAfter') : array('0' => Configure::read('Select.naBefore') . __('Select Department First') . Configure::read('Select.naAfter')
);



		echo $this->Form->input('department_id', array('id' => 'departments','empty' => 'Please Select First','rel' => $urla,'options'=>$departments));
		echo $this->Form->input('category_id', array('id' => 'categories','empty' => $emptyCategory));
		echo $this->Form->input('reasons_for_transfer',array('label'=>'Reason for transfer!', 'type'=>'textarea')); //textarea input 		
	?>
	<?php echo $this->Form->submit('Transfer It !', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>