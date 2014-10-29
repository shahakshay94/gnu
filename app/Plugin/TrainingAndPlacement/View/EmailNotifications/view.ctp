
<div class="emailNotifications view">
<h2><?php echo __('Email Notification'); ?></h2>
	<dl>
		<dt><?php echo __('To'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['to']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flag'); ?></dt>
		<dd>
			<?php echo h($emailNotification['EmailNotification']['flag']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Email Notification'), array('action' => 'edit', $emailNotification['EmailNotification']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Email Notification'), array('action' => 'delete', $emailNotification['EmailNotification']['id']), null, __('Are you sure you want to delete # %s?', $emailNotification['EmailNotification']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Email Notifications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Notification'), array('action' => 'add')); ?> </li>
	</ul>
</div>
