<div class="placementResults form">
<?php echo $this->Form->create('PlacementResult'); ?>
	<fieldset>
		<legend><?php echo __('Add Placement Result'); ?></legend>
	<?php
		echo $this->Form->input('company_master_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Apply For This Company')); ?>
</div>
