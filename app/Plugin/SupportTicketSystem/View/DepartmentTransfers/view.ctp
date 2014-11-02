
<div class="table-responsive">
<div class="trasnfers view">
<h2><?php echo __('Current Ticket Status'); ?></h2>
	<table class="table table-striped">
		<tr>
			<th><?php echo __('Ticket No.'); ?></th>
			<td>
				<?php echo h($transfer['DepartmentTransfer']['ticket_id']); ?>
				&nbsp;
			</td>
		</tr>
		<tr>
			<th><?php echo __('User'); ?></th>
			<td>
				<?php echo h($transfer['Ticket']['User']['fullname']); ?>
				&nbsp;
			</td>
		</tr>
		<tr>
			<th><?php echo __('Current Staff'); ?></th>
			<td>
				<?php echo h($transfer['Staff']['firstname']." ".$transfer['Staff']['lastname']); ?>
				&nbsp;
			</td>
		</tr>
		<tr>
			<th><?php echo __('Current Category'); ?></th>
			<td>
				<?php echo h($transfer['Category']['name']); ?>
				&nbsp;
			</td>
		</tr>
		<tr>
			<th><?php echo __('Current Subject'); ?></th>
			<td>
				<?php echo h($transfer['Ticket']['subject']); ?>
				&nbsp;
			</td>
		</tr>
		<tr>
			<th><?php echo __('Reason for Transfer'); ?></th>
			<td>
				<?php echo h($transfer['DepartmentTransfer']['reasons_for_transfer']); ?>
				&nbsp;
			</td>
		</tr>
		<tr>
			<th><?php echo __('Current Status'); ?></th>
			<td>
				<?php echo h($transfer['Status']['name']); ?>
				&nbsp;
			</td>
		</tr>
	</table>
</div>

<!-- <?php debug($transfer);?> -->

<div class="table table-striped">
	<h2><?php echo __('History of ticket'); ?></h2>
	<?php if (!empty($transfer['DepartmentTransfer'])): ?>
	<table cellpatding = "0" cellspacing = "0" class="table table striped">
	<tr>
		<th><?php echo __('Ticket No'); ?></th>
		<th><?php echo __('From Department'); ?></th>
		<th><?php echo __('Old Staff'); ?></th>
		<th><?php echo __('Category'); ?></th>
		<th><?php echo __('Complain'); ?></th>
	</tr>
		<tr>
			<td><?php echo $transfer['Ticket']['ticket_no']; ?></td>
			<td><?php echo $transfer['Ticket']['Staff']['Department']['name']; ?></td>
			<td><?php echo $transfer['Ticket']['Staff']['name']; ?></td>
			<td><?php echo $transfer['Category']['name']; ?></td>
			<td><?php echo $transfer['Ticket']['complain']; ?></td>
		</tr>
	</table>
<?php endif; ?>
</div>
</div>
