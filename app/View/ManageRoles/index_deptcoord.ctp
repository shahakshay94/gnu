
<div class="table-responsive">
<div class="coordinators index">
	<h2><?php echo __('Department Co-ordinators'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>

			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('institution_id'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th><?php echo $this->Paginator->sort('role_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($coordinators as $coordinator): ?>
	<tr>

		<td>
			<?php echo h($coordinator['Staff']['firstname']." ".$coordinator['Staff']['lastname']); ?>
		</td>
		<td>
			<?php echo h($coordinator['Institution']['name']); ?>
		</td>
		<td>
			<?php echo h($coordinator['Department']['name']); ?>
		</td>
		<td>
			<?php echo h($coordinator['Role']['alias']); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('', true), array('action' => 'view_admin', $coordinator['ManageRole']['id']), array('class' => 'glyphicon glyphicon-eye-open')); ?>
			<?php 
			if($coordinator['ManageRole']['recstatus'] == 1){
				echo $this->Form->postLink(__('', true), array('action' => 'deactivate_developer_deptcoord', $coordinator['ManageRole']['id']),array('class' => 'glyphicon glyphicon-remove', 'escape' => false), null, __('Are you sure you want to Deactivate # %s?', $coordinator['ManageRole']['id'])); 
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