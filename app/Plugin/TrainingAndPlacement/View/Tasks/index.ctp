<br>
<div class="table-responsive">
<div class="tasks index">
	<h2><?php echo __('Tasks'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('title','Title'); ?></th>
			<th><?php echo $this->Paginator->sort('dateoftask','Date of Task'); ?></th>
			<th><?php echo $this->Paginator->sort('done','Status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tasks as $task): ?>
	<tr>
		<td><?php echo h($task['Task']['title']); ?>&nbsp;</td>
		<td width="13%"><?php echo h($task['Task']['dateoftask']); ?>&nbsp;</td>
		<td width="13%">
			<?php
if($task['Task']['done']) 
	{
		echo $this->Html->image('test-pass-icon.png');
		echo "Done";
	}
else 
	{
		echo $this->Html->image('test-fail-icon.png');
		echo "Pending";
	}
?>
		&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('', true), array('action' => 'view', $task['Task']['id']), array('class' => 'glyphicon glyphicon-search')); ?>
			<?php echo $this->Html->link(__('', true), array('action' => 'edit', $task['Task']['id']), array('class' => 'glyphicon glyphicon-edit')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<ul class="pagination pagination-large pull-right">
                        <?php
                            echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                            echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                        ?>
                    </ul>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Task'), array('action' => 'add')); ?></li>
	</ul>
</div>
<?php echo $this->Js->writeBuffer();?>