<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('pwd', ['type' => 'password','label'=>'Password','autocomplete'=>'off']);
        echo $this->Form->input('pwd_repeat', ['type' => 'password','label'=>'Password repeat','autocomplete'=>'off']);
		echo $this->Form->input('fullname');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
