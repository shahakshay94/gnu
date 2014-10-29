<div class="row">
          <div class="col-lg-6">

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
	


echo $this->Form->input('staff_id', array('id' => 'staffs','empty' => 'Please Select'));
echo $this->Form->input('category_id',array('id' => 'categoriess','empty' => 'Please select'));
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