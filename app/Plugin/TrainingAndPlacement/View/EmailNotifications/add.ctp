<div class="emailNotifications form">
<?php echo $this->Form->create('EmailNotification', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Send Email Notification'); ?></legend>
	<?php
		echo $this->Form->input('to');
		echo $this->Form->input('subject');
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Email Notifications'), array('action' => 'index')); ?></li>
	</ul>
</div>
