<div class="companyMasters view">
<h3><?php echo __('Company Master'); ?></h3>
<table class="table table-striped">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($companyMaster['CompanyMaster']['name']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Profile'); ?></th>
		<td>
			<?php echo h($companyMaster['CompanyMaster']['profile']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Website'); ?></th>
		<td>
			<?php echo h($companyMaster['CompanyMaster']['website']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Location'); ?></th>
		<td>
			<?php echo h($companyMaster['CompanyMaster']['location']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Category'); ?></th>
		<td>
			<?php echo h($companyMaster['CompanyMaster']['category']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Training'); ?></th>
		<td>
			<?php if($companyMaster['CompanyMaster']['training'] == 1){
			echo $this->Html->image('yes.png',array('withh' => '30px', 'height' => '30px'));
			
		}
		else{
			echo $this->Html->image('no.png',array('withh' => '30px', 'height' => '30px'));
			
		}
		?>	&nbsp;
		</td>
	</tr>
	<tr>	
		<th><?php echo __('Job'); ?></th>
		<td>
			<?php if($companyMaster['CompanyMaster']['job'] == 1){
			echo $this->Html->image('yes.png',array('withh' => '30px', 'height' => '30px'));
			
		}
		else{
			echo $this->Html->image('no.png',array('withh' => '30px', 'height' => '30px'));
			
		}
		?>
			&nbsp;
		</td>
	</tr>
	</table>
</div>
