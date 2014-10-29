
<div class="table-responsive">
<div class="statuses index">
	<h2><?php echo __('Statuses'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($statuses as $status): ?>
	<tr>
		<td><?php echo h($status['Status']['id']); ?>&nbsp;</td>
		<td><?php echo h($status['Status']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('',true), array('action' => 'view', $status['Status']['id']),array('class' => 'glyphicon glyphicon-search')); ?>
			<?php echo $this->Html->link(__('',true), array('action' => 'edit', $status['Status']['id']),array('class' => 'glyphicon glyphicon-edit')); ?>
			<?php
            if($status['Status']['recstatus'] == 1){
                echo $this->Form->postLink(__('',true), array('action' => 'deactivate', $status['Status']['id']),array('class' => 'glyphicon glyphicon-remove', 'escape' => false),null, __('Are you sure you want to deactivate # %s?', $status['Status']['id']));
            }
        ?>
        <?php
            if($status['Status']['recstatus'] == 0){
                echo $this->Form->postLink(__('',true), array('action' => 'activate', $status['Status']['id']),array('class' => 'glyphicon glyphicon-ok', 'escape' => false),null, __('Are you sure you want to activate # %s?', $status['Status']['id']));
            }
        ?>
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
</div>