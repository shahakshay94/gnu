<div class="table-responsive">
<div class="ticketManages view">
<h2><?php echo __('Ticket Manage'); ?></h2>
	<table class="table table-striped">
		<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($ticketManage['TicketManage']['id']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Category'); ?></th>
		<td>
			<?php echo $this->Html->link($ticketManage['Category']['name'], array('controller' => 'categories', 'action' => 'view', $ticketManage['Category']['id'])); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Staff'); ?></th>
		<td>
			<?php echo $this->Html->link($ticketManage['Staff']['id'], array('controller' => 'staffs', 'action' => 'view', $ticketManage['Staff']['id'])); ?>
			&nbsp;
		</td>
		</tr>
	</table>
</div>
</div>