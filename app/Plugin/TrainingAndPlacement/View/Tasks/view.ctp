<br>
<div class="tasks view">
<h3><?php echo __('Task'); ?></h3>
<table class="table table-striped">
	
	<tr>
		<th><?php echo __('Title'); ?></th>
		<td><?php echo h($task['Task']['title']); ?></td>
	</tr>
	<tr>
		<th><?php echo __('Date of task'); ?></th>
		<td><?php echo h($task['Task']['dateoftask']); ?></td>
	</tr>
	<tr>
		<th><?php echo __('Done'); ?></th>
		<td>
			<?php
if($task['Task']['done']) 
	{
		echo $this->Html->image('test-pass-icon.png', array('alt' => 'CakePHP'));
		echo "Done";
	}
else 
	{
		echo $this->Html->image('test-fail-icon.png', array('alt' => 'CakePHP'));
		echo "Pending";
	}
?></td>
	</tr>
</table>

	
</div>
