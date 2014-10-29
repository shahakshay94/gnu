<div class="staffs form">
<?php echo $this->Form->create('Staff'); ?>
	<fieldset>
		<legend><?php echo __('Edit Staff'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('creator_id');
		echo $this->Form->input('modifier_id');
		echo $this->Form->input('recstatus');
		echo $this->Form->input('firstname');
		echo $this->Form->input('lastname');
		echo $this->Form->input('email');
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
		echo $this->Form->input('staffstatus');
		echo $this->Form->input('institution_id');
		echo $this->Form->input('department_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Staff.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Staff.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Staffs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('controller' => 'institutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('controller' => 'institutions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ticket Manages'), array('controller' => 'ticket_manages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ticket Manage'), array('controller' => 'ticket_manages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tickets'), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ticket'), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
	</ul>
</div>
