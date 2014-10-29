<div class="table-responsive">
<div class="placementResults index">
<h3>Your Campus Selection Status</h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo 'Student'; ?></th>
			<th><?php echo 'Company'; ?></th>
			<th><?php echo 'Verbal Test'; ?></th>
			<th><?php echo 'Aptitude Test'; ?></th>
			<th><?php echo 'Interview Test '; ?></th>
			<th><?php echo 'GD Test'; ?></th>
			<th><?php echo 'HR Test'; ?></th>
			<th><?php echo 'Selection Status'; ?></th>
	</tr>
	<?php foreach ($PlacementResults as $placementResult): ?>
	<tr>
		<td><?php echo h($placementResult['Student']['firstname'].' '.$placementResult['Student']['lastname']); ?>&nbsp;</td>
		<td>
			<?php echo h($placementResult['CompanyCampus']['CompanyMaster']['name']); ?>	
		</td>
		<td><?php if($placementResult['PlacementResult']['verbal'] == 1){
				echo 'Pass';
			}	
			else{
				echo 'Yet Not Given/Fail';
			}	
			 ?>&nbsp;</td>
		<td><?php if($placementResult['PlacementResult']['aptitude'] == 1){
				echo 'Pass';
			}
			else{
				echo 'Yet Not Given/Fail';
			}	
			  ?>&nbsp;</td>
		<td><?php if($placementResult['PlacementResult']['interview'] == 1){
				echo 'Pass';
			}
			else{
				echo 'Yet Not Given/Fail';
			}	
			  ?>&nbsp;</td>
		<td><?php if($placementResult['PlacementResult']['gd'] == 1){
				echo 'Pass';
			}	
			else{
				echo 'Yet Not Given/Fail';
			}	
			  ?>&nbsp;</td>
		<td><?php if($placementResult['PlacementResult']['hr'] == 1){
				echo 'Pass';
			}	
			else{
				echo 'Yet Not Given/Fail';
			}	
			  ?>&nbsp;</td>
		<td><?php echo $placementResult['PlacementResult']['status'];?></td>
			
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
</div></div>