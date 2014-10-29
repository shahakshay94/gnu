<br><br>

<div class="row">
          <div class="col-lg-6">
<?php 
	echo $this->Html->script('jquery'); 
	echo $this->Html->css('jquery-ui-1.10.4.custom');
	echo $this->Html->script('jquery-1.10.2');
	echo $this->Html->script('jquery-ui.min');
	echo $this->Html->script('jquery-ui-1.10.4.custom.min');
?>

<script type="text/javascript">
var dateToday = new Date();
	$(function() {
		$( "#datepicker1" ).datepicker({ minDate: dateToday,dateFormat: "dd-mm-yy"});
	});
	</script>
<div class="tasks form">
<?php echo $this->Form->create('Task', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Add Task'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('dateoftask',array('type' => 'text','id' => 'datepicker1','label' => 'Date Of Task'));
		echo $this->Form->input('done',array('wrapInput' => 'col col-md-9 col-md-offset-3','label' => 'Done','class' => false));
	?>
	<div class="col col-md-9 col-md-offset-3">
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
			<button type="reset" class="btn btn-default">Cancel</button>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tasks'), array('action' => 'index')); ?></li>
	</ul>
</div>
