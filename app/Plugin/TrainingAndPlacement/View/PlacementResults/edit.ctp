<div class="placementResults form">
<?php echo $this->Form->create('PlacementResult', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Edit Placement Result'); ?></legend>
	<?php
		echo $this->Form->input('verbal',array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('aptitude',array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('interview',array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('gd',array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
		echo $this->Form->input('hr',array('wrapInput' => 'col col-md-9 col-md-offset-3','class' => false));
	?>
	<legend><?php echo __('Selection Status'); ?></legend>
	<?php 
		$options = array('Appointed' => 'Appointed', 'Pending' => 'Pending', 'Not Qualified' => 'Not Qualified');
        echo $this->Form->select('status',$options);
	?>
	<div class="col col-md-9 col-md-offset-3">
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
			
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>

