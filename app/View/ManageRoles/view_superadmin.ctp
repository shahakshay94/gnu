
<div class="table-responsive">
<div class="superadmins view">
<h2><?php echo __('Super Admin'); ?></h2>
	<table class="table table-striped">
		
		<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo h($superadmin['Staff']['firstname']." ".$superadmin['Staff']['lastname']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Institution'); ?></th>
		<td>
			<?php echo h($superadmin['Institution']['name']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Department'); ?></th>
		<td>
			<?php echo h($superadmin['Department']['name']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Role'); ?></th>
		<td>
			<?php echo h($superadmin['Role']['alias']); ?>
			&nbsp;
		</td>
		</tr>
		</table>
</div>
</div>
