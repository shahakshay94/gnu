
<div class="row">
          <div class="col-lg-4 col-lg-offset-4">
             
                <h2>Login</h2>
           
                
<?php echo $this->Form->create('User', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'label' => false,
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-block'
)); ?>
    <fieldset>
        <legend>
            <font size="3"><?php echo __('Please enter your username and password'); ?></font>
        </legend>
        <?php echo $this->Form->input('username', ['autocomplete'=>'off','placeholder' => 'Username']);
        echo $this->Form->input('password', ['autocomplete'=>'off','placeholder' => 'Password']);
        echo $this->Form->submit('Sign in', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
    ?>
    <?php echo $this->Form->end(); ?>

<?php echo $this->Html->link(__('Forgot Password'), ['controller'=>'users','action' => 'lost_password']); ?>
    </fieldset>

</div></div>
    