<div class="degrees index">
	<h2><?php echo __('Degrees'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($degrees as $degree): ?>
	<tr>
		<td><?php echo h($degree['Degree']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($degree['Department']['name'], array('controller' => 'departments', 'action' => 'view', $degree['Department']['id'])); ?>
		</td>
		<td><?php echo h($degree['Degree']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $degree['Degree']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $degree['Degree']['id'])); ?>
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