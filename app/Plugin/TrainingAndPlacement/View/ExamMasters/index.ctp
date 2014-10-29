<div class="examMasters index">
	<h3><?php echo __('Exam Masters'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			
			<th><?php echo 'Student Name'; ?></th> 
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ExamMasters as $examMaster): ?>
	<tr>
		
		<td>
			<?php echo $examMaster['Student']['firstname'].' '.$examMaster['Student']['lastname']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('', true), array('action' => 'view', $examMaster['Student']['id']), array('class' => 'glyphicon glyphicon-search')); ?>
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

