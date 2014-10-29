<div class="table-responsive">
<div class="companycampus index">
	<h3><?php echo __('Company Campus'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('institution_id','Institution'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id','Department'); ?></th>
			<th><?php echo $this->Paginator->sort('degree_id','Degree'); ?></th>
			<th><?php echo $this->Paginator->sort('company_master_id','Company'); ?></th>
			<th><?php echo $this->Paginator->sort('academic_year_id','Academic Year'); ?></th>
			<th><?php echo $this->Paginator->sort('recstatus','Status'); ?>
			<th class="actions"><?php echo __('Actions'); ?></th>	
	</tr>
	<?php foreach ($CompanyCampuses as $companyCampus): ?>
	<tr>
		<td>
			<?php echo $companyCampus['Institution']['name']; ?>
		</td>
		<td><?php echo $companyCampus['Department']['name']; ?>&nbsp;</td>
		<td><?php echo $companyCampus['Degree']['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->link($companyCampus['CompanyMaster']['name'], array('controller' => 'company_masters', 'action' => 'view', $companyCampus['CompanyMaster']['id'])); ?>&nbsp;</td>
		<td><?php echo $companyCampus['AcademicYear']['name']; ?>&nbsp;</td>
		<td><?php 
		if($companyCampus['CompanyCampus']['recstatus'] == 1) {
			echo "Active";	
		} else {
			echo "Not Active";
		}?>
		&nbsp;
		</td>
		<td class="actions">
			<?php 
			if($companyCampus['CompanyCampus']['recstatus'] == 0){
				echo $this->Form->postLink(__('', true), array('action' => 'activate', $companyCampus['CompanyCampus']['id']), array('class' => 'glyphicon glyphicon-ok', 'escape' => false), null, __('Are you sure you want to Activate # %s?', $companyCampus['CompanyCampus']['id'])); 
			}
		?>
		<?php 
			if($companyCampus['CompanyCampus']['recstatus'] == 1){
				echo $this->Form->postLink(__('', true), array('action' => 'deactivate', $companyCampus['CompanyCampus']['id']), array('class' => 'glyphicon glyphicon-remove', 'escape' => false), null, __('Are you sure you want to Deactivate # %s?', $companyCampus['CompanyCampus']['id'])); 
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
