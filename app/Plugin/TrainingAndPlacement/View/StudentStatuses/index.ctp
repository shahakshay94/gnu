<div class="table-responsive">
<div class="stuStatuses index">
	<h3><?php echo __('Student Statuses'); ?></h3>
	<table cellpadding="0" cellspacing="0"  class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('student_id','Student Name'); ?></th>
			<th><?php echo $this->Paginator->sort('trainingAt','Training At'); ?></th>
			<th><?php echo $this->Paginator->sort('companyname','Company Name'); ?></th>
			<th><?php echo $this->Paginator->sort('training','Training Confirm'); ?></th>
			<th><?php echo $this->Paginator->sort('job','Job Confirm'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($studentStatuses as $studentStatus): ?>
	<tr>
		<td><?php echo $this->Html->link($studentStatus['Student']['firstname'].' '.$studentStatus['Student']['lastname'], array('controller' => 'Students', 'action' => 'view', $studentStatus['Student']['id'])); ?>
		&nbsp;</td>
		<td><?php echo h($studentStatus['StudentStatus']['trainingAt']); ?>&nbsp;</td>
		<td><?php echo h($studentStatus['StudentStatus']['companyname']); ?>&nbsp;</td>
		<td><?php if($studentStatus['StudentStatus']['training'] == 1){
			echo $this->Html->image('yes.png',array('width' => '30px', 'height' => '30px'));			
		}
		else{
			echo $this->Html->image('no.png',array('width' => '30px', 'height' => '30px'));
			
		} ?>&nbsp;</td>
		<td><?php if($studentStatus['StudentStatus']['job'] == 1){
			echo $this->Html->image('yes.png',array('width' => '30px', 'height' => '30px'));
			
		}
		else{
			echo $this->Html->image('no.png',array('width' => '30px', 'height' => '30px'));
			
		} ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('', true), array('action' => 'view', $studentStatus['StudentStatus']['id']), array('class' => 'glyphicon glyphicon-search')); ?>
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