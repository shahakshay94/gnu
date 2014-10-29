<div class="row">
<style type="text/css">
	.div{
		background-color: 
	}
</style>
          <div class="col-lg-4 col-lg-offset-4">
<h2><?php echo __('Password lost?');?></h2>
<div class="users form">
<?php echo $this->Form->create('User', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'label' => false,
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-block'
));?>
	<fieldset id="step-1">
		<legend><?php echo __('Step %s', 1);?></legend>
		<p>Please enter your email address</p>
	<?php
	echo $this->Form->input('User.email', ['autocomplete' => 'off', 'label' => __('Email'),'placeholder' => 'Email-Id']);
	 echo $this->Form->submit('Submit', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end();
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div></div></div>
<div class="row">
          <div class="col-lg-4 col-lg-offset-4">
<?php echo $this->Form->create('User', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'label' => false,
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-block'
));?>
	<fieldset id="step-2">
 		<legend><?php echo __('Step %s', 2);?></legend>
 		<p>
			Click on the link in the email or Copy-and-Paste your received token here:
 		</p>
	<?php
	echo $this->Form->input('Form.key', ['autocomplete' => 'off','placeholder' => 'Received Token']);
 echo $this->Form->submit('Submit', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end();
	?>
	</fieldset>
<?php echo $this->Html->link(__('Login instead'), ['action' => 'login']);?>
<?php echo $this->Form->end();?>
</div>
</div></div>