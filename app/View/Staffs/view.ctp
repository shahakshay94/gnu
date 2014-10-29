<div class="table-responsive">
<div class="students view">
<h3><?php echo __('Personal Profile'); ?></h3>
<table class="table table-striped">
		<tr><th><?php echo __('Firstname'); ?></th>
		<td>
			<?php echo h($staff['Staff']['firstname']); ?>
			&nbsp;
		</td></tr>
		<tr><th><?php echo __('Lastname'); ?></th>
		<td>
			<?php echo h($staff['Staff']['lastname']); ?>
			&nbsp;
		</td></tr>
		<tr><th><?php echo __('Institution'); ?></th>
		<td>
		<?php echo $staff['Institution']['name']; ?>
		</td></tr>
		<tr><th><?php echo __('Department'); ?></th>
		<td>
		
			<?php echo $staff['Department']['name']; ?>
	
		</td></tr>
		<tr><th><?php echo __('Email-Id'); ?></th>
		<td>
		<?php echo AuthComponent::user('email'); ?>
		</td></tr>
</table>
</div>
</div>
