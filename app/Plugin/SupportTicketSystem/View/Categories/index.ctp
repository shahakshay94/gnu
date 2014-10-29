
<div class="table-responsive">
<div class="categories index">
	<h2><?php echo __('Categories'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('institution_id'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
		<td><?php echo h($category['Institution']['name']); ?>&nbsp;</td>
		<td><?php echo h($category['Department']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('',true), array('action' => 'view', $category['Category']['id']),array('class' => 'glyphicon glyphicon-search')); ?>
			<?php echo $this->Html->link(__('',true), array('action' => 'edit', $category['Category']['id']),array('class' => 'glyphicon glyphicon-edit')); ?>
			<?php
            if($category['Category']['recstatus'] == 1){
                echo $this->Form->postLink(__('',true), array('action' => 'deactivate', $category['Category']['id']),array('class' => 'glyphicon glyphicon-remove', 'escape' => false),null, __('Are you sure you want to deactivate # %s?', $category['Category']['id']));
            }
        ?>
        <?php
            if($category['Category']['recstatus'] == 0){
                echo $this->Form->postLink(__('',true), array('action' => 'activate', $category['Category']['id']),array('class' => 'glyphicon glyphicon-ok', 'escape' => false),null, __('Are you sure you want to activate # %s?', $category['Category']['id']));
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

