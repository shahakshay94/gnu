<div class="table-responsive">
<div class="placementResults index">
	<h3><?php echo __('Pending Students'); ?></h3>
<p style="text-transform:uppercase;"><b>Campus Info : </b><?php 
foreach ($institute as $data){
echo $data['Institution']['name'].' >> '; 	
}
foreach ($branch as $data){
echo $data['Department']['name'].' >> '; 	
}
foreach ($degree as $data){
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
