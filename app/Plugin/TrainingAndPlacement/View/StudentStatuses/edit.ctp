<br><br>

<div class="row">
          <div class="col-lg-6">
<div class="Student Statuses form">
<?php echo $this->Form->create('StudentStatus', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Edit Your Training/Job Status'); ?></legend>
	<?php
		echo $this->Form->input('trainingAt', ['placeholder' => 'e.g. company,college,home etc', 'autocomplete' => 'off']);
		echo $this->Form->input('companyname', ['label' => 'Company Name' , 'placeholder' => 'Enter name of company', 'autocomplete' => 'off']);
		echo $this->Form->input('project_title', ['label' => 'Project Title' , 'placeholder' => 'Enter title of your project', 'autocomplete' => 'off']);
		echo $this->Form->input('project', ['label' => 'Project' , 'placeholder' => 'Brief discription about your project', 'type' => 'textarea']);
		echo $this->Form->input('training', ['label' => 'Is training confirm', 
		'wrapInput' => 'col col-md-9 col-md-offset-3',
		'class' => false
	]);
		echo $this->Form->input('job', ['label' => 'Is job confirm', 'class' => 'chk']);
		echo $this->Form->input('post', ['class' => 'txt','label' => 'Designation','placeholder' => 'Your designation if job confirmed', 'autocomplete' => 'off', 'disabled' => 'disabled']);
		echo $this->Form->input('salary', ['class' => 'txt','placeholder' => 'Your salary package', 'autocomplete' => 'off', 'disabled' => 'disabled','label' => 'Salary Package']);
		
	?>
	<div class="col">
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
		
		</div>
	</fieldset>
		<script type="text/javascript">
	$(':checkbox.chk').click(function() {
    $('input.txt:text').attr('disabled',! this.checked)
});
</script>
<?php echo $this->Form->end(); ?>
</div></div>
