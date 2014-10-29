<div class="row">
          <div class="col-lg-6">
<div class="referredCompanies form">
<?php echo $this->Form->create('ReferredCompany', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
    ),
    'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Refere A Company'); ?></legend>
		
	<?php
		echo $this->Form->input('companyname', ['label' => 'Company Name','placeholder' => 'Enter name of company', 'autocomplete' => 'off']);
		echo $this->Form->input('forTraining', ['label' => 'Offer A Training', 'wrapInput' => 'col col-md-9 col-md-offset-3','class' => false]);
		echo $this->Form->input('forJob', ['label' => 'Offer A Job', 'autocomplete' => 'off','wrapInput' => 'col col-md-9 col-md-offset-3','class' => false]);
		echo $this->Form->input('location', ['label' => 'Company Address','placeholder' => 'Provide exact location of referred company', 'autocomplete' => 'off']);
		echo $this->Form->input('website',['placeholder' => 'Company website/url', 'autocomplete' => 'off']);
		echo $this->Form->input('companycontact', [ 'label' => 'Company Contact' , 'maxlength' => 10, 'placeholder' => 'Enter valid contact no.', 'autocomplete' => 'off','required','pattern'=>'(7|8|9)\d{9}']);
		echo $this->Form->input('referance', ['label' => 'Reference in Company', 'placeholder' => 'Enter your reference in company', 'autocomplete' => 'off']);
		echo $this->Form->hidden('flag', ['value' => false]);
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
	

