<div class="table-responsive">
<div class="placementResults index">
	<h3><?php echo __('Placement Results'); ?></h3>
<p style="text-transform:uppercase;"><b>Campus Info : </b><?php 
foreach ($company_institute as $data){
echo $data['Institution']['name'].' >> '; 	
}
foreach ($company_department as $data){
echo $data['Department']['name'].' >> '; 	
}
foreach ($company_degree as $data){
echo $data['Degree']['name'].'<br/>'; 	
}
?></p><p style="text-transform:uppercase;">
<b>List of students who applied for :</b>
<?php 
foreach ($company_name as $name){
echo $name['CompanyMaster']['name']; }?>		
</p>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('student_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Verbal'); ?></th>
			<th><?php echo $this->Paginator->sort('aptitude'); ?></th>
			<th><?php echo $this->Paginator->sort('interview'); ?></th>
			<th><?php echo $this->Paginator->sort('gd'); ?></th>
			<th><?php echo $this->Paginator->sort('hr'); ?></th>
			<th><?php echo $this->Paginator->sort('Selection Status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($PlacementResults as $placementResult): ?>
	<tr>
		<td><?php echo $this->Html->link($placementResult['Student']['firstname'].' '.$placementResult['Student']['lastname'], array('controller' => 'Students', 'action' => 'view', $placementResult['Student']['id'])); ?>&nbsp;
		</td> 
	
		<td><?php if($placementResult['PlacementResult']['verbal'] == 1){
				echo 'Pass';
			}	
			else{
				echo 'Fail';
			}	
			 ?>&nbsp;</td>
		<td><?php if($placementResult['PlacementResult']['aptitude'] == 1){
				echo 'Pass';
			}
			else{
				echo 'Fail';
			}	
			  ?>&nbsp;</td>
		<td><?php if($placementResult['PlacementResult']['interview'] == 1){
				echo 'Pass';
			}
			else{
				echo 'Fail';
			}	
			  ?>&nbsp;</td>
		<td><?php if($placementResult['PlacementResult']['gd'] == 1){
				echo 'Pass';
			}	
			else{
				echo 'Fail';
			}	
			  ?>&nbsp;</td>
		<td><?php if($placementResult['PlacementResult']['hr'] == 1){
				echo 'Pass';
			}	
			else{
				echo 'Fail';
			}	
			  ?>&nbsp;</td>
		<td><?php echo $placementResult['PlacementResult']['status'];?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('Change Status'), array('controller' => 'placement_results','action' => 'edit', $placementResult['PlacementResult']['id'], $institute, $department, $degree, $company)); ?>
			<?php echo $this->Html->link(__('Check Resume'), array('controller' => 'student_resumes','action' => 'view', $placementResult['Student']['id'])); ?>
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
