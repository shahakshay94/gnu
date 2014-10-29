<div class="table-responsive">
<div class="referredCompanies index">
	<h3><?php echo __('Referred Companies'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('ReferredCompany.companyname','Company Name'); ?></th>
			<th><?php echo $this->Paginator->sort('ReferredCompany.forTraining','Offer Training'); ?></th>
			<th><?php echo $this->Paginator->sort('ReferredCompany.forjob','Offer Job'); ?></th>
			<th><?php echo $this->Paginator->sort('location'); ?></th>
			<th><?php echo $this->Paginator->sort('website'); ?></th>
			<th><?php echo $this->Paginator->sort('ReferredCompany.companycontact','Company Contact'); ?></th>
			<th><?php echo $this->Paginator->sort('ReferredCompany.referance','Referance in compamy'); ?></th>
			<th><?php echo $this->Paginator->sort('flag'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ReferredCompanies as $referredCompany): ?>
	<tr>
		<td><?php echo h($referredCompany['ReferredCompany']['companyname']); ?>&nbsp;</td>
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
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $referredCompany['ReferredCompany']['id'])); ?>
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
