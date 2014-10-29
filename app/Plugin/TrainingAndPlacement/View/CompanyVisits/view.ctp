<div class="table-responsive">
<div class="companyVisits view">
<h3><?php echo __('Company Visit'); ?></h3>
<table class="table table-striped">
	<tr>
		<th><?php echo __('Company Master'); ?></th>
		<td>
			<?php echo $this->Html->link($companyVisit['CompanyMaster']['name'], array('controller' => 'company_masters', 'action' => 'view', $companyVisit['CompanyMaster']['id'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Pre Placement Talk'); ?></th>
		<td>
			<?php echo h($this->Time->format('F jS,Y h:i:s A', $companyVisit['CompanyVisit']['pptdate'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Visit Date 1'); ?></th>
		<td>
			<?php echo h($this->Time->format('F jS,Y h:i:s A', $companyVisit['CompanyVisit']['visitdate1'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Visit Date 2'); ?></th>
		<td>
			<?php echo h($this->Time->format('F jS,Y h:i:s A', $companyVisit['CompanyVisit']['visitdate2'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Visit Date 3'); ?></th>
		<td>
			<?php echo h($this->Time->format('F jS,Y h:i:s A', $companyVisit['CompanyVisit']['visitdate3'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Last Date'); ?></th>
		<td>
			<?php echo h($this->Time->format('F jS,Y h:i:s A', $companyVisit['CompanyVisit']['lastdate'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Placement Type'); ?></th>
		<td>
			<?php echo h($companyVisit['CompanyVisit']['placementtype']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Placement Venue'); ?></th>
		<td>
			<?php echo h($companyVisit['CompanyVisit']['placementvenue']); ?>
			&nbsp;
		</td>
	</tr>
	</table>
</div>
