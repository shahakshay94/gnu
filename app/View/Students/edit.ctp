<div class="students form">
<?php echo $this->Form->create('Student'); ?>
	<fieldset>
		<legend><?php echo __('Edit Personal Profile'); ?></legend>
	<?php
	/*	echo $this->Form->input('id');
		echo $this->Form->input('creator_id');
		echo $this->Form->input('modifier_id');
		echo $this->Form->input('recstatus');*/
		echo $this->Form->input('firstname',array('label' => 'Firstname'));
		echo $this->Form->input('lastname',array('label' => 'Lastname'));
		echo $this->Form->input('email',array('label' => 'Email-Id'));
	//	echo $this->Form->input('instituteid');
		echo $this->Form->input('phone1',array('label' => 'Contact-1'));
		echo $this->Form->input('phone2',array('label' => 'Contact-2'));
		echo $this->Form->input('C_Address-1',array('label' => 'Current Address - 1'));
		echo $this->Form->input('C_Address-2',array('label' => 'Current Address - 2'));
		echo $this->Form->input('C_Address-3',array('label' => 'Current Address - 3'));
		echo $this->Form->input('C_City',array('label' => 'Current City'));
		echo $this->Form->input('C_State',array('label' => 'Current State'));
		echo $this->Form->input('C_Pincode',array('label' => 'Current Pincode'));
		echo $this->Form->input('P_Address-1',array('label' => 'Permenent Address - 1'));
		echo $this->Form->input('P_Address-2',array('label' => 'Permenent Address - 2'));
		echo $this->Form->input('P_Address-3',array('label' => 'Permenent Address - 3'));
		echo $this->Form->input('P_City',array('label' => 'Permenent City'));
		echo $this->Form->input('P_State',array('label' => 'Permenent State'));
		echo $this->Form->input('P_Pincode',array('label' => 'Permenent Pincode'));
		//echo $this->Form->input('picture');
		//echo $this->Form->input('studentstatus');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Student.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Student.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Students'), array('action' => 'index')); ?></li>
	</ul>
</div>
-->