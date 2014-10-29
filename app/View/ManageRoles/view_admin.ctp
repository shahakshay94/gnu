<div class="table-responsive">
<div class="admins view">
<h2><?php echo __('Admin'); ?></h2>
	<table class="table table-striped">
		
		<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo h($admin['Staff']['firstname']." ".$admin['Staff']['lastname']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Institution'); ?></th>
		<td>
			<?php echo h($admin['Institution']['name']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Department'); ?></th>
		<td>
			<?php echo h($admin['Department']['name']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Role'); ?></th>
		<td>
			<?php echo h($admin['Role']['alias']); ?>
			&nbsp;
		</td>
		</tr>
		</table>
</div>
</div>
