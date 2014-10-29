<div class="table-responsive">
<div class="companyVisits index">
	<h3><?php echo __('Company Visit Date'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			
			<th><?php echo $this->Paginator->sort('CompanyVisit.company_master_id','Company'); ?></th>
			<th><?php echo $this->Paginator->sort('CompanyVisit.pptdate','PrePlacement Talk'); ?></th>
			<th><?php echo $this->Paginator->sort('CompanyVisit.visitdate1','Visiting Priority-1'); ?></th>
			<th><?php echo $this->Paginator->sort('CompanyVisit.visitdate2','Visiting Priority-2'); ?></th>
			<th><?php echo $this->Paginator->sort('CompanyVisit.visitdate3','Visiting Priority-3'); ?></th>
			<th><?php echo $this->Paginator->sort('CompanyVisit.lastdate','Last Date Of Registration'); ?></th>
			<th><?php echo $this->Paginator->sort('CompanyVisit.placementtype','Placement'); ?></th>
			<th><?php echo $this->Paginator->sort('CompanyVisit.placementvenue','Placement Venue'); ?></th>
	</tr>
	<?php foreach ($CompanyVisits as $companyVisit): ?>
	<tr>
		<?php if($companyVisit['CompanyVisit']['recstatus'] == 1){ ?>
		<td>
			<?php echo $this->Html->link($companyVisit['CompanyMaster']['name'], array('controller' => 'company_masters', 'action' => 'view', $companyVisit['CompanyMaster']['id'])); ?>
		</td>
		<td><?php echo h($this->Time->format('F jS,Y', $companyVisit['CompanyVisit']['pptdate'])); ?>&nbsp;</td>
		<td><?php echo h($this->Time->format('F jS,Y', $companyVisit['CompanyVisit']['visitdate1'])); ?>&nbsp;</td>
		<td><?php echo h($this->Time->format('F jS,Y', $companyVisit['CompanyVisit']['visitdate2'])); ?>&nbsp;</td>
		<td><?php echo h($this->Time->format('F jS,Y', $companyVisit['CompanyVisit']['visitdate3'])); ?>&nbsp;</td>
		<td><?php echo h($this->Time->format('F jS,Y', $companyVisit['CompanyVisit']['lastdate'])); ?>&nbsp;</td>
		<td><?php echo h($companyVisit['CompanyVisit']['placementtype']); ?>&nbsp;</td>
		<td><?php echo h($companyVisit['CompanyVisit']['placementvenue']); ?>&nbsp;</td>
		<?php } ?>
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
