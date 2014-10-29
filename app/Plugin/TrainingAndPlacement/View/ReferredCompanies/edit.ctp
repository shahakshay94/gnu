<div class="referredCompanies form">
<?php echo $this->Form->create('ReferredCompany'); ?>
	<fieldset>
		<legend><?php echo __('Edit Referred Company'); ?></legend>
	<?php
		echo $this->Form->input('companyname');
		echo $this->Form->input('forTraining');
		echo $this->Form->input('forJob');
		echo $this->Form->input('location');
		echo $this->Form->input('website');
		echo $this->Form->input('companycontact');
		echo $this->Form->input('referance');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>