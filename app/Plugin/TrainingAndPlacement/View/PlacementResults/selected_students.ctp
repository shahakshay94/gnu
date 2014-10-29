<div class="placementResults index">
	<h2><?php echo __('List of selected students'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Students'); ?></th>
			<th><?php echo $this->Paginator->sort('Selection Status'); ?></th>
	</tr>
	<?php foreach ($data as $placementResult): ?>
	<tr>
		<td><?php echo $this->Html->link($placementResult['Student']['firstname'].' '.$placementResult['Student']['lastname'], array('controller' => 'students', 'action' => 'view', $placementResult['Student']['id'])); ?>&nbsp;
		</td> 
		<td>
		<?php foreach ($company as $data){
			echo $data['CompanyMaster']['name'];	
			} ?>
		</td>
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
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	<?php echo $this->Html->link(__('<< Back To Search <<'), array('controller' => 'placement_results', 'action' => 'form2')); ?>
</div>
