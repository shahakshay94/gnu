<div class="students index">
	<h2><?php echo __('Students'); ?></h2>
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
			<th><?php echo $this->Paginator->sort('instituteid'); ?></th>
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
			<th><?php echo $this->Paginator->sort('studentstatus'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($students as $student): ?>
	<tr>
		<td><?php echo h($student['Student']['id']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['created']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['creator_id']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['modified']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['modifier_id']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['recstatus']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['firstname']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['lastname']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['email']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['institution_id']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['phone1']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['phone2']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['C_Address-1']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['C_Address-2']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['C_Address-3']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['C_City']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['C_State']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['C_Pincode']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['P_Address-1']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['P_Address-2']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['P_Address-3']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['P_City']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['P_State']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['P_Pincode']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['picture']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['studentstatus']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $student['Student']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $student['Student']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $student['Student']['id']), null, __('Are you sure you want to delete # %s?', $student['Student']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Student'), array('action' => 'add')); ?></li>
	</ul>
</div>
