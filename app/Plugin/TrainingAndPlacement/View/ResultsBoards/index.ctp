<div class="table-responsive">
<div class="resultsBoards index">
	<h3><?php echo __('SSC & HSC Results'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo 'Student Name'; ?></th>
			<th><?php echo 'Exam'; ?></th>
			<th><?php echo 'Passing Year'; ?></th>
			<th><?php echo 'Board Name'; ?></th>
			<th><?php echo 'Percentage'; ?></th>
	</tr>

	<?php foreach ($ResultsBoards as $resultsBoard): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($resultsBoard['Student']['firstname'].' '.$resultsBoard['Student']['lastname'], array('controller' => 'students', 'action' => 'view', $resultsBoard['Student']['id'])); ?>
		</td>
		<td><?php echo h($resultsBoard['ResultsBoard']['exam_type']); ?></td>
		<td><?php echo h($resultsBoard['ResultsBoard']['passing_year']); ?>&nbsp;</td>
		
		<td><?php echo h($resultsBoard['ResultsBoard']['board_name']); ?>&nbsp;</td>
		<td><?php echo h($resultsBoard['ResultsBoard']['percentage']); ?>&nbsp;</td>
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