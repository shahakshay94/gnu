<div class="row">
          <div class="col-lg-6">
          <div class="Tasks form">
<h3>Import CSV Section-Company Job Eligibility</h3>
<?php
/* display message saved in session if any */
echo $this->Session->flash();
/* create form with proper enctype */
echo $this->Form->create('CompanyJobEligibilities',array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
));
/* create file input */
echo $this->Form->input('file',array( 'type' => 'file','label' => 'Upload file here','class' => 'well form-horizontal'));
/* create submit button and close form */
?>
<div class="col">
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
			<button type="reset" class="btn btn-default">Cancel</button>
		</div>
<?php
echo $this->Form->end();
?>
</div></div></div>

