
<div class="transfers index">
	<h2><?php echo __('Manage Transferred Tickets'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			
			<th><?php echo $this->Paginator->sort('ticket_id'); ?></th>			
			<th><?php echo $this->Paginator->sort('created','Transferred On'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('staff_id'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('status_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
		<?php foreach ($transfers as $transfer): ?>
		<?php if($transfer['DepartmentTransfer']['recstatus'] != 0 ){ ?>
	<tr>
		
		<td>
			<?php echo h($transfer['DepartmentTransfer']['ticket_id']); ?>&nbsp;
		</td>
		<td>
			<?php echo h($this->Time->nice($transfer['DepartmentTransfer']['created'])); ?>&nbsp;
		</td>
		<td>
			<?php echo h($transfer['Ticket']['User']['fullname']); ?>
		</td>
		<td>
			<?php echo h($transfer['Staff']['firstname']." ".$transfer['Staff']['lastname']); ?>
		</td>
		<td>
			<?php echo h($transfer['Category']['name']); ?>
		</td>
		<td><?php echo h($transfer['Ticket']['subject']); ?>&nbsp;</td>
		<td>
			<?php echo h($transfer['Status']['name']); ?>
		</td>
		<td class="actions">

			<?php echo $this->Html->link(__('View'), array('action' => 'view', $transfer['DepartmentTransfer']['id'])); ?>
			
			<?php echo $this->Html->link(__('Change Ticket Status'), array('action' => 'change_status', $transfer['DepartmentTransfer']['id'])); ?>
		
			
		</td>
	</tr>
	<?php } ?>	
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