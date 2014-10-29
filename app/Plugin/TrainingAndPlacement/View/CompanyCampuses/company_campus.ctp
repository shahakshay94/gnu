<div class="table-responsive"> 
<div class="companycampus index">
	<h3><?php echo __('Company Campus'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo  'Company'; ?></th>
			<th><?php echo  'Academic Year'; ?></th>	
	</tr>
	<?php foreach ($CompanyCampuses as $companyCampus): ?>
	<tr>
	<?php if($companyCampus['CompanyCampus']['recstatus'] == 1){ ?>
		<td><?php echo $this->Html->link($companyCampus['CompanyMaster']['name'], array('controller' => 'company_masters', 'action' => 'view', $companyCampus['CompanyMaster']['id'])); ?>&nbsp;</td>
		<td>			<?php echo $companyCampus['AcademicYear']['name']; ?>&nbsp;</td>
		<?php }?>
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