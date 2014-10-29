You requested to reset your password.

Please click on the link to confirm your request:
<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'lost_password', $code), true);?>


Alternativly, you can also insert the code manually on the website:
<?php echo TB; ?>Code: <?php echo TB; ?><?php echo $code;?>


Note:
If you did not request the password change or don't need to anymore, please disregard the email.
