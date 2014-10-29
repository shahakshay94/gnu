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
		<legend><?php echo __('Add Company Details'); ?></legend>
	<?php
		echo $this->Form->input('name', ['label' => 'Comapany Name', 'placeholder' => 'Full name of company']);
		echo $this->Form->input('profile', ['type' => 'textarea', 'placeholder' => 'Brief about company']);
		echo $this->Form->input('website', ['placeholder' => 'Company website']);
		echo $this->Form->input('location', ['type' => 'textarea', 'placeholder' => 'Address of company']);
		echo $this->Form->input('category',['placeholder' => 'e.g. Private, MNC etc']);
		echo $this->Form->input('email', ['placeholder' => 'Company email id']);
		echo $this->Form->input('contactno', ['placeholder' => 'Company contact no.','maxlength' => 10]);
		echo $this->Form->input('training', array('wrapInput' => 'col col-md-9 col-md-offset-3','label' => 'Offer Training','class' => false)); 
		echo $this->Form->input('job', array(
		'wrapInput' => 'col col-md-9 col-md-offset-3',
		'label' => 'Offer Job',
		'class' => false
	));
	?>
	<div class="col col-md-9 col-md-offset-3">
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
			<button type="reset" class="btn btn-default">Cancel</button>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div></div>


 