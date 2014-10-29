<div class="staffs index">
	<h2><?php echo __('Staffs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('creator_id'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('modifier_id'); ?></th>
			<th><?php echo $this->Paginator->sort('recstatus'); ?></th>
			<th><?php echo $this->Paginator->sort('firstname'); ?></th>
			<th><?php echo $this->Paginator->sort('lastname'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('phone1'); ?></th>
			<th><?php echo $this->Paginator->sort('phone2'); ?></th>
			<th><?php echo $this->Paginator->sort('C_Address-1'); ?></th>
			<th><?php echo $this->Paginator->sort('C_Address-2'); ?></th>
			<th><?php echo $this->Paginator->sort('C_Address-3'); ?></th>
			<th><?php echo $this->Paginator->sort('C_City'); ?></th>
			<th><?php echo $this->Paginator->sort('C_State'); ?></th>
			<th><?php echo $this->Paginator->sort('C_Pincode'); ?></th>
			<th><?php echo $this->Paginator->sort('P_Address-1'); ?></th>
			<th><?php echo $this->Paginator->sort('P_Address-2'); ?></th>
			<th><?php echo $this->Paginator->sort('P_Address-3'); ?></th>
			<th><?php echo $this->Paginator->sort('P_City'); ?></th>
			<th><?php echo $this->Paginator->sort('P_State'); ?></th>
			<th><?php echo $this->Paginator->sort('P_Pincode'); ?></th>
			<th><?php echo $this->Paginator->sort('picture'); ?></th>
			<th><?php echo $this->Paginator->sort('staffstatus'); ?></th>
			<th><?php echo $this->Paginator->sort('institution_id'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($staffs as $staff): ?>
	<tr>
		<td><?php echo h($staff['Staff']['id']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['created']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['creator_id']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['modified']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['modifier_id']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['recstatus']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['firstname']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['lastname']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['email']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['phone1']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['phone2']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['C_Address-1']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['C_Address-2']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['C_Address-3']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['C_City']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['C_State']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['C_Pincode']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['P_Address-1']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['P_Address-2']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['P_Address-3']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['P_City']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['P_State']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['P_Pincode']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['picture']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['staffstatus']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($staff['Institution']['name'], array('controller' => 'institutions', 'action' => 'view', $staff['Institution']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($staff['Department']['name'], array('controller' => 'departments', 'action' => 'view', $staff['Department']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $staff['Staff']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $staff['Staff']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $staff['Staff']['id']), null, __('Are you sure you want to delete # %s?', $staff['Staff']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Staff'), array('action' => 'add')); ?></li>
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
