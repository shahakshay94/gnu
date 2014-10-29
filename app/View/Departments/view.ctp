<div class="departments view">
<h2><?php echo __('Department'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($department['Department']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Institution'); ?></dt>
		<dd>
			<?php echo $this->Html->link($department['Institution']['name'], array('controller' => 'institutions', 'action' => 'view', $department['Institution']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($department['Department']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Degrees'); ?></h3>
	<?php debug($department['Degree']); ?>
	<?php if (!empty($department['Degree'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Department'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($department['Degree'] as $degree): ?>
		<tr>
			<td><?php echo $degree['id']; ?></td>
			<td>	<?php echo $this->Html->link($department['Department']['name'], array('controller' => 'institutions', 'action' => 'view', $degree['id'])); ?></td>
			<td><?php echo $degree['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'degrees', 'action' => 'view', $degree['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'degrees', 'action' => 'edit', $degree['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
