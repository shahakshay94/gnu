<div class="row">
          <div class="col-lg-6">
<div class="settings form">
<?php echo $this->Form->create('Setting', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('General Settings'); ?></legend>
	<?php
		echo $this->Form->input('pagination_value',['placeholder'=>'Enter value of pagination between 1 to 50']);
		echo $this->Form->input('status_id',['label'=>'Default Status']);
	?>
	<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Settings'), array('action' => 'index')); ?></li>
	</ul>
</div>
</div>
</div>