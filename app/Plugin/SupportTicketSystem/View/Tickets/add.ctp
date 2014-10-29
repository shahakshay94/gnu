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
		<legend><?php echo __('Add Ticket'); ?></legend>
	<?php
		echo $this->Form->input('category_id');
		echo $this->Form->input('subject',['autocomplete' => 'off']);
		echo $this->Form->input('complain',['autocomplete' => 'off' ,'type' => 'textarea' ]);
	?>
	<?php echo $this->Form->submit('Save changes', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>