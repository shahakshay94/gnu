<?php 
	echo $this->Html->css('TrainingAndPlacement.jquery-ui-1.10.4.custom');
	echo $this->Html->script('TrainingAndPlacement.jquery-ui.min');
	echo $this->Html->script('TrainingAndPlacement.jquery-ui-1.10.4.custom.min');
?>

<script type="text/javascript">
var dateToday = new Date();
	$(function() {
		$( "#datepicker1" ).datepicker({ minDate: dateToday,dateFormat: "dd-mm-yy"});
	});
	$(function() {
		$( "#datepicker2" ).datepicker({ minDate: dateToday,dateFormat: "dd-mm-yy"});
	});
	$(function() {
		$( "#datepicker3" ).datepicker({ minDate: dateToday,dateFormat: "dd-mm-yy"});
	});
	$(function() {
		$( "#datepicker4" ).datepicker({ minDate: dateToday,dateFormat: "dd-mm-yy"});
	});
	$(function() {
		$( "#datepicker5" ).datepicker({ minDate: dateToday,dateFormat: "dd-mm-yy"});
	});

	</script>
	<div class="row">
          <div class="col-lg-6">
	<div class="companyVisits form">
<?php echo $this->Form->create('CompanyVisit', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Edit Company Visit'); ?></legend>
	<?php
		echo $this->Form->input('company_master_id');
		echo $this->Form->input('pptdate',array('type' => 'text','id' => 'datepicker1'));
		echo $this->Form->input('visitdate1',array('type' => 'text','id' => 'datepicker2'));
		echo $this->Form->input('visitdate2',array('type' => 'text','id' => 'datepicker3'));
		echo $this->Form->input('visitdate3',array('type' => 'text','id' => 'datepicker4'));
		echo $this->Form->input('lastdate',array('type' => 'text','id' => 'datepicker5'));
		echo $this->Form->input('placementtype');
		echo $this->Form->input('placementvenue');
	?>
	<div class="col">
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>
