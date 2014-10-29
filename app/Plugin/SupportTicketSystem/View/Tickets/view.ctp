<div class="table-responsive">
<div class="tickets view">
<h2><?php echo __('Ticket'); ?></h2>
	<table class="table table-striped">
		<tr>
		<th><?php echo __('Ticket No'); ?></th>
		<td>
			<?php echo h($ticket['Ticket']['ticket_no']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo h($ticket['User']['fullname']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Staff'); ?></th>
		<td>
			<?php echo h($ticket['Staff']['firstname']." ".$ticket['Staff']['lastname']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Category'); ?></th>
		<td>
			<?php echo h($ticket['Category']['name']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Subject'); ?></th>
		<td>
			<?php echo h($ticket['Ticket']['subject']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Complain'); ?></th>
		<td>
			<?php echo h($ticket['Ticket']['complain']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($ticket['Status']['name']); ?>
			&nbsp;
		</td>
		</tr>
		</table>
</div>
</div>
