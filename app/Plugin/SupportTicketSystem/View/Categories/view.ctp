
<div class="table-responsive">
<div class="categories view">
<h2><?php echo __('Category'); ?></h2>
	<table class="table table-striped">
		<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($category['Category']['name']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Recstatus'); ?></th>
		<td>
			<?php if($category['Category']['recstatus'] ==1 ){
				echo "Active";
				} else {
					echo "Deactive";
				} ?>
			&nbsp;
		</td>
		</tr>
	</table>
</div>

<div class="related">
	<h3><?php echo __('Related Tickets'); ?></h3>
	<?php if (!empty($category['Ticket'])): ?>
	<table cellpatding = "0" cellspacing = "0" class="table table striped">
	<tr>
		<th><?php echo __('Ticket No'); ?></th>
		<th><?php echo __('User'); ?></th>
		<th><?php echo __('Staff'); ?></th>
		<th><?php echo __('Category'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($category['Ticket'] as $ticket): ?>
		<tr>
			<td><?php echo $ticket['ticket_no']; ?></td>
			<td><?php echo $ticket['User']['fullname']; ?></td>
			<td><?php echo $ticket['Staff']['firstname']." ".$ticket['Staff']['lastname']; ?></td>
			<td><?php echo $category['Category']['name']; ?></td>
			<td><?php echo $ticket['subject']; ?></td>
			<td><?php echo $ticket['Status']['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tickets', 'action' => 'view', $ticket['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
</div>
