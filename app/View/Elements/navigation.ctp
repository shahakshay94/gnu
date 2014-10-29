<?php echo $this->Html->css('navigation'); ?>
<br>
<div class="navbar navbar-default navbar-static-top" style="background-color:#fff;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <p style="padding-left: 20px;">   <?php echo $this->Html->image('gnulogo.png', array('alt' => 'GNU', 'border' => '0')); ?></p>
        </div>
        <h3 style="padding-left:200px;">Support Ticket System & Training And Placement Module</h3>
      <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><?php echo $this->Html->link(__("Home"),array('plugin'=>false,'controller' => 'users', 'action' => 'dashboard')) ?></li>
        <li class="dropdown menu-large">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Roles<b class="caret"></b></a>        
        <ul class="dropdown-menu megamenu row">
          <li class="col-sm-3">
            <ul>

              <?php if(Auth::hasRoles(['superadmin','developer'])) {?>
              <li class="dropdown-header">Manage Roles</li>
              <li><?php echo $this->Html->link(__("New Role",true),array('plugin'=>false,'controller' => 'roles', 
              'action' => 'add')) ?></li>
              <li><?php echo $this->Html->link(__("View Roles",true),array('plugin'=>false,'controller' => 'roles',
               'action' => 'index'))  ?></li>
              <li class="divider"></li>
              <?php } ?>


              <?php if(Auth::hasRoles(['developer'])) {?>
              <li class="dropdown-header">Manage Super Admins</li>
              <li><?php echo $this->Html->link(__("New Super Admin",true),array('plugin'=>false,'controller' => 'manage_roles', 'action' => 'add_superadmin')) ?></li>
              <li><?php echo $this->Html->link(__("View Super Admins",true),array('plugin'=>false,'controller' => 'manage_roles', 'action' => 'index_superadmin'))  ?></li>
              <li class="divider"></li>
              <?php } ?>


              <?php if(Auth::hasRoles(['superadmin'])) {?>
              <li class="dropdown-header">Manage Admin</li>
              <li><?php echo $this->Html->link(__("New Admin",true),array('plugin'=>false,'controller' => 'manage_roles', 'action' => 'add_admin')) ?></li>
              <?php } ?>

              <?php  if(Auth::hasRoles(['developer'])) {?>
              <li class="dropdown-header">Manage Admin</li>
              <li><?php echo $this->Html->link(__("New Admin",true),array('plugin'=>false,'controller' => 'manage_roles', 'action' => 'add_developer_admin')) ?></li>
              <?php } ?>

              <?php if(Auth::hasRoles(['developer'])) {?>
              <li><?php echo $this->Html->link(__("View Admins",true),array('plugin'=>false,'controller' => 'manage_roles', 'action' => 'index_admin_developer'))  ?></li>
              <li class="divider"></li>
              <?php } ?>
              <?php if(Auth::hasRoles(['superadmin'])) {?>
              <li><?php echo $this->Html->link(__("View Admins",true),array('plugin'=>false,'controller' => 'manage_roles', 'action' => 'index_admin'))  ?></li>
              <li class="divider"></li>
              <?php } ?>



               <?php if(Auth::hasRoles(['developer'])) {?>
              <li class="dropdown-header">Manage Department Coordinator</li>
              <li><?php echo $this->Html->link(__("New Department Coordinator",true),array('plugin'=>false,'controller' => 'manage_roles', 'action' => 'add_developer_deptcoord')) ?></li>
              <?php } ?>

              <?php if(Auth::hasRoles(['superadmin','stadmin'])) {?>
              <li class="dropdown-header">Manage Department Coordinator</li>
              <li><?php echo $this->Html->link(__("New Department Coordinator",true),array('plugin'=>false,'controller' => 'manage_roles', 'action' => 'add_deptcoord')) ?></li>
              <?php } ?>

              <?php if(Auth::hasRoles(['developer','superadmin','stadmin'])) {?>
              <li><?php echo $this->Html->link(__("View Department Coordinator",true),array('plugin'=>false,'controller' => 'manage_roles', 'action' => 'index_deptcoord'))  ?></li>
              <li class="divider"></li>
              <?php } ?>
         
       </div>
    </div>
    </div>