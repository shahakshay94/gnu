<div class="table-responsive">
<div class="companycampus index">
	<h3><?php echo __('Apply For Campus Placement'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo  'Company Name'; ?></th>
			<th><?php echo  'Academic Year'; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>	
	</tr>
	<?php foreach ($CompanyCampuses as $companyCampus): ?>
	<tr>
		<td><?php echo $this->Html->link($companyCampus['CompanyMaster']['name'], array('controller' => 'company_masters', 'action' => 'view', $companyCampus['CompanyMaster']['id'])); ?>&nbsp;</td>
		<td>			<?php echo $companyCampus['AcademicYear']['name']; ?>&nbsp;</td>
		<td class="actions">
	<?php 
			$lastdate = $companyCampus['CompanyMaster']['CompanyVisit'][0]['lastdate'];
			$date = date('d-m-Y');
			if($student_check == 0 && strtotime($lastdate) > strtotime($date)){
						
					echo $this->Form->postLink(__('Apply for this company'), array('controller' => 'PlacementResults','action' => 'apply_company', $companyCampus['CompanyCampus']['id'],$student_id), null, __('Are you sure you want to apply for this company ?'));
			} else{
					echo 'Cant apply for this company';	
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

