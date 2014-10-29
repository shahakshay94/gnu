<!DOCTYPE html>
<html lang="en">
  <head>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	<?php
		echo $this->Html->meta('icon');
	?>

  	<!-- Latest compiled and minified CSS -->
  	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/css/bootstrap-glyphicons.css">

  	<!-- Latest compiled and minified JavaScript -->
  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    
  <?php
    echo $this->Html->script('fade');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');  
  ?>
  </head>
  <body>
    <div class="row" style="width:100%;">
      <div class="span4">
        <?php if($this->Session->check('Auth.User.id'))
        {
         echo $this->Element('navigation');
        }
        else
        {
          echo $this->Element('login');          
        }
         ?>
       </div>
    </div>
    
    <div class="container">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
    </div>
  </body>
</html>
