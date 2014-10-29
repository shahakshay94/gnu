<div class="table-responsive">
<div class="referredCompanies index">
	<h3><?php echo __('Referred Companies'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>

			<th><?php echo $this->Paginator->sort('ReferredCompany.userid','Referred By'); ?></th>
			<th><?php echo $this->Paginator->sort('forTraining','Training'); ?></th>
			<th><?php echo $this->Paginator->sort('forJob','Job'); ?></th>
			<th><?php echo $this->Paginator->sort('companyname', 'Company'); ?></th>
			<th><?php echo $this->Paginator->sort('location', 'Location'); ?></th>
			<th><?php echo $this->Paginator->sort('website', 'Website'); ?></th>
			<th><?php echo $this->Paginator->sort('companycontact', 'Contact'); ?></th>
			<th><?php echo $this->Paginator->sort('reference', 'Reference'); ?></th>
			<th><?php echo $this->Paginator->sort('flag', 'Approved'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($referredCompanies as $referredCompany): ?>
	<tr>
		
		<td><?php
			foreach ($user as $key => $name) {
					echo $name['User']['fullname'];
				}	
			?>&nbsp;</td>
		<td>
		<?php if($referredCompany['ReferredCompany']['forTraining'] == 1){
			echo $this->Html->image('yes.png',array('width' => '30px', 'height' => '30px'));
		//	echo 'YES';
		}
		else{
			echo $this->Html->image('no.png',array('width' => '30px', 'height' => '30px'));
		//	echo 'NO'; 
		}
		?>
		&nbsp;</td>
		<td>
			<?php if($referredCompany['ReferredCompany']['forJob'] == 1){
			echo $this->Html->image('yes.png',array('width' => '30px', 'height' => '30px'));
		//	echo 'YES';
		}
		else{
			echo $this->Html->image('no.png',array('width' => '30px', 'height' => '30px'));
		//	echo 'NO'; 
		}
		?>	
		&nbsp;</td>
		<td><?php echo h($referredCompany['ReferredCompany']['companyname']); ?>&nbsp;</td>
		<td><?php echo h($referredCompany['ReferredCompany']['location']); ?>&nbsp;</td>
		<td><?php echo h($referredCompany['ReferredCompany']['website']); ?>&nbsp;</td>
		<td><?php echo h($referredCompany['ReferredCompany']['companycontact']); ?>&nbsp;</td>
		<td><?php echo h($referredCompany['ReferredCompany']['referance']); ?>&nbsp;</td>
		<td><?php if($referredCompany['ReferredCompany']['flag'] == 0){
			echo $this->Html->image('new.jpg',array('width' => '50px', 'height' => '50px'));
		}
		else{
			echo $this->Html->image('rsave.png',array('width' => '50px', 'height' => '50px'));
		}
		?></td>
<!--		<td><?php echo h($referredCompany['ReferredCompany']['ip']); ?>&nbsp;</td> -->
		<td class="actions">
			<?php 
			if($referredCompany['ReferredCompany']['flag'] == 1){
				echo $this->Form->postLink(__('Unsave'), array('action' => 'unsave', $referredCompany['ReferredCompany']['id']), null, __('Are you sure you want to unsave # %s?', $referredCompany['ReferredCompany']['id'])); 
			}
		?>
		<?php 
			if($referredCompany['ReferredCompany']['flag'] == 0){
				echo $this->Form->postLink(__('Save'), array('action' => 'save', $referredCompany['ReferredCompany']['id']), null, __('Are you sure you want to save # %s?', $referredCompany['ReferredCompany']['id'])); 
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
</div></div>

