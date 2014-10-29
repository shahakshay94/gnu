<div class="table-responsive"><div class="table-responsive">
<div class="ticketManages index">
	<h2><?php echo __('Ticket Coordinators'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('staff_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ticketManages as $ticketManage): ?>
	<tr>
		<td><?php echo h($ticketManage['TicketManage']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ticketManage['Category']['name'], array('controller' => 'categories', 'action' => 'view', $ticketManage['Category']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ticketManage['Staff']['firstname'].$ticketManage['Staff']['lastname'], array('plugin'=>false,'controller' => 'staffs', 'action' => 'view', $ticketManage['Staff']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ticketManage['TicketManage']['id'])); ?>
			<?php
            if($ticketManage['TicketManage']['recstatus'] == 1){
                echo $this->Form->postLink(__('deactivate'), array('action' => 'deactivate', $ticketManage['TicketManage']['id']),null, __('Are you sure you want to deactivate # %s?', $ticketManage['TicketManage']['id']));
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