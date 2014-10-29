<div class="row">
          <div class="col-lg-6">
<div class="categories form">
<?php echo $this->Form->create('Category', array(
	'inputDefaults' => array(-
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>

	<fieldset>
		<legend><?php echo __('Add Category'); ?></legend>
	<?php
		echo $this->Form->input('department_id', array('id' => 'departments','empty' => 'Please Select First'));
		echo $this->Form->input('name',['autocomplete' => 'off','label'=>'New Category']);
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
