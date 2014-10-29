<div class="students form">
<?php echo $this->Form->create('Student'); ?>
	<fieldset>
		<legend><?php echo __('Add Student'); ?></legend>
	<?php
		echo $this->Form->input('creator_id');
		echo $this->Form->input('modifier_id');
		echo $this->Form->input('recstatus');
		echo $this->Form->input('firstname');
		echo $this->Form->input('lastname');
		echo $this->Form->input('email');
		echo $this->Form->input('instituteid');
		echo $this->Form->input('phone1');
		echo $this->Form->input('phone2');
		echo $this->Form->input('C_Address-1');
		echo $this->Form->input('C_Address-2');
		echo $this->Form->input('C_Address-3');
		echo $this->Form->input('C_City');
		echo $this->Form->input('C_State');
		echo $this->Form->input('C_Pincode');
		echo $this->Form->input('P_Address-1');
		echo $this->Form->input('P_Address-2');
		echo $this->Form->input('P_Address-3');
		echo $this->Form->input('P_City');
		echo $this->Form->input('P_State');
		echo $this->Form->input('P_Pincode');
		echo $this->Form->input('picture');
		echo $this->Form->input('studentstatus');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Students'), array('action' => 'index')); ?></li>
	</ul>
</div>
