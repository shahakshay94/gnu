<div class="row">
          <div class="col-lg-6">
<div class="students index">
<h3>View Student's Profile</h3>
	<table class="table table-striped">
		<tr>
			<th>Student Name</th>
			<th>Action</th>
		</tr>
		<?php foreach ($Students as $student): ?>
		<tr>
			<td><?php echo h($student['Student']['firstname'].' '.$student['Student']['lastname']); ?></td>
			<td class="actions">
			<?php echo $this->Html->link(__('', true), array('action' => 'view', $student['Student']['id']), array('class' => 'glyphicon glyphicon-search')); ?>
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
</div></div>