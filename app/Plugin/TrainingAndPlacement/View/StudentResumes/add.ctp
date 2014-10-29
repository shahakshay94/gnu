<br><br>

<div class="row">
          <div class="col-lg-6">
<div class="Student Resumes form">
<?php echo $this->Form->create('StudentResume', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); 
?>
	<fieldset>
		<legend><?php echo __('Prepare Your Short Resume'); ?></legend>
	<?php
		echo $this->Form->input('careerobjective', [
			'type'=>'textarea', 
			'label' => 'Your Career Objective',
			'placeholder' => 'Put your career objective in brief',
			'autocomplete' => 'off'
		]);
		echo $this->Form->input('hobbies', [
			'label' => 'Your Hobbies',
			'placeholder' => 'Type your hobbies here',
			'autocomplete' => 'off'
		]);
		echo $this->Form->input('strengths',[
			'placeholder' => 'e.g. Confidence, Positive Thinking etc.',
			'autocomplete' => 'off'
		]);
		echo $this->Form->input('os', [
			'label' => 'Known Operating systems',
			'placeholder' => 'What operating systems you now?',
			'autocomplete' => 'off'
		]);
		echo $this->Form->input('techlanguages', [
			'label' => 'Known Technical Languages',
			'placeholder' => 'Type your technical language stuff',
			'autocomplete' => 'off'
		]);
		echo $this->Form->input('db', [
			'label' => 'Known Databases',
			'placeholder' => 'In which databases you are stronge?',
			'autocomplete' => 'off'
		]);
		echo $this->Form->input('webtechnologies', [
			'label' => 'Known Web Technologies',
			'placeholder' => 'e.g. html,css,js etc.',
			'autocomplete' => 'off'
			]);
		echo $this->Form->input('sw_prog_tools', [
			'label' => 'Known Software programming tools',
			'placeholder' => 'Names of Soft tools or editors',
			'autocomplete' => 'off'
		]);
		echo $this->Form->input('interestedin', [
			'type'=>'textarea',
			'label' => 'Interested In',
			'placeholder' => 'What you are interestedin??',
			'autocomplete' => 'off'
		]);
		echo $this->Form->input('workshops', [
			'type'=>'textarea',
			'placeholder' => 'Have you attended any workshops or contest in past??',
			'autocomplete' => 'off'
		]);
		echo $this->Form->input('seminars', [
			'type'=>'textarea',
			'placeholder' => 'Have you attended any Seminars ??',
			'autocomplete' => 'off'
		]);
		echo $this->Form->input('projectname', [
			'type'=>'textarea',
			'label' => 'Past Projects',
			'placeholder' => 'just list down your past projects',
			'autocomplete' => 'off'
		]);
		
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
