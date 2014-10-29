<div class="row">
          <div class="col-lg-6">
<div class="tickets form">
<?php echo $this->Form->create('Ticket', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Edit Ticket'); ?></legend>
	<?php

		echo $this->Form->input('category_id');
		echo $this->Form->input('subject');
		echo $this->Form->input('complain');
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