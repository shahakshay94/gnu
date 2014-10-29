<div class="row">
          <div class="col-lg-6">
<div class="companyMasters form">
<?php echo $this->Form->create('CompanyMaster', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Edit Company Master'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('profile',array('type' => 'textarea'));
		echo $this->Form->input('website');
		echo $this->Form->input('location');
		echo $this->Form->input('category');
		echo $this->Form->input('email');
		echo $this->Form->input('contactno', array('maxlength' => 10));
		echo $this->Form->input('training', array('wrapInput' => 'col col-md-9 col-md-offset-3','label' => 'Offer Training','class' => false)); 
		echo $this->Form->input('job', array(
		'wrapInput' => 'col col-md-9 col-md-offset-3',
		'label' => 'Offer Job',
		'class' => false
	));
	?>
	<div class="col">
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>